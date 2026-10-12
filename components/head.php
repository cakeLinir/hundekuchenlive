<?php
declare(strict_types=1);

if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

// Hängt die Änderungszeit der Datei an die URL, damit nach Uploads nie alte Versionen aus dem Cache kommen
if (!function_exists('asset_url')) {
    function asset_url(string $path): string
    {
        $file = dirname(__DIR__) . $path;
        $version = is_file($file) ? (int) filemtime($file) : 0;
        return $path . ($version > 0 ? '?v=' . $version : '');
    }
}

$page = $page ?? [];
$siteUrl = 'https://hundekuchenlive.de';
$title = $page['title'] ?? 'hundekuchenlive – Willkommen in Los Santos';
$description = $page['description'] ?? 'Live auf Twitch: GTA RP, Valorant und Satisfactory mit hundekuchenlive.';
$path = $page['path'] ?? '/';
$robots = $page['robots'] ?? 'index,follow';
$styles = array_merge(['style.css'], $page['css'] ?? [], ['effects.css']);
$ogImage = $siteUrl . '/assets/img/og-image.jpg';
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    (() => {
      document.documentElement.classList.add("js");
      try {
        const theme = localStorage.getItem("hkl-theme");
        const safeTheme = theme === "light" ? "light" : "dark";
        document.documentElement.setAttribute("data-theme", safeTheme);
        document.documentElement.style.colorScheme = safeTheme;
      } catch (error) {
        document.documentElement.setAttribute("data-theme", "dark");
        document.documentElement.style.colorScheme = "dark";
      }
    })();
  </script>
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($description) ?>">
  <meta name="robots" content="<?= e($robots) ?>">
  <link rel="canonical" href="<?= e($siteUrl . $path) ?>">

  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($description) ?>">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="de_DE">
  <meta property="og:url" content="<?= e($siteUrl . $path) ?>">
  <meta property="og:image" content="<?= e($ogImage) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($title) ?>">
  <meta name="twitter:description" content="<?= e($description) ?>">
  <meta name="twitter:image" content="<?= e($ogImage) ?>">

<?php foreach ($styles as $css): ?>
  <link rel="stylesheet" href="<?= e(asset_url('/assets/css/' . $css)) ?>">
<?php endforeach; ?>
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
  <link rel="apple-touch-icon" href="/assets/img/favicon.png">
<?php if (!empty($page['jsonld'])): ?>
  <script type="application/ld+json"><?= $page['jsonld'] ?></script>
<?php endif; ?>
</head>

<body class="<?= e($page['body'] ?? '') ?>">
  <a class="skip-link" href="#main">Direkt zum Inhalt springen</a>
<?php require __DIR__ . '/header.php'; ?>
