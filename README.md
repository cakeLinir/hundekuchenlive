# hundekuchenlive

Official website for **hundekuchenlive**, a German gaming creator focused on **Valorant, Rocket League and other games**. Live on Twitch (Monday and Friday), with community presence on Discord, TikTok and YouTube.

**Live:** [hundekuchenlive.de](https://hundekuchenlive.de)  
**Last updated:** 2026-10-12

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3 (custom properties, dark/light theme, "Los Santos" graffiti design system), Vanilla JS |
| Backend | PHP 7.4+ (production: PHP 8.4), PHPMailer 7.0.2 |
| Layout | Server-side includes (`components/*.php`), no client-side fetching of header/footer |
| Email | IONOS SMTP via PHPMailer |
| Streaming | Twitch Helix API (live status, token + response caching) |
| Hosting | Apache (IONOS), `.htaccess` rewriting, security headers, caching |

No build tools, no npm, no frameworks. Intentionally lean. No external fonts, scripts or trackers are loaded without consent.

---

## Pages

| Route | Description | Sitemap priority |
|-------|-------------|------------------|
| `/` | Homepage: hero with live status and next stream, games, stream times, spray wall, Twitch player, crew, quiz, merch, partners | 1.0 |
| `/about/` | Creator background, games, team UKF Eclipse (Unknown Forces Esports e.V.) and member search | 0.8 |
| `/streamingplan/` | Fixed stream times (Monday and Friday only) | 0.8 |
| `/partner/` | Sponsorship packages + contact form | 0.7 |
| `/money-quest/` | Branded gaming quiz (MoneyQuest partnership, advertising) | 0.6 |
| `/cloud/` | Internal collaboration (Nextcloud) landing page | 0.4 |
| `/impressum/` | Legal imprint (German law) | 0.3 |
| `/datenschutz/` | Privacy policy / GDPR | 0.3 |
| `/spenden/` | 302 redirect to the StreamElements tipping page (not in sitemap) | - |
| `/404.php` | Custom error page (`ErrorDocument 404`) | - |

---

## Project Structure

```
hundekuchenlive/
├── about/, streamingplan/, partner/, cloud/,
│   money-quest/, impressum/, datenschutz/   # one index.php per page
├── spenden/index.php        # redirect to StreamElements
├── api/
│   └── twitch-status.php    # Twitch Helix proxy (token + status cache in temp dir)
├── assets/
│   ├── css/                 # style.css (design system), effects.css (global),
│   │                        # home.css, pages.css, plan.css, team.css
│   ├── js/                  # site, theme, effects, home, spray, quiz, quiz-data,
│   │                        # twitch-status, consent-manager/-embeds/-settings, contact
│   ├── img/                 # logos, splat/drips SVGs, OG image, icons
│   ├── fonts/               # optional self-hosted Anton (anton.woff2)
│   └── php/                 # csrf.php, rate-limit.php, kontakt-submit.php
├── components/
│   ├── head.php             # <head>, meta, OG, JSON-LD, CSS (cache-busted)
│   ├── header.php           # navigation
│   ├── footer.php           # footer, legal links, consent settings, theme toggle
│   └── foot.php             # footer include, mobile action bar, scripts
├── PHPMailer/               # PHPMailer 7.0.2 (bundled, no Composer)
├── 404.php
├── .htaccess                # redirects, CSP, security headers, caching
├── config.php               # credential loader (config.local.php or environment)
├── config.local.php.example # template, copy to config.local.php
├── robots.txt
└── sitemap.xml
```

### How a page is built

Each page file sets a `$page` array (title, description, canonical path, extra CSS/JS, body class), includes `components/head.php` and ends with `components/foot.php`. CSS and JS files get their modification time appended (`?v=…`) automatically, so deployments never serve stale assets.

### Where to change content

| What | Where |
|------|-------|
| Stream times (display) | `index.php` (section "Streamzeiten") and `streamingplan/index.php` |
| Next-stream countdown | `SCHEDULE` in `assets/js/home.js` (German time) |
| Quiz questions | `assets/js/quiz-data.js` (`[question, answers, correctIndex, category]`) |
| Navigation / footer | `components/header.php`, `components/footer.php` |
| Tipping link | `TIP_URL` in `components/header.php` and `spenden/index.php` |
| Colors, fonts, effects | `:root` in `assets/css/style.css` |

---

## Local Setup

**1. Clone the repository**

```bash
git clone https://github.com/cakeLinir/hundekuchenlive.git
cd hundekuchenlive
```

**2. Configure credentials**

```bash
cp config.local.php.example config.local.php
```

`config.local.php` may either call `define()` for the constants below or provide the values via `putenv()`. `config.php` handles both and falls back to server environment variables.

| Variable | Description |
|----------|-------------|
| `SMTP_HOST` | SMTP server (default: `smtp.ionos.de`) |
| `SMTP_USER` | Sender email address |
| `SMTP_PASS` | SMTP password |
| `SMTP_PORT` | SMTP port (default: `587`) |
| `TWITCH_CLIENT_ID` | Twitch Developer App Client ID |
| `TWITCH_CLIENT_SECRET` | Twitch Developer App Client Secret (app type: Confidential) |

`config.local.php` is listed in `.gitignore` and is never committed.

**3. Serve locally**

```bash
php -S localhost:8000
```

The PHP built-in server ignores `.htaccess` (no redirects, CSP or caching). The session cookie is only marked `Secure` over HTTPS, so the contact form works locally.

---

## Production Deployment

1. Upload all files to the webroot **except** `config.local.php`.
2. Create `config.local.php` directly on the server (FTP/SSH). It is not part of the repository, so `git pull` never brings it along.
3. Required Apache modules: `mod_rewrite`, `mod_headers`; recommended: `mod_expires`, `mod_deflate`.
4. PHP needs cURL and write access to `sys_get_temp_dir()` (Twitch token and status cache).
5. Check that `sitemap.xml` is up to date and referenced in `robots.txt`.
6. After deploying, verify: `/api/twitch-status.php` returns `{"live":false}` (or live data). On errors it returns a short `reason` code (for example `config`, `token_http_403`, `network`) and writes details to the PHP error log.
7. Never leave temporary diagnostic scripts on the server.

---

## SEO & Sitemap

- `sitemap.xml` lists all public pages with `lastmod` and `priority`, following the [sitemaps.org](https://www.sitemaps.org/) protocol.
- `robots.txt` references the sitemap and disallows `/api/`, `/assets/php/` and `/components/`.
- Each page sets title, description, canonical URL, Open Graph and Twitter tags in its `$page` array. The homepage also ships JSON-LD (`WebSite`, `Person`).
- Redirect-only or internal pages must not be listed in the sitemap and should be set to `noindex` (`$page['robots']`).
- Submit the sitemap in Google Search Console to monitor indexing.

---

## Security

- Credentials are never hardcoded. They are loaded at runtime via `config.php`.
- `.htaccess` blocks direct access to `config*.php`, `csrf.php`, `rate-limit.php`, `README.md`, `.git`, `PHPMailer/` and `components/*.php`.
- Security headers on every response: `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy`, `Strict-Transport-Security` and a **Content-Security-Policy** that only allows `self`, the Twitch player (frames) and the Instant Gaming banner (script, style, font, connect, frame).
- Twitch: the app token is cached (and refreshed automatically on `401`), the status response is cached for 45 seconds, so the client secret and the API are not hit on every visit.
- Contact form: honeypot, CSRF token (session cookie, `HttpOnly`, `SameSite=Lax`), server-side validation, length limits and file-based rate limiting (hashed IP).
- No third-party fonts or trackers. External content loads only after consent.

---

## Features

- **Dark / Light theme** ("night" asphalt and "concrete wall"), persisted in `localStorage`, applied before first paint.
- **Twitch live status** with next-stream countdown (Monday 18:45, Friday 19:00, German time), polled every 60 seconds while the tab is visible.
- **Spray wall**: interactive canvas, paint drips, undo, PNG export with watermark. Nothing leaves the browser.
- **Gamer quiz**: 10 random questions out of 100 with shuffled answers. Nothing is stored. The MoneyQuest page reuses the same engine.
- **Partner contact form**: package selector with live preview, JSON submission, SMTP delivery.
- **Consent management**: Twitch player and Instant Gaming banner load only after consent. The footer link "Einwilligungen verwalten" lets visitors change or revoke consent at any time.
- **UX extras**: scroll progress bar, mobile quick-action bar, parallax splats, reduced-motion support.
- **Support**: the menu link and `/spenden/` lead to the StreamElements tipping page. No payment data is processed on this site.

---

## Legal & Third-Party Content

- Imprint and privacy policy are maintained manually under `/impressum/` and `/datenschutz/`. A review by a lawyer or a legal text generator before major changes is recommended.
- Third-party logos (team or partner logos) may only be used with written permission from the rights holder. Keep the confirmation on file and respect usage guidelines (display, attribution, linking). The UKF Eclipse / Unknown Forces Esports logo is used with permission of the club board.
- No game cover art is used. Games are only named in text.
- Partner and affiliate content is labeled as advertising ("Werbung") and uses `rel="sponsored"`.
- External embeds that transfer data (Twitch player, Instant Gaming banner) load only after consent.

---

## License

Private project, all rights reserved.  
© 2026 hundekuchenlive (Justin Barth)
