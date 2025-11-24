<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleConnect.css">


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ÉcoGestUM - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <!-- Section gauche - Formulaire de connexion -->
        <div class="login-section">
            <div class="logo">
                <img src="assets/Logo/logo-LeMansUniversite.png" alt="Le Mans Université">
            </div>

            <form class="form-container" method="POST" action="connect.php">
                <div class="form-group">
                    <label for="identifiant">Identifiant :*</label>
                    <input type="text" id="identifiant" name="identifiant" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe : *</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <?php if (isset($_GET['error'])){
                    echo "<div class='error'>Identifiant ou mot de passe incorrect.</div>";
                }
                ?>

                <button type="submit" class="btn-primary">Se connecter</button>
                
                <a href="" class="btn-secondary">1ère connexion</a>

                <a href="" class="forgot-password">Mot de passe oublié ?</a>

                <p class="security-notice">
                    Pour des raisons de sécurité, veuillez vous <a href="logout.php">déconnecter</a> et fermer votre navigateur lorsque vous avez fini d'accéder aux services authentifiés.
                </p>
            </form>
        </div>

        <!-- Section droite - Image -->
        <div class="image-section"></div>
    </div>
</body>
</html>