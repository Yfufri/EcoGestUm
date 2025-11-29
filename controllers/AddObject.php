<script>
    function displayFiles() {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';

            const fileName = document.createElement('span');
            fileName.textContent = file.name;

            const removeBtn = document.createElement('button');
            removeBtn.textContent = '✕';
            removeBtn.className = 'remove-btn';
            removeBtn.type = 'button';
            removeBtn.onclick = () => removeFile(index);

            fileItem.appendChild(fileName);
            fileItem.appendChild(removeBtn);
            fileList.appendChild(fileItem);
        });

        updateFileInput();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        displayFiles();
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        document.getElementById('fileInput').files = dt.files;
    }
</script>

<?php
$max_size = 5 * 1024 * 1024;
$target_dir = $_SERVER["DOCUMENT_ROOT"] . $_ENV['ASSET_FOLDER'] . 'photos/';
include "models/gererEquipement.php";

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);

function handle_a_upload($file_info, $max_size, $target_dir, $idObjet, $i)
{
    if ($file_info["size"] > $max_size) {
        $max_size_mb = number_format($max_size / (1024 * 1024), 1);
        echo "<p class=\"error\">Erreur : Le fichier '{$file_info["name"]}' dépasse la taille maximale autorisée de {$max_size_mb} MB.</p>";
        exit();
    }

    $tmp_file = $file_info["tmp_name"];
    $original_file_name = basename($file_info["name"]); //recup l'extension du fichier
    $allowed_extensions = ["png", "jpeg", "jpg", "webp"];

    $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "<p class=\"error\">Erreur : Le fichier '{$file_info["name"]}' n'est pas une image valide.</p>";
        exit();
    }

    $check = getimagesize($tmp_file);
    if ($check === false) {
        echo "<p class=\"error\">Erreur : Le fichier '{$file_info["name"]}' n'est pas une image valide.</p>";
        exit();
    }

    $new_file_name = "objet" . $idObjet . "_" . $i + 1 . "." . $imageFileType;
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($tmp_file, $target_file)) {
        return '/photos/' . $new_file_name;
    } else {
        echo "<p class=\"error\">Erreur : Impossible de déplacer le fichier '{$file_info["name"]}'.</p>";
        exit();
    }
}

if (isset($_POST['titre']) and isset($_POST['categorie']) and isset($_POST['Point_de_collecte']) and isset($_POST['description'])) {
    $idObjet = ajouterObjet($conn, $_POST['titre'], $_POST['description'], $_SESSION['user']['Id_utilisateur'], $_POST['categorie'], $_POST['Point_de_collecte']);
    $files = $_FILES['images'];
    var_dump($files);
    if (!empty($files['name'][0])) {
        for ($i = 0; $i < count($files['name']); $i++) {
            $file_info = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];
            $url = handle_a_upload($file_info, $max_size, $target_dir, $idObjet, $i);
            ajouterImage($conn, $idObjet, $url);
        }
    }
}
require 'views/AddObject.php';


?>