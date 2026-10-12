<?php
// Zentraler Config-Loader.
// 1) config.local.php (lokal oder auf dem Server) wird geladen, falls vorhanden.
//    Sie darf Konstanten per define() setzen ODER Werte per putenv() bereitstellen.
// 2) Alles, was danach noch fehlt, kommt aus Umgebungsvariablen bzw. Standardwerten.
declare(strict_types=1);

$hklLocalConfig = __DIR__ . '/config.local.php';
if (is_file($hklLocalConfig)) {
    require_once $hklLocalConfig;
}
unset($hklLocalConfig);

$hklEnv = static function (string $key, string $default = ''): string {
    $value = getenv($key);
    return ($value === false || $value === '') ? $default : $value;
};

if (!defined('SMTP_HOST')) {
    define('SMTP_HOST', $hklEnv('SMTP_HOST', 'smtp.ionos.de'));
}
if (!defined('SMTP_USER')) {
    define('SMTP_USER', $hklEnv('SMTP_USER'));
}
if (!defined('SMTP_PASS')) {
    define('SMTP_PASS', $hklEnv('SMTP_PASS'));
}
if (!defined('SMTP_PORT')) {
    define('SMTP_PORT', (int) $hklEnv('SMTP_PORT', '587'));
}
if (!defined('TWITCH_CLIENT_ID')) {
    define('TWITCH_CLIENT_ID', $hklEnv('TWITCH_CLIENT_ID'));
}
if (!defined('TWITCH_CLIENT_SECRET')) {
    define('TWITCH_CLIENT_SECRET', $hklEnv('TWITCH_CLIENT_SECRET'));
}

unset($hklEnv);
