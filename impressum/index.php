<?php
// Optional: Telefonnummer eintragen, z. B. '+49 5831 123456'. Leer lassen = wird nicht angezeigt.
$phone = '';

$page = [
    'title' => 'Impressum | hundekuchenlive',
    'description' => 'Impressum und Anbieterkennzeichnung von hundekuchenlive (Justin Barth).',
    'path' => '/impressum/',
    'css' => ['pages.css'],
    'body' => 'page',
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">
    <div class="container legal">
      <h1 class="tag-title xl">Impressum</h1>
      <p>Anbieterkennzeichnung nach § 5 DDG und weitere rechtliche Hinweise zu diesem Online-Auftritt.</p>

      <h2>Anbieter</h2>
      <address>
        Justin Barth<br>
        Einzelunternehmen, Online-Auftritt: hundekuchenlive<br>
        Gewerbliche Tätigkeit: Erstellung und Vermarktung digitaler Inhalte (Livestreaming / Content Creation)
      </address>

      <h2>Ladungsfähige Anschrift</h2>
      <address>
        Justin Barth<br>
        c/o Impressum4u – LEADERLY UG (haftungsbeschränkt)<br>
        Amtstraße 22<br>
        44575 Castrop-Rauxel<br>
        Deutschland
      </address>
      <p>Zustellungen können unter dieser Anschrift rechtswirksam erfolgen.</p>

      <h2>Kontakt und schnelle Kontaktaufnahme</h2>
      <p>
        E-Mail: <a href="mailto:hundekuchenlive@impressum4u.de">hundekuchenlive@impressum4u.de</a><br>
<?php if ($phone !== ''): ?>
        Telefon: <a href="tel:<?= e((string) preg_replace('/[^+0-9]/', '', $phone)) ?>"><?= e($phone) ?></a><br>
<?php endif; ?>
        Kontaktformular für direkte Anfragen: <a href="/partner/#kontakt-anfragen">hundekuchenlive.de/partner/ – Formular „Anfrage senden“</a><br>
        Discord-Server: <a href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">discord.gg/WfTbuyhXcJ</a><br>
        Kooperationen &amp; Partnerschaften: <a href="mailto:business@hundekuchenlive.de">business@hundekuchenlive.de</a><br>
        Datenschutzanfragen: <a href="mailto:privacy@hundekuchenlive.de">privacy@hundekuchenlive.de</a>
      </p>

      <h2>Register und Steuern</h2>
      <p>
        Registereintrag: Nicht im Handelsregister oder in einem vergleichbaren Register eingetragen.<br>
        Wirtschafts-Identifikationsnummer (W-IdNr.): DE460826126-00001<br>
        Hinweis: Kleinunternehmer im Sinne von § 19 UStG, es wird keine Umsatzsteuer ausgewiesen.
      </p>

      <h2>Verantwortlich für Inhalte</h2>
      <p>Verantwortlich für journalistisch-redaktionelle Inhalte nach § 18 Abs. 2 MStV: Justin Barth, Anschrift wie oben.</p>

      <h2>Geltungsbereich</h2>
      <p>Dieses Impressum gilt für die Website <a href="https://hundekuchenlive.de/">hundekuchenlive.de</a> mit ihren Unterseiten und Subdomains sowie für die verbundenen Auftritte, soweit dort auf dieses Impressum verwiesen wird:</p>
      <ul>
        <li><a href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer">Twitch</a></li>
        <li><a href="https://www.tiktok.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer">TikTok</a></li>
        <li><a href="https://www.youtube.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer">YouTube</a></li>
        <li><a href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Discord-Server</a> und der von mir betriebene Discord-Bot</li>
      </ul>
      <p>Für Inhalte und Funktionen auf externen Plattformen gelten ergänzend deren Nutzungsbedingungen, Community-Richtlinien und Datenschutzbestimmungen.</p>

      <h2>Werbung, Affiliate-Links und Kooperationen</h2>
      <p>Diese Website kann Werbung, Affiliate-Links, Sponsoring und Kooperationsinhalte enthalten, unter anderem von Instant Gaming und MoneyQuest. Solche Inhalte sind als „Werbung“ gekennzeichnet. Bei einem Kauf oder einer Anmeldung über diese Links kann ich eine Provision oder sonstige Vergütung erhalten. Für dich entstehen keine zusätzlichen Kosten.</p>

      <h2>Support</h2>
      <p>Über die Support-Seite gelangst du zu meiner Tipping-Seite bei StreamElements. Zahlungen dort sind freiwillige Zuwendungen ohne Gegenleistung. Es handelt sich nicht um Spenden an eine gemeinnützige Einrichtung, Zuwendungsbestätigungen werden nicht ausgestellt.</p>

      <h2>Haftung für Inhalte</h2>
      <p>Die Inhalte wurden mit größter Sorgfalt erstellt. Für Richtigkeit, Vollständigkeit und Aktualität kann ich jedoch keine Gewähr übernehmen. Als Diensteanbieter bin ich nach den allgemeinen Gesetzen für eigene Inhalte verantwortlich. Bei Bekanntwerden von Rechtsverletzungen entferne ich entsprechende Inhalte umgehend.</p>

      <h2>Haftung für Links</h2>
      <p>Diese Website enthält Links zu externen Websites Dritter, auf deren Inhalte ich keinen Einfluss habe. Für diese Inhalte ist stets der jeweilige Anbieter verantwortlich. Bei Bekanntwerden von Rechtsverletzungen entferne ich solche Links umgehend.</p>

      <h2>Urheberrecht</h2>
      <p>Die von mir erstellten Inhalte und Werke unterliegen dem deutschen Urheberrecht. Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechts bedürfen der vorherigen Zustimmung. Beiträge Dritter und Marken Dritter (z. B. Spieletitel) sind Eigentum der jeweiligen Rechteinhaber und werden nur zur Beschreibung verwendet.</p>
    </div>
  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
