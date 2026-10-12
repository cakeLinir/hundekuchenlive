(() => {
  "use strict";

  const CATEGORIES = {
    g: "Gaming-Grundwissen", b: "Gaming-Begriffe", m: "Spielmechaniken", n: "Genres",
    k: "Gaming-Kultur", s: "Bekannte Spiele", h: "Hardware", t: "Technik",
    o: "Online-Gaming", u: "Multiplayer", v: "Streaming", x: "Shooter",
    r: "Spielrollen", e: "Esport", a: "Grafik",
  };
  const LABELS = ["a)", "b)", "c)", "d)"];

  const bank = (window.HKL_QUIZ || []).map(([question, answers, correct, cat]) => ({
    question, answers, correct, category: CATEGORIES[cat] || "",
  }));

  const $ = (id) => document.getElementById(id);
  const container = $("mini-quiz-container");
  const result = $("mini-quiz-result");
  const questionEl = $("mini-quiz-question");
  const answersEl = $("mini-quiz-answers");
  const nextBtn = $("mini-quiz-next-btn");
  const restartBtn = $("mini-quiz-restart-btn");
  const counterEl = $("mini-quiz-question-counter");
  const scoreInlineEl = $("mini-quiz-score-inline");
  const progressEl = $("mini-quiz-progress");
  const scoreEl = $("mini-quiz-score");
  const scoreTextEl = $("mini-quiz-score-text");
  const categoryEl = $("mini-quiz-category");

  if (!container || !result || !questionEl || !answersEl || !nextBtn || !restartBtn ||
      !counterEl || !scoreInlineEl || !progressEl || !scoreEl || !scoreTextEl || !bank.length) {
    return;
  }

  const rounds = Math.min(bank.length, Number(container.dataset.rounds) || 10);
  document.querySelectorAll("[data-quiz-total]").forEach((el) => { el.textContent = String(bank.length); });

  let current = [];
  let index = 0;
  let score = 0;
  let answered = false;

  function shuffle(list) {
    const copy = list.slice();
    for (let i = copy.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [copy[i], copy[j]] = [copy[j], copy[i]];
    }
    return copy;
  }

  function toggleAfter(visible) {
    document.querySelectorAll("[data-quiz-after]").forEach((el) => { el.hidden = !visible; });
  }

  function startRound() {
    current = shuffle(bank).slice(0, rounds).map((q) => ({
      question: q.question,
      category: q.category,
      options: shuffle(q.answers.map((text, i) => ({ text, ok: i === q.correct }))),
    }));
    index = 0;
    score = 0;
    container.hidden = false;
    result.hidden = true;
    toggleAfter(false);
    render();
  }

  function render() {
    const q = current[index];
    answered = false;
    nextBtn.disabled = true;
    nextBtn.textContent = index === current.length - 1 ? "Ergebnis anzeigen" : "Nächste Frage";

    counterEl.textContent = `Frage ${index + 1} / ${current.length}`;
    scoreInlineEl.textContent = `Punkte: ${score}`;
    progressEl.style.width = `${(index / current.length) * 100}%`;
    if (categoryEl) categoryEl.textContent = q.category;
    questionEl.textContent = q.question;

    answersEl.replaceChildren(...q.options.map((option, i) => {
      const button = document.createElement("button");
      button.type = "button";
      button.className = "mini-quiz-btn mini-quiz-btn-answer";

      const label = document.createElement("span");
      label.className = "mini-quiz-answer-label";
      label.textContent = LABELS[i];

      const text = document.createElement("span");
      text.textContent = option.text;

      button.append(label, text);
      button.addEventListener("click", () => choose(i));
      return button;
    }));
  }

  function choose(choice) {
    if (answered) return;
    answered = true;

    const q = current[index];
    Array.from(answersEl.children).forEach((button, i) => {
      button.disabled = true;
      if (q.options[i].ok) button.classList.add("is-correct");
      if (i === choice && !q.options[i].ok) button.classList.add("is-wrong");
    });

    if (q.options[choice].ok) score++;
    scoreInlineEl.textContent = `Punkte: ${score}`;
    nextBtn.disabled = false;
    nextBtn.focus();
  }

  function next() {
    if (!answered) return;
    index++;
    if (index >= current.length) {
      showResult();
    } else {
      render();
    }
  }

  function showResult() {
    container.hidden = true;
    result.hidden = false;
    progressEl.style.width = "100%";
    scoreEl.textContent = `${score} / ${current.length}`;

    const ratio = score / current.length;
    scoreTextEl.textContent =
      ratio === 1 ? "Perfekt! Du hast alle Fragen richtig beantwortet." :
      ratio >= 0.7 ? "Sehr gut! Du hast schon richtig viel Wissen." :
      ratio >= 0.4 ? "Gar nicht schlecht, da geht noch was!" :
      "Kopf hoch, beim nächsten Versuch wird's besser!";

    toggleAfter(true);
  }

  nextBtn.addEventListener("click", next);
  restartBtn.addEventListener("click", startRound);
  startRound();
})();
