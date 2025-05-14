<?php
require_once 'users.inc.php';
session_start();

$users = [];

if (($handle = fopen("users.csv", "r")) !== false) {
    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) >= 5) {
            $users[] = [
                'username' => $data[0],
                'bestscore' => (int)$data[3],
                'games' => (int)$data[4]
            ];
        }
    }
    fclose($handle);
}

// Trie du meilleur score au plus bas
usort($users, fn($a, $b) => $b['bestscore'] <=> $a['bestscore']);

// Garde les 10 premiers
$topUsers = array_slice($users, 0, 10);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>🏆 Classement des 10 meilleurs joueurs</h1>
    <table class="leaderboard">
        <thead>
            <tr>
                <th>Rang</th>
                <th>Nom d'utilisateur</th>
                <th>Meilleur score</th>
                <th>Parties jouées</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topUsers as $i => $user): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= $user['bestscore'] ?></td>
                    <td><?= $user['games'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">← Retour au jeu</a></p>
</body>
</html>
