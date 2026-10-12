(() => {
  "use strict";

  const canvas = document.getElementById("spray-canvas");
  if (!canvas) return;

  const ctx = canvas.getContext("2d", { willReadFrequently: true });
  const hint = document.getElementById("spray-hint");
  const sizeInput = document.getElementById("spray-size");
  const swatches = document.querySelectorAll(".swatch");
  const undoBtn = document.getElementById("spray-undo");
  const clearBtn = document.getElementById("spray-clear");
  const saveBtn = document.getElementById("spray-save");

  const W = canvas.width;
  const H = canvas.height;
  const history = [];
  const drips = [];

  let color = "#6dff1f";
  let radius = Number(sizeInput && sizeInput.value) || 26;
  let spraying = false;
  let running = false;
  let pos = { x: 0, y: 0 };
  let last = null;
  let still = 0;

  function paintWall() {
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#c9cbca";
    ctx.fillRect(0, 0, W, H);
    for (let i = 0; i < 7000; i++) {
      ctx.fillStyle = Math.random() < 0.5 ? "rgba(0,0,0,0.07)" : "rgba(255,255,255,0.12)";
      ctx.fillRect(Math.random() * W, Math.random() * H, 2, 2);
    }
    ctx.strokeStyle = "rgba(0,0,0,0.12)";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(0, H * 0.34); ctx.lineTo(W, H * 0.34);
    ctx.moveTo(0, H * 0.68); ctx.lineTo(W, H * 0.68);
    ctx.stroke();
  }

  function pushHistory() {
    history.push(ctx.getImageData(0, 0, W, H));
    if (history.length > 8) history.shift();
  }

  function point(event) {
    const rect = canvas.getBoundingClientRect();
    return {
      x: (event.clientX - rect.left) * (W / rect.width),
      y: (event.clientY - rect.top) * (H / rect.height),
    };
  }

  function dots(x, y) {
    ctx.fillStyle = color;
    const count = Math.round(radius * 1.6);
    for (let i = 0; i < count; i++) {
      const angle = Math.random() * Math.PI * 2;
      const distance = radius * Math.random();
      ctx.globalAlpha = 0.35 + Math.random() * 0.4;
      ctx.fillRect(x + Math.cos(angle) * distance, y + Math.sin(angle) * distance, 1.8, 1.8);
    }
    ctx.globalAlpha = 1;
  }

  function strokeTo(from, to) {
    const dx = to.x - from.x;
    const dy = to.y - from.y;
    const steps = Math.ceil(Math.hypot(dx, dy) / Math.max(2, radius / 4));
    for (let i = 1; i <= steps; i++) dots(from.x + (dx * i) / steps, from.y + (dy * i) / steps);
  }

  function frame() {
    if (spraying) {
      const moved = last && Math.abs(pos.x - last.x) + Math.abs(pos.y - last.y) > 1;
      if (moved) {
        still = 0;
        strokeTo(last, pos);
      } else {
        still++;
        dots(pos.x, pos.y);
        if (still > 25 && Math.random() < 0.04 && drips.length < 40) {
          drips.push({
            x: pos.x + (Math.random() - 0.5) * radius,
            y: pos.y + radius * 0.3,
            left: 30 + Math.random() * 90,
            w: 1.5 + Math.random() * 2,
            c: color,
          });
        }
      }
      last = { x: pos.x, y: pos.y };
    }

    for (let i = drips.length - 1; i >= 0; i--) {
      const d = drips[i];
      ctx.fillStyle = d.c;
      ctx.globalAlpha = 0.9;
      ctx.fillRect(d.x, d.y, d.w, 2);
      ctx.globalAlpha = 1;
      d.y += 1.4;
      d.left -= 1.4;
      if (d.left <= 0 || d.y > H) drips.splice(i, 1);
    }

    if (spraying || drips.length) {
      requestAnimationFrame(frame);
    } else {
      running = false;
    }
  }

  function kick() {
    if (!running) {
      running = true;
      requestAnimationFrame(frame);
    }
  }

  canvas.addEventListener("pointerdown", (event) => {
    canvas.setPointerCapture(event.pointerId);
    pushHistory();
    spraying = true;
    last = null;
    still = 0;
    pos = point(event);
    if (hint) hint.classList.add("is-hidden");
    kick();
  });
  canvas.addEventListener("pointermove", (event) => { if (spraying) pos = point(event); });
  ["pointerup", "pointercancel", "pointerleave"].forEach((type) => {
    canvas.addEventListener(type, () => { spraying = false; });
  });

  swatches.forEach((swatch) => {
    swatch.addEventListener("click", () => {
      color = swatch.dataset.color;
      swatches.forEach((s) => {
        s.classList.toggle("is-active", s === swatch);
        s.setAttribute("aria-pressed", String(s === swatch));
      });
    });
  });

  if (sizeInput) sizeInput.addEventListener("input", () => { radius = Number(sizeInput.value) || 26; });

  if (undoBtn) {
    undoBtn.addEventListener("click", () => {
      const snapshot = history.pop();
      drips.length = 0;
      if (snapshot) ctx.putImageData(snapshot, 0, 0);
    });
  }

  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      pushHistory();
      drips.length = 0;
      paintWall();
      if (hint) hint.classList.remove("is-hidden");
    });
  }

  if (saveBtn) {
    saveBtn.addEventListener("click", () => {
      const out = document.createElement("canvas");
      out.width = W;
      out.height = H;
      const o = out.getContext("2d");
      o.drawImage(canvas, 0, 0);
      o.font = "34px Impact, 'Arial Black', sans-serif";
      o.textAlign = "right";
      o.lineJoin = "round";
      o.lineWidth = 6;
      o.strokeStyle = "#0b0c0b";
      o.fillStyle = "#6dff1f";
      o.strokeText("hundekuchenlive.de", W - 24, H - 22);
      o.fillText("hundekuchenlive.de", W - 24, H - 22);

      out.toBlob((blob) => {
        if (!blob) return;
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.href = url;
        link.download = "los-santos-tag.png";
        document.body.appendChild(link);
        link.click();
        link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 2000);
      }, "image/png");
    });
  }

  paintWall();
})();
