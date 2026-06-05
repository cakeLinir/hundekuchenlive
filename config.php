<?php
// Central config loader — loads config.local.php if present (local dev),
// otherwise falls back to server environment variables (production).
declare(strict_types=1);

$_localConfig = __DIR__ . '/config.local.php';
if (file_exists($_localConfig)) {
    require $_localConfig;
}
unset($_localConfig);

define('SMTP_HOST',            getenv('SMTP_HOST')            ?: 'smtp.ionos.de');
define('SMTP_USER',            getenv('SMTP_USER')            ?: '');
define('SMTP_PASS',            getenv('SMTP_PASS')            ?: '');
define('SMTP_PORT',      (int)(getenv('SMTP_PORT')            ?: 587));
define('TWITCH_CLIENT_ID',     getenv('TWITCH_CLIENT_ID')     ?: '');
define('TWITCH_CLIENT_SECRET', getenv('TWITCH_CLIENT_SECRET') ?: '');
