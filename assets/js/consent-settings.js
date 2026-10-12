(() => {
  "use strict";

  const KEY_MARKETING = "hkl_cookie_consent_v1"; // { marketing: true }
  const KEY_EMBEDS = "hkl_embed_consent_v1";     // { twitch: true }

  let dialog = null;

  function readJson(key) {
    try {
      return JSON.parse(localStorage.getItem(key)) || {};
    } catch {
      return {};
    }
  }

  function currentState() {
    return {
      twitch: readJson(KEY_EMBEDS).twitch === true,
      marketing: readJson(KEY_MARKETING).marketing === true,
    };
  }

  function buildDialog() {
    const el = document.createElement("dialog");
    el.className = "consent-dialog";
    el.setAttribute("aria-labelledby", "consent-title");
    el.innerHTML = `
      <form method="dialog" class="consent-inner">
        <h2 id="consent-title">Deine Einwilligungen</h2>
        <p>Externe Inhalte werden nur geladen, wenn du zustimmst. Deine Auswahl wird lokal in deinem Browser gespeichert
          und kann hier jederzeit geändert oder widerrufen werden. Mehr dazu in der
          <a href="/datenschutz/">Datenschutzerklärung</a>.</p>

        <label class="consent-row">
          <input type="checkbox" id="consent-twitch">
          <span><strong>Twitch-Player</strong>
            Der Stream wird automatisch geladen. Dabei werden Daten (z. B. deine IP-Adresse) an Twitch in den USA übertragen.</span>
        </label>

        <label class="consent-row">
          <input type="checkbox" id="consent-marketing">
          <span><strong>Instant-Gaming-Banner (Marketing / Affiliate)</strong>
            Ein Partner-Banner von Instant Gaming wird geladen. Dabei kann Tracking stattfinden.</span>
        </label>

        <div class="consent-actions">
          <button class="btn primary" type="button" id="consent-save">Speichern</button>
          <button class="btn" type="button" id="consent-revoke">Alles widerrufen</button>
          <button class="btn" type="button" id="consent-close">Schließen</button>
        </div>
      </form>`;
    document.body.appendChild(el);

    el.querySelector("#consent-save").addEventListener("click", () => save(false));
    el.querySelector("#consent-revoke").addEventListener("click", () => save(true));
    el.querySelector("#consent-close").addEventListener("click", () => el.close());
    return el;
  }

  function save(revokeAll) {
    const before = currentState();
    const twitch = revokeAll ? false : dialog.querySelector("#consent-twitch").checked;
    const marketing = revokeAll ? false : dialog.querySelector("#consent-marketing").checked;

    try {
      const embeds = readJson(KEY_EMBEDS);
      if (twitch) {
        embeds.twitch = true;
        localStorage.setItem(KEY_EMBEDS, JSON.stringify(embeds));
      } else {
        delete embeds.twitch;
        if (Object.keys(embeds).length) {
          localStorage.setItem(KEY_EMBEDS, JSON.stringify(embeds));
        } else {
          localStorage.removeItem(KEY_EMBEDS);
        }
      }

      if (marketing) {
        localStorage.setItem(KEY_MARKETING, JSON.stringify({ marketing: true }));
      } else {
        localStorage.removeItem(KEY_MARKETING);
      }
    } catch {
      /* Speicher nicht verfügbar: nichts zu tun */
    }

    dialog.close();

    // Bereits geladene Drittanbieter-Inhalte lassen sich nur durch ein Neuladen entfernen
    if (before.twitch !== twitch || before.marketing !== marketing) {
      window.location.reload();
    }
  }

  function openDialog() {
    if (!dialog) dialog = buildDialog();

    const state = currentState();
    dialog.querySelector("#consent-twitch").checked = state.twitch;
    dialog.querySelector("#consent-marketing").checked = state.marketing;

    if (typeof dialog.showModal === "function") {
      dialog.showModal();
    } else {
      dialog.setAttribute("open", "");
    }
  }

  document.addEventListener("click", (event) => {
    if (event.target.closest("[data-open-consent]")) {
      event.preventDefault();
      openDialog();
    }
  });
})();
