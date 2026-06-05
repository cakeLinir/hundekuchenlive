(() => {
  const STORAGE_KEY = "hkl_embed_consent_v1"; // { twitch: true/false }

  function loadState() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch {
      return {};
    }
  }

  function saveState(state) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
  }

  function createIframe(kind, data) {
    const iframe = document.createElement("iframe");
    iframe.width = "100%";
    iframe.height = data.height || "540";
    iframe.allowFullscreen = true;

    if (kind === "twitch") {
      const parent = data.parent || "hundekuchenlive.de";
      const channel = data.channel || "hundekuchenlive";
      iframe.src = `https://player.twitch.tv/?channel=${encodeURIComponent(channel)}&parent=${encodeURIComponent(parent)}`;
    }

    return iframe;
  }

  function render(kind, box) {
    const data = {
      height: box.dataset.height || "540",
      parent: box.dataset.parent,
      channel: box.dataset.channel
    };

    const wrap = box.querySelector(".embed-wrap");
    if (!wrap) return;

    wrap.innerHTML = "";
    wrap.appendChild(createIframe(kind, data));

    const hint = box.querySelector(".embed-hint");
    if (hint) hint.remove();
  }

  function enable(kind, box, remember) {
    render(kind, box);

    if (remember) {
      const state = loadState();
      state[kind] = true;
      saveState(state);
    }
  }

  function init() {
    const state = loadState();

    document.querySelectorAll("[data-embed]").forEach((box) => {
      const kind = box.dataset.embed;
      const remember = box.dataset.remember === "true";

      if (remember && state[kind] === true) {
        render(kind, box);
        return;
      }

      const btnLoad = box.querySelector("[data-action='load']");
      const btnLoadRemember = box.querySelector("[data-action='load-remember']");

      if (btnLoad) {
        btnLoad.addEventListener("click", () => enable(kind, box, false));
      }

      if (btnLoadRemember) {
        btnLoadRemember.addEventListener("click", () => enable(kind, box, true));
      }
    });
  }

  document.addEventListener("DOMContentLoaded", init);
})();