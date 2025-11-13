<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config.php';
try {
    $stmt = $pdo->prepare("SELECT verset_id, updated_at FROM versetdujour WHERE id = 1 LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $today = (new DateTime())->format('Y-m-d');
    $verset = null;
    if ($row && $row['verset_id'] && $row['updated_at'] === $today) {
        $v = $pdo->prepare("SELECT id, reference, texte FROM versets WHERE id = ? LIMIT 1");
        $v->execute([$row['verset_id']]);
        $verset = $v->fetch(PDO::FETCH_ASSOC);
    } else {
        $count = (int)$pdo->query("SELECT COUNT(*) FROM versets")->fetchColumn();
        if ($count === 0) {
            echo json_encode(['success' => false, 'message' => 'Aucun verset trouvé.']);
            exit;
        }
        $dayOfYear = (int)date('z');
        $offset = ($dayOfYear % $count);
        $sel = $pdo->prepare("SELECT id, reference, texte FROM versets ORDER BY id LIMIT 1 OFFSET ?");
        $sel->bindValue(1, $offset, PDO::PARAM_INT);
        $sel->execute();
        $verset = $sel->fetch(PDO::FETCH_ASSOC);
        if (!$verset) {
            $sel2 = $pdo->query("SELECT id, reference, texte FROM versets ORDER BY RAND() LIMIT 1");
            $verset = $sel2->fetch(PDO::FETCH_ASSOC);
        }
        $up = $pdo->prepare("INSERT INTO versetdujour (id, verset_id, updated_at) VALUES (1, ?, ?) ON DUPLICATE KEY UPDATE verset_id = VALUES(verset_id), updated_at = VALUES(updated_at)");
        $up->execute([$verset['id'], $today]);
    }
    if ($verset) {
        echo json_encode(['success' => true, 'verset' => $verset]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Impossible de récupérer le verset.']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur serveur: ' . $e->getMessage()]);
}
?>