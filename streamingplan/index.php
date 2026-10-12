<?php
$page = [
    'title' => 'Streamplan | hundekuchenlive',
    'description' => 'Die festen Streamzeiten von hundekuchenlive: Montag Valorant Ranked Solo/Duo (18:45–21:30 Uhr) und Freitag Community-Abend (19:00–22:30 Uhr) live auf Twitch.',
    'path' => '/streamingplan/',
    'css' => ['pages.css', 'plan.css'],
    'body' => 'page',
    'scripts' => ['home.js'],
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">

    <section class="page-hero">
      <span class="splat ph-a" aria-hidden="true"></span>
      <span class="splat b ph-b" aria-hidden="true"></span>
      <div class="container">
        <p class="kicker">Streamplan</p>
        <h1 class="tag-title xl">Wann ich live bin</h1>
        <p class="lead">Zwei feste Streamtage pro Woche, live auf Twitch. Alle Zeiten sind deutsche Zeit (MEZ/MESZ).</p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="plan-list">

          <article class="plan-row tone-live" data-day="1">
            <span class="plan-abbr" aria-hidden="true">MO</span>
            <div class="plan-main">
              <h3>Valorant Ranked</h3>
              <ul class="slots">
                <li><span class="t">18:45–21:30</span><span class="d">Twitch-Stream: Ranked Solo/Duo</span></li>
              </ul>
            </div>
            <span class="plan-badge">Live</span>
          </article>

          <article class="plan-row tone-team" data-day="5">
            <span class="plan-abbr" aria-hidden="true">FR</span>
            <div class="plan-main">
              <h3>Community-Abend</h3>
              <ul class="slots">
                <li><span class="t">19:00–22:30</span><span class="d">Twitch-Stream: Valorant, Rocket League und mehr mit Community und Mates, lockerer Abend</span></li>
              </ul>
            </div>
            <span class="plan-badge">Live</span>
          </article>

        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="callout">
          <h2>Änderungen zuerst auf Discord</h2>
          <p>Kurzfristige Änderungen und spontane Zusatzstreams siehst du zuerst auf Twitch und Discord. Dort bekommst du auch Infos zu Community-Aktionen.</p>
          <div class="actions">
            <a class="btn primary" href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Discord beitreten</a>
            <a class="btn" href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer">Zum Twitch-Kanal</a>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Gut zu wissen</h2>
        <div class="cards-3">
          <article class="s-card c-lime"><h3>Feste Streams</h3><p>Montag (Valorant Ranked Solo/Duo) und Freitag (Community-Abend) sind meine festen Streamtage.</p></article>
          <article class="s-card c-teal"><h3>Zusatzstreams</h3><p>Spontane Streams sind möglich. Ich kündige sie auf Twitch und Discord an.</p></article>
          <article class="s-card c-magenta"><h3>Richtwerte</h3><p>Alle Zeiten sind geplante Richtwerte. Änderungen oder frühere Starts sind jederzeit möglich.</p></article>
        </div>
      </div>
    </section>

  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
