<header>
    <div class="header-bar">
        <img src="assets/Logo/logo.webp" alt="Le Mans Université" class="header-logo">
        <nav class="site-nav">
            <a href="index.php">Accueil</a>
            <a href="index.php?action=politique">Politique de recyclage</a>
            <a href="index.php?action=statistiques">Statistiques</a>
            <a href="index.php?action=evenements">Événements</a>
            <?php if (!empty($_SESSION['id_utilisateur'])): ?>
                <a href="index.php?action=logout">Se déconnecter</a>
            <?php else: ?>
                <a href="index.php?action=login">Se connecter</a>
            <?php endif; ?>
        </nav>
    </div>
    <div class="ecogestum-bar">ÉcoGestUM</div>
</header>