(() => {
  "use strict";

  const ENDPOINT = "/api/twitch-status.php";
  const REFRESH_MS = 60000;
  let timer = null;

  function publish(state, detail) {
    document.documentElement.dataset.live = state; // "true" | "false" | "unknown"
    document.dispatchEvent(new CustomEvent("twitch:status", { detail }));
  }

  function setState(element, isLive, text) {
    element.textContent = text;
    element.classList.toggle("live", isLive);
    element.classList.toggle("offline", !isLive);
  }

  async function updateTwitchStatus() {
    const statusElement = document.getElementById("twitch-status");
    if (!statusElement) return;

    try {
      const response = await fetch(ENDPOINT, { cache: "no-store" });
      const data = await response.json();

      if (!response.ok || data.error) {
        setState(statusElement, false, "Status derzeit nicht verfügbar");
        publish("unknown", { live: false, unavailable: true });
        return;
      }

      if (data.live) {
        const game = data.game_name ? ` – ${data.game_name}` : "";
        const viewers = Number.isFinite(data.viewer_count) ? ` (${data.viewer_count} Zuschauer)` : "";
        setState(statusElement, true, `LIVE${game}${viewers}`);
        publish("true", data);
      } else {
        setState(statusElement, false, "Offline");
        publish("false", { live: false });
      }
    } catch (error) {
      setState(statusElement, false, "Status derzeit nicht verfügbar");
      publish("unknown", { live: false, unavailable: true });
    }
  }

  function startPolling() {
    stopPolling();
    updateTwitchStatus();
    timer = setInterval(updateTwitchStatus, REFRESH_MS);
  }

  function stopPolling() {
    if (timer !== null) {
      clearInterval(timer);
      timer = null;
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    if (!document.getElementById("twitch-status")) return;

    startPolling();

    document.addEventListener("visibilitychange", () => {
      if (document.hidden) {
        stopPolling();
      } else {
        startPolling();
      }
    });
  });
})();
