<link rel="stylesheet" href="assets/css/style.csss">
<link rel="stylesheet" href="assets/css/styleAddObject.css">


<h2>AJOUTER UN OBJET</h2>
<div class="page-add-object">
    <section class="add-object-container">

        <?php if (isset($_POST['titre']) and isset($_POST['categorie']) and isset($_POST['Point_de_collecte']) and isset($_POST['description'])) {
            $max_size = 5 * 1024 * 1024;
            $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/assets/img/products/";
            ?>

            <div class="success-message">
                Objet "<?php echo htmlspecialchars($_POST['titre']); ?>" ajouté avec succès ! <br>
                <a href="index.php">Retourner à l'accueil</a>
            </div>


        <?php } else { ?>
            <form class="add-object-form" method="post" action="?action=addObject" enctype="multipart/form-data">
                <input type="text" name="titre" placeholder="Titre :" required>
                <select name="categorie" required>

                    <option value="" disabled selected>Catégorie :</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo htmlspecialchars($categorie['Id_categorie_objet']); ?>">
                            <?php echo htmlspecialchars($categorie['Nom_categorie_objet']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="Point de collecte" required>
                    <option value="" disabled selected>Point de Collecte :</option>
                    <?php foreach ($points_collecte as $point_collecte): ?>
                        <option value="<?php echo htmlspecialchars($point_collecte['id']); ?>">
                            <?php echo htmlspecialchars($point_collecte['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <textarea name="description" placeholder="Description :" required></textarea>
                <input class="file-input" type="file" name="images[]" multiple id="fileInput" accept=".png,.jpeg,.jpg,.webp">
                <div id="fileList" class="file-list"></div>

                <script>
                    let selectedFiles = [];
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];

                    document.getElementById('fileInput').addEventListener('change', function (e) {
                        const newFiles = Array.from(e.target.files);
                        const validFiles = newFiles.filter(file => {
                            if (allowedTypes.includes(file.type)) {
                                return true;
                            } else {
                                alert(`Le fichier "${file.name}" n'est pas un format autorisé. Formats acceptés : PNG, JPEG, JPG, WEBP`);
                                return false;
                            }
                        });

                        selectedFiles = [...selectedFiles, ...validFiles];
                        displayFiles();
                    });
                </script>
                <button type="submit" class="submit-btn">AJOUTER</button>
            </form>
        <?php } ?>
    </section>
</div>