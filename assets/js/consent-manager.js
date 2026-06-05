(() => {
  const KEY = "hkl_cookie_consent_v1";

  function hasMarketingConsent() {
    try {
      return JSON.parse(localStorage.getItem(KEY))?.marketing === true;
    } catch {
      return false;
    }
  }

  function saveMarketingConsent() {
    localStorage.setItem(KEY, JSON.stringify({ marketing: true }));
  }

  function loadInstantGaming() {
    window.igBannerConfig = {
      lang: "de",
      igr: "hundekuchen",
      banners: ["ig-banner-slot"]
    };

    const script = document.createElement("script");
    script.src = "https://www.instant-gaming.com/api/banner/partner/loader.js";
    script.defer = true;
    document.head.appendChild(script);
  }

  function showPlaceholder() {
    document.querySelectorAll('[data-consent-vendor="instant-gaming"]').forEach(slot => {
      slot.innerHTML = `
        <div class="consent-placeholder">
          <strong>Instant-Gaming-Banner blockiert</strong>
          <p>Dieser Partnerinhalt kann Tracking nutzen und wird erst nach Zustimmung geladen.</p>
          <button class="btn primary" type="button" data-allow-marketing>
            Marketing / Affiliate erlauben
          </button>
        </div>
      `;
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    if (hasMarketingConsent()) {
      loadInstantGaming();
    } else {
      showPlaceholder();
    }

    document.addEventListener("click", (event) => {
      if (event.target.matches("[data-allow-marketing]")) {
        saveMarketingConsent();
        document.querySelectorAll('[data-consent-vendor="instant-gaming"]').forEach(slot => {
          slot.innerHTML = "";
        });
        loadInstantGaming();
      }
    });
  });
})();