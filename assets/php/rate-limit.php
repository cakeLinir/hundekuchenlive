<?php
// assets/php/rate-limit.php
declare(strict_types=1);

/**
 * Einfaches, dateibasiertes Rate-Limiting pro IP-Adresse.
 *
 * Regeln:
 *  - Mindestabstand zwischen zwei Anfragen: 15 Sekunden
 *  - Max. 5 Anfragen pro 10 Minuten
 *  - Max. 15 Anfragen pro 24 Stunden
 *
 * Gibt true zurück, wenn die Anfrage erlaubt ist, sonst false.
 */
function rate_limit_check(string $identifier, string $bucket = 'contact_form'): bool
{
    $dir = sys_get_temp_dir() . '/hkl_ratelimit';
    if (!is_dir($dir)) {
        mkdir($dir, 0700, true);
    }

    // Dateiname aus Bucket + gehashter IP (kein Klartext auf der Platte)
    $safeId = hash('sha256', $identifier);
    $file = $dir . '/' . $bucket . '_' . $safeId . '.json';

    $fp = fopen($file, 'c+');
    if ($fp === false) {
        // Wenn Locking/Datei fehlschlägt: im Zweifel nicht blockieren,
        // aber loggen, damit man es merkt.
        error_log('Rate-Limit: Konnte Datei nicht öffnen: ' . $file);
        return true;
    }

    flock($fp, LOCK_EX);

    $raw = stream_get_contents($fp);
    $data = json_decode((string) $raw, true);
    if (!is_array($data) || !isset($data['hits'])) {
        $data = ['hits' => []];
    }

    $now = time();

    // Alte Einträge (älter als 24h) rauswerfen
    $data['hits'] = array_values(array_filter(
        $data['hits'],
        static fn($ts) => $ts > $now - 86400
    ));

    $lastHit = $data['hits'] ? max($data['hits']) : 0;
    $hitsLast10Min = count(array_filter($data['hits'], static fn($ts) => $ts > $now - 600));
    $hitsLast24h = count($data['hits']);

    $allowed = true;
    if ($now - $lastHit < 15) {
        $allowed = false; // zu schnell hintereinander
    } elseif ($hitsLast10Min >= 5) {
        $allowed = false; // zu viele in kurzer Zeit
    } elseif ($hitsLast24h >= 15) {
        $allowed = false; // Tageslimit erreicht
    }

    if ($allowed) {
        $data['hits'][] = $now;
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($data));
        fflush($fp);
    }

    flock($fp, LOCK_UN);
    fclose($fp);

    return $allowed;
}

/**
 * Ermittelt die Client-IP möglichst zuverlässig.
 * Falls ihr hinter einem Reverse-Proxy/Load-Balancer lauft, muesst ihr
 * X-Forwarded-For serverseitig entsprechend konfigurieren/validieren.
 */
function rate_limit_client_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}
