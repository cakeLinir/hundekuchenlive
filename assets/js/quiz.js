(() => {
    "use strict";

    const questions = [
        {
            question: "Wofür steht die Abkürzung NPC in Videospielen?",
            answers: ["Non-Playable Character", "New Player Class", "Network Player Control", "Next Play Command"],
            correctAnswer: 0,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet FPS im Zusammenhang mit Shooter-Genres?",
            answers: ["Fast Play System", "First-Person Shooter", "Frame Power Setting", "Final Player Score"],
            correctAnswer: 1,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet FPS im technischen Sinn?",
            answers: ["Full Player Sync", "Fast Play Signal", "Frames per Second", "Final Frame Score"],
            correctAnswer: 2,
            category: "Technik",
            difficulty: "leicht"
        },
        {
            question: "Was beschreibt der Ping beim Online-Gaming?",
            answers: ["Die Grafikqualität", "Die Lautstärke", "Die Anzahl der Spieler", "Die Verzögerung der Verbindung"],
            correctAnswer: 3,
            category: "Online-Gaming",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Lag in einem Online-Spiel?",
            answers: ["Eine Verzögerung oder ein Ruckeln", "Eine seltene Waffe", "Ein neuer Spielmodus", "Ein Speicherpunkt"],
            correctAnswer: 0,
            category: "Online-Gaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Patch in einem Videospiel?",
            answers: ["Ein Cheat-Code", "Ein Update zur Fehlerbehebung oder Anpassung", "Ein Spielstand", "Ein Controller-Profil"],
            correctAnswer: 1,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Nerf in Videospielen?",
            answers: ["Ein Server wird gestartet", "Ein Spiel wird gelöscht", "Eine Fähigkeit oder Waffe wird schwächer gemacht", "Ein Spieler wird automatisch geheilt"],
            correctAnswer: 2,
            category: "Gaming-Begriffe",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Buff in Videospielen?",
            answers: ["Ein Grafikfehler", "Ein Verbindungsabbruch", "Ein verlorenes Match", "Eine Verbesserung von Werten oder Fähigkeiten"],
            correctAnswer: 3,
            category: "Gaming-Begriffe",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Loot-System?",
            answers: ["Ein System zum Sammeln von Gegenständen oder Belohnungen", "Ein System zum Ändern der Bildschirmauflösung", "Ein System zum Sperren von Spielern", "Ein System für Controller-Treiber"],
            correctAnswer: 0,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Grinding in Videospielen?",
            answers: ["Das Löschen eines Accounts", "Wiederholtes Spielen zum Sammeln von Erfahrung, Items oder Ressourcen", "Das Pausieren eines Spiels", "Das Ändern der Sprache"],
            correctAnswer: 1,
            category: "Spielmechaniken",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein RPG?",
            answers: ["Rapid Play Game", "Ranking Point Game", "Role-Playing Game", "Realistic Physics Game"],
            correctAnswer: 2,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein MMORPG?",
            answers: ["Modern Multiplayer Online Racing Game", "Mega Match Online Ranking Game", "Multi Mode Offline Role Game", "Massively Multiplayer Online Role-Playing Game"],
            correctAnswer: 3,
            category: "Genres",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein MOBA?",
            answers: ["Multiplayer Online Battle Arena", "Modern Online Boss Adventure", "Massive Offline Battle Action", "Multiplayer Open Base Arena"],
            correctAnswer: 0,
            category: "Genres",
            difficulty: "mittel"
        },
        {
            question: "Welches Genre beschreibt Spiele wie Valorant oder Counter-Strike am besten?",
            answers: ["Rennspiel", "Taktik-Shooter", "Aufbausimulation", "Kartenspiel"],
            correctAnswer: 1,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Welches Genre beschreibt Minecraft im Kern am besten?",
            answers: ["Rennspiel", "Rhythmusspiel", "Sandbox-Spiel", "Kampfspiel"],
            correctAnswer: 2,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Was ist typisch für ein Battle-Royale-Spiel?",
            answers: ["Zwei Spieler spielen Schach", "Man baut ausschließlich Städte", "Man verwaltet nur Menüs", "Viele Spieler kämpfen, bis nur noch einer oder ein Team übrig ist"],
            correctAnswer: 3,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Roguelike- oder Roguelite-Element?",
            answers: ["Zufällig generierte Inhalte und oft ein Neustart nach dem Tod", "Immer dieselbe lineare Mission", "Nur Multiplayer ohne Fortschritt", "Ein Spiel ohne Gegner"],
            correctAnswer: 0,
            category: "Genres",
            difficulty: "mittel"
        },
        {
            question: "Was ist eine Simulation im Gaming-Kontext?",
            answers: ["Ein Spiel ohne Steuerung", "Ein Spiel, das reale oder fiktive Abläufe nachvollziehbar nachbildet", "Ein reiner Ladebildschirm", "Ein Musikplayer"],
            correctAnswer: 1,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Soulslike?",
            answers: ["Ein reines Kartenspiel", "Ein Fußballmanager", "Ein meist schweres Action-RPG mit präzisem Kampf und hohem Risiko", "Ein Partyspiel ohne Gegner"],
            correctAnswer: 2,
            category: "Genres",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Speedrun?",
            answers: ["Ein Spiel besonders langsam spielen", "Nur die Grafik testen", "Ein Spiel ohne Ton starten", "Ein Spiel möglichst schnell abschließen"],
            correctAnswer: 3,
            category: "Gaming-Kultur",
            difficulty: "leicht"
        },
        {
            question: "In welchem Spiel baut man unter anderem mit Blöcken und kann in einer offenen Welt überleben?",
            answers: ["Minecraft", "EA Sports FC", "Tekken", "Gran Turismo"],
            correctAnswer: 0,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "Welche Spielereihe ist besonders für den Modus Ultimate Team bekannt?",
            answers: ["The Legend of Zelda", "EA Sports FC / FIFA", "Doom", "Civilization"],
            correctAnswer: 1,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "Welches Spiel ist ein taktischer 5v5-Shooter von Riot Games?",
            answers: ["Rocket League", "Stardew Valley", "Valorant", "Skyrim"],
            correctAnswer: 2,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "In welchem Spiel kombiniert man Fußball mit Autos?",
            answers: ["Forza Horizon", "Euro Truck Simulator 2", "Trackmania", "Rocket League"],
            correctAnswer: 3,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "Welche Spielereihe ist besonders mit der offenen Stadt Los Santos verbunden?",
            answers: ["Grand Theft Auto", "Halo", "Portal", "Age of Empires"],
            correctAnswer: 0,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "Welches Spiel ist für den Satz „The cake is a lie“ bekannt?",
            answers: ["Minecraft", "Portal", "Valorant", "The Sims"],
            correctAnswer: 1,
            category: "Gaming-Kultur",
            difficulty: "mittel"
        },
        {
            question: "Welche Spielereihe spielt oft in Hyrule?",
            answers: ["Call of Duty", "Need for Speed", "The Legend of Zelda", "Diablo"],
            correctAnswer: 2,
            category: "Bekannte Spiele",
            difficulty: "mittel"
        },
        {
            question: "Welche Spielereihe ist bekannt für den Doom Slayer?",
            answers: ["Animal Crossing", "The Sims", "Cities: Skylines", "Doom"],
            correctAnswer: 3,
            category: "Bekannte Spiele",
            difficulty: "leicht"
        },
        {
            question: "Welches Spiel ist ein Farming- und Lebenssimulator von ConcernedApe?",
            answers: ["Stardew Valley", "Apex Legends", "Overwatch", "Dark Souls"],
            correctAnswer: 0,
            category: "Bekannte Spiele",
            difficulty: "mittel"
        },
        {
            question: "Welche Spielereihe ist für Monsterjagd, Crafting und große Waffen bekannt?",
            answers: ["Tetris", "Monster Hunter", "Rocket League", "Farming Simulator"],
            correctAnswer: 1,
            category: "Bekannte Spiele",
            difficulty: "mittel"
        },
        {
            question: "Welche Komponente berechnet hauptsächlich die Grafik in einem Gaming-PC?",
            answers: ["Netzteil", "Gehäuselüfter", "Grafikkarte", "Soundkarte"],
            correctAnswer: 2,
            category: "Hardware",
            difficulty: "leicht"
        },
        {
            question: "Wofür ist die CPU hauptsächlich zuständig?",
            answers: ["Nur für WLAN", "Nur für die Lautstärke", "Nur für die Farbe des Gehäuses", "Allgemeine Berechnungen und Programmausführung"],
            correctAnswer: 3,
            category: "Hardware",
            difficulty: "leicht"
        },
        {
            question: "Was ist RAM?",
            answers: ["Arbeitsspeicher", "Eine Grafikschnittstelle", "Ein Spielmodus", "Ein Controller-Typ"],
            correctAnswer: 0,
            category: "Hardware",
            difficulty: "leicht"
        },
        {
            question: "Was bringt eine SSD gegenüber einer klassischen HDD meistens?",
            answers: ["Mehr FPS durch RGB", "Schnellere Ladezeiten", "Besseren Ping ohne Internet", "Automatische Cheats"],
            correctAnswer: 1,
            category: "Hardware",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet 144 Hz bei einem Monitor?",
            answers: ["Der Monitor hat 144 Lautsprecher", "Der Monitor hat 144 Farben", "Der Monitor kann bis zu 144 Bilder pro Sekunde anzeigen", "Der Monitor braucht zwingend 144 Watt"],
            correctAnswer: 2,
            category: "Hardware",
            difficulty: "mittel"
        },
        {
            question: "Was ist V-Sync?",
            answers: ["Ein Sprachchat-Programm", "Ein Anti-Cheat-System", "Eine Speicherkarte", "Eine Technik zur Synchronisation von Bildrate und Monitor"],
            correctAnswer: 3,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was beschreibt die Auflösung 1920×1080?",
            answers: ["Full HD", "4K", "8K", "HD Ready"],
            correctAnswer: 0,
            category: "Technik",
            difficulty: "leicht"
        },
        {
            question: "Was ist Input Lag?",
            answers: ["Ein Soundeffekt", "Verzögerung zwischen Eingabe und sichtbarer Reaktion", "Ein Speicherfehler", "Ein Grafikstil"],
            correctAnswer: 1,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Wofür steht VR im Gaming?",
            answers: ["Visual Ranking", "Video Render", "Virtual Reality", "Voice Relay"],
            correctAnswer: 2,
            category: "Technik",
            difficulty: "leicht"
        },
        {
            question: "Was ist Raytracing?",
            answers: ["Ein Netzwerkprotokoll", "Ein Controller-Layout", "Ein Speicherformat", "Eine Technik zur realistischeren Berechnung von Licht und Schatten"],
            correctAnswer: 3,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was bedeutet GG am Ende eines Matches?",
            answers: ["Good Game", "Great Graphics", "Game Gone", "Global Goal"],
            correctAnswer: 0,
            category: "Gaming-Kultur",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet GLHF vor einem Match?",
            answers: ["Great Loot, High Fame", "Good Luck, Have Fun", "Game Loaded, Hold Fire", "Go Left, Hit First"],
            correctAnswer: 1,
            category: "Gaming-Kultur",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Clan oder eine Gilde?",
            answers: ["Ein Grafikmodus", "Ein einzelner Spielstand", "Eine organisierte Spielergruppe", "Ein Controller-Fehler"],
            correctAnswer: 2,
            category: "Multiplayer",
            difficulty: "leicht"
        },
        {
            question: "Was ist Matchmaking?",
            answers: ["Das Speichern von Screenshots", "Das Einstellen der Mausgeschwindigkeit", "Das Kaufen eines Spiels", "Das Zusammenstellen von Spielern für eine Runde"],
            correctAnswer: 3,
            category: "Multiplayer",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Ranked in vielen Multiplayer-Spielen?",
            answers: ["Ein gewerteter Spielmodus mit Rangsystem", "Ein Modus ohne Gegner", "Ein reiner Trainingsmodus", "Ein Grafiktest"],
            correctAnswer: 0,
            category: "Multiplayer",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Smurf-Account?",
            answers: ["Ein gelöschter Hauptaccount", "Ein Zweitaccount, oft unterhalb des eigentlichen Spielniveaus", "Ein Account ohne Namen", "Ein Account nur für Zuschauer"],
            correctAnswer: 1,
            category: "Multiplayer",
            difficulty: "mittel"
        },
        {
            question: "Was bedeutet Toxicity im Online-Gaming?",
            answers: ["Ein Grafikfilter", "Ein besonders starker Charakter", "Schädliches oder beleidigendes Verhalten gegenüber anderen", "Ein Spiel ohne Chat"],
            correctAnswer: 2,
            category: "Online-Gaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Ragequit?",
            answers: ["Ein perfekter Sieg", "Ein freiwilliges Tutorial", "Ein Neustart des Routers", "Ein wütendes Verlassen des Spiels"],
            correctAnswer: 3,
            category: "Gaming-Kultur",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Carry im Teamspiel?",
            answers: ["Ein Spieler, der das Team besonders stark zum Sieg führt", "Ein Spieler ohne Tastatur", "Ein Zuschauer im Stream", "Ein Spielmodus ohne Punkte"],
            correctAnswer: 0,
            category: "Multiplayer",
            difficulty: "mittel"
        },
        {
            question: "Was bedeutet Meta in kompetitiven Spielen?",
            answers: ["Das Hauptmenü", "Aktuell besonders effektive Strategien, Charaktere oder Waffen", "Ein Speicherstand", "Ein Controller-Hersteller"],
            correctAnswer: 1,
            category: "Esport",
            difficulty: "mittel"
        },
        {
            question: "Wofür wird OBS häufig genutzt?",
            answers: ["Nur zum Schreiben von Texten", "Nur zum Erstellen von Tabellen", "Streaming und Aufnahme von Bildschirm, Spiel und Kamera", "Nur zum Installieren von Spielen"],
            correctAnswer: 2,
            category: "Streaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist eine Facecam im Stream?",
            answers: ["Ein Mikrofonfilter", "Ein Spielmodus", "Ein Chat-Bot", "Eine Kameraaufnahme des Streamers"],
            correctAnswer: 3,
            category: "Streaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Overlay beim Streaming?",
            answers: ["Grafische Elemente über dem Streambild", "Ein neues Betriebssystem", "Ein Ersatz für das Mikrofon", "Ein Controller-Akku"],
            correctAnswer: 0,
            category: "Streaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Bitrate-Wert beim Streaming?",
            answers: ["Die Anzahl der Zuschauer", "Die Datenmenge, die pro Sekunde für den Stream übertragen wird", "Die Lautstärke des Mikrofons", "Die Größe der Tastatur"],
            correctAnswer: 1,
            category: "Streaming",
            difficulty: "mittel"
        },
        {
            question: "Was macht ein Chatbot in einem Stream typischerweise?",
            answers: ["Die Grafikkarte austauschen", "Den Monitor reinigen", "Chatbefehle, Moderation oder automatische Nachrichten verwalten", "Das Spiel automatisch gewinnen"],
            correctAnswer: 2,
            category: "Streaming",
            difficulty: "leicht"
        },
        {
            question: "Wofür steht AFK?",
            answers: ["Always Fighting Keyboard", "Auto Frame Kill", "Advanced Fast Key", "Away From Keyboard"],
            correctAnswer: 3,
            category: "Gaming-Begriffe",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet AoE in Spielen?",
            answers: ["Area of Effect", "Attack of Energy", "Arena of Endgame", "Amount of Equipment"],
            correctAnswer: 0,
            category: "Gaming-Begriffe",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Cooldown?",
            answers: ["Ein Grafikfilter", "Eine Wartezeit, bis eine Fähigkeit erneut genutzt werden kann", "Ein Spielmodus", "Ein Speicherpunkt"],
            correctAnswer: 1,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Skilltree?",
            answers: ["Ein Server-Browser", "Ein Chatfenster", "Ein System zur Auswahl oder Verbesserung von Fähigkeiten", "Ein Grafikmenü"],
            correctAnswer: 2,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet PvP?",
            answers: ["Player versus Puzzle", "Power versus Ping", "Private Voice Party", "Player versus Player"],
            correctAnswer: 3,
            category: "Gaming-Begriffe",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet PvE?",
            answers: ["Player versus Environment", "Player versus Editor", "Ping versus Engine", "Private Virtual Event"],
            correctAnswer: 0,
            category: "Gaming-Begriffe",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Bossfight?",
            answers: ["Ein normaler Ladebildschirm", "Ein Kampf gegen einen besonders starken Gegner", "Ein Kaufmenü", "Ein Grafikbenchmark"],
            correctAnswer: 1,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Checkpoint?",
            answers: ["Ein Cheatprogramm", "Ein Controller-Profil", "Ein Speicher- oder Rücksetzpunkt im Spiel", "Ein Livestream-Overlay"],
            correctAnswer: 2,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Questlog?",
            answers: ["Ein FPS-Zähler", "Ein Serverfehler", "Ein Voice-Chat", "Eine Übersicht aktiver oder abgeschlossener Aufgaben"],
            correctAnswer: 3,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist Crafting?",
            answers: ["Das Herstellen von Gegenständen aus Materialien", "Das Löschen alter Spielstände", "Das Senken der Auflösung", "Das Messen der Latenz"],
            correctAnswer: 0,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was beschreibt der Begriff Open World?",
            answers: ["Eine reine Bestenliste", "Eine frei erkundbare Spielwelt", "Ein geschlossenes Tutorial", "Ein lokaler Split-Screen"],
            correctAnswer: 1,
            category: "Genres",
            difficulty: "leicht"
        },
        {
            question: "Was ist Permadeath?",
            answers: ["Ein temporärer Soundfehler", "Eine Belohnungskiste", "Dauerhafter Tod oder Verlust eines Charakters", "Ein Cloud-Speicher"],
            correctAnswer: 2,
            category: "Spielmechaniken",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Emulator?",
            answers: ["Ein Online-Rang", "Ein Controller-Akku", "Ein Grafikstil", "Software, die ein anderes System nachbildet"],
            correctAnswer: 3,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Remaster?",
            answers: ["Eine technisch überarbeitete Neuauflage eines bestehenden Spiels", "Ein komplett anderes Genre", "Ein Controller-Modus", "Ein Server-Rollback"],
            correctAnswer: 0,
            category: "Gaming-Grundwissen",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Remake?",
            answers: ["Ein reiner Patch", "Eine neu entwickelte Version eines bekannten Spiels", "Ein Savegame-Import", "Ein Anti-Cheat-Test"],
            correctAnswer: 1,
            category: "Gaming-Grundwissen",
            difficulty: "mittel"
        },
        {
            question: "Was ist Early Access?",
            answers: ["Ein versteckter Cheat", "Ein LAN-Kabel", "Ein Spiel ist vor der finalen Veröffentlichung spielbar", "Ein Endboss-Modus"],
            correctAnswer: 2,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Crossplay?",
            answers: ["Nur Offline-Spielen", "Ein Grafikmodus", "Ein exklusiver Konsolenmodus", "Gemeinsames Spielen über unterschiedliche Plattformen hinweg"],
            correctAnswer: 3,
            category: "Online-Gaming",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Cross-Save?",
            answers: ["Spielstände können plattformübergreifend genutzt werden", "Ein Spiel wird automatisch gewonnen", "Der Ping wird halbiert", "Ein Stream wird gespiegelt"],
            correctAnswer: 0,
            category: "Gaming-Grundwissen",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Season Pass?",
            answers: ["Ein Hardware-Treiber", "Ein Paket oder Zugang zu zusätzlichen Inhalten über eine Saison oder einen Zeitraum", "Ein lokaler Multiplayer-Modus", "Ein Passwortmanager"],
            correctAnswer: 1,
            category: "Gaming-Grundwissen",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Battle Pass?",
            answers: ["Ein LAN-Kabel", "Ein Mausprofil", "Ein Fortschrittssystem mit Belohnungen über Stufen", "Ein Controller-Adapter"],
            correctAnswer: 2,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was ist DLC?",
            answers: ["Direct Latency Control", "Dual Link Cable", "Dynamic Level Cache", "Downloadable Content"],
            correctAnswer: 3,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Wofür steht DRM?",
            answers: ["Digital Rights Management", "Direct Render Mode", "Dynamic Raid Match", "Dual Role Menu"],
            correctAnswer: 0,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Anti-Cheat-System?",
            answers: ["Ein Grafikfilter", "Software oder Technik zur Erkennung und Verhinderung von Cheats", "Ein Controller-Hersteller", "Ein Musikmodus"],
            correctAnswer: 1,
            category: "Online-Gaming",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Hitmarker?",
            answers: ["Ein Speicherstand", "Ein Freundeslisten-Status", "Eine visuelle oder akustische Rückmeldung für einen Treffer", "Ein Mod-Menü"],
            correctAnswer: 2,
            category: "Shooter",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Recoil bei Waffen in Shootern?",
            answers: ["Nachladezeit", "Schaden pro Sekunde", "Trefferzone", "Rückstoßverhalten der Waffe"],
            correctAnswer: 3,
            category: "Shooter",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet ADS in Shootern?",
            answers: ["Aim Down Sights", "Auto Damage System", "Advanced Discord Sync", "Area Defense Score"],
            correctAnswer: 0,
            category: "Shooter",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Headshot?",
            answers: ["Ein Treffer in den Fuß", "Ein Treffer am Kopf", "Ein Treffer in die Wand", "Ein Treffer am Fahrzeug"],
            correctAnswer: 1,
            category: "Shooter",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Loadout?",
            answers: ["Ein Servername", "Ein Grafikpreset", "Die ausgewählte Ausrüstung oder Zusammenstellung vor einer Runde", "Eine Mausmatte"],
            correctAnswer: 2,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Spawnpunkt?",
            answers: ["Ein Chatbefehl", "Ein Bildfilter", "Ein Shop-Angebot", "Ein Ort, an dem Spieler oder Objekte erscheinen"],
            correctAnswer: 3,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was ist Spawncamping?",
            answers: ["Das gezielte Warten und Angreifen an Spawnpunkten", "Das Bauen eines Zelts im Menü", "Ein Grafikmodus", "Ein Tutorial-System"],
            correctAnswer: 0,
            category: "Multiplayer",
            difficulty: "mittel"
        },
        {
            question: "Was bedeutet K/D?",
            answers: ["Keyboard/Display", "Kills/Deaths", "Kick/Disconnect", "Key/Direction"],
            correctAnswer: 1,
            category: "Multiplayer",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Healer in Teamspielen?",
            answers: ["Ein Schadensverursacher", "Ein Fahrzeug", "Eine Rolle, die Teammitglieder heilt oder unterstützt", "Ein Grafikmenü"],
            correctAnswer: 2,
            category: "Spielrollen",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Tank in Teamspielen?",
            answers: ["Ein Speicherfehler", "Ein Musikbot", "Ein Rennmodus", "Eine robuste Rolle, die Schaden abfängt oder Gegner bindet"],
            correctAnswer: 3,
            category: "Spielrollen",
            difficulty: "leicht"
        },
        {
            question: "Was ist DPS?",
            answers: ["Damage per Second", "Direct Player Save", "Dual Platform Sync", "Dynamic Ping System"],
            correctAnswer: 0,
            category: "Spielrollen",
            difficulty: "leicht"
        },
        {
            question: "Was ist Crowd Control?",
            answers: ["Eine Streaming-Kamera", "Fähigkeiten, die Gegner kontrollieren oder einschränken", "Ein Controller-Ladegerät", "Ein Discord-Emoji"],
            correctAnswer: 1,
            category: "Spielmechaniken",
            difficulty: "mittel"
        },
        {
            question: "Was beschreibt Mana in vielen Spielen?",
            answers: ["Eine Grafikoption", "Eine Bestenliste", "Eine Ressource zum Wirken von Fähigkeiten oder Zaubern", "Ein Speicherformat"],
            correctAnswer: 2,
            category: "Spielmechaniken",
            difficulty: "leicht"
        },
        {
            question: "Was sind Cooldown-Reduction-Werte?",
            answers: ["Werte für Bildschirmhelligkeit", "Werte für Netzwerkports", "Werte für Controller-Vibration", "Werte, die Wartezeiten von Fähigkeiten verkürzen"],
            correctAnswer: 3,
            category: "Spielmechaniken",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Achievement?",
            answers: ["Eine freischaltbare Errungenschaft", "Ein Grafikkartenfehler", "Ein Routerprofil", "Ein Serverbackup"],
            correctAnswer: 0,
            category: "Gaming-Grundwissen",
            difficulty: "leicht"
        },
        {
            question: "Was ist ein Easter Egg in Spielen?",
            answers: ["Ein Pflicht-Tutorial", "Eine versteckte Anspielung oder Überraschung", "Ein Cloudspeicher", "Ein Anti-Cheat-Log"],
            correctAnswer: 1,
            category: "Gaming-Kultur",
            difficulty: "leicht"
        },
        {
            question: "Was bedeutet Modding?",
            answers: ["Das Wechseln des Monitors", "Das Löschen eines Spiels", "Das Verändern oder Erweitern eines Spiels durch Mods", "Das Sperren eines Accounts"],
            correctAnswer: 2,
            category: "Gaming-Kultur",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Dedicated Server?",
            answers: ["Ein lokaler Controller", "Ein Grafikfilter", "Ein Stream-Overlay", "Ein eigener Server, der speziell für ein Spiel oder einen Dienst läuft"],
            correctAnswer: 3,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was ist ein Peer-to-Peer-Modell im Multiplayer?",
            answers: ["Spieler verbinden sich direkt oder teilweise direkt miteinander", "Alle Daten laufen immer nur über eine Konsole ohne Netzwerk", "Ein reiner Offline-Modus", "Ein Grafiktreiber"],
            correctAnswer: 0,
            category: "Technik",
            difficulty: "mittel"
        },
        {
            question: "Was bedeutet FOV?",
            answers: ["Frame Output Value", "Field of View", "Fast Online Voice", "Final Objective Vote"],
            correctAnswer: 1,
            category: "Technik",
            difficulty: "leicht"
        },
        {
            question: "Was beschreibt Motion Blur?",
            answers: ["Eine Netzwerkverzögerung", "Ein Serverabsturz", "Bewegungsunschärfe im Bild", "Ein Tastaturprofil"],
            correctAnswer: 2,
            category: "Grafik",
            difficulty: "leicht"
        },
        {
            question: "Was ist Upscaling in Spielen?",
            answers: ["Das Senken des Tons", "Das Löschen alter Savegames", "Ein Voice-Chat-Filter", "Das Hochskalieren einer niedrigeren Renderauflösung auf eine höhere Ausgabeauflösung"],
            correctAnswer: 3,
            category: "Grafik",
            difficulty: "mittel"
        }
    ];

    function initMiniQuiz() {
        let currentQuestionIndex = 0;
        let score = 0;
        let questionAnswered = false;

        const questionEl = document.getElementById("mini-quiz-question");
        const answersEl = document.getElementById("mini-quiz-answers");
        const nextBtn = document.getElementById("mini-quiz-next-btn");
        const quizContainer = document.getElementById("mini-quiz-container");
        const resultContainer = document.getElementById("mini-quiz-result");
        const scoreEl = document.getElementById("mini-quiz-score");
        const scoreTextEl = document.getElementById("mini-quiz-score-text");
        const questionCounterEl = document.getElementById("mini-quiz-question-counter");
        const scoreInlineEl = document.getElementById("mini-quiz-score-inline");
        const progressEl = document.getElementById("mini-quiz-progress");
        const restartBtn = document.getElementById("mini-quiz-restart-btn");
        const answerLabels = ["a)", "b)", "c)", "d)"];

        if (!questionEl || !answersEl || !nextBtn || !quizContainer || !resultContainer || !scoreEl ||
            !scoreTextEl || !questionCounterEl || !scoreInlineEl || !progressEl || !restartBtn) {
            return;
        }

        function displayQuestion() {
            const total = questions.length;

            if (currentQuestionIndex >= total) {
                showResult();
                return;
            }

            const question = questions[currentQuestionIndex];

            questionEl.textContent = question.question;
            questionCounterEl.textContent = `Frage ${currentQuestionIndex + 1} / ${total}`;
            scoreInlineEl.textContent = `Punkte: ${score}`;

            const progressPercent = (currentQuestionIndex / total) * 100;
            progressEl.style.width = `${progressPercent}%`;

            answersEl.innerHTML = "";
            questionAnswered = false;
            nextBtn.disabled = true;

            question.answers.forEach((answer, index) => {
                const answerButton = document.createElement("button");
                answerButton.type = "button";
                answerButton.classList.add("mini-quiz-btn", "mini-quiz-btn-answer");
                answerButton.style.order = [1, 3, 2, 4][index];

                const labelSpan = document.createElement("span");
                labelSpan.textContent = answerLabels[index] || "";
                labelSpan.classList.add("mini-quiz-answer-label");

                const textSpan = document.createElement("span");
                textSpan.textContent = answer;

                answerButton.appendChild(labelSpan);
                answerButton.appendChild(textSpan);

                answerButton.addEventListener("click", () => {
                    checkAnswer(index);
                });

                answersEl.appendChild(answerButton);
            });
        }

        function checkAnswer(userAnswerIndex) {
            if (questionAnswered) return;

            questionAnswered = true;

            const currentQuestion = questions[currentQuestionIndex];
            const correctIndex = currentQuestion.correctAnswer;

            Array.from(answersEl.children).forEach((btn, index) => {
                btn.disabled = true;

                if (index === correctIndex) {
                    btn.classList.add("is-correct");
                }

                if (index === userAnswerIndex && index !== correctIndex) {
                    btn.classList.add("is-wrong");
                }
            });

            if (userAnswerIndex === correctIndex) {
                score++;
                scoreInlineEl.textContent = `Punkte: ${score}`;
            }

            nextBtn.disabled = false;
        }

        function nextQuestion() {
            if (!questionAnswered) return;

            currentQuestionIndex++;
            displayQuestion();
        }

        function showResult() {
            quizContainer.hidden = true;
            resultContainer.hidden = false;

            scoreEl.textContent = `${score} / ${questions.length}`;

            const ratio = score / questions.length;
            let text = "";

            if (ratio === 1) {
                text = "Perfekt! Du hast alle Fragen richtig beantwortet.";
            } else if (ratio >= 0.7) {
                text = "Sehr gut! Du hast schon richtig viel Wissen.";
            } else if (ratio >= 0.4) {
                text = "Gar nicht schlecht – da geht noch was!";
            } else {
                text = "Kopf hoch, beim nächsten Versuch wird's besser!";
            }

            scoreTextEl.textContent = text;
            progressEl.style.width = "100%";
        }

        function restartQuiz() {
            currentQuestionIndex = 0;
            score = 0;
            questionAnswered = false;

            quizContainer.hidden = false;
            resultContainer.hidden = true;
            nextBtn.disabled = true;

            displayQuestion();
        }

        nextBtn.addEventListener("click", nextQuestion);
        restartBtn.addEventListener("click", restartQuiz);

        displayQuestion();
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initMiniQuiz);
    } else {
        initMiniQuiz();
    }
})();