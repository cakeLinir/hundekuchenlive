(() => {
  "use strict";

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const root = document.documentElement;

  // Scroll-Fortschritt, Schnellzugriff-Leiste, Parallax
  const bar = document.createElement("div");
  bar.className = "scroll-progress";
  bar.setAttribute("aria-hidden", "true");
  document.body.appendChild(bar);

  const actionBar = document.querySelector(".action-bar");
  const parallaxItems = Array.from(document.querySelectorAll("[data-parallax]"));
  let ticking = false;

  function update() {
    const max = root.scrollHeight - window.innerHeight;
    const y = window.scrollY;

    bar.style.setProperty("--p", max > 0 ? (y / max).toFixed(4) : "0");
    if (actionBar) actionBar.classList.toggle("is-visible", y > 480);

    if (!reduce) {
      parallaxItems.forEach((el) => {
        el.style.setProperty("--py", `${(y * Number(el.dataset.parallax)).toFixed(1)}px`);
      });
    }
    ticking = false;
  }

  window.addEventListener("scroll", () => {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  }, { passive: true });
  window.addEventListener("resize", update);
  update();

  // 3D-Kippen mit der Maus
  if (!reduce && window.matchMedia("(hover: hover)").matches) {
    document.querySelectorAll("[data-tilt]").forEach((el) => {
      el.addEventListener("pointermove", (event) => {
        const rect = el.getBoundingClientRect();
        const px = (event.clientX - rect.left) / rect.width - 0.5;
        const py = (event.clientY - rect.top) / rect.height - 0.5;
        el.style.transform = `perspective(900px) rotateY(${(px * 10).toFixed(2)}deg) rotateX(${(-py * 10).toFixed(2)}deg)`;
      });
      el.addEventListener("pointerleave", () => { el.style.transform = ""; });
    });
  }
})();
