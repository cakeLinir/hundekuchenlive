// assets/js/contact.js
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.contact-form');
  if (!form) return;

  const submitButton = form.querySelector('button[type="submit"]');
  const SUCCESS_COLOR = '#7cff3a';

  // Status-Element (Fehler/Erfolg)
  const statusEl = document.createElement('p');
  statusEl.className = 'form-status sub';
  statusEl.style.marginTop = '0.75rem';
  statusEl.setAttribute('role', 'status');
  statusEl.setAttribute('aria-live', 'polite');
  form.appendChild(statusEl);

  // --- Paket-Vorschau-Logik ---
  const packageSelect = document.getElementById('contact-package');
  const previewBody = document.getElementById('package-preview-body');

  const packageDescriptions = {
    '': `
      <h4>Noch unentschlossen / individuelles Angebot</h4>
      <p>
        Du bist dir noch nicht sicher, welches Paket passt?<br>
        Schreib kurz, was du dir vorstellst – Budget, Ziele und Plattformen –
        und du bekommst ein individuelles Angebot.
      </p>
      <p>Mögliche Schwerpunkte:</p>
      <ul>
        <li>kurze Testkampagne (z.&nbsp;B. 2 Wochen)</li>
        <li>einmalige Aktionen / Events / Gewinnspiele</li>
        <li>Sachleistung statt Geld (Produkte, Gutscheine, Gewinnspiel-Preise)</li>
        <li>Affiliate: Rabattcode oder Partnerlink mit Provision</li>
        <li>angepasste Kombination aus Shoutouts, Overlay und Website-Placement</li>
      </ul>
    `,
    'Starter Shoutout (Paket 1)': `
      <h4>Paket 1 – Starter Shoutout</h4>
      <p><strong>Für:</strong> Kleine Brands, lokale Shops und erste Testkampagnen.</p>
      <p><strong>Preis:</strong> 10&nbsp;€ einmalig.</p>
      <p><strong>Laufzeit:</strong> 14 Tage, keine Vertragsbindung.</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>mündliche Erwähnung in jedem Stream („Dieser Stream wird unterstützt von …“)</li>
        <li>Logo, kurzer Text und Link im Panel-Bereich</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>1 Post im Partner-Channel mit Logo, kurzem Pitch und Link</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Logo und Link im Partnerbereich</li>
      </ul>
      <p><strong>Nutzen:</strong> Günstiger Einstieg, um die Reaktion der Community zu testen.</p>
      <p><strong>Auch möglich:</strong> Sachleistung statt Geld, Wert wird fair abgestimmt.</p>
    `,
    'Community Partner (Paket 2)': `
      <h4>Paket 2 – Community Partner</h4>
      <p><strong>Für:</strong> Marken, die regelmäßig in Stream, Discord und Website sichtbar sein wollen.</p>
      <p><strong>Preis:</strong> 25&nbsp;€/Monat.</p>
      <p><strong>Laufzeit:</strong> mindestens 1 Monat, danach monatlich kündbar. Bei 3 Monaten im Voraus 10&nbsp;% Rabatt.</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>fester Overlay-Slot (kleines Logo/Banner)</li>
        <li>1 Werbe-Statement pro Stream (ca. 15–30&nbsp;Sek.)</li>
        <li>Verlinkung in den Panels (z.&nbsp;B. mit Rabattcode/Affiliate-Link)</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>gepinnter Beitrag im Partner-Channel mit Logo, Beschreibung, Link, ggf. Code</li>
        <li>wöchentlicher Reminder-Post (ohne Spam)</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Logo, Kurzbeschreibung und Link im sichtbaren Bereich der Partnerseite</li>
        <li>Optional: kurze Partner-Vorstellung</li>
      </ul>
      <p><strong>Add-ons:</strong> Unterseite, Gewinnspiel, Rabattcode-Aktion und Extra-Spots sind separat buchbar.</p>
    `,
    'Main Sponsor (Paket 3)': `
      <h4>Paket 3 – Main Sponsor</h4>
      <p><strong>Für:</strong> Den Hauptpartner mit klarer, dauerhafter Sichtbarkeit (z.&nbsp;B. lokale Unternehmen, Gaming- oder Tech-Brands). Nur 1 Platz verfügbar.</p>
      <p><strong>Preis:</strong> 50&nbsp;€/Monat.</p>
      <p><strong>Laufzeit:</strong> mindestens 3 Monate, danach monatlich kündbar.</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>„Präsentiert von [Sponsor]“ im Stream</li>
        <li>prominentes Overlay (größeres Logo/Banner)</li>
        <li>eigene Sektion im Start- und Endscreen</li>
        <li>1 Spot pro Stream (max. 30&nbsp;Sekunden)</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>Nennung als Hauptpartner</li>
        <li>1 Aktionspost pro Monat</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Top-Placement im Partnerbereich als „Hauptsponsor“</li>
        <li>Logo, Text und Call-to-Action-Button (z.&nbsp;B. „Zum Shop“)</li>
      </ul>
      <p><strong>Add-ons:</strong></p>
      <ul>
        <li>eigene Partner-Unterseite: 25&nbsp;€ einmalig</li>
        <li>Gewinnspiel-Aktion (Stream + Discord): ab 15&nbsp;€</li>
        <li>Rabattcode-Aktion einrichten: 10&nbsp;€ einmalig</li>
        <li>zusätzlicher Spot: 5&nbsp;€ pro Spot</li>
      </ul>
    `
  };

  const updatePreview = () => {
    if (!packageSelect || !previewBody) return;
    const value = packageSelect.value;
    previewBody.innerHTML = packageDescriptions[value] || packageDescriptions[''];
    previewBody.scrollTop = 0;
  };

  if (packageSelect && previewBody) {
    packageSelect.addEventListener('change', updatePreview);
    updatePreview(); // Initial
  }

  // --- Status-Helfer ---
  const showError = (message) => {
    statusEl.textContent = message;
    statusEl.className = 'form-status sub form-status--error';
    statusEl.style.color = '';
  };

  const showSuccess = (message) => {
    statusEl.textContent = message;
    statusEl.className = 'form-status sub form-status--success';
    statusEl.style.color = SUCCESS_COLOR;
  };

  // --- Submit-Logik ---
  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = 'Senden...';
    }
    statusEl.textContent = '';
    statusEl.className = 'form-status sub';
    statusEl.style.color = '';

    const formData = new FormData(form);

    // Token sicherstellen
    if (!formData.get('form_token')) {
      formData.set('form_token', 'partner_contact_v1');
    }

    const payload = {};
    formData.forEach((value, key) => {
      payload[key] = value;
    });

    try {
      const response = await fetch('/assets/php/kontakt-submit.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      const data = await response.json().catch(() => ({}));

      if (response.status === 429) {
        showError('Bitte warte kurz – du hast zu viele Anfragen in kurzer Zeit gesendet.');
      } else if (!response.ok || !data.success) {
        showError(data.error || 'Beim Senden ist ein Fehler aufgetreten. Bitte versuche es später erneut.');
      } else {
        showSuccess('Danke für deine Anfrage! Ich melde mich so schnell wie möglich bei dir.');
        form.reset();
        updatePreview();
      }
    } catch (err) {
      console.error('Kontaktformular Fehler:', err);
      showError('Netzwerkfehler. Bitte überprüfe deine Verbindung und versuche es erneut.');
    } finally {
      if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = 'Anfrage senden';
      }
    }
  });
});
