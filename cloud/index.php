<?php
$page = [
    'title' => 'Creator-Cloud | hundekuchenlive',
    'description' => 'Geschützter Cloud-Bereich von hundekuchenlive für Rohmaterial, Schnittprojekte und fertige Videos. Zugang nur für berechtigte Personen.',
    'path' => '/cloud/',
    'robots' => 'noindex,nofollow',
    'css' => ['pages.css'],
    'body' => 'page',
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">

    <section class="page-hero">
      <span class="splat ph-a" aria-hidden="true"></span>
      <span class="splat b ph-b" aria-hidden="true"></span>
      <div class="container">
        <p class="kicker">Nur für die Crew</p>
        <h1 class="tag-title xl">Creator-Cloud</h1>
        <p class="lead">Der geschützte Austauschbereich für Rohmaterial, Schnittprojekte und fertige Videos. Große Dateien strukturiert bereitstellen und bearbeitete Inhalte sicher zurückgeben.</p>
        <p style="margin-top:22px"><a class="btn primary lg" href="https://cloud.hundekuchenlive.de/" target="_blank" rel="noopener noreferrer">Cloud öffnen</a></p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Der Workflow</h2>
        <p class="sub">Für den Austausch zwischen hundekuchenlive und berechtigten Projektbeteiligten.</p>
        <div class="steps">
          <article class="step"><h3>Rohmaterial bereitstellen</h3><p>Streammitschnitte, Rohclips oder Projektdateien werden in der Cloud strukturiert abgelegt.</p></article>
          <article class="step"><h3>Schnitt &amp; Bearbeitung</h3><p>Berechtigte Personen laden das benötigte Material herunter und verwenden es für den Videoschnitt.</p></article>
          <article class="step"><h3>Fertige Videos zurück</h3><p>Fertige Clips, Schnittfassungen oder Exportdateien werden über die Cloud zurückgegeben.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Sicherheit &amp; Zugriff</h2>
        <p class="sub">Die Cloud ist kein öffentlicher Uploadbereich, sondern ein geschützter Arbeitsbereich.</p>
        <div class="cards-3">
          <article class="s-card c-lime"><h3>Geschützter Zugang</h3><p>Zugriff erhalten nur berechtigte Personen. Öffentliche Uploads ohne Freigabe sind nicht vorgesehen.</p></article>
          <article class="s-card c-teal"><h3>Projektbezogen</h3><p>Die Cloud dient dem Austausch von Material für Content-Produktion, Videoschnitt und Projektarbeit.</p></article>
          <article class="s-card c-magenta"><h3>Keine Website-Uploads</h3><p>Uploads laufen nicht über diese Website, sondern direkt über die geschützte Cloud-Oberfläche.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="callout">
          <h2>Zugriff nötig?</h2>
          <p>Inhalte dürfen nur für den vorgesehenen Projektzweck verwendet werden. Wenn du Zugriff brauchst oder ein bestehender Zugriff nicht funktioniert, melde dich direkt. Hinweise zur Datenverarbeitung stehen in der <a class="text-link" href="/datenschutz/#cloud">Datenschutzerklärung</a>.</p>
          <div class="actions">
            <a class="btn primary" href="https://cloud.hundekuchenlive.de/" target="_blank" rel="noopener noreferrer">Zur Nextcloud</a>
            <a class="btn" href="mailto:business@hundekuchenlive.de">Kontakt aufnehmen</a>
          </div>
        </div>
      </div>
    </section>

  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
