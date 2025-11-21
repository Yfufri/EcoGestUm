<link rel="stylesheet" href="assets/css/StyleInscriptionEvent.css">

<div class="evenements-conteneur">
  <?php if ($evenement): ?>
    <div class="evenement-ligne">
      <div class="evenement-gauche">
        <img src="<?= htmlspecialchars($evenement['Url_image'] ?? '') ?>"
             alt="<?= htmlspecialchars($evenement['Nom_evenement'] ?? '') ?> illustration">
      </div>
      <div class="evenement-details">
        <h2><?= htmlspecialchars($evenement['Nom_evenement'] ?? '') ?></h2>
        <p><?= htmlspecialchars($evenement['Description'] ?? '') ?></p>
        <form class="formulaire-inscription" method="post">
          <input type="text" name="nom" placeholder="Nom *" required>
          <input type="text" name="prenom" placeholder="Prénom *" required>
          <input type="email" name="email" placeholder="Adresse mail *" required>
          <button type="submit">S'inscrire</button>
        </form>
      </div>
    </div>
  <?php else: ?>
    <p>Aucun événement trouvé</p>
  <?php endif; ?>
</div>