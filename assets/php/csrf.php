<?php
// assets/php/csrf.php
declare(strict_types=1);

/**
 * Startet die Session sicher (falls noch nicht gestartet) und
 * stellt Helper-Funktionen für CSRF-Tokens bereit.
 */
function csrf_start_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => true,      // nur über HTTPS senden
            'httponly' => true,    // kein JS-Zugriff auf das Cookie
            'samesite' => 'Lax',
        ]);
        session_start();
    }
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
 * Prüft ein übergebenes Token gegen das Session-Token.
 * Nutzt timing-safe Vergleich. Invalidiert das Token NICHT automatisch,
 * damit z. B. ein Retry nach Netzwerkfehler noch funktioniert.
 */
function csrf_verify(?string $token): bool
{
    csrf_start_session();
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
