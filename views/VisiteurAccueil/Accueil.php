<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Votre titre</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="banner-recycler">
        <div class="banner-overlay">
            RECYCLER<br>
            N’A JAMAIS<br>
            ÉTÉ SI FACILE
        </div>
    </div>
    <!-- Engagement Section -->
    <div class="engagement-section">
        <div class="engagement-Greenbox">
            <div class="engagement-Whitebox">
                <h2>Notre Engagement pour<br>
                    une université écoresponsable
                </h2>
                <p>
                    À Le Mans Université, nous nous engageons à réduire notre impact environnemental en favorisant le
                    recyclage, la réutilisation et la gestion durable des ressources.
                </p>
                <p>
                    Grâce à ÉcoGestUM, notre application dédiée, nous mettons en place des solutions innovantes pour
                    optimiser le tri, encourager la réutilisation des objets et sensibiliser notre communauté
                    universitaire aux enjeux écologiques.
                </p>
            </div>
            <a href="#" class="policy-btn">Découvrir notre politique</a>
        </div>
    </div>
    <!-- Statistics Section -->
    <?php
    include('views/statistiquesEnv.php');
    ?>
    <!-- Visite Guidée Section -->
    <div class="visite-section">
        <h1 class="visite-title">Visite Guidée</h1>

        <div class="photo-wrapper">
            <picture>
                <source media="(max-width: 824px)" srcset="assets/Accueil/PhotoAccueil3Responsive.png">
                <source media="(min-width: 825px)" srcset="assets/Accueil/PhotoAccueil3.png">
                <img src="assets/Accueil/PhotoAccueil3.png" alt="Groupe d'étudiants ramassant des déchets" />
            </picture>
            
            <div class="visite-overlay">
                <div class="visite-desc">
                    Des événements<br><strong>À NE PAS RATER!</strong>
                </div>
                <a href="#" class="policy-btn">S’inscrire à un événement</a>
            </div>
        </div>
    </div>
    <!--Evenements Section -->
    <div class="event-section">
        <h1 class="event-title">Événements</h1>

        <div class="photo-wrapper">
            <img src="assets/Accueil/PhotoAccueil2.png" alt="Groupe d'étudiants ramassant des déchets" />

            <div class="event-overlay">
                <div class="event-desc">
                    Des événements<br><strong>À NE PAS RATER!</strong>
                </div>
                <a href="#" class="policy-btn">S’inscrire à un événement</a>
            </div>
        </div>

        <div class="event-caption">
            Le Mans : des étudiants mobilisés pour ramasser des déchets
        </div>
    </div>
</body>

</html>