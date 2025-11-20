<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ÉcoGestUM - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
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
