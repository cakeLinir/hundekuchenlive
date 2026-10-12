<?php
$page = [
    'title' => 'Über mich | hundekuchenlive',
    'description' => 'Justin alias hundekuchenlive: Streamer seit 2018, Valorant-Spieler im Team UKF Eclipse von Unknown Forces Esports e.V. Das Team sucht neue Mitglieder.',
    'path' => '/about/',
    'css' => ['pages.css', 'team.css'],
    'body' => 'page',
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">

    <section class="page-hero">
      <span class="splat ph-a" aria-hidden="true"></span>
      <span class="splat b ph-b" aria-hidden="true"></span>
      <div class="container">
        <p class="kicker">Über mich</p>
        <h1 class="tag-title xl">Hi, ich bin Justin</h1>
        <p class="lead">Online besser bekannt als <strong>hundekuchenlive</strong>. Gaming, Community und Content mit Wiedererkennungswert.</p>
      </div>
    </section>

    <section class="section">
      <div class="container split">
        <div class="prose">
          <p>Seit 2018 teile ich meine Leidenschaft für Gaming und Unterhaltung auf Twitch. Mein Fokus liegt auf einer aktiven Community, wiedererkennbarem Content und Projekten, die langfristig wachsen können.</p>
          <p>Mein Schwerpunkt ist <strong>Valorant</strong>. Ich bin Mitglied bei <strong>Unknown Forces Esports e.V.</strong> und spiele dort im Team <a class="text-link" href="https://unknown-forces.com/team-detail?tab=Valo%20PC%20UKF%20Eclipse" target="_blank" rel="noopener noreferrer">UKF Eclipse</a>. Dazu kommen <strong>Rocket League</strong>, weitere Games und entspannte Community-Abende mit Mates. Highlights und kurze Ausschnitte findest du auf TikTok und YouTube.</p>
          <div class="callout">
            <p>Live dabei sein oder Clips schauen:</p>
            <div class="actions">
              <a class="btn primary" href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer">Twitch</a>
              <a class="btn" href="https://tiktok.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer">TikTok</a>
              <a class="btn" href="/streamingplan/">Streamplan</a>
            </div>
          </div>
        </div>
        <figure class="frame">
          <img src="/assets/img/hkl-logo.jpg" width="1024" height="1024" loading="lazy" decoding="async"
            alt="hundekuchenlive-Logo: grüner Igel-Fuchs mit Sonnenbrille und Lederjacke vor Graffiti-Wand">
        </figure>
      </div>
    </section>

    <section class="section" aria-labelledby="team-title">
      <div class="container">
        <div class="team-card">
          <a class="team-badge" href="https://unknown-forces.com/team-detail?tab=Valo%20PC%20UKF%20Eclipse"
            target="_blank" rel="noopener noreferrer" aria-label="Teamseite von UKF Eclipse öffnen">
            <img src="/assets/img/ukf-eclipse-logo.png" width="1500" height="1500" loading="lazy" decoding="async"
              alt="Teamlogo von Team Eclipse, Unknown Forces Esports: blauer Adler vor einem Schild">
          </a>
          <div class="team-copy">
            <p class="kicker">Mitglieder gesucht</p>
            <h2 id="team-title">UKF Eclipse sucht Verstärkung</h2>
            <p>Ich spiele bei Unknown Forces eSports e.V. im Valorant-Team UKF Eclipse. Wir suchen neue Mitglieder, die Lust auf Teamplay, Training und Wettkampf haben. Alle Infos zum Team findest du auf der Teamseite. Hast du Interesse? Dann melde dich bei mir im Discord.</p>
            <div class="actions">
              <a class="btn primary" href="https://unknown-forces.com/team-detail?tab=Valo%20PC%20UKF%20Eclipse"
                target="_blank" rel="noopener noreferrer">Zur Teamseite ↗</a>
              <a class="btn" href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Im Discord melden</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Wofür ich stehe</h2>
        <p class="sub">Nicht nur Streams, sondern ein Auftritt mit Wiedererkennung.</p>
        <div class="cards-3">
          <article class="s-card c-lime"><h3>Community</h3><p>Ein freundlicher Umgang, gemeinsame Projekte und echte Einbindung der Zuschauer stehen im Mittelpunkt.</p></article>
          <article class="s-card c-teal"><h3>Langfristigkeit</h3><p>Der Kanal ist nicht auf kurzfristigen Hype ausgelegt, sondern auf beständigen Content und Entwicklung.</p></article>
          <article class="s-card c-magenta"><h3>Transparenz</h3><p>Ehrliche Kommunikation, nachvollziehbare Entscheidungen und ein offener Umgang mit Projekten und Ideen.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Das spiele ich</h2>
        <div class="cards-3">
          <article class="s-card c-lime"><h3>Valorant</h3><p>Mein Schwerpunkt: Ranked-Grind und Teamplay im Team UKF Eclipse. Montags spiele ich Ranked Solo/Duo live im Stream.</p></article>
          <article class="s-card c-teal"><h3>Rocket League</h3><p>Fußball mit Raketenantrieb: Runden mit Mates und der Community, lockere Abende voller Tore und Chaos.</p></article>
          <article class="s-card c-magenta"><h3>Sonstige Games</h3><p>Spontane Sessions, neue Releases und alles, worauf die Crew Lust hat.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="callout">
          <h2>Kooperationen</h2>
          <p>Für Partner-, Sponsoring- und Business-Anfragen nutze das Formular auf der Partnerseite oder schreib direkt an <a class="text-link" href="mailto:business@hundekuchenlive.de">business@hundekuchenlive.de</a>.</p>
          <div class="actions"><a class="btn primary" href="/partner/">Zur Partnerseite</a></div>
        </div>
      </div>
    </section>

  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
