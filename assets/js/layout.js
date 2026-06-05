async function loadComponent(id, file) {
  const element = document.getElementById(id);
  if (!element) return;

  try {
    const response = await fetch(file);
    if (!response.ok) {
      throw new Error(`Fehler beim Laden von ${file}: ${response.status}`);
    }

    const html = await response.text();
    element.innerHTML = html;
  } catch (error) {
    console.error(error);
  }
}

function markActiveNav() {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll("nav a");

  navLinks.forEach((link) => {
    const href = link.getAttribute("href");

    link.removeAttribute("aria-current");

    if (href === "/" && currentPath === "/") {
      link.setAttribute("aria-current", "page");
      return;
    }

    if (href !== "/" && currentPath.startsWith(href)) {
      link.setAttribute("aria-current", "page");
    }
  });
}

function initMobileNav() {
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.querySelector("#site-nav");

  if (!toggle || !nav) return;

  toggle.addEventListener("click", () => {
    const isOpen = nav.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    toggle.setAttribute("aria-label", isOpen ? "Menü schließen" : "Menü öffnen");
  });

  nav.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      nav.classList.remove("is-open");
      toggle.setAttribute("aria-expanded", "false");
      toggle.setAttribute("aria-label", "Menü öffnen");
    });
  });
}

document.addEventListener("DOMContentLoaded", async () => {
  const headerTarget = document.getElementById("site-header");
  const footerTarget = document.getElementById("site-footer");

  async function loadComponent(target, path) {
    if (!target) return;

    try {
      const response = await fetch(path, {
        cache: "no-store"
      });

      if (!response.ok) {
        throw new Error(`Component konnte nicht geladen werden: ${path}`);
      }

      target.innerHTML = await response.text();
    } catch (error) {
      console.error(error);
    }
  }

  await loadComponent(headerTarget, "/components/header.html");
  await loadComponent(footerTarget, "/components/footer.html");

  document.dispatchEvent(new CustomEvent("layout:loaded"));
});