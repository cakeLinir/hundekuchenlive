<?php
if (!defined('TIP_URL')) {
    define('TIP_URL', 'https://streamelements.com/hundekuchenlive/tip');
}

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$navItems = [
    ['/', 'Start'],
    ['/about/', 'Über mich'],
    ['/streamingplan/', 'Streamplan'],
    ['/partner/', 'Partner'],
];
?>
  <header id="site-header" role="banner">
    <div class="container">
      <div class="navbar">

        <a class="brand" href="/" aria-label="hundekuchenlive – Startseite">
          <span class="brand-mark"><img src="/assets/img/hkl-logo.jpg" alt="" width="48" height="48" decoding="async"></span>
          <span class="brand-word">Hundekuchen<span class="brand-live">Live</span></span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Menü öffnen" aria-expanded="false"
          aria-controls="site-nav"><span aria-hidden="true">☰</span></button>

        <nav id="site-nav" aria-label="Hauptnavigation">
<?php foreach ($navItems as [$href, $label]):
    $active = $href === '/' ? $currentPath === '/' : strpos($currentPath, $href) === 0; ?>
          <a href="<?= $href ?>"<?= $active ? ' aria-current="page"' : '' ?>><?= $label ?></a>
<?php endforeach; ?>
          <a href="<?= e(TIP_URL) ?>" target="_blank" rel="noopener noreferrer">Support ↗</a>
          <a href="https://shop.hundekuchenlive.de/" target="_blank" rel="noopener noreferrer">Merch ↗</a>
        </nav>

        <a class="btn primary header-cta" href="https://twitch.tv/hundekuchenlive" target="_blank"
          rel="noopener noreferrer">Live auf Twitch</a>

      </div>
    </div>
  </header>
