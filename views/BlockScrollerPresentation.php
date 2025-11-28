<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleBSPresentation.css">

<section class="sectionPresentation">
    <h2><?= $titre ?></h2>
    <div class="content">
        <div class="blockItem">
            <img src="<?= 'assets/'.$element['image'] ?? 'assets/default.png' ?>" alt="Image">
            <div class="text">
                <h3><?= $element['titre'] ?? 'Titre' ?></h3>
                <p><?= $element['desc'] ?? 'Description' ?></p>
            </div>
        </div>
        <a href="?action=<?= $type ?>" class="btnBS">Voir plus</a>
    </div>
</section>