<link rel="stylesheet" href="assets/css/StyleInscriptionEvent.css">

<div class="evenements-conteneur">
  <div class="evenement-ligne">
    <div class="evenement-gauche">
      <img src="<?= htmlspecialchars($evenement['img_url']) ?>"
           alt="<?= htmlspecialchars($evenement['titre']) . ' illustration' ?>">
    </div>
    <div class="evenement-details">
      <h2><?= htmlspecialchars($evenement['titre']) ?></h2>
      <p><?= htmlspecialchars($evenement['description']) ?></p>
      <form class="formulaire-inscription" method="post">
        <input type="text" name="nom" placeholder="Nom *">
        <input type="text" name="prenom" placeholder="Prénom *">
        <input type="email" name="email" placeholder="Adresse mail *">
        <button type="submit">S'inscrire</button>
      </form>
    </div>
  </div>
</div>
