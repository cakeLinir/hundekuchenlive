<?php require __DIR__ . '/footer.php'; ?>

  <div class="action-bar" aria-label="Schnellzugriff">
    <a class="btn primary" href="https://www.twitch.tv/hundekuchenlive" target="_blank" rel="noopener noreferrer">▶ Twitch</a>
    <a class="btn" href="https://discord.gg/WfTbuyhXcJ" target="_blank" rel="noopener noreferrer">Discord</a>
  </div>

  <script src="<?= e(asset_url('/assets/js/site.js')) ?>" defer></script>
  <script src="<?= e(asset_url('/assets/js/theme.js')) ?>" defer></script>
  <script src="<?= e(asset_url('/assets/js/consent-settings.js')) ?>" defer></script>
  <script src="<?= e(asset_url('/assets/js/effects.js')) ?>" defer></script>
<?php foreach (($page['scripts'] ?? []) as $script): ?>
  <script src="<?= e(asset_url('/assets/js/' . $script)) ?>" defer></script>
<?php endforeach; ?>
</body>

</html>
