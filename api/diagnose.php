<?php
declare(strict_types=1);
header('Content-Type: text/plain; charset=utf-8');

$root = dirname(__DIR__);

// Datei => Merkmal, das nur in der neuen Version vorkommt (null = nur Existenz prüfen)
$expected = [
    'index.php' => 'hero-x',
    '404.php' => 'nf-code',
    '.htaccess' => 'ErrorDocument 404 /404.php',
    'robots.txt' => 'Disallow: /api/',
    'sitemap.xml' => 'lastmod',
    'config.php' => 'hklEnv',
    'api/twitch-status.php' => 'StatusException',
    'components/head.php' => 'effects.css',
    'components/header.php' => 'navItems',
    'components/footer.php' => 'footer-claim',
    'components/foot.php' => 'action-bar',
    'assets/css/style.css' => 'Design-System',
    'assets/css/home.css' => 'poster',
    'assets/css/pages.css' => 'page-hero',
    'assets/css/effects.css' => 'scroll-progress',
    'assets/js/site.js' => 'initMobileNav',
    'assets/js/theme.js' => 'layout:loaded',
    'assets/js/consent-settings.js' => 'KEY_MARKETING',
    'assets/js/effects.js' => 'scroll-progress',
    'assets/js/home.js' => 'berlinNow',
    'assets/js/spray.js' => 'spray-canvas',
    'assets/js/quiz-data.js' => 'HKL_QUIZ',
    'assets/js/quiz.js' => 'CATEGORIES',
    'assets/js/twitch-status.js' => 'twitch:status',
    'assets/php/csrf.php' => 'csrf_is_https',
    'assets/php/kontakt-submit.php' => 'read_field',
    'about/index.php' => 'Hi, ich bin Justin',
    'streamingplan/index.php' => 'board-row',
    'partner/index.php' => 'package-preview',
    'spenden/index.php' => 'streamelements.com',
    'cloud/index.php' => 'Creator-Cloud',
    'money-quest/index.php' => 'mini-quiz-category',
    'impressum/index.php' => 'DE460826126-00001',
    'datenschutz/index.php' => 'legal-toc',
    'assets/img/hkl-logo.jpg' => null,
    'assets/img/splat-a.svg' => null,
    'assets/img/splat-b.svg' => null,
    'assets/img/drips.svg' => null,
    'assets/img/og-image.jpg' => null,
];

// Alte Dateien, die gelöscht werden sollen
$obsolete = [
    'index.html', '404.html',
    'about/index.html', 'streamingplan/index.html', 'cloud/index.html',
    'spenden/index.html', 'impressum/index.html', 'datenschutz/index.html',
    'money-quest/index.html',
    'components/header.html', 'components/footer.html',
    'assets/js/layout.js', 'assets/js/spenden.js', 'assets/img/sonic.png',
];

$problems = 0;
echo "== Dateien ==\n";
foreach ($expected as $file => $marker) {
    $path = $root . '/' . $file;
    if (!is_file($path)) {
        echo "[FEHLT] $file\n";
        $problems++;
        continue;
    }
    if ($marker !== null && strpos((string) @file_get_contents($path), $marker) === false) {
        echo "[ALT]   $file (neue Version fehlt)\n";
        $problems++;
        continue;
    }
    echo "[ok]    $file\n";
}

echo "\n== Alte Dateien (bitte löschen) ==\n";
$found = 0;
foreach ($obsolete as $file) {
    if (is_file($root . '/' . $file)) {
        echo "[LÖSCHEN] $file\n";
        $found++;
    }
}
if ($found === 0) {
    echo "keine\n";
}

echo "\n== Umgebung ==\n";
echo 'PHP-Version:              ' . PHP_VERSION . "\n";
echo 'cURL verfügbar:           ' . (function_exists('curl_init') ? 'ja' : 'NEIN') . "\n";
echo 'Temp-Ordner beschreibbar: ' . (is_writable(sys_get_temp_dir()) ? 'ja' : 'NEIN') . "\n";
echo 'config.local.php:         ' . (is_file($root . '/config.local.php') ? 'vorhanden' : 'FEHLT') . "\n";

echo "\nProbleme: $problems, alte Dateien: $found\n";
