<?php
// assets/php/csrf.php
declare(strict_types=1);

/**
 * Erkennt, ob die aktuelle Anfrage über HTTPS läuft
 * (auch hinter einem Proxy mit X-Forwarded-Proto).
 */
function csrf_is_https(): bool
{
    $https = strtolower((string) ($_SERVER['HTTPS'] ?? ''));
    if ($https !== '' && $https !== 'off') {
        return true;
    }
    if ((string) ($_SERVER['SERVER_PORT'] ?? '') === '443') {
        return true;
    }
    return strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https';
}

/**
 * Startet die Session sicher (falls noch nicht gestartet).
 */
function csrf_start_session(): void
{
    if (session_status() !== PHP_SESSION_NONE) {
        return;
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => csrf_is_https(), // Secure nur über HTTPS, damit lokales Testen funktioniert
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/**
 * Erzeugt (falls nötig) ein CSRF-Token und gibt es zurück.
 */
function csrf_token(): string
{
    csrf_start_session();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Prüft ein übergebenes Token timing-safe gegen das Session-Token.
 * Das Token wird nicht invalidiert, damit ein Retry nach Netzwerkfehler funktioniert.
 */
function csrf_verify(?string $token): bool
{
    csrf_start_session();
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
