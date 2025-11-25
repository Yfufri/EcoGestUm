<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleStatitics.css">

<section class="stats">
  <h2>Statistiques Environnementales</h2>
  <div class="stats-cards">
    <div class="stat">
      <img src="assets/etudiant/image5.png" alt="Objets recyclés">
      <span class="stat-nombre"><?= $nbObjetRecycle ?? 0 ?></span>
      <span class="stat-libelle">objets recyclés</span>
    </div>
    <div class="stat">
      <img src="assets/etudiant/image3.png" alt="Evenement">
      <span class="stat-nombre"><?= $nbEvenementPasse ?? 0 ?></span>
      <span class="stat-libelle">évenements organisés</span>
    </div>
    <div class="stat">
      <img src="assets/etudiant/image4.png" alt="Objets Disponibles">
      <span class="stat-nombre"><?= $nbObjetDisponible ?? 0 ?></span>
      <span class="stat-libelle">objets disponibles</span>
    </div>
  </div>
  <a class="btn" href="?action=statistiques">En savoir plus</a>
</section>

<script>
// Animation des compteurs de statistiques
function animateCounters() {
  const counters = document.querySelectorAll('.stat-nombre');
  
  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
        animateCounter(entry.target);
        entry.target.classList.add('animated');
      }
    });
  }, observerOptions);

  counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element) {
  const target = parseInt(element.textContent) || 0;
  const duration = 1200;
  const startTime = Date.now();

  element.textContent = '0';

  function easeInOutQuad(t) {
    return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
  }

  const timer = setInterval(() => {
    const elapsed = Date.now() - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const easedProgress = easeInOutQuad(progress);
    const current = Math.floor(easedProgress * target);

    element.textContent = current;

    if (progress >= 1) {
      element.textContent = target;
      clearInterval(timer);
    }
  }, 16);
}

document.addEventListener('DOMContentLoaded', animateCounters);
</script>