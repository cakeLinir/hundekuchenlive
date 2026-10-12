<?php
$page = [
    'title' => 'Datenschutzerklärung | hundekuchenlive',
    'description' => 'Datenschutzerklärung von hundekuchenlive: Verarbeitung personenbezogener Daten auf Website, Support-Seite, Discord-Server und Discord-Bot.',
    'path' => '/datenschutz/',
    'css' => ['pages.css'],
    'body' => 'page',
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">
    <div class="container legal">
      <h1 class="tag-title xl">Datenschutz</h1>
      <p>Informationen zur Verarbeitung personenbezogener Daten auf dieser Website, bei Zahlungen über die Support-Seite, auf dem Discord-Server und durch den Discord-Bot. Stand: Oktober 2026.</p>

      <ol class="legal-toc">
        <li><a href="#verantwortlicher">Verantwortlicher</a></li>
        <li><a href="#ueberblick">Kurzüberblick</a></li>
        <li><a href="#hosting">Hosting und Logfiles</a></li>
        <li><a href="#speicherung">Lokale Speicherung und Cookies</a></li>
        <li><a href="#twitch">Twitch</a></li>
        <li><a href="#affiliate">Affiliate und Partner</a></li>
        <li><a href="#partnerformular">Partnerformular und E-Mail</a></li>
        <li><a href="#support">Support und Zahlungen</a></li>
        <li><a href="#shop">Merch-Shop</a></li>
        <li><a href="#quiz">Quiz</a></li>
        <li><a href="#cloud">Creator-Cloud</a></li>
        <li><a href="#discord">Discord-Server und Bot</a></li>
        <li><a href="#hetzner">Hetzner</a></li>
        <li><a href="#empfaenger">Empfänger und Drittländer</a></li>
        <li><a href="#dauer">Speicherdauer</a></li>
        <li><a href="#rechte">Deine Rechte</a></li>
        <li><a href="#beschwerde">Beschwerderecht</a></li>
      </ol>

      <h2 id="verantwortlicher">1. Verantwortlicher</h2>
      <p>Justin Barth, Online-Auftritt hundekuchenlive. Anschrift: siehe <a href="/impressum/">Impressum</a>. Datenschutzkontakt: <a href="mailto:privacy@hundekuchenlive.de">privacy@hundekuchenlive.de</a></p>

      <h2 id="ueberblick">2. Kurzüberblick</h2>
      <ul>
        <li>Diese Website nutzt <strong>keine Analyse- oder Werbe-Tracker</strong> und lädt keine Schriften oder Skripte von Dritten.</li>
        <li>Externe Inhalte (Twitch-Player, Instant-Gaming-Banner) werden <strong>erst nach deiner Einwilligung</strong> geladen. Die Einwilligung kannst du jederzeit über „Einwilligungen verwalten“ im Footer ändern oder widerrufen.</li>
        <li>Weil nur technisch erforderliche Speicherungen ohne Einwilligung erfolgen, ist kein Cookie-Banner nötig.</li>
      </ul>
      <p><strong>Rechtsgrundlagen:</strong> Art. 6 Abs. 1 lit. a DSGVO (Einwilligung), lit. b (Vertrag oder vorvertragliche Maßnahmen), lit. c (rechtliche Pflicht), lit. f (berechtigtes Interesse) sowie § 25 TDDDG für Speicherung und Zugriff auf Endgeräte.</p>

      <h2 id="hosting">3. Hosting und Server-Logfiles</h2>
      <p>Die Website wird bei der IONOS SE, Elgendorfer Str. 57, 56410 Montabaur, gehostet. Beim Aufruf verarbeitet IONOS technische Zugriffsdaten (angeforderte Seite, Referrer, Browser, Betriebssystem, Gerätetyp, Uhrzeit, IP-Adresse in anonymisierter Form). Nach Angaben von IONOS erfolgt die Anonymisierung direkt bei der Erhebung, die Speicherung dauert 8 Wochen, und es findet kein Transfer in Drittstaaten außerhalb der EU statt. Ein Vertrag zur Auftragsverarbeitung besteht. Zweck: Sicherheit und Stabilität. Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO.</p>

      <h2 id="speicherung">4. Lokale Speicherung und Cookies</h2>
      <table class="legal-table">
        <thead><tr><th>Name</th><th>Zweck</th><th>Dauer</th><th>Grundlage</th></tr></thead>
        <tbody>
          <tr><td><code>hkl-theme</code> (localStorage)</td><td>Merkt Dark- oder Lightmode, den du gewählt hast.</td><td>Bis du ihn löschst</td><td>§ 25 Abs. 2 Nr. 2 TDDDG</td></tr>
          <tr><td><code>hkl_embed_consent_v1</code> (localStorage)</td><td>Speichert, dass du den Twitch-Player dauerhaft laden willst.</td><td>Bis zum Widerruf</td><td>Art. 6 Abs. 1 lit. a DSGVO, § 25 Abs. 2 Nr. 2 TDDDG</td></tr>
          <tr><td><code>hkl_cookie_consent_v1</code> (localStorage)</td><td>Speichert deine Einwilligung für den Instant-Gaming-Banner.</td><td>Bis zum Widerruf</td><td>Art. 6 Abs. 1 lit. a DSGVO, § 25 Abs. 2 Nr. 2 TDDDG</td></tr>
          <tr><td><code>PHPSESSID</code> (Cookie)</td><td>Sicherheits-Token (CSRF-Schutz) für das Partnerformular. Wird nur auf der Partnerseite gesetzt.</td><td>Bis zum Schließen des Browsers</td><td>§ 25 Abs. 2 Nr. 2 TDDDG, Art. 6 Abs. 1 lit. f DSGVO</td></tr>
        </tbody>
      </table>
      <p>Über „Einwilligungen verwalten“ im Footer kannst du die Einwilligungen jederzeit ändern. Beim Widerruf werden die gespeicherten Einträge gelöscht und die Seite neu geladen.</p>

      <h2 id="twitch">5. Twitch</h2>
      <p><strong>Player:</strong> Der Twitch-Player (Twitch Interactive, Inc., 350 Bush Street, San Francisco, CA 94104, USA) wird erst nach deinem Klick oder deiner gespeicherten Einwilligung geladen. Dabei werden insbesondere IP-Adresse, Browser- und Geräteinformationen übertragen, auch in die USA. Rechtsgrundlage: Art. 6 Abs. 1 lit. a DSGVO. Mehr: <a href="https://www.twitch.tv/p/de-de/legal/privacy-notice/" target="_blank" rel="noopener noreferrer">Datenschutzhinweise von Twitch</a>.</p>
      <p><strong>Live-Status:</strong> Ob ich live bin, frage ich serverseitig über die Twitch-API ab. Dabei werden keine Daten von dir an Twitch übermittelt, die Antwort wird kurz zwischengespeichert. Dein Browser spricht dafür nur mit dieser Website.</p>

      <h2 id="affiliate">6. Affiliate und Partner</h2>
      <p><strong>Instant Gaming:</strong> Die Website enthält Affiliate-Links. Beim Klick kann der Anbieter nachvollziehen, dass du über diese Website kommst (u. a. IP-Adresse, Browserdaten, Referrer, Affiliate-Parameter). Ein Partner-Banner wird nur nach deiner Einwilligung geladen (Art. 6 Abs. 1 lit. a DSGVO). Bei bloßen Links beruht die Verarbeitung auf Art. 6 Abs. 1 lit. f DSGVO (Refinanzierung des Angebots).</p>
      <p><strong>MoneyQuest:</strong> Links führen zu money-quest.de und zu einem externen Fragebogen (Typeform) mit Ref-Hinweis. Erst mit deinem Klick verlässt du diese Website, ab dann verarbeitet der jeweilige Anbieter deine Daten eigenverantwortlich.</p>

      <h2 id="partnerformular">7. Partnerformular und E-Mail</h2>
      <p>Wenn du das Formular nutzt oder mir schreibst, verarbeite ich Name, E-Mail-Adresse, Betreff, gewünschtes Paket, Nachricht und Zeitpunkt, um deine Anfrage zu bearbeiten. Zusätzlich:</p>
      <ul>
        <li>Zum Schutz vor Missbrauch speichert ein Rate-Limit einen SHA-256-Hash deiner IP-Adresse mit Zeitstempeln in einer temporären Datei auf dem Server (längstens 24 Stunden). Deine IP-Adresse steht außerdem im technischen Header der E-Mail.</li>
        <li>Die E-Mail wird über den SMTP-Server von IONOS versendet. Eine Kopie geht an das über den Impressum-Dienst Impressum4u eingerichtete Postfach.</li>
        <li>Das Formular ist durch ein Honeypot-Feld und ein CSRF-Token geschützt (siehe Abschnitt 4).</li>
      </ul>
      <p>Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO, sonst lit. f (Bearbeitung von Anfragen). Löschung, sobald die Anfrage abgeschlossen ist und keine Aufbewahrungspflichten bestehen.</p>

      <h2 id="support">8. Support und Zahlungen</h2>
      <p>Der Menüpunkt „Support“ führt direkt zu meiner Tipping-Seite bei StreamElements (streamelements.com/hundekuchenlive/tip). Diese Website verarbeitet dabei keine Zahlungs- oder Unterstützerdaten und lädt nichts von StreamElements nach, bevor du den Link anklickst. Mit dem Klick verlässt du diese Website.</p>
      <p>Auf der Tipping-Seite verarbeitet StreamElements (StreamElements Pte. Ltd. und verbundene Unternehmen) deine Angaben, insbesondere Name oder Nickname, Betrag, optionale Nachricht und Zahlungsdaten, und wickelt die Zahlung über seine Zahlungsabwicklung oder über PayPal ab. Als Empfänger erhalte ich Name oder Nickname, Betrag und Nachricht. Name und Nachricht können im Stream oder in Benachrichtigungen eingeblendet werden. Für die Verarbeitung durch StreamElements und die Zahlungsdienstleister gelten deren Datenschutzhinweise, siehe <a href="https://streamelements.com/privacy" target="_blank" rel="noopener noreferrer">streamelements.com/privacy</a>. Eine Übermittlung in Drittländer ist möglich.</p>
      <p>Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO (Abwicklung der freiwilligen Zuwendung), lit. f (Darstellung im Stream) und lit. c (steuer- und handelsrechtliche Aufbewahrung von Zahlungsbelegen). Auf Anfrage lösche ich Angaben aus meiner Hand, soweit keine Aufbewahrungspflichten entgegenstehen.</p>

      <h2 id="shop">9. Merch-Shop</h2>
      <p>Der Link „Merch“ führt zu shop.hundekuchenlive.de. Diese Adresse leitet auf einen Shop bei Fourthwall weiter. Der Shop wird nicht von mir betrieben und ist technisch nicht Teil dieser Website. Mit dem Aufruf des Links verlässt du diese Website, Bestellungen und Daten verarbeitet der Shop-Betreiber eigenverantwortlich nach seinen Datenschutzhinweisen.</p>

      <h2 id="quiz">10. Quiz</h2>
      <p>Das Gamer-Quiz und das MoneyQuest-Quiz laufen vollständig in deinem Browser. Antworten und Ergebnis werden weder gespeichert noch an einen Server gesendet.</p>

      <h2 id="cloud">11. Creator-Cloud</h2>
      <p>Die Creator-Cloud (cloud.hundekuchenlive.de, Nextcloud) wird ausschließlich intern genutzt, für den Videoschnitt und die Zusammenarbeit mit Mitwirkenden. Dort verarbeite ich Zugangsdaten, hochgeladene und bereitgestellte Dateien sowie technische Zugriffsdaten. Öffentliche Uploads sind nicht vorgesehen. Rechtsgrundlage: Art. 6 Abs. 1 lit. b oder f DSGVO.</p>

      <h2 id="discord">12. Discord-Server und Bot</h2>
      <p>Auf dem Discord-Server verarbeitet Discord selbst Daten (Konto, User-ID, Name, Avatar, Nachrichten, Rollen, technische Daten, <a href="https://discord.com/privacy" target="_blank" rel="noopener noreferrer">Datenschutzerklärung von Discord</a>). Als Betreiber sehe ich insbesondere User-ID, Namen, Rollen, öffentliche Nachrichten sowie Moderations- und Aktivitätsinformationen. Ein von mir betriebener Bot verarbeitet je nach Nutzung User-ID, Namen, Server- und Channel-ID, Rollen und Rollenänderungen, Commands samt Zeitpunkt sowie Aktivitäts- und Moderationslogs. Das Logging findet ausschließlich innerhalb von Discord statt, <strong>Bot-Logs werden nach 30 Tagen gelöscht</strong>. Zwecke: Community-Betrieb, Moderation, Rollenverwaltung, Missbrauchsabwehr. Rechtsgrundlage: Art. 6 Abs. 1 lit. f, bei aktiv genutzten Commands auch lit. b DSGVO.</p>

      <h2 id="hetzner">13. Hetzner</h2>
      <p>Der Discord-Bot läuft auf einem VPS der Hetzner Online GmbH, Industriestr. 25, 91710 Gunzenhausen. Dabei können technische Verbindungsdaten, Server-Logs und Sicherheitsereignisse anfallen. Mit Hetzner besteht eine Vereinbarung zur Auftragsverarbeitung nach Art. 28 DSGVO. Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO (sicherer Betrieb).</p>

      <h2 id="empfaenger">14. Empfänger und Drittländer</h2>
      <p>Empfänger können sein: IONOS SE und Hetzner Online GmbH (Hosting), StreamElements und je nach Zahlungsart PayPal (Support-Zahlungen), Twitch und Discord (Plattformen), Impressum4u (Postfach), Instant Gaming, MoneyQuest und Fourthwall (nur, wenn du deren Links nutzt), Moderatoren und Administratoren des Discord-Servers sowie Behörden, soweit gesetzlich nötig. Bei Anbietern außerhalb der EU, etwa Twitch in den USA oder StreamElements, erfolgt die Übermittlung auf Grundlage eines Angemessenheitsbeschlusses oder von Standardvertragsklauseln, soweit der Anbieter sich darauf stützt.</p>

      <h2 id="dauer">15. Speicherdauer</h2>
      <p>Ich speichere Daten nur so lange, wie es der Zweck erfordert oder gesetzliche Aufbewahrungsfristen gelten. Insbesondere: IONOS-Zugriffsdaten 8 Wochen, Rate-Limit-Hashes höchstens 24 Stunden, Bot-Logs 30 Tage, Kontaktanfragen bis zum Abschluss der Bearbeitung, Zahlungsbelege nach den steuer- und handelsrechtlichen Fristen, lokale Einwilligungen bis zum Widerruf oder bis du sie löschst. Die Speicherdauer bei StreamElements richtet sich nach deren Datenschutzhinweisen.</p>

      <h2 id="rechte">16. Deine Rechte</h2>
      <p>Du hast das Recht auf Auskunft, Berichtigung, Löschung, Einschränkung der Verarbeitung, Datenübertragbarkeit und Widerspruch. Erteilte Einwilligungen kannst du jederzeit mit Wirkung für die Zukunft widerrufen, über „Einwilligungen verwalten“ im Footer oder per E-Mail an <a href="mailto:privacy@hundekuchenlive.de">privacy@hundekuchenlive.de</a>. Wenn ich Daten auf Grundlage berechtigter Interessen verarbeite, kannst du aus Gründen, die sich aus deiner besonderen Situation ergeben, widersprechen.</p>
      <p>Die Bereitstellung deiner Daten ist nicht gesetzlich oder vertraglich vorgeschrieben. Für den Betrieb der Website ist die Verarbeitung der IP-Adresse technisch nötig, ohne die Angaben im Formular kann ich deine Anfrage nicht beantworten. Eine automatisierte Entscheidungsfindung einschließlich Profiling findet nicht statt.</p>

      <h2 id="beschwerde">17. Beschwerderecht</h2>
      <p>Du hast das Recht, dich bei einer Datenschutzaufsichtsbehörde zu beschweren, insbesondere in dem Mitgliedstaat deines Aufenthaltsorts oder des mutmaßlichen Verstoßes. Für mich zuständig ist: Der Landesbeauftragte für den Datenschutz Niedersachsen, Prinzenstraße 5, 30159 Hannover, Telefon 0511 120-4500, <a href="mailto:poststelle@lfd.niedersachsen.de">poststelle@lfd.niedersachsen.de</a>, <a href="https://www.lfd.niedersachsen.de" target="_blank" rel="noopener noreferrer">www.lfd.niedersachsen.de</a>.</p>
    </div>
  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
