<?php
require_once __DIR__ . '/../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref = trim($_POST['reference'] ?? '');
    $texte = trim($_POST['texte'] ?? '');
    $cat = trim($_POST['categorie'] ?? null);
    if ($ref === '' || $texte === '') { $error = 'Référence et texte requis.'; }
    else {
        $stmt = $pdo->prepare('INSERT INTO versets (reference, texte, categorie) VALUES (?, ?, ?)');
        $stmt->execute([$ref, $texte, $cat]);
        $success = 'Verset ajouté.';
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Ajouter</title></head><body>
<h2>Ajouter verset</h2>
<?php if(!empty($error)) echo '<p style="color:red;">'.htmlspecialchars($error).'</p>'; ?>
<?php if(!empty($success)) echo '<p style="color:green;">'.htmlspecialchars($success).'</p>'; ?>
<form method="post">
<label>Référence<br><input name="reference" required></label><br><br>
<label>Texte<br><textarea name="texte" rows="6" cols="70" required></textarea></label><br><br>
<label>Catégorie (facultatif)<br><input name="categorie"></label><br><br>
<button type="submit">Ajouter</button>
</form>
<p><a href="liste.php">Voir la liste</a></p>
</body></html>
