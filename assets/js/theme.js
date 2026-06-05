(() => {
  "use strict";

  const STORAGE_KEY = "hkl-theme";
  const root = document.documentElement;

  function getTheme() {
    try {
      const savedTheme = localStorage.getItem(STORAGE_KEY);
      return savedTheme === "light" ? "light" : "dark";
    } catch {
      return "dark";
    }
  }

  function saveTheme(theme) {
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch {
      /* ignorieren */
    }
  }

  function applyTheme(theme) {
    const isLight = theme === "light";

    root.setAttribute("data-theme", theme);
    root.style.colorScheme = theme;

    document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
      const text = button.querySelector(".theme-toggle-text");

      button.setAttribute("aria-pressed", String(isLight));

      if (text) {
        text.textContent = isLight ? "Lightmode" : "Darkmode";
      }
    });
  }

  applyTheme(getTheme());

  document.addEventListener("click", (event) => {
    const button = event.target.closest("[data-theme-toggle]");

    if (!button) return;

    const currentTheme = root.getAttribute("data-theme") || getTheme();
    const nextTheme = currentTheme === "light" ? "dark" : "light";

    applyTheme(nextTheme);
    saveTheme(nextTheme);
  });
})();