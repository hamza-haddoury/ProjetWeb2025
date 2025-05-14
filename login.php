<?php
$message = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - QSport</title>
    <link rel="stylesheet" href="./css/styles1.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-body">
                <?php if ($message): ?>
                    <div class="alert-error">
                        <?= $message ?>
                    </div>
                <?php endif; ?>

                <form class="login-form" method="post" action="access.php">
                    <div class="input-group">
                        <label for="login-email" class="input-label">Nom d'utilisateur</label>
                        <input type="text" name="login" id="login-email" class="input-field" required placeholder="Votre identifiant">
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    
                    <div class="input-group">
                        <label for="login-password" class="input-label">Mot de passe</label>
                        <input type="password" name="mdp" id="login-password" class="input-field" required placeholder="Votre mot de passe">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Se connecter
                    </button>
                </form>

                <div class="login-footer">
                    <p>Nouveau membre ? <a href="register.php" class="login-link">Créer un compte</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
