(() => {
    // ─────────────────────────────────────────────
    // KONFIGURATION
    // ─────────────────────────────────────────────
    const BACKEND = 'https://api.hundekuchenlive.de'; // ← VPS IP/Domain + Port eintragen

    // ─────────────────────────────────────────────
    // DOM-REFERENZEN
    // ─────────────────────────────────────────────
    const amountInput = document.getElementById('amount-input');
    const donorName = document.getElementById('donor-name');
    const donorMessage = document.getElementById('donor-message');
    const donateBtn = document.getElementById('donate-btn');
    const formStatus = document.getElementById('form-status');
    const donationList = document.getElementById('donation-list');
    const statusBanner = document.getElementById('status-banner');
    const badgeInfo = document.getElementById('badge-info');
    const presetBtns = document.querySelectorAll('.preset-btn');
    const paymentTabs = document.querySelectorAll('.payment-tab');

    let selectedMethod = 'stripe';

    // ─────────────────────────────────────────────
    // STATUS-BANNER (Rückleitung nach Zahlung)
    // ─────────────────────────────────────────────
    const urlParams = new URLSearchParams(window.location.search);
    const urlStatus = urlParams.get('status');

    if (urlStatus === 'success') {
        statusBanner.textContent = '🎉 Vielen Dank für deine Spende! Du bist der Beste.';
        statusBanner.className = 'status-banner visible success';
        // URL bereinigen ohne Reload
        history.replaceState(null, '', '/spenden/');
    } else if (urlStatus === 'cancel') {
        statusBanner.textContent = '↩️ Zahlung abgebrochen. Du kannst es jederzeit erneut versuchen.';
        statusBanner.className = 'status-banner visible cancel';
        history.replaceState(null, '', '/spenden/');
    }

    // ─────────────────────────────────────────────
    // PRESET-BUTTONS
    // ─────────────────────────────────────────────
    presetBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            presetBtns.forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');
            amountInput.value = btn.dataset.value;
        });
    });

    amountInput.addEventListener('input', () => {
        presetBtns.forEach((b) => b.classList.remove('active'));
    });

    // ─────────────────────────────────────────────
    // ZAHLUNGSMETHODEN TABS
    // ─────────────────────────────────────────────
    const providerInfo = {
        stripe: '💳 Kreditkarte, Apple Pay, Google Pay & mehr – abgesichert durch Stripe',
        paypal: '🔵 Zahlung über dein PayPal-Konto',
    };

    function updateMethodUI(method) {
        selectedMethod = method;
        paymentTabs.forEach((tab) => {
            tab.classList.toggle('active', tab.dataset.method === method);
        });
        badgeInfo.textContent = providerInfo[method];
    }

    paymentTabs.forEach((tab) => {
        tab.addEventListener('click', () => updateMethodUI(tab.dataset.method));
    });

    updateMethodUI('stripe'); // Standardwert setzen

    // ─────────────────────────────────────────────
    // FORMULAR VALIDIERUNG
    // ─────────────────────────────────────────────
    function getAmount() {
        return parseFloat(amountInput.value);
    }

    function showStatus(msg, type) {
        formStatus.textContent = msg;
        formStatus.className = `form-status visible form-status--${type}`;
    }

    function clearStatus() {
        formStatus.className = 'form-status';
        formStatus.textContent = '';
    }

    // ─────────────────────────────────────────────
    // SPENDEN-BUTTON
    // ─────────────────────────────────────────────
    donateBtn.addEventListener('click', async () => {
        clearStatus();

        const amount = getAmount();
        if (!amount || amount < 1) {
            showStatus('Bitte gib einen gültigen Betrag ein (Minimum: 1 €).', 'error');
            amountInput.focus();
            return;
        }

        donateBtn.disabled = true;
        donateBtn.textContent = 'Weiterleitung läuft...';

        const body = {
            amount: amount.toFixed(2),
            donor_name: donorName.value.trim() || 'Anonym',
            message: donorMessage.value.trim() || '',
        };

        try {
            let endpoint;
            if (selectedMethod === 'stripe') {
                endpoint = `${BACKEND}/api/stripe/create-session`;
            } else {
                endpoint = `${BACKEND}/api/paypal/create-order`;
            }

            const res = await fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body),
            });

            const data = await res.json();

            if (!res.ok || !data.url) {
                throw new Error(data.error || 'Unbekannter Fehler vom Server.');
            }

            // Weiterleitung zur Zahlungsseite
            window.location.href = data.url;

        } catch (err) {
            showStatus(`Fehler: ${err.message}`, 'error');
            donateBtn.disabled = false;
            donateBtn.textContent = 'Jetzt spenden';
        }
    });

    // ─────────────────────────────────────────────
    // LETZTE SPENDEN LADEN
    // ─────────────────────────────────────────────
    async function loadRecentDonations() {
        try {
            const res = await fetch(`${BACKEND}/api/donations/recent`);
            const list = await res.json();

            if (!list || list.length === 0) {
                donationList.innerHTML = '<li class="no-donations">Noch keine Spenden vorhanden.</li>';
                return;
            }

            donationList.innerHTML = list.map((d) => {
                const time = new Date(d.timestamp).toLocaleString('de-DE', {
                    day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit',
                });
                const providerLabel = d.provider === 'stripe' ? '💳 Stripe' : '🔵 PayPal';
                return `
            <li class="donation-item">
              <div class="donation-item-header">
                <span class="donation-donor">${escapeHtml(d.donor)}</span>
                <span class="donation-amount">${d.amount} ${d.currency}</span>
              </div>
              ${d.message ? `<p class="donation-message">"${escapeHtml(d.message)}"</p>` : ''}
              <div style="display:flex;justify-content:space-between;align-items:center;">
                <span class="donation-time">${time}</span>
                <span class="donation-provider">${providerLabel}</span>
              </div>
            </li>`;
            }).join('');

        } catch (_) {
            donationList.innerHTML = '<li class="no-donations">Spenden konnten nicht geladen werden.</li>';
        }
    }

    function escapeHtml(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // Initial laden + alle 30 Sekunden aktualisieren
    loadRecentDonations();
    setInterval(loadRecentDonations, 30_000);

})();
