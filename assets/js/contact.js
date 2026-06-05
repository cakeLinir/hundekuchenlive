// assets/js/contact.js
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.contact-form');
  if (!form) return;

  const submitButton = form.querySelector('button[type="submit"]');

  // Status-Element (Fehler/Erfolg)
  let statusEl = document.createElement('p');
  statusEl.className = 'form-status sub';
  statusEl.style.marginTop = '0.75rem';
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
        und wir erstellen ein individuelles Angebot.
      </p>
      <p>Mögliche Schwerpunkte:</p>
      <ul>
        <li>kurze Testkampagne (z.&nbsp;B. 2 Wochen)</li>
        <li>einmalige Aktionen / Events</li>
        <li>angepasste Kombination aus Shoutouts, Overlay und Website-Placement</li>
      </ul>
    `,
    'Starter Shoutout (Paket 1)': `
      <h4>Paket 1 – Starter Shoutout</h4>
      <p><strong>Für:</strong> Kleine Brands, Streamer oder Projekte mit ersten Testkampagnen.</p>
      <p><strong>Preis-Idee:</strong> ca. 15–30&nbsp;€/Monat oder 10–20&nbsp;€ pro Kampagne (z.&nbsp;B. 2 Wochen).</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>1× mündliche Erwähnung pro Stream („Dieser Stream wird unterstützt von …“)</li>
        <li>Logo + kurzer Text + Link im Panel-Bereich</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>Erwähnung im #partner-Channel mit Logo, kurzem Pitch und Link</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Logo + Link im Unterstützer- oder Partnerbereich</li>
      </ul>
      <p><strong>Nutzen:</strong> Günstiger Einstieg, um die Reaktion der Community zu testen.</p>
    `,
    'Community Partner (Paket 2)': `
      <h4>Paket 2 – Community Partner</h4>
      <p><strong>Für:</strong> Marken, die in Stream, Discord und Website dauerhaft präsent sein wollen.</p>
      <p><strong>Preis-Idee:</strong> ca. 40–80&nbsp;€/Monat.</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>fester Overlay-Slot (kleines Logo/Banner)</li>
        <li>1–2 kurze Werbe-Statements pro Stream (ca. 15–30&nbsp;Sek.)</li>
        <li>Verlinkung in Streambeschreibung &amp; Panels (z.&nbsp;B. mit Rabattcode/Affiliate-Link)</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>gepinnter Beitrag im #partner-Channel mit Logo, Beschreibung, Link, ggf. Code</li>
        <li>1× wöchentlicher Reminder-Post (ohne Spam)</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Logo + Kurzbeschreibung + Link im sichtbaren Bereich der Partnerseite</li>
        <li>Optional: 1× „Partner-Vorstellung“-Beitrag</li>
      </ul>
    `,
    'Main Sponsor (Paket 3)': `
      <h4>Paket 3 – Main Sponsor</h4>
      <p><strong>Für:</strong> Hauptpartner mit klarer, dauerhafter Sichtbarkeit (z.&nbsp;B. lokale Unternehmen, Gaming- oder Tech-Brands).</p>
      <p><strong>Preis-Idee:</strong> ca. 100–200&nbsp;€/Monat (je nach Laufzeit verhandelbar).</p>
      <p><strong>Twitch:</strong></p>
      <ul>
        <li>„Präsentiert von [Sponsor]“ im Titel oder der Streambeschreibung (wenn passend)</li>
        <li>prominente Overlay-Position (größeres Logo/Banner)</li>
        <li>eigene Sektion im Start- und Endscreen</li>
        <li>1× pro Stream kurzer Spot (ca. 30–60&nbsp;Sekunden)</li>
      </ul>
      <p><strong>Discord:</strong></p>
      <ul>
        <li>eigener Bereich/Channel (z.&nbsp;B. #main-sponsor)</li>
        <li>regelmäßige News-/Aktionsposts (in Abstimmung, ca. 1–2× pro Woche)</li>
        <li>Nennung als Hauptpartner in der Serverbeschreibung</li>
      </ul>
      <p><strong>Website:</strong></p>
      <ul>
        <li>Top-Placement als „Hauptsponsor“ / „Offizieller Partner“</li>
        <li>Logo + Text + Call-to-Action‑Button (z.&nbsp;B. „Zum Shop“)</li>
        <li>Optional: eigene Unterseite mit ausführlicher Beschreibung &amp; Angebot</li>
      </ul>
    `
  };

  if (packageSelect && previewBody) {
    const updatePreview = () => {
      const value = packageSelect.value;
      previewBody.innerHTML = packageDescriptions[value] || packageDescriptions[''];
      previewBody.scrollTop = 0;
    };

    packageSelect.addEventListener('change', updatePreview);
    updatePreview(); // Initial
  }

  // --- Submit-Logik ---
  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (submitButton) {
      submitButton.disabled = true;
      submitButton.textContent = 'Senden...';
    }
    statusEl.textContent = '';
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

      if (!response.ok || !data.success) {
        const msg = data.error || 'Beim Senden ist ein Fehler aufgetreten. Bitte versuche es später erneut.';
        statusEl.textContent = msg;
        statusEl.style.color = '#ff7070';
      } else {
        statusEl.textContent = data.message || 'Vielen Dank! Deine Anfrage wurde erfolgreich gesendet.';
        statusEl.style.color = '#53e89b';
        form.reset();
      }
    } catch (err) {
      console.error('Kontaktformular Fehler:', err);
      statusEl.textContent = 'Netzwerkfehler. Bitte überprüfe deine Verbindung und versuche es erneut.';
      statusEl.style.color = '#ff7070';
    } finally {
      if (submitButton) {
        submitButton.disabled = false;
        submitButton.textContent = 'Anfrage senden';
      }
    }
  });
});
