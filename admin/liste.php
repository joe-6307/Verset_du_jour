<?php
require_once __DIR__ . '/../config.php';
$stmt = $pdo->query("SELECT id, reference, LEFT(texte,120) AS extrait, date_added FROM versets ORDER BY date_added DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Liste</title></head><body>
<h2>Liste</h2><p><a href="add_verset.php">Ajouter</a></p>
<table border="1" cellpadding="6"><tr><th>ID</th><th>Réf</th><th>Extrait</th><th>Ajouté</th></tr>
<?php foreach($rows as $r): ?>
<tr><td><?=htmlspecialchars($r['id'])?></td><td><?=htmlspecialchars($r['reference'])?></td><td><?=htmlspecialchars($r['extrait'])?></td><td><?=htmlspecialchars($r['date_added'])?></td></tr>
<?php endforeach; ?>
</table></body></html>
