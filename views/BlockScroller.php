<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleBlockScroller.css">

<div class="blockScroller">
    <h2><?= $titre ?? 'titre' ?></h2>
    <div class="blockItems">
        <?php foreach ($elements as $element): ?>
            <div class="blockItem">
                <img src="<?= $element['image'] ?? 'assets/default.png' ?>" alt="<?= $element['alt'] ?? 'Image' ?>">
                <div class="text">
                    <h3><?= $element['titre'] ?? 'Titre' ?></h3>
                    <p><?= $element['desc'] ?? 'Description' ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>