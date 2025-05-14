<?php
require_once 'users.inc.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $mdp = trim($_POST['mdp'] ?? '');
    $mdp2 = trim($_POST['mdp2'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($login === '' || $mdp === '' || $mdp2 === '' || $email === '') {
        $msg = "Tous les champs sont requis.";
    } elseif ($mdp !== $mdp2) {
        $msg = "Les mots de passe ne correspondent pas.";
    } elseif (exist($login)) {
        $msg = "Le nom d'utilisateur est déjà utilisé.";
    } else {
        if (addUser($login, $mdp, $email)) {
            header("Location: login.php?msg=Inscription réussie !");
            exit();
        } else {
            $msg = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="./css/styles1.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-body">
                <h2 style="text-align:center; margin-bottom: 2rem;">Créer un compte</h2>

                <?php if ($msg): ?>
                    <div class="alert-error"><?= htmlspecialchars($msg) ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="input-group">
                        <label class="input-label" for="signup-name">Nom d'utilisateur</label>
                        <input type="text" name="login" id="signup-name" class="input-field" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="signup-password">Mot de passe</label>
                        <input type="password" name="mdp" id="signup-password" class="input-field" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="signup-password2">Confirmer le mot de passe</label>
                        <input type="password" name="mdp2" id="signup-password2" class="input-field" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="signup-email">Email</label>
                        <input type="email" name="email" id="signup-email" class="input-field" required>
                    </div>

                    <button type="submit" class="submit-btn">S'inscrire</button>
                </form>

                <div class="login-footer">
                    <p>Déjà un compte ? <a href="login.php" class="login-link">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
