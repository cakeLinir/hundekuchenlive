<?php
$page = [
    'title' => 'MoneyQuest-Quiz | hundekuchenlive',
    'description' => 'Das MoneyQuest-Quiz von hundekuchenlive: Teste dein Gaming-Wissen, sammle Punkte und entscheide danach selbst, ob du deine MoneyQuest starten möchtest. Werbung.',
    'path' => '/money-quest/',
    'css' => ['home.css', 'pages.css'],
    'body' => 'page',
    'scripts' => ['quiz-data.js', 'quiz.js'],
];
require dirname(__DIR__) . '/components/head.php';
?>

  <main id="main">

    <section class="page-hero">
      <span class="splat ph-a" aria-hidden="true"></span>
      <span class="splat b ph-b" aria-hidden="true"></span>
      <div class="container">
        <p class="kicker">hundekuchenlive × MoneyQuest</p>
        <h1 class="tag-title xl">Das MoneyQuest-Quiz</h1>
        <p class="lead"><span class="stamp">Werbung · Kooperation</span><br>Beantworte Fragen aus Gaming, Technik, Multiplayer und Streaming. Am Ende siehst du dein Ergebnis und kannst freiwillig entscheiden, ob du den nächsten Schritt mit MoneyQuest gehst.</p>
        <p style="margin-top:22px"><a class="btn primary lg" href="#quiz">Quiz starten</a></p>
      </div>
    </section>

    <section class="section" id="ablauf">
      <div class="container">
        <h2 class="tag-title lg">So läuft es ab</h2>
        <div class="steps">
          <article class="step"><h3>Quiz starten</h3><p>Du bekommst 10 zufällig gemischte Fragen aus <span data-quiz-total>100</span> Fragen. Keine Anmeldung nötig.</p></article>
          <article class="step"><h3>Ergebnis erhalten</h3><p>Nach der letzten Frage siehst du deine Punktzahl und eine kurze Einordnung.</p></article>
          <article class="step"><h3>Optional weitermachen</h3><p>Erst danach erscheint der Link zum externen MoneyQuest-Fragebogen. Der Klick ist freiwillig.</p></article>
        </div>
      </div>
    </section>

    <section class="section" id="quiz" aria-labelledby="quiz-title">
      <div class="container">
        <h2 class="tag-title lg" id="quiz-title">Gamer-Finanzen-Quiz</h2>
        <p class="sub">Die Auswertung passiert lokal in deinem Browser. Antworten und Ergebnis werden nicht gespeichert und nicht gesendet.</p>

        <div class="qz-card" id="mini-quiz-container" data-rounds="10">
          <div class="qz-meta">
            <span id="mini-quiz-question-counter" aria-live="polite">Frage 1 / 10</span>
            <span id="mini-quiz-score-inline">Punkte: 0</span>
          </div>
          <div class="qz-progress" aria-hidden="true"><div class="qz-progress-bar" id="mini-quiz-progress"></div></div>
          <p class="qz-cat" id="mini-quiz-category"></p>
          <h3 class="qz-question" id="mini-quiz-question">Frage wird geladen...</h3>
          <div class="qz-answers" id="mini-quiz-answers"></div>
          <button class="btn primary" id="mini-quiz-next-btn" type="button" disabled>Nächste Frage</button>
        </div>

        <div class="qz-card qz-result" id="mini-quiz-result" hidden>
          <h3>Quiz abgeschlossen</h3>
          <p>Deine Punktzahl: <strong id="mini-quiz-score">0</strong></p>
          <p id="mini-quiz-score-text"></p>
          <button class="btn" id="mini-quiz-restart-btn" type="button">Quiz erneut spielen</button>

          <div class="mq-cta" data-quiz-after hidden>
            <h4>Bereit für den nächsten Schritt?</h4>
            <p>Wenn du möchtest, öffne jetzt den externen MoneyQuest-Fragebogen. Dort geht es nicht um dein Quiz-Ergebnis, sondern um deine persönliche Ausgangslage. Mit dem Klick verlässt du diese Seite, ab dann gelten die Datenschutzhinweise des Anbieters.</p>
            <div class="actions">
              <a class="btn primary" href="https://leistunglohntsich.typeform.com/to/ixsu066c#ref=Hundekuchen" target="_blank"
                rel="nofollow sponsored noopener noreferrer">MoneyQuest-Fragebogen öffnen (Werbung)</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="tag-title lg">Transparenz</h2>
        <div class="cards-3">
          <article class="s-card c-lime"><h3>Quiz-Daten</h3><p>Deine Antworten und dein Score verlassen deinen Browser nicht.</p></article>
          <article class="s-card c-teal"><h3>Weiterleitung</h3><p>Der Fragebogen öffnet sich nur, wenn du nach dem Ergebnis aktiv klickst. Der Link enthält einen Ref-Hinweis, damit erkennbar ist, dass du über hundekuchenlive kommst.</p></article>
          <article class="s-card c-magenta"><h3>Keine Beratung</h3><p>Diese Seite ist Werbung für eine Kooperation und stellt keine Finanzberatung dar.</p></article>
        </div>
      </div>
    </section>

  </main>

<?php require dirname(__DIR__) . '/components/foot.php'; ?>
