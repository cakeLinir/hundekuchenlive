<?php
if (!defined('TIP_URL')) {
    define('TIP_URL', 'https://streamelements.com/hundekuchenlive/tip');
}
?>
  <footer id="site-footer" role="contentinfo">
    <div class="footer-tape tape-line" aria-hidden="true"></div>

    <div class="container footer-inner">

      <div class="footer-col">
        <p class="footer-claim">Los Santos<br>wartet.</p>
        <p>Streams, Ranked und eine Crew, die mitredet. Live auf Twitch, Clips auf TikTok und YouTube.</p>
      </div>

      <nav class="footer-col" aria-label="Seiten">
        <h2>Crew</h2>
        <ul>
          <li><a href="/streamingplan/">Streamplan</a></li>
          <li><a href="/about/">Über mich</a></li>
          <li><a href="/partner/">Partner &amp; Kooperationen</a></li>
          <li><a href="<?= e(TIP_URL) ?>" target="_blank" rel="noopener noreferrer">Support ↗</a></li>
          <li><a href="/cloud/">Creator-Cloud</a></li>
          <li><a href="https://shop.hundekuchenlive.de/" target="_blank" rel="noopener noreferrer">Merch ↗</a></li>
        </ul>
      </nav>

      <nav class="footer-col" aria-label="Rechtliches">
        <h2>Rechtliches</h2>
        <ul>
          <li><a href="/impressum/">Impressum</a></li>
          <li><a href="/datenschutz/">Datenschutz</a></li>
          <li><button class="linklike" type="button" data-open-consent>Einwilligungen verwalten</button></li>
        </ul>
      </nav>

      <nav class="footer-col" aria-label="Social Media">
        <h2>Folgen</h2>
        <ul>
          <li><a href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer">Twitch ↗</a></li>
          <li><a href="https://www.tiktok.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer">TikTok ↗</a></li>
          <li><a href="https://www.youtube.com/@hundekuchenlive" target="_blank" rel="noopener noreferrer">YouTube ↗</a></li>
          <li><a href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Discord ↗</a></li>
        </ul>
      </nav>

    </div>

    <div class="container footer-bottom">
      <p>© <?= date('Y') ?> hundekuchenlive · Justin Barth · Links mit „Werbung“ sind Partner- bzw. Affiliate-Links.</p>

      <button class="theme-toggle" type="button" data-theme-toggle aria-label="Zwischen Darkmode und Lightmode wechseln"
        aria-pressed="false">
        <span class="theme-toggle-indicator" aria-hidden="true"></span>
        <span class="theme-toggle-text">Darkmode</span>
      </button>
    </div>
  </footer>
