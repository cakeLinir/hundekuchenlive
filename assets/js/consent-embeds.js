(() => {
  "use strict";

  const STORAGE_KEY = "hkl_embed_consent_v1"; // { twitch: true }

  function loadState() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch {
      return {};
    }
  }

  function saveState(state) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    } catch {
      /* Speicher nicht verfügbar: ignorieren */
    }
  }

  function createIframe(kind, data) {
    const iframe = document.createElement("iframe");
    iframe.title = "Twitch-Stream von hundekuchenlive";
    iframe.allow = "autoplay; fullscreen";
    iframe.allowFullscreen = true;
    iframe.referrerPolicy = "strict-origin-when-cross-origin";

    if (kind === "twitch") {
      const params = new URLSearchParams({
        channel: data.channel || "hundekuchenlive",
        parent: window.location.hostname || "hundekuchenlive.de",
        autoplay: data.autoplay ? "true" : "false",
        muted: "false",
      });
      iframe.src = `https://player.twitch.tv/?${params.toString()}`;
    }
    return iframe;
  }

  function render(kind, box, autoplay) {
    const wrap = box.querySelector(".embed-wrap");
    if (!wrap) return;
    wrap.replaceChildren(createIframe(kind, { channel: box.dataset.channel, autoplay }));
  }

  function init() {
    const state = loadState();

    document.querySelectorAll("[data-embed]").forEach((box) => {
      const kind = box.dataset.embed;
      const remember = box.dataset.remember === "true";

      // Gespeicherte Einwilligung: ohne Autoplay laden (der Player liegt meist noch außerhalb des Bildschirms)
      if (remember && state[kind] === true) {
        render(kind, box, false);
        return;
      }

      const btnLoad = box.querySelector("[data-action='load']");
      const btnLoadRemember = box.querySelector("[data-action='load-remember']");

      if (btnLoad) {
        btnLoad.addEventListener("click", () => render(kind, box, true));
      }
      if (btnLoadRemember) {
        btnLoadRemember.addEventListener("click", () => {
          const current = loadState();
          current[kind] = true;
          saveState(current);
          render(kind, box, true);
        });
      }
    });
  }

  document.addEventListener("DOMContentLoaded", init);
})();
