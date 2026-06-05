(() => {
  "use strict";

  const CONFIG = {
    answerLabels: ["A", "B", "C", "D"],
    fallbackCategory: "Quiz",
    fallbackDifficulty: "normal"
  };

  const state = {
    currentIndex: 0,
    score: 0,
    answered: false,
    questions: []
  };

  function getRawQuestions() {
    if (Array.isArray(window.moneyQuestQuestions)) {
      return window.moneyQuestQuestions;
    }

    if (typeof questions !== "undefined" && Array.isArray(questions)) {
      return questions;
    }

    return [];
  }

  function getElements() {
    return {
      totalQuestions: document.getElementById("mq-total-questions"),
      quizContainer: document.getElementById("mq-quiz-container"),
      result: document.getElementById("mq-result"),
      question: document.getElementById("mq-question"),
      answers: document.getElementById("mq-answers"),
      nextBtn: document.getElementById("mq-next-btn"),
      restartBtn: document.getElementById("mq-restart-btn"),
      scoreInline: document.getElementById("mq-score-inline"),
      score: document.getElementById("mq-score"),
      scoreText: document.getElementById("mq-score-text"),
      counter: document.getElementById("mq-question-counter"),
      category: document.getElementById("mq-question-category"),
      progress: document.getElementById("mq-progress")
    };
  }

  function hasRequiredElements(els) {
    const required = [
      "quizContainer",
      "result",
      "question",
      "answers",
      "nextBtn",
      "restartBtn",
      "scoreInline",
      "score",
      "scoreText",
      "counter",
      "category",
      "progress"
    ];

    return required.every((key) => Boolean(els[key]));
  }

  function shuffle(array) {
    const copy = [...array];

    for (let index = copy.length - 1; index > 0; index -= 1) {
      const randomIndex = Math.floor(Math.random() * (index + 1));
      [copy[index], copy[randomIndex]] = [copy[randomIndex], copy[index]];
    }

    return copy;
  }

  function normalizeQuestion(question) {
    if (!question || typeof question !== "object") return null;
    if (!Array.isArray(question.answers)) return null;
    if (question.answers.length < 2) return null;

    const questionText = String(question.question || "").trim();
    const correctAnswerIndex = Number(question.correctAnswer);

    if (!questionText) return null;

    if (
      !Number.isInteger(correctAnswerIndex) ||
      correctAnswerIndex < 0 ||
      correctAnswerIndex >= question.answers.length
    ) {
      return null;
    }

    const answers = question.answers
      .map((answer, index) => ({
        text: String(answer || "").trim(),
        isCorrect: index === correctAnswerIndex
      }))
      .filter((answer) => answer.text.length > 0);

    const hasCorrectAnswer = answers.some((answer) => answer.isCorrect);

    if (!hasCorrectAnswer || answers.length < 2) {
      return null;
    }

    return {
      question: questionText,
      category: String(question.category || CONFIG.fallbackCategory).trim(),
      difficulty: String(question.difficulty || CONFIG.fallbackDifficulty).trim(),
      answers: shuffle(answers)
    };
  }

  function prepareQuestions(els) {
    const rawQuestions = getRawQuestions();

    state.questions = shuffle(rawQuestions)
      .map(normalizeQuestion)
      .filter(Boolean);

    if (els.totalQuestions) {
      els.totalQuestions.textContent = String(state.questions.length);
    }
  }

  function setProgress(els, percent) {
    const safePercent = Math.max(0, Math.min(100, percent));
    els.progress.style.width = `${safePercent}%`;
  }

  function updateProgress(els) {
    const total = state.questions.length;
    const progress = total === 0 ? 0 : (state.currentIndex / total) * 100;

    setProgress(els, progress);
  }

  function updateScore(els) {
    els.scoreInline.textContent = `Punkte: ${state.score}`;
  }

  function clearAnswers(els) {
    els.answers.innerHTML = "";
  }

  function createAnswerButton(answer, index) {
    const button = document.createElement("button");
    button.className = "mq-answer-btn";
    button.type = "button";
    button.dataset.correct = String(answer.isCorrect);

    const label = document.createElement("span");
    label.className = "mq-answer-label";
    label.textContent = CONFIG.answerLabels[index] || String(index + 1);

    const text = document.createElement("span");
    text.className = "mq-answer-text";
    text.textContent = answer.text;

    button.append(label, text);

    return button;
  }

  function showEmptyState(els) {
    els.question.textContent = "Es wurden keine gültigen Quizfragen gefunden.";
    els.counter.textContent = "Frage 0 / 0";
    els.category.textContent = "Keine Fragen verfügbar";
    els.scoreInline.textContent = "Punkte: 0";
    els.nextBtn.disabled = true;

    clearAnswers(els);
    setProgress(els, 0);
  }

  function renderQuestion(els) {
    const total = state.questions.length;

    if (total === 0) {
      showEmptyState(els);
      return;
    }

    if (state.currentIndex >= total) {
      showResult(els);
      return;
    }

    const currentQuestion = state.questions[state.currentIndex];

    state.answered = false;
    els.nextBtn.disabled = true;

    els.question.textContent = currentQuestion.question;
    els.counter.textContent = `Frage ${state.currentIndex + 1} / ${total}`;
    els.category.textContent = `${currentQuestion.category} · ${currentQuestion.difficulty}`;

    updateScore(els);
    updateProgress(els);
    clearAnswers(els);

    currentQuestion.answers.forEach((answer, index) => {
      els.answers.appendChild(createAnswerButton(answer, index));
    });
  }

  function checkAnswer(els, selectedButton) {
    if (state.answered) return;

    state.answered = true;

    const isCorrect = selectedButton.dataset.correct === "true";
    const answerButtons = Array.from(els.answers.querySelectorAll(".mq-answer-btn"));

    answerButtons.forEach((button) => {
      button.disabled = true;

      if (button.dataset.correct === "true") {
        button.classList.add("is-correct");
      }
    });

    if (isCorrect) {
      state.score += 1;
      updateScore(els);
    } else {
      selectedButton.classList.add("is-wrong");
    }

    els.nextBtn.disabled = false;
    els.nextBtn.focus();
  }

  function nextQuestion(els) {
    if (!state.answered) return;

    state.currentIndex += 1;
    renderQuestion(els);
  }

  function getResultText(ratio) {
    if (ratio === 1) {
      return "Perfekt! Du hast jede Frage richtig beantwortet.";
    }

    if (ratio >= 0.8) {
      return "Starkes Ergebnis. Du hast ein sehr gutes Gaming-Wissen.";
    }

    if (ratio >= 0.55) {
      return "Solider Run. Du hast eine gute Basis, aber ein paar Fragen waren noch offen.";
    }

    return "Starterzone geschafft. Beim nächsten Versuch kannst du dein Ergebnis verbessern.";
  }

  function showResult(els) {
    const total = state.questions.length;
    const ratio = total === 0 ? 0 : state.score / total;

    els.quizContainer.hidden = true;
    els.result.hidden = false;

    setProgress(els, 100);

    els.score.textContent = `${state.score} / ${total}`;
    els.scoreText.textContent = getResultText(ratio);

    els.result.scrollIntoView({
      behavior: "smooth",
      block: "start"
    });
  }

  function restartQuiz(els) {
    state.currentIndex = 0;
    state.score = 0;
    state.answered = false;

    prepareQuestions(els);

    els.quizContainer.hidden = false;
    els.result.hidden = true;
    els.nextBtn.disabled = true;

    renderQuestion(els);

    els.quizContainer.scrollIntoView({
      behavior: "smooth",
      block: "start"
    });
  }

  function bindEvents(els) {
    els.answers.addEventListener("click", (event) => {
      const selectedButton = event.target.closest(".mq-answer-btn");

      if (!selectedButton || !els.answers.contains(selectedButton)) {
        return;
      }

      checkAnswer(els, selectedButton);
    });

    els.nextBtn.addEventListener("click", () => {
      nextQuestion(els);
    });

    els.restartBtn.addEventListener("click", () => {
      restartQuiz(els);
    });
  }

  function initQuiz() {
    const els = getElements();

    if (!hasRequiredElements(els)) {
      console.warn("Money-Quest-Quiz konnte nicht initialisiert werden: erforderliche HTML-Elemente fehlen.");
      return;
    }

    prepareQuestions(els);
    bindEvents(els);
    renderQuestion(els);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initQuiz, { once: true });
  } else {
    initQuiz();
  }
})();