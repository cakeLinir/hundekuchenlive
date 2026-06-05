# hundekuchenlive

Official website for **hundekuchenlive** — a German gaming creator focused on GTA RP, Valorant, and Satisfactory. Live on Twitch, with community presence on Discord, TikTok, and YouTube.

**Live:** [hundekuchenlive.de](https://hundekuchenlive.de)

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3 (custom variables, dark/light theme), Vanilla JS |
| Backend | PHP 7.3+, PHPMailer 7.0.2 |
| Email | IONOS SMTP via PHPMailer |
| Streaming | Twitch Helix API (live status with token caching) |
| Hosting | Apache (IONOS), `.htaccess` rewriting + security headers |

No build tools, no npm, no frameworks — intentionally lean.

---

## Pages

| Route | Description |
|-------|-------------|
| `/` | Homepage with hero, Twitch live status, mini quiz, partner tiles |
| `/about/` | Creator background, content focus, community values |
| `/streamingplan/` | Weekly streaming schedule |
| `/partner/` | Sponsorship packages + contact form |
| `/cloud/` | Nextcloud-based video collaboration info |
| `/money-quest/` | Branded financial literacy quiz (MoneyQuest partnership) |
| `/impressum/` | Legal imprint (German law) |
| `/datenschutz/` | Privacy policy / GDPR |

---

## Project Structure

```
hundekuchenlive/
├── about/               # About page
├── api/
│   └── twitch-status.php    # Twitch Helix API proxy (token cached in /tmp/)
├── assets/
│   ├── css/             # Per-page stylesheets + global design system
│   ├── img/             # Images, icons, OG image
│   ├── js/              # Modular JS: layout, theme, quiz, consent, contact
│   └── php/
│       └── kontakt-submit.php  # Partner contact form backend (JSON/SMTP)
├── cloud/               # Cloud collaboration page
├── components/
│   ├── header.html      # Shared nav header (loaded via fetch)
│   └── footer.html      # Shared footer with theme toggle
├── datenschutz/         # Privacy policy
├── impressum/           # Legal imprint
├── money-quest/         # MoneyQuest quiz (self-contained)
├── partner/             # Sponsorship page
├── PHPMailer/           # PHPMailer 7.0.2 (bundled, no Composer)
├── streamingplan/       # Streaming schedule
├── .htaccess            # HTTPS redirect, canonicals, security headers
├── config.php           # Central credential loader (env vars or config.local.php)
├── config.local.php.example  # Template — copy to config.local.php for local dev
├── robots.txt
└── sitemap.xml
```

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

Edit `config.local.php` and fill in:

| Variable | Description |
|----------|-------------|
| `SMTP_HOST` | SMTP server (default: `smtp.ionos.de`) |
| `SMTP_USER` | Sender email address |
| `SMTP_PASS` | SMTP password |
| `SMTP_PORT` | SMTP port (default: `587`) |
| `TWITCH_CLIENT_ID` | Twitch Developer App Client ID |
| `TWITCH_CLIENT_SECRET` | Twitch Developer App Client Secret |

`config.local.php` is listed in `.gitignore` and will never be committed.

**3. Serve locally**

Any PHP-capable local server works (XAMPP, Laragon, PHP built-in server):

```bash
php -S localhost:8000
```

---

## Production Deployment

1. Upload all files to your webroot **except** `config.local.php`
2. Create `config.local.php` directly on the server (FTP/SSH), or set the variables as server environment variables
3. Verify the Apache `mod_headers` module is enabled for the security headers in `.htaccess`
4. Confirm PHP has write access to `sys_get_temp_dir()` for Twitch token caching

> `setup-nextcloud.php` is excluded from the repository via `.gitignore`.

---

## Security

- Credentials are never hardcoded — loaded at runtime via `config.php`
- `config.php` and `config.local.php` are blocked from direct web access via `.htaccess`
- Security headers set on every response: `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy`
- Twitch OAuth token is cached in `/tmp/` — client secret is not sent on every API request
- Contact form uses honeypot + form token + server-side validation

---

## Features

- **Dark / Light theme** — persisted in `localStorage`, applied before first paint (no FOUC)
- **Twitch live status** — polls `/api/twitch-status.php` every 60 seconds
- **Mini gaming quiz** — 70+ questions, randomised, score tracked in session
- **Partner contact form** — package selector with live preview, JSON submission, SMTP delivery
- **Consent-gated affiliate banner** — Instant Gaming widget blocked until user consents
- **Component-based layout** — header and footer loaded via `fetch`, active nav link highlighted automatically

---

## License

Private project — all rights reserved.  
© 2026 hundekuchenlive (Justin Barth)
