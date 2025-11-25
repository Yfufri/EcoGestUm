<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/views/inscription.php
?>
<link rel="stylesheet" href="assets/css/StyleInscriptionEvent.css?v=<?= time() ?>">

<!-- Grand titre avec background -->
<div class="inscription-banner">
    <h1><?= htmlspecialchars($evenement['Nom_evenement']) ?></h1>
</div>

<div class="evenements-conteneur">
  <?php if (isset($evenement) && $evenement): ?>
    <div class="evenement-ligne">
      <div class="evenement-gauche">
        <?php if (!empty($evenement['Url_image'])): ?>
          <img src="<?= htmlspecialchars($evenement['Url_image']) ?>"
               alt="<?= htmlspecialchars($evenement['Nom_evenement']) ?> illustration">
        <?php else: ?>
          <div class="image-placeholder">📅</div>
        <?php endif; ?>
        
        <div class="event-info-box">
          <p><?= htmlspecialchars($evenement['Description']) ?></p>
          <div class="event-info">
            <div class="event-date">
              <strong>Date:</strong> <?= date('d/m/Y', strtotime($evenement['Date_evenement'])) ?>
            </div>
            <div class="event-location">
              <strong>Lieu:</strong> <?= htmlspecialchars($evenement['Localisation_evenement']) ?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="evenement-details">
        <?php if (isset($inscriptionMessage)): ?>
          <div class="message-inscription <?= $inscriptionMessage['success'] ? 'success' : 'error' ?>" id="messageInscription">
            <div class="message-icon">
              <?= $inscriptionMessage['success'] ? '✓' : '✖' ?>
            </div>
            <div class="message-content">
              <strong><?= $inscriptionMessage['success'] ? 'Succès !' : 'Erreur' ?></strong>
              <p><?= htmlspecialchars($inscriptionMessage['message']) ?></p>
            </div>
            <button class="message-close" onclick="closeMessage()">×</button>
          </div>
        <?php endif; ?>
        
        <form class="formulaire-inscription" method="post" action="?action=inscription&id=<?= $evenement['Id_evenement'] ?>" id="formInscription">
          <input type="text" name="nom" placeholder="Nom *" required>
          <input type="text" name="prenom" placeholder="Prénom *" required>
          <input type="email" name="email" placeholder="Adresse mail *" required>
          <button type="submit">S'inscrire</button>
        </form>
      </div>
    </div>
  <?php else: ?>
    <div class="error-container">
      <h3>Événement introuvable</h3>
      <p>Désolé, cet événement n'existe pas ou n'est plus disponible.</p>
      <a href="?action=evenements" class="btn-retour">← Retour aux événements</a>
    </div>
  <?php endif; ?>
</div>

<script>
// Vider le formulaire après soumission réussie
<?php if (isset($inscriptionMessage) && $inscriptionMessage['success']): ?>
  document.getElementById('formInscription').reset();
  
  // Scroll vers le message
  document.getElementById('messageInscription').scrollIntoView({ 
    behavior: 'smooth', 
    block: 'center' 
  });
<?php endif; ?>

// Fonction pour fermer le message
function closeMessage() {
  const message = document.getElementById('messageInscription');
  message.style.animation = 'slideOut 0.3s ease-out';
  setTimeout(() => {
    message.style.display = 'none';
  }, 300);
}

// Fermer automatiquement après 5 secondes si succès
<?php if (isset($inscriptionMessage) && $inscriptionMessage['success']): ?>
  setTimeout(() => {
    closeMessage();
  }, 5000);
<?php endif; ?>
</script>