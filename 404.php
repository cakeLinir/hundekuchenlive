<?php
http_response_code(404);
$page = [
    'title' => 'Seite nicht gefunden | hundekuchenlive',
    'description' => 'Diese Seite gibt es nicht.',
    'path' => '/',
    'robots' => 'noindex,nofollow',
    'css' => ['pages.css'],
    'body' => 'page',
];
require __DIR__ . '/components/head.php';
?>

  <main id="main">
    <section class="nf">
      <span class="splat nf-sp-a" aria-hidden="true"></span>
      <div class="container">
        <h1 class="tag-title nf-code">404</h1>
        <p>Hier ist nur eine leere Wand. Der Link ist falsch, veraltet oder die Seite wurde verschoben.</p>
        <div class="actions">
          <a class="btn primary lg" href="/">Zur Startseite</a>
          <a class="btn lg" href="/partner/">Kontakt aufnehmen</a>
        </div>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/components/foot.php'; ?>
