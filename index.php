<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=versetdb;charset=utf8', 'root', '');

// Calcul de l'offset selon le jour de l'année
$dayOfYear = date('z'); // 0-365
$stmt = $pdo->query("SELECT COUNT(*) FROM versets");
$totalVersets = $stmt->fetchColumn();
$offset = $dayOfYear % $totalVersets;

// Récupération du verset du jour
$stmt = $pdo->query("SELECT * FROM versets LIMIT 1 OFFSET $offset");
$verse = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Verset du Jour - CBCA Mutiri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="assets/LOGO_CBCA.jpg" alt="CBCA Logo" class="logo">
            <h1>CBCA Mutiri</h1>
        </div>
        <h2>Verset du Jour</h2>
        <p class="verse-day" id="verse-day"></p>
        <p class="verse-date" id="verse-date"></p>
    </header>

    <main>
        <div class="verse-card">
            <p id="verse-text"><?= htmlspecialchars($verse['texte']) ?></p>
            <p class="reference" id="verse-ref"><?= htmlspecialchars($verse['reference']) ?></p>
        </div>

        <div class="share-buttons">
            <button class="whatsapp">WhatsApp</button>
            <button class="facebook">Facebook</button>
            <button class="x">X</button>
            <button class="instagram">Instagram</button>
            <button class="tiktok">TikTok</button>
            <button class="download">Télécharger</button>
        </div>
    </main>

    <footer>
        &copy; <?= date('Y') ?> CBCA Mutiri. Tous droits réservés.
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
