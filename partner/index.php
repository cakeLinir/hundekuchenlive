<?php
require_once dirname(__DIR__) . '/assets/php/csrf.php';
$csrfToken = csrf_token();

$page = [
    'title' => 'Partner & Kooperationen | hundekuchenlive',
    'description' => 'Aktuelle Partner, Affiliate-Angebote und Kooperationspakete für Streams, Discord und Website von hundekuchenlive. Jetzt unverbindlich anfragen.',
    'path' => '/partner/',
    'css' => ['pages.css'],
    'body' => 'page',
    'scripts' => ['contact.js'],
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">

    <section class="page-hero">
      <span class="splat ph-a" aria-hidden="true"></span>
      <span class="splat b ph-b" aria-hidden="true"></span>
      <div class="container">
        <p class="kicker">Partner &amp; Kooperationen</p>
        <h1 class="tag-title xl">Lass uns was bauen</h1>
        <p class="lead">Aktuelle Partner, Affiliate-Angebote und Möglichkeiten für Kooperationen. Transparenz, klare Kommunikation und passende Marken stehen im Vordergrund.</p>
      </div>
    </section>

    <section class="section" aria-labelledby="aktive-partner">
      <div class="container">
        <h2 class="tag-title lg" id="aktive-partner">Aktive Partner</h2>
        <p class="sub">Alle Inhalte in diesem Abschnitt sind Werbung.</p>
        <div class="cards-3">
          <article class="s-card c-lime">
            <span class="stamp">Werbung · Affiliate</span>
            <h3>Instant Gaming</h3>
            <p>Günstige Spiele, regelmäßige Aktionen und schnelle digitale Lieferung. Über den Partnerlink unterstützt du mich ohne zusätzliche Kosten. Bei einem Kauf kann eine Provision entstehen.</p>
            <div class="callout" style="border:0;padding:14px 0 0">
              <div class="actions">
                <a class="btn primary" href="https://www.instant-gaming.com/?igr=hundekuchen" target="_blank" rel="nofollow sponsored noopener noreferrer">Zum Shop</a>
                <a class="btn" href="https://www.instant-gaming.com/de/giveaway/instantgamingde?igr=hundekuchen" target="_blank" rel="nofollow sponsored noopener noreferrer">Gewinnspiel</a>
              </div>
            </div>
          </article>
          <article class="s-card c-teal">
            <span class="stamp">Werbung · Kooperation</span>
            <h3>MoneyQuest</h3>
            <p>Finanzberatung für Gamer &amp; Streamer. Von der Starterzone bis zum Endboss, mit klarer Strategie, Quests und persönlicher 1:1-Beratung. Keine Finanzberatung durch hundekuchenlive.</p>
            <div class="callout" style="border:0;padding:14px 0 0">
              <div class="actions">
                <a class="btn primary" href="/money-quest/">MoneyQuest-Quiz</a>
                <a class="btn" href="https://www.money-quest.de/" target="_blank" rel="nofollow sponsored noopener noreferrer">Mehr erfahren</a>
              </div>
            </div>
          </article>
          <article class="s-card c-magenta">
            <h3>Dein Logo hier?</h3>
            <p>Dieser Platz ist frei für den nächsten Sponsor oder Kooperationspartner mit Logo, Beschreibung und Verlinkung.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section" aria-labelledby="pakete">
      <div class="container">
        <h2 class="tag-title lg" id="pakete">Die Pakete</h2>
        <p class="sub">Alle Preise sind unverbindliche Richtwerte und werden individuell abgestimmt.</p>
        <div class="cards-3">
          <article class="s-card c-lime">
            <h3>Starter Shoutout</h3>
            <p>Für kleine Brands und erste Testkampagnen.</p>
            <p class="price">ab ca. 15 €</p>
            <ul>
              <li>Twitch: 1× mündliche Erwähnung pro Stream, Logo und Link im Panel</li>
              <li>Discord: Erwähnung im Partner-Channel</li>
              <li>Website: Logo und Link im Partnerbereich</li>
            </ul>
          </article>
          <article class="s-card c-teal">
            <h3>Community Partner</h3>
            <p>Für Marken, die regelmäßig sichtbar sein wollen.</p>
            <p class="price">ca. 40–80 €/Monat</p>
            <ul>
              <li>Twitch: fester Overlay-Slot, 1–2 Werbe-Statements, Verlinkung in Panels</li>
              <li>Discord: gepinnter Post, wöchentlicher Reminder</li>
              <li>Website: Logo, Beschreibung und Link, optional Vorstellung</li>
            </ul>
          </article>
          <article class="s-card c-magenta">
            <h3>Main Sponsor</h3>
            <p>Für Hauptpartner mit klarer Sichtbarkeit.</p>
            <p class="price">ca. 100–200 €/Monat</p>
            <ul>
              <li>Twitch: „Präsentiert von“, prominentes Overlay, Start- und Endscreen, 1× Spot pro Stream</li>
              <li>Discord: eigener Bereich, regelmäßige Aktionsposts, Nennung als Hauptpartner</li>
              <li>Website: Top-Placement, optional eigene Unterseite, Add-ons wie Gewinnspiele und Rabattcodes</li>
            </ul>
          </article>
        </div>
      </div>
    </section>

    <section class="section" aria-labelledby="kontakt-anfragen">
      <div class="container">
        <h2 class="tag-title lg" id="kontakt-anfragen">Anfrage senden</h2>
        <p class="sub">Oder direkt per Mail: <a class="text-link" href="mailto:business@hundekuchenlive.de">business@hundekuchenlive.de</a>. Seriöse und thematisch passende Anfragen werden bevorzugt berücksichtigt.</p>

        <div class="contact-layout">

          <aside class="package-preview" aria-live="polite">
            <h3 class="package-preview-title">Paket-Details</h3>
            <div class="package-preview-body" id="package-preview-body">
              <h4>Noch unentschlossen / individuelles Angebot</h4>
              <p>Schreib kurz, was du dir vorstellst: Budget, Ziele und Plattformen. Du bekommst ein individuelles Angebot.</p>
            </div>
          </aside>

          <div class="contact-form-card">
            <form class="contact-form" action="/assets/php/kontakt-submit.php" method="post">

              <div class="form-row">
                <div class="form-field">
                  <label for="contact-name">Name*</label>
                  <input type="text" id="contact-name" name="name" required aria-required="true" autocomplete="name" maxlength="150">
                </div>
                <div class="form-field">
                  <label for="contact-email">E-Mail*</label>
                  <input type="email" id="contact-email" name="email" required aria-required="true" autocomplete="email" maxlength="200">
                </div>
              </div>

              <div class="form-field">
                <label for="contact-subject">Betreff</label>
                <input type="text" id="contact-subject" name="subject" autocomplete="off" maxlength="200">
              </div>

              <div class="form-field">
                <label for="contact-package">Gewünschtes Paket</label>
                <select id="contact-package" name="package">
                  <option value="">Noch unentschlossen / individuelles Angebot</option>
                  <option value="Starter Shoutout (Paket 1)">Starter Shoutout (Paket 1)</option>
                  <option value="Community Partner (Paket 2)">Community Partner (Paket 2)</option>
                  <option value="Main Sponsor (Paket 3)">Main Sponsor (Paket 3)</option>
                </select>
              </div>

              <div class="form-field">
                <label for="contact-message">Nachricht*</label>
                <textarea id="contact-message" name="message" rows="6" required aria-required="true" maxlength="5000"></textarea>
              </div>

              <div class="form-field form-honeypot" aria-hidden="true">
                <label for="contact-website">Bitte dieses Feld leer lassen</label>
                <input type="text" id="contact-website" name="website" autocomplete="off" tabindex="-1">
              </div>

              <input type="hidden" name="form_token" value="<?= e($csrfToken) ?>">

              <div class="form-actions">
                <button type="submit" class="btn primary lg">Anfrage senden</button>
              </div>

              <p class="form-hint">Deine Angaben werden nur zur Bearbeitung deiner Anfrage verwendet. Details zu Verarbeitung, Speicherdauer und Empfängern findest du in der <a class="text-link" href="/datenschutz/#partnerformular">Datenschutzerklärung</a>.</p>
            </form>
          </div>

        </div>
      </div>
    </section>

  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
