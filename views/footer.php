<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleFooter.css">

<footer class="footer">
    <img src="assets/Logo/BlancComplet.png" alt="EcoGestUM Logo" class="footer-logo" />

    <div class="acess">
        <p>Accès rapides</p>
        <div class="links">
            <a href="https://www.univ-lemans.fr" target="_blank" rel="noopener noreferrer">Site de l'université</a>
            <a href="#">Notre politique de recyclage</a>
            <a href="#">Nos événements</a>
             <?php if (!empty($_SESSION['id_utilisateur'])): ?>
                <a href="?action=logout">Se déconnecter</a>
            <?php else: ?>
                <a href="?action=login">Se connecter</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="legals">
        <a href="#">Accessibilité : non conforme</a>
        <a href="#">Données personnelles</a>
        <a href="#">Mentions légales</a>
        <a href="#">Plan du site</a>
    </div>
</footer>