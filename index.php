<?php
$page = [
    'title' => 'hundekuchenlive – Willkommen in Los Santos | Valorant, Rocket League & Community live auf Twitch',
    'description' => 'Live auf Twitch: Valorant, Rocket League und mehr mit hundekuchenlive. Montag und Freitag live, Streamzeiten, Gamer-Quiz, Spray-Wand und Merch.',
    'path' => '/',
    'css' => ['home.css', 'plan.css'],
    'body' => 'home',
    'scripts' => ['twitch-status.js', 'home.js', 'spray.js', 'quiz-data.js', 'quiz.js', 'consent-manager.js', 'consent-embeds.js'],
    'jsonld' => '{"@context":"https://schema.org","@graph":[{"@type":"WebSite","name":"hundekuchenlive","url":"https://hundekuchenlive.de/","inLanguage":"de"},{"@type":"Person","name":"Justin Barth","alternateName":"hundekuchenlive","url":"https://hundekuchenlive.de/","sameAs":["https://www.twitch.tv/hundekuchenlive","https://www.tiktok.com/@hundekuchenlive","https://www.youtube.com/@hundekuchenlive"]}]}',
];
require __DIR__ . '/components/head.php';
?>

  <main id="main">

    <!-- HERO -->
    <section class="hero-x" aria-labelledby="hero-title">
      <span class="splat hero-sp-a" data-parallax="0.08" aria-hidden="true"></span>
      <span class="splat b hero-sp-b" data-parallax="-0.06" aria-hidden="true"></span>
      <span class="splat hero-sp-c" data-parallax="0.12" aria-hidden="true"></span>

      <div class="container hero-grid-s">

        <div class="hero-copy">
          <p class="kicker">Valorant · Rocket League · Mehr</p>
          <h1 class="tag-title hero-title" id="hero-title"><span>Hundekuchen</span><span class="l2">Live</span></h1>
          <p class="hero-lead">
            Willkommen in Los Santos. Ich bin Justin, <strong>hundekuchenlive</strong>:
            Ranked-Grind und Community-Abende, live auf Twitch.
          </p>
          <div class="hero-cta">
            <a class="btn primary lg" id="hero-watch" href="https://www.twitch.tv/hundekuchenlive" target="_blank"
              rel="noopener noreferrer">Auf Twitch zuschauen</a>
            <a class="btn lg" href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Zur Crew</a>
          </div>

          <div class="ticket" id="live-card" aria-label="Stream-Status und nächster Stream">
            <p class="ticket-status"><span id="twitch-status" class="offline">Status wird geladen...</span></p>
            <p class="ticket-label" id="live-card-label">Streamzeiten</p>
            <p class="ticket-title" id="live-card-title">Mo 18:45 · Fr 19:00 Uhr</p>
            <p class="ticket-meta" id="live-card-meta">Montag Valorant Ranked, Freitag Community-Abend.</p>
            <a class="btn primary" id="live-card-cta" href="/streamingplan/">Streamplan ansehen</a>
          </div>

          <ul class="hero-facts">
            <li><strong>Seit 2018</strong><span>auf Twitch</span></li>
            <li><strong>2× live</strong><span>Montag &amp; Freitag</span></li>
            <li><strong>Valorant</strong><span>Rocket League &amp; mehr</span></li>
          </ul>
        </div>

        <div class="stage">
          <span class="sticker-float st-a" aria-hidden="true">Valorant</span>
          <span class="sticker-float st-b" aria-hidden="true">Rocket League</span>
          <span class="sticker-float st-c" aria-hidden="true">Mo &amp; Fr live</span>
          <figure class="wall" data-tilt>
            <img src="/assets/img/hkl-logo.jpg" width="1024" height="1024" fetchpriority="high" decoding="async"
              alt="hundekuchenlive-Logo: grüner Igel-Fuchs mit Sonnenbrille und Lederjacke vor einer Graffiti-Wand mit der Aufschrift Los Santos">
          </figure>
        </div>

      </div>
    </section>

    <!-- TICKER -->
    <div class="ticker-wrap" aria-hidden="true">
      <div class="ticker">
        <div class="ticker-track">
          <span>Live auf Twitch</span><span>✷</span><span>Valorant</span><span>✷</span><span>Rocket League</span><span>✷</span><span>Mehr Games</span><span>✷</span><span>Mo 18:45</span><span>✷</span><span>Fr 19:00</span><span>✷</span>
          <span>Live auf Twitch</span><span>✷</span><span>Valorant</span><span>✷</span><span>Rocket League</span><span>✷</span><span>Mehr Games</span><span>✷</span><span>Mo 18:45</span><span>✷</span><span>Fr 19:00</span><span>✷</span>
        </div>
      </div>
    </div>

    <!-- GAMES -->
    <section class="section" id="games" aria-labelledby="games-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="games-title">Das spielen wir</h2>
            <p class="sub">Drei Welten, ein Kanal.</p>
          </div>
        </div>

        <div class="rail">
          <article class="poster t-lime reveal">
            <span class="poster-day" aria-hidden="true">VAL</span>
            <span class="splat" aria-hidden="true"></span>
            <span class="poster-time">Ranked · Solo/Duo</span>
            <h3>Valorant</h3>
            <p>Mein Schwerpunkt: Ranked-Grind und Teamplay. Kompetitiv, direkt und mit Debrief nach der Runde.</p>
          </article>
          <article class="poster t-teal reveal">
            <span class="poster-day" aria-hidden="true">RL</span>
            <span class="splat b" aria-hidden="true"></span>
            <span class="poster-time">Mates · Community</span>
            <h3>Rocket League</h3>
            <p>Fußball mit Raketenantrieb: Runden mit Mates und der Community, lockere Abende voller Tore und Chaos.</p>
          </article>
          <article class="poster t-magenta reveal">
            <span class="poster-day" aria-hidden="true">GG</span>
            <span class="splat" aria-hidden="true"></span>
            <span class="poster-time">Spontan · Flexibel</span>
            <h3>Sonstige Games</h3>
            <p>Spontane Sessions, neue Releases und alles, worauf die Crew Lust hat.</p>
          </article>
        </div>
        <p class="rail-hint">← Wisch durch die Games →</p>
      </div>
    </section>

    <!-- STREAMZEITEN -->
    <section class="section" id="streamplan" aria-labelledby="plan-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="plan-title">Streamzeiten</h2>
            <p class="sub">Zwei feste Streamtage pro Woche. Alle Zeiten sind deutsche Zeit.</p>
          </div>
          <a class="text-link" href="/streamingplan/">Alle Details zum Plan →</a>
        </div>

        <div class="plan-list">
          <article class="plan-row tone-live reveal" data-day="1">
            <span class="plan-abbr" aria-hidden="true">MO</span>
            <div class="plan-main">
              <h3>Valorant Ranked</h3>
              <ul class="slots">
                <li><span class="t">18:45–21:30</span><span class="d">Twitch-Stream: Ranked Solo/Duo</span></li>
              </ul>
            </div>
            <span class="plan-badge">Live</span>
          </article>

          <article class="plan-row tone-team reveal" data-day="5">
            <span class="plan-abbr" aria-hidden="true">FR</span>
            <div class="plan-main">
              <h3>Community-Abend</h3>
              <ul class="slots">
                <li><span class="t">19:00–22:30</span><span class="d">Twitch-Stream: Valorant, Rocket League und mehr mit Community und Mates</span></li>
              </ul>
            </div>
            <span class="plan-badge">Live</span>
          </article>
        </div>
      </div>
    </section>

    <!-- TAG DIE WAND -->
    <section class="section" id="wand" aria-labelledby="wand-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="wand-title">Tag die Wand</h2>
            <p class="sub">Sprüh was an die Wand! Maus oder Finger gedrückt halten, bleib stehen und die Farbe läuft. Speichern und im Discord zeigen.</p>
          </div>
        </div>

        <div class="studio">
          <div class="studio-wall">
            <canvas id="spray-canvas" width="960" height="540" role="img"
              aria-label="Zeichenfläche: Mit Maus oder Finger auf eine Betonwand sprühen"></canvas>
            <p class="studio-hint" id="spray-hint">Zieh hier drüber</p>
          </div>

          <div class="studio-tools">
            <div class="swatches" role="group" aria-label="Farbe wählen">
              <button class="swatch sw-lime is-active" type="button" data-color="#6dff1f" aria-label="Neon-Lime" aria-pressed="true"></button>
              <button class="swatch sw-teal" type="button" data-color="#14b8a6" aria-label="Teal" aria-pressed="false"></button>
              <button class="swatch sw-magenta" type="button" data-color="#d03aa5" aria-label="Magenta" aria-pressed="false"></button>
              <button class="swatch sw-visor" type="button" data-color="#2f9bff" aria-label="Blau" aria-pressed="false"></button>
              <button class="swatch sw-black" type="button" data-color="#0b0c0b" aria-label="Schwarz" aria-pressed="false"></button>
              <button class="swatch sw-white" type="button" data-color="#f3f2ec" aria-label="Weiß" aria-pressed="false"></button>
            </div>
            <label class="size-ctl">Größe <input id="spray-size" type="range" min="10" max="60" value="26"></label>
            <button class="btn" id="spray-undo" type="button">Zurück</button>
            <button class="btn" id="spray-clear" type="button">Neue Wand</button>
            <button class="btn primary" id="spray-save" type="button">Als Bild speichern</button>
          </div>
          <p class="studio-note">Dein Bild bleibt in deinem Browser. Es wird nichts hochgeladen oder gespeichert.</p>
        </div>
      </div>
    </section>

    <!-- PLAYER -->
    <section class="section" id="live" aria-labelledby="live-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="live-title">Reinschauen</h2>
            <p class="sub">Starte den Stream direkt hier auf der Seite.</p>
          </div>
          <a class="text-link" href="https://www.twitch.tv/hundekuchenlive/videos" target="_blank"
            rel="noopener noreferrer">Vergangene Streams →</a>
        </div>

        <div class="screen">
          <span class="on-air">On Air</span>
          <div data-embed="twitch" data-remember="true" data-channel="hundekuchenlive" data-parent="hundekuchenlive.de">
            <div class="embed-wrap">
              <div class="embed-hint">
                <h3>Twitch-Stream laden</h3>
                <p>Beim Laden werden Daten (z. B. deine IP-Adresse) an Twitch übertragen.
                  Mehr dazu in der <a href="/datenschutz/">Datenschutzerklärung</a>.</p>
                <div class="embed-actions">
                  <button class="btn primary" type="button" data-action="load">Einmal laden</button>
                  <button class="btn" type="button" data-action="load-remember">Immer laden</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CREW -->
    <section class="section" id="community" aria-labelledby="crew-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="crew-title">Die Crew</h2>
            <p class="sub">Hier erfährst du Änderungen am schnellsten und tauschst dich mit anderen aus.</p>
          </div>
        </div>

        <div class="bento">
          <div class="sticker crew-card b-discord reveal">
            <span class="splat b crew-sp" aria-hidden="true"></span>
            <h3 class="tag-title md teal">Komm auf den Discord</h3>
            <p>Ankündigungen, spontane Streams, Community-Abende am Freitag und die beste Möglichkeit, bei Aktionen
              direkt dabei zu sein.</p>
            <a class="btn primary lg" href="https://discord.gg/WfTbuyhXcJ" target="_blank"
              rel="noopener noreferrer">Discord beitreten</a>
          </div>

          <ul class="tags b-tags reveal">
            <li><a class="tag-link" href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer"><span><strong>Twitch</strong><span>Live-Streams und Chat</span></span><span class="arrow" aria-hidden="true">→</span></a></li>
            <li><a class="tag-link" href="https://tiktok.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer"><span><strong>TikTok</strong><span>Clips und Highlights</span></span><span class="arrow" aria-hidden="true">→</span></a></li>
            <li><a class="tag-link" href="https://youtube.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer"><span><strong>YouTube</strong><span>Highlights und Videos</span></span><span class="arrow" aria-hidden="true">→</span></a></li>
          </ul>
        </div>
      </div>
    </section>

    <!-- QUIZ -->
    <section class="section" id="quiz" aria-labelledby="quiz-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="quiz-title">Gamer-Quiz</h2>
            <p class="sub">10 zufällige Fragen aus <span data-quiz-total>100</span>. Es wird nichts gespeichert.</p>
          </div>
        </div>

        <div class="qz-card" id="mini-quiz-container" data-rounds="10">
          <div class="qz-meta">
            <span id="mini-quiz-question-counter" aria-live="polite">Frage 1 / 10</span>
            <span id="mini-quiz-score-inline">Punkte: 0</span>
          </div>
          <div class="qz-progress" aria-hidden="true"><div class="qz-progress-bar" id="mini-quiz-progress"></div></div>
          <h3 class="qz-question" id="mini-quiz-question">Bereit für die nächste Frage?</h3>
          <div class="qz-answers" id="mini-quiz-answers"></div>
          <button class="btn primary" id="mini-quiz-next-btn" type="button" disabled>Nächste Frage</button>
        </div>

        <div class="qz-card qz-result" id="mini-quiz-result" hidden>
          <h3>Quiz beendet!</h3>
          <p>Deine Punktzahl: <strong id="mini-quiz-score">0</strong></p>
          <p id="mini-quiz-score-text"></p>
          <button class="btn primary" id="mini-quiz-restart-btn" type="button">Nochmal spielen</button>
        </div>
      </div>
    </section>

    <!-- MERCH -->
    <section class="section" aria-labelledby="merch-title">
      <div class="container">
        <div class="drop reveal">
          <span class="splat b drop-sp" aria-hidden="true"></span>
          <div class="drop-inner">
            <div>
              <h2 id="merch-title">Trag die Crew</h2>
              <p>Zeig, dass du zu Los Santos gehörst. Alle Artikel findest du im offiziellen Merch-Shop.</p>
            </div>
            <a class="btn lg" href="https://shop.hundekuchenlive.de/" target="_blank" rel="noopener noreferrer">Zum Merch-Shop</a>
          </div>
        </div>
      </div>
    </section>

    <!-- PARTNER -->
    <section class="section" id="partner" aria-labelledby="partner-title">
      <div class="container">
        <div class="section-head">
          <div>
            <h2 class="tag-title lg" id="partner-title">Partner</h2>
            <p class="sub">Mit diesen Partnern arbeite ich zusammen. Die Inhalte in diesem Bereich sind Werbung.</p>
          </div>
        </div>

        <div class="partner-grid-home">
          <article class="partner-tile reveal">
            <span class="stamp">Werbung · Affiliate</span>
            <h3>Instant Gaming</h3>
            <p>Günstige Spiele, regelmäßige Aktionen und schnelle digitale Lieferung.
              Über den Partnerlink unterstützt du mich ohne zusätzliche Kosten.</p>
            <div class="ig-banner-slot" id="ig-banner-slot" data-consent-vendor="instant-gaming"></div>
            <div class="partner-links">
              <a class="btn primary" href="https://www.instant-gaming.com/?igr=hundekuchen" target="_blank"
                rel="nofollow sponsored noopener noreferrer">Zum Shop</a>
              <a class="btn" href="https://www.instant-gaming.com/de/giveaway/instantgamingde?igr=hundekuchen"
                target="_blank" rel="nofollow sponsored noopener noreferrer">Gewinnspiel</a>
            </div>
          </article>

          <article class="partner-tile reveal">
            <span class="stamp">Werbung · Kooperation</span>
            <img class="partner-logo" src="/assets/img/moneyquest_logo.png" alt="MoneyQuest Logo" loading="lazy" decoding="async">
            <h3>MoneyQuest</h3>
            <p>Finanzberatung für Gamer &amp; Streamer. Deine Finanzen sind dein größtes Abenteuer.
              Von der Starterzone bis zum Endboss, mit klarer Strategie, Quests und persönlicher 1:1-Beratung.</p>
            <div class="partner-links">
              <a class="btn primary" href="/money-quest/">MoneyQuest-Quiz</a>
              <a class="btn" href="https://www.money-quest.de/" target="_blank" rel="nofollow sponsored noopener noreferrer">Mehr erfahren</a>
            </div>
          </article>
        </div>

        <p class="partner-foot">
          Interesse an einer Kooperation? <a class="text-link" href="/partner/">Partner werden →</a>
        </p>
      </div>
    </section>

  </main>

<?php require __DIR__ . '/components/foot.php'; ?>
