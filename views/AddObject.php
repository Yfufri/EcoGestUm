<link rel="stylesheet" href="assets/css/style.csss">
<link rel="stylesheet" href="assets/css/styleAddObject.css">

<h2>AJOUTER UN OBJET</h2>
<div class="page-add-object">
<section class="add-object-container">
    <form class="add-object-form" method="post" action="AddObject.php" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Titre :" required>
        <select name="categorie" required>
            <!--A remplacer par une boucle php qui récupère les catégories en base de données-->
            <option value="">Choisissez une catégorie</option>
            <option value="mobilier">Mobilier</option>
            <option value="électronique">Électronique</option>
            <option value="livre">Livre</option>
            <option value="autres">Autres</option>
        </select>
        <input type="text" name="adresse" placeholder="Adresse :" required>
        <textarea name="description" placeholder="Description :" required></textarea>
        <div class="file-drop-area">
            <span class="fake-btn">Glissez-déposez des images ici<br>pour les téléverser</span>
            <input class="file-input" type="file" name="images[]" multiple>
        </div>
        <button type="submit" class="submit-btn">AJOUTER</button>
    </form>
</section>
</div>