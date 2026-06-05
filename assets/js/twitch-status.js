async function updateTwitchStatus() {
  const statusElement = document.getElementById("twitch-status");
  if (!statusElement) return;

  try {
    const response = await fetch("/api/twitch-status.php", { cache: "no-store" });
    const data = await response.json();

    if (data.live) {
      statusElement.textContent = `LIVE – ${data.game_name} (${data.viewer_count} Zuschauer)`;
      statusElement.classList.add("live");
      statusElement.classList.remove("offline");
    } else {
      statusElement.textContent = "Offline";
      statusElement.classList.add("offline");
      statusElement.classList.remove("live");
    }
  } catch (error) {
    statusElement.textContent = "Status derzeit nicht verfügbar";
    statusElement.classList.remove("live");
    statusElement.classList.add("offline");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  updateTwitchStatus();
  setInterval(updateTwitchStatus, 60000);
});