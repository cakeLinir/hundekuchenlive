<?php
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../config.php';

$clientId = TWITCH_CLIENT_ID;
$clientSecret = TWITCH_CLIENT_SECRET;
$userLogin = 'hundekuchenlive';

function http_post($url, $postFields) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($postFields),
        CURLOPT_TIMEOUT => 15,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        throw new Exception('POST request failed: ' . $error);
    }
    if ($httpCode < 200 || $httpCode >= 300) {
        throw new Exception('POST request returned HTTP ' . $httpCode . ': ' . $response);
    }
    return $response;
}

function http_get($url, $headers = []) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 15,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        throw new Exception('GET request failed: ' . $error);
    }
    if ($httpCode < 200 || $httpCode >= 300) {
        throw new Exception('GET request returned HTTP ' . $httpCode . ': ' . $response);
    }
    return $response;
}

// Returns a cached app access token, fetching a new one only when expired.
function getAccessToken(string $clientId, string $clientSecret): string {
    $cacheFile = sys_get_temp_dir() . '/hkl_twitch_token.json';

    if (file_exists($cacheFile)) {
        $cached = json_decode((string) file_get_contents($cacheFile), true);
        // Keep using the cached token until 5 minutes before expiry
        if (isset($cached['token'], $cached['expires_at']) && $cached['expires_at'] > time() + 300) {
            return $cached['token'];
        }
    }

    $data = json_decode(http_post('https://id.twitch.tv/oauth2/token', [
        'client_id'     => $clientId,
        'client_secret' => $clientSecret,
        'grant_type'    => 'client_credentials',
    ]), true);

    if (!isset($data['access_token'])) {
        throw new Exception('No access token returned by Twitch.');
    }

    file_put_contents($cacheFile, json_encode([
        'token'      => $data['access_token'],
        'expires_at' => time() + ($data['expires_in'] ?? 3600),
    ]));

    return $data['access_token'];
}

try {
    $accessToken = getAccessToken($clientId, $clientSecret);

    $streamResponse = http_get(
        'https://api.twitch.tv/helix/streams?user_login=' . urlencode($userLogin),
        [
            'Client-ID: ' . $clientId,
            'Authorization: Bearer ' . $accessToken,
        ]
    );

    $streamData = json_decode($streamResponse, true);

    if (!isset($streamData['data'])) {
        throw new Exception('Unexpected Twitch API response.');
    }

    if (count($streamData['data']) > 0) {
        $stream = $streamData['data'][0];
        echo json_encode([
            'live'         => true,
            'title'        => $stream['title'] ?? '',
            'game_name'    => $stream['game_name'] ?? '',
            'viewer_count' => $stream['viewer_count'] ?? 0,
            'started_at'   => $stream['started_at'] ?? null,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(['live' => false], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'live'  => false,
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
