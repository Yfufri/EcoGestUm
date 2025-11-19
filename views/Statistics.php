<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/styleStatitics.css">

<section class="stats">
  <h2>Statistiques Environnementales</h2>
  <div class="stats-cards">
    <div class="stat">
      <img src="../assets/etudiant/image5.png" alt="Objets recyclés">
      <span class="stat-nombre"><?= $nbObjetRecyclé ?? 0 ?></span>
      <span class="stat-libelle">objets recyclés</span>
    </div>
    <div class="stat">
      <img src="../assets/etudiant/image3.png" alt="Evenement">
      <span class="stat-nombre"><?= $nbEvenementPassé ?? 0 ?></span>
      <span class="stat-libelle">évenements organisés</span>
    </div>
    <div class="stat">
      <img src="../assets/etudiant/image4.png" alt="Objets Disponibles">
      <span class="stat-nombre"><?= $nbEvenementPassé ?? 0 ?></span>
      <span class="stat-libelle">objets disponibles</span>
    </div>
  </div>
  <a class="btn" href="#">En savoir plus</a>
</section>