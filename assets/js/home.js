(() => {
  "use strict";

  const TZ = "Europe/Berlin";
  const TWITCH_URL = "https://www.twitch.tv/hundekuchenlive";
  const DAY_NAMES = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];

  // Feste Livestreams (deutsche Zeit). day: 0 = Sonntag … 6 = Samstag
  const SCHEDULE = [
    { day: 1, hour: 18, minute: 45, endHour: 21, endMinute: 30, title: "Valorant Ranked Solo/Duo" },
    { day: 5, hour: 19, minute: 0, endHour: 22, endMinute: 30, title: "Community-Abend" },
  ];

  const el = {
    label: document.getElementById("live-card-label"),
    title: document.getElementById("live-card-title"),
    meta: document.getElementById("live-card-meta"),
    cta: document.getElementById("live-card-cta"),
    heroWatch: document.getElementById("hero-watch"),
  };

  let liveData = null;

  function berlinNow() {
    try {
      const parts = new Intl.DateTimeFormat("en-GB", {
        timeZone: TZ,
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hourCycle: "h23",
      }).formatToParts(new Date());
      const get = (type) => Number(parts.find((p) => p.type === type).value);
      return new Date(get("year"), get("month") - 1, get("day"), get("hour"), get("minute"), get("second"));
    } catch (error) {
      return new Date();
    }
  }

  function at(base, hour, minute) {
    return new Date(base.getFullYear(), base.getMonth(), base.getDate(), hour, minute);
  }

  // Läuft heute gerade ein geplantes Zeitfenster?
  function activeSlot(now) {
    for (const slot of SCHEDULE) {
      if (slot.day !== now.getDay()) continue;
      const start = at(now, slot.hour, slot.minute);
      const end = at(now, slot.endHour, slot.endMinute);
      if (now >= start && now <= end) return slot;
    }
    return null;
  }

  function nextStream(now) {
    for (let offset = 0; offset <= 7; offset++) {
      const base = new Date(now.getFullYear(), now.getMonth(), now.getDate() + offset);
      for (const slot of SCHEDULE) {
        if (slot.day !== base.getDay()) continue;
        const start = at(base, slot.hour, slot.minute);
        if (start > now) return { slot, start, offset };
      }
    }
    return null;
  }

  function formatCountdown(ms) {
    const totalMin = Math.max(0, Math.round(ms / 60000));
    const days = Math.floor(totalMin / 1440);
    const hours = Math.floor((totalMin % 1440) / 60);
    const mins = totalMin % 60;

    if (days >= 1) {
      return `in ${days} ${days === 1 ? "Tag" : "Tagen"}${hours ? ` und ${hours} Std.` : ""}`;
    }
    if (hours >= 1) return `in ${hours} Std. ${mins} Min.`;
    return `in ${mins} Min.`;
  }

  function dayLabel(offset, date) {
    if (offset === 0) return "Heute";
    if (offset === 1) return "Morgen";
    return DAY_NAMES[date.getDay()];
  }

  function pad(n) {
    return String(n).padStart(2, "0");
  }

  function setCta(text, href, external) {
    if (!el.cta) return;
    el.cta.textContent = text;
    el.cta.href = href;
    if (external) {
      el.cta.target = "_blank";
      el.cta.rel = "noopener noreferrer";
    } else {
      el.cta.removeAttribute("target");
      el.cta.removeAttribute("rel");
    }
  }

  function renderCard() {
    const now = berlinNow();

    // heutigen Streamtag hervorheben
    document.querySelectorAll("[data-day]").forEach((item) => {
      item.classList.toggle("is-today", Number(item.dataset.day) === now.getDay());
    });

    if (!el.title) return;

    // Twitch meldet: live
    if (liveData && liveData.live) {
      const bits = [];
      if (liveData.game_name) bits.push(liveData.game_name);
      if (Number.isFinite(liveData.viewer_count)) bits.push(`${liveData.viewer_count} Zuschauer`);

      if (el.label) el.label.textContent = "Jetzt live";
      el.title.textContent = liveData.title || "hundekuchenlive ist live";
      if (el.meta) el.meta.textContent = bits.join(" · ");
      setCta("Jetzt zuschauen", TWITCH_URL, true);
      if (el.heroWatch) el.heroWatch.textContent = "Jetzt live zuschauen";
      return;
    }

    if (el.heroWatch) el.heroWatch.textContent = "Auf Twitch zuschauen";

    // Geplantes Zeitfenster läuft, Twitch zeigt aber noch offline
    const active = activeSlot(now);
    if (active) {
      if (el.label) el.label.textContent = "Heute geplant";
      el.title.textContent = active.title;
      if (el.meta) {
        el.meta.textContent =
          `${pad(active.hour)}:${pad(active.minute)}–${pad(active.endHour)}:${pad(active.endMinute)} Uhr · gleich geht's los`;
      }
      setCta("Auf Twitch vorbeischauen", TWITCH_URL, true);
      return;
    }

    const next = nextStream(now);
    if (!next) return;

    const { slot, start, offset } = next;
    if (el.label) el.label.textContent = "Nächster Stream";
    el.title.textContent = slot.title;
    if (el.meta) {
      el.meta.textContent =
        `${dayLabel(offset, start)}, ${pad(slot.hour)}:${pad(slot.minute)} Uhr · ${formatCountdown(start - now)}`;
    }
    setCta("Streamplan ansehen", "/streamingplan/", false);
  }

  function initReveal() {
    const items = document.querySelectorAll(".reveal");
    if (!("IntersectionObserver" in window)) {
      items.forEach((item) => item.classList.add("is-visible"));
      return;
    }
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    items.forEach((item) => observer.observe(item));
  }

  document.addEventListener("twitch:status", (event) => {
    liveData = event.detail || null;
    renderCard();
  });

  document.addEventListener("DOMContentLoaded", () => {
    renderCard();
    setInterval(renderCard, 30000);
    initReveal();
  });
})();
