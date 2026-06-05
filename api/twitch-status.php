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

try {
    // 1. App Access Token holen
    $tokenResponse = http_post('https://id.twitch.tv/oauth2/token', [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials'
    ]);

    $tokenData = json_decode($tokenResponse, true);
    if (!isset($tokenData['access_token'])) {
        throw new Exception('No access token returned by Twitch.');
    }

    $accessToken = $tokenData['access_token'];

    // 2. Streamstatus abfragen
    $streamResponse = http_get(
        'https://api.twitch.tv/helix/streams?user_login=' . urlencode($userLogin),
        [
            'Client-ID: ' . $clientId,
            'Authorization: Bearer ' . $accessToken
        ]
    );

    $streamData = json_decode($streamResponse, true);

    if (!isset($streamData['data'])) {
        throw new Exception('Unexpected Twitch API response.');
    }

    if (count($streamData['data']) > 0) {
        $stream = $streamData['data'][0];

        echo json_encode([
            'live' => true,
            'title' => $stream['title'] ?? '',
            'game_name' => $stream['game_name'] ?? '',
            'viewer_count' => $stream['viewer_count'] ?? 0,
            'started_at' => $stream['started_at'] ?? null
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode([
            'live' => false
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'live' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}