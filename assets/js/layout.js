async function loadComponent(target, path) {
  if (!target) return;
  try {
    const response = await fetch(path, { cache: 'no-store' });
    if (!response.ok) throw new Error(`Component konnte nicht geladen werden: ${path}`);
    target.innerHTML = await response.text();
  } catch (error) {
    console.error(error);
  }
}

function markActiveNav() {
  const currentPath = window.location.pathname;
  document.querySelectorAll('nav a').forEach((link) => {
    const href = link.getAttribute('href');
    link.removeAttribute('aria-current');
    if (href === '/' && currentPath === '/') {
      link.setAttribute('aria-current', 'page');
    } else if (href !== '/' && currentPath.startsWith(href)) {
      link.setAttribute('aria-current', 'page');
    }
  });
}

function initMobileNav() {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('#site-nav');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    const isOpen = nav.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    toggle.setAttribute('aria-label', isOpen ? 'Menü schließen' : 'Menü öffnen');
  });

  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      nav.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Menü öffnen');
    });
  });
}

document.addEventListener('DOMContentLoaded', async () => {
  await loadComponent(document.getElementById('site-header'), '/components/header.html');
  await loadComponent(document.getElementById('site-footer'), '/components/footer.html');

  markActiveNav();
  initMobileNav();
  document.dispatchEvent(new CustomEvent('layout:loaded'));
});
