<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

const TWITCH_USER_LOGIN = 'hundekuchenlive';
const STATUS_TTL = 45;          // Sekunden: so lange gilt eine gecachte Antwort
const STATUS_STALE_MAX = 600;   // Sekunden: Fallback bei Twitch-Fehlern

/** Fehler mit kurzem, geheimnisfreiem Grund-Code */
class StatusException extends RuntimeException
{
    private $reason;

    public function __construct(string $reason, string $message)
    {
        parent::__construct($message);
        $this->reason = $reason;
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}

function json_out(array $payload, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function cache_path(string $name): string
{
    return sys_get_temp_dir() . '/hkl_' . $name . '.json';
}

function cache_read(string $name): ?array
{
    $file = cache_path($name);
    if (!is_file($file)) {
        return null;
    }
    $data = json_decode((string) @file_get_contents($file), true);
    return is_array($data) ? $data : null;
}

function cache_write(string $name, array $data): void
{
    $file = cache_path($name);
    if (@file_put_contents($file, json_encode($data), LOCK_EX) === false) {
        error_log('Twitch-Cache: Konnte Datei nicht schreiben: ' . $file);
        return;
    }
    @chmod($file, 0600);
}

/** @return array{0:int,1:string} [HTTP-Code, Body] */
function http_request(string $method, string $url, array $headers = [], array $postFields = []): array
{
    if (!function_exists('curl_init')) {
        throw new StatusException('curl_missing', 'PHP-cURL ist nicht verfügbar.');
    }

    $ch = curl_init($url);
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 8,
        CURLOPT_HTTPHEADER => $headers,
    ];
    if ($method === 'POST') {
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = http_build_query($postFields);
    }
    curl_setopt_array($ch, $options);

    $body = curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    if ($body === false) {
        throw new StatusException('network', $method . ' fehlgeschlagen: ' . $error);
    }
    return [$code, (string) $body];
}

// Liefert ein gecachtes App-Token; holt nur bei Ablauf (oder erzwungen) ein neues.
function get_access_token(string $clientId, string $clientSecret, bool $forceRefresh = false): string
{
    if (!$forceRefresh) {
        $cached = cache_read('twitch_token');
        if ($cached && isset($cached['token'], $cached['expires_at']) && (int) $cached['expires_at'] > time() + 300) {
            return (string) $cached['token'];
        }
    }

    [$code, $body] = http_request('POST', 'https://id.twitch.tv/oauth2/token', [], [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials',
    ]);

    if ($code < 200 || $code >= 300) {
        throw new StatusException('token_http_' . $code, 'Token-Anfrage lieferte HTTP ' . $code);
    }

    $data = json_decode($body, true);
    if (!is_array($data) || empty($data['access_token'])) {
        throw new StatusException('token_missing', 'Twitch hat kein Access-Token geliefert.');
    }

    cache_write('twitch_token', [
        'token' => $data['access_token'],
        'expires_at' => time() + (int) ($data['expires_in'] ?? 3600),
    ]);

    return (string) $data['access_token'];
}

// Ruft den Stream-Status ab; bei 401 wird einmal ein neues Token geholt.
function fetch_stream(string $clientId, string $clientSecret): array
{
    for ($attempt = 0; $attempt < 2; $attempt++) {
        $token = get_access_token($clientId, $clientSecret, $attempt > 0);

        [$code, $body] = http_request(
            'GET',
            'https://api.twitch.tv/helix/streams?user_login=' . urlencode(TWITCH_USER_LOGIN),
            [
                'Client-ID: ' . $clientId,
                'Authorization: Bearer ' . $token,
            ]
        );

        if ($code === 401 && $attempt === 0) {
            continue;
        }
        if ($code < 200 || $code >= 300) {
            throw new StatusException('helix_http_' . $code, 'Helix lieferte HTTP ' . $code);
        }

        $data = json_decode($body, true);
        if (!is_array($data) || !isset($data['data']) || !is_array($data['data'])) {
            throw new StatusException('unexpected_response', 'Unerwartete Antwort der Twitch-API.');
        }
        return $data['data'];
    }

    throw new StatusException('auth_failed', 'Twitch-Authentifizierung fehlgeschlagen.');
}

// ---- Ablauf ----------------------------------------------------------------

require __DIR__ . '/../config.php';

$cached = cache_read('twitch_status');
$now = time();

// Frische gecachte Antwort sofort ausliefern
if ($cached && isset($cached['fetched_at'], $cached['payload']) && ($now - (int) $cached['fetched_at']) < STATUS_TTL) {
    json_out($cached['payload']);
}

try {
    if (
        !defined('TWITCH_CLIENT_ID') || !defined('TWITCH_CLIENT_SECRET') ||
        TWITCH_CLIENT_ID === '' || TWITCH_CLIENT_SECRET === ''
    ) {
        throw new StatusException('config', 'Twitch-Zugangsdaten fehlen in der Konfiguration.');
    }

    $streams = fetch_stream(TWITCH_CLIENT_ID, TWITCH_CLIENT_SECRET);

    if (count($streams) > 0) {
        $stream = $streams[0];
        $payload = [
            'live' => true,
            'title' => $stream['title'] ?? '',
            'game_name' => $stream['game_name'] ?? '',
            'viewer_count' => (int) ($stream['viewer_count'] ?? 0),
            'started_at' => $stream['started_at'] ?? null,
        ];
    } else {
        $payload = ['live' => false];
    }

    cache_write('twitch_status', ['fetched_at' => $now, 'payload' => $payload]);
    json_out($payload);
} catch (Throwable $e) {
    $reason = $e instanceof StatusException ? $e->getReason() : 'unexpected';
    error_log('Twitch-Status-Fehler [' . $reason . ']: ' . $e->getMessage());

    // Bei Twitch-Problemen kurz den letzten bekannten Status weiterverwenden
    if ($cached && isset($cached['fetched_at'], $cached['payload']) && ($now - (int) $cached['fetched_at']) < STATUS_STALE_MAX) {
        json_out($cached['payload']);
    }

    json_out(['live' => false, 'error' => 'Status derzeit nicht verfügbar.', 'reason' => $reason], 500);
}
