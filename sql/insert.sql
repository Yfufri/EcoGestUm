-- 1. INSERTION DES RÔLES 
INSERT INTO ROLE (Nom_role) VALUES
('Etudiant'),
('Enseignant'),
('Chef de departement'),
('Administrateur'),
('Président'),
('Visiteur'),
('Responsable Service'),
('BDE'),
('Directeur Composante');

-- 2. INSERTION DES CATÉGORIES D'OBJETS  
INSERT INTO CATEGORIE_OBJET (Nom_categorie_objet, Desc_categorie_objet) VALUES
('Livre', 'Livres academiques et manuels'),
('Materiel informatique', 'Ordinateurs, cables, accessoires'),
('Mobilier', 'Chaises, bureaux, etageres'),
('Fournitures', 'Stylos, cahiers, classeurs'),
('Equipement sportif', 'Materiel de sport'),
('Electronique', 'Appareils electroniques divers'),
('Vetements', 'Vetements et accessoires'),
('Decoration', 'Elements decoratifs'),
('Materiel de laboratoire', 'Equipement scientifique'),
('Instruments de musique', 'Instruments et accessoires musicaux');

-- 3. INSERTION DES CATÉGORIES D'ÉVÉNEMENTS 
INSERT INTO CATEGORIE_EVENEMENT (Nom_categorie_evenement, Desc_categorie_evenement) VALUES
('Atelier recyclage', 'Ateliers sur le recyclage et tri'),
('Collecte', 'Evenements de collecte'),
('Sensibilisation', 'Evenements de sensibilisation ecologique'),
('Formation', 'Formations sur le developpement durable'),
('Conference', 'Conferences environnementales'),
('Visite', 'Visites de centres de tri'),
('Competition', 'Competitions eco-responsables'),
('Exposition', 'Expositions thematiques'),
('Nettoyage', 'Journees de nettoyage'),
('Marche', 'Marches et vides-greniers solidaires');

-- 4. INSERTION DES STATUTS 
INSERT INTO STATUT (Nom_statut) VALUES
('Disponible'),
('Reserve'),
('En attente validation'),
('Non Disponible');

-- 5. INSERTION DES POINTS DE COLLECTE 
INSERT INTO POINT_DE_COLLECTE (Nom_point_de_collecte, Desc_point_de_collecte, Localisation_point_de_collecte) VALUES
('Hall principal - Le Mans', 'Point de collecte au hall principal', '48.01557681668436, 0.1608242977434759'),
('Bibliotheque universitaire - Le Mans', 'Point de collecte a la BU', '48.01606059993084, 0.16056293443514547'),
('RU - Le Mans', 'Point de collecte restaurant universitaire', '48.015197566744746, 0.16503270950652685'),
('Hall des sports - Le Mans', 'Point de collecte du hall des sports', '48.01668924670227, 0.16641198934104198'),
('Cité Université Vaurouzé - Le Mans', 'Point de collecte de la cité Vaurouzé', '48.01585976560582, 0.16617809946218237'),
('Laboratoire CERIUM - Laval', 'Point de collecte du CERIUM', '48.08519351274947, -0.755934750453157'),
('Département Informatique - Laval', 'Point de collecte du département informatique', '48.08599958402622, -0.7594807442014263'),
('Batiment Administratif - Laval', 'Point de collecte du batiment administratif', '48.085868926312415, -0.7577887111208575'),
('Résidence Universitaire la Dormerie - Laval', 'Point de collecte de la résidence universitaire la dormerie', '48.08538267895369, -0.7591712912470682'),
('BU - Laval', 'Point de collecte de la BU', '48.08599995335052, -0.7586132263612575');

-- 6. INSERTION DES COMPOSANTES 
INSERT INTO COMPOSANTE (Nom_composante) VALUES
('Faculté de Droit, Sciences Économiques & Gestion'),
('Faculté des Lettres, Langues & Sciences Humaines'),
('Faculté des Sciences & Techniques'),
('Institut Universitaire de Technologie (IUT) du Mans'),
('Institut Universitaire de Technologie (IUT) de Laval'),
('École Nationale Supérieure d\'Ingénieurs du Mans (ENSIM)');

-- 7. INSERTION DES DÉPARTEMENTS 
INSERT INTO DEPARTEMENT (Nom_departement, Id_composante) VALUES
('Informatique', 5),
('Génie Biologique', 5),
('Métiers du Multimédia et de l\'Internet', 5),
('Techniques de Commercialisation', 5),
('Chimie', 4),
('Génie Mécanique et Productique', 4),
('Gestion des Entreprises et des Administrations', 4),
('Droit public économique', 1),
('Droit bancaire et financier', 1),
('Droit des assurances', 1),
('Licence avec parcours Sciences Po', 1),
('Droit généraliste', 1),
('Vibrations, Acoustique', 6),
('Instrumentation pour l\'Environnement', 6),
('Architecture des Systèmes Temps-Réel et Embarqués', 6);

-- 8. INSERTION DES UTILISATEURS 
-- Étudiants 
INSERT INTO UTILISATEUR (Nom_utilisateur, Prenom_utilisateur, Mail_utilisateur, Id_departement, Id_role) VALUES
('Dupont', 'Marie', 'marie.dupont@etu.univ-lemans.fr', 1, 1),
('Martin', 'Lucas', 'lucas.martin@etu.univ-lemans.fr', 1, 1),
('Bernard', 'Sophie', 'sophie.bernard@etu.univ-lemans.fr', 2, 1),
('Petit', 'Thomas', 'thomas.petit@etu.univ-lemans.fr', 3, 1),
('Dubois', 'Emma', 'emma.dubois@etu.univ-lemans.fr', 4, 1),
('Leroy', 'Hugo', 'hugo.leroy@etu.univ-lemans.fr', 1, 1),
('Garnier', 'Lea', 'lea.garnier@etu.univ-lemans.fr', 5, 1),
('Rousseau', 'Nathan', 'nathan.rousseau@etu.univ-lemans.fr', 6, 1),
('Blanc', 'Camille', 'camille.blanc@etu.univ-lemans.fr', 7, 1),
('Girard', 'Alexandre', 'alexandre.girard@etu.univ-lemans.fr', 8, 1),
('Faure', 'Julie', 'julie.faure@etu.univ-lemans.fr', 9, 1),
('Andre', 'Maxime', 'maxime.andre@etu.univ-lemans.fr', 10, 1),
('Mercier', 'Sarah', 'sarah.mercier@etu.univ-lemans.fr', 11, 1),
('Lemoine', 'Antoine', 'antoine.lemoine@etu.univ-lemans.fr', 12, 1),
('Mathieu', 'Clara', 'clara.mathieu@etu.univ-lemans.fr', 13, 1);

-- Enseignants 
INSERT INTO UTILISATEUR (Nom_utilisateur, Prenom_utilisateur, Mail_utilisateur, Id_departement, Id_role) VALUES
('Moreau', 'Pierre', 'pierre.moreau@univ-lemans.fr', 1, 2),
('Simon', 'Claire', 'claire.simon@univ-lemans.fr', 2, 2),
('Laurent', 'Jean', 'jean.laurent@univ-lemans.fr', 3, 2),
('Lefebvre', 'Anne', 'anne.lefebvre@univ-lemans.fr', 4, 2),
('Michel', 'Francois', 'francois.michel@univ-lemans.fr', 5, 2),
('Garcia', 'Isabelle', 'isabelle.garcia@univ-lemans.fr', 6, 2),
('David', 'Laurent', 'laurent.david@univ-lemans.fr', 1, 2),
('Bertrand', 'Sophie', 'sophie.bertrand@univ-lemans.fr', 2, 2),
('Robert', 'Michel', 'michel.robert@univ-lemans.fr', 3, 2),
('Thomas', 'Marie', 'marie.thomas@univ-lemans.fr', 4, 2);

-- Chefs de département
INSERT INTO UTILISATEUR (Nom_utilisateur, Prenom_utilisateur, Mail_utilisateur, Id_departement, Id_role) VALUES
('Roux', 'Philippe', 'philippe.roux@univ-lemans.fr', 1, 3),
('Fournier', 'Isabelle', 'isabelle.fournier@univ-lemans.fr', 2, 3),
('Girard', 'Marc', 'marc.girard@univ-lemans.fr', 3, 3),
('Morel', 'Christine', 'christine.morel@univ-lemans.fr', 4, 3),
('Fontaine', 'Paul', 'paul.fontaine@univ-lemans.fr', 5, 3),
('Chevalier', 'Valerie', 'valerie.chevalier@univ-lemans.fr', 6, 3),
('Gautier', 'Jacques', 'jacques.gautier@univ-lemans.fr', 7, 3),
('Perrin', 'Sylvie', 'sylvie.perrin@univ-lemans.fr', 8, 3),
('Robin', 'Daniel', 'daniel.robin@univ-lemans.fr', 9, 3),
('Clement', 'Nathalie', 'nathalie.clement@univ-lemans.fr', 10, 3);

-- 9. INSERTION DES OBJETS 
INSERT INTO OBJET (Nom_objet, Desc_objet, Id_utilisateur, Id_categorie_objet, Id_point_collecte, Id_statut) VALUES
('Livre Java avance', 'Livre de programmation Java en bon etat', 1, 1, 1, 1),
('Chaise de bureau', 'Chaise pivotante noire', 2, 3, 2, 1),
('Calculatrice scientifique', 'TI-84 Plus en parfait etat', 3, 4, 1, 2),
('Manuel de biologie', 'Manuel de biologie cellulaire 3e edition', 4, 1, 3, 1),
('Cable HDMI', 'Cable HDMI 2m', 1, 2, 1, 1),
('Lampe de bureau', 'Lampe LED reglable', 5, 3, 2, 1),
('Ecran 24 pouces', 'Ecran Dell 24 pouces Full HD', 16, 2, 4, 1),
('Lot de stylos', 'Lot de 20 stylos bille bleus', 17, 4, 4, 1),
('Livres mathematiques', 'Collection de 5 livres de mathematiques', 17, 1, 2, 1),
('Classeurs vides', 'Lot de 10 classeurs A4', 19, 4, 3, 1),
('Ordinateur portable', 'HP Pavilion i5, 8Go RAM', 26, 2, 4, 1),
('Bureau en bois', 'Bureau 120x60 cm en bon etat', 27, 3, 2, 1),
('Raquette de tennis', 'Raquette Wilson Pro Staff', 6, 5, 5, 1),
('Dictionnaire anglais', 'Oxford Advanced Learner Dictionary', 7, 1, 2, 1),
('Clavier sans fil', 'Clavier Logitech K380', 8, 2, 1, 1),
('Etagere murale', 'Etagere blanche 80cm', 9, 3, 6, 1),
('Microscope', 'Microscope optique Leica', 18, 9, 6, 3),
('Guitare acoustique', 'Guitare Yamaha F310', 10, 10, 7, 1),
('Imprimante', 'Imprimante HP DeskJet 2630', 11, 2, 9, 1),
('Tableau blanc', 'Tableau blanc 120x90 cm avec support', 20, 8, 4, 1),
('Sac a dos', 'Sac a dos Eastpak noir', 12, 7, 8, 1),
('Cafetiere', 'Cafetiere Senseo', 13, 6, 3, 1),
('Plantes vertes', 'Lot de 3 plantes en pot', 14, 8, 9, 3),
('Balance de laboratoire', 'Balance precision Sartorius', 21, 9, 6, 1),
('Livres de droit', 'Collection Code Civil et annexes', 15, 1, 2, 1);

-- 10. INSERTION DES PHOTOS 
INSERT INTO PHOTO (Url_photo, Id_objet) VALUES
('/photos/objet1_1.jpg', 1),
('/photos/objet2_1.jpg', 2),
('/photos/objet3_1.jpg', 3),
('/photos/objet7_1.jpg', 7),
('/photos/objet11_1.jpg', 11),
('/photos/objet11_2.jpg', 11),
('/photos/objet13_1.jpg', 13),
('/photos/objet17_1.jpg', 17),
('/photos/objet17_2.jpg', 17),
('/photos/objet18_1.jpg', 18),
('/photos/objet19_1.jpg', 19),
('/photos/objet20_1.jpg', 20),
('/photos/objet24_1.jpg', 24),
('/photos/objet25_1.jpg', 25),
('/photos/objet12_1.jpg', 12);

-- 11. INSERTION DES RÉSERVATIONS 
INSERT INTO RESERVATION (Date_reservation, Id_utilisateur, Id_objet) VALUES
('2025-10-15', 3, 3),
('2025-10-18', 6, 1),
('2025-10-19', 2, 7),
('2025-10-20', 4, 9),
('2025-10-21', 5, 14),
('2025-10-19', 7, 15),
('2025-10-20', 8, 18),
('2025-10-18', 9, 19),
('2025-10-21', 10, 20),
('2025-10-17', 11, 21),
('2025-10-16', 12, 22),
('2025-10-20', 13, 24);

-- 12. INSERTION DES SIGNALEMENTS 
INSERT INTO SIGNALEMENT (Motif_signalement, Date_signalement, Id_objet, Id_utilisateur) VALUES
('Objet en mauvais etat non signale', '2025-10-16', 2, 16),
('Description incorrecte', '2025-10-17', 6, 17),
('Objet manquant sur le point de collecte', '2025-10-18', 10, 18),
('Photo ne correspond pas a l objet', '2025-10-19', 13, 19),
('Objet dangereux', '2025-10-20', 17, 26),
('Contenu inapproprie', '2025-10-15', 16, 20),
('Doublon', '2025-10-17', 21, 21),
('Non conforme', '2025-10-18', 22, 27),
('Etat non precise', '2025-10-19', 23, 22),
('Information manquante', '2025-10-20', 25, 28);

-- 13. INSERTION DES ÉVÉNEMENTS 
INSERT INTO EVENEMENT 
(Nom_evenement, Localisation_evenement, Date_evenement, Id_categorie_evenement, Id_utilisateur, Description) VALUES
('Atelier tri selectif', 'Amphi A', '2025-11-05', 1, 16, 'Atelier sur le tri sélectif et bonnes pratiques éco-responsables.'),
('Collecte de materiel informatique', 'Hall principal', '2025-11-12', 2, 17, 'Collecte de matériels informatiques usagés pour recyclage.'),
('Sensibilisation zero dechet', 'Salle B12', '2025-11-20', 3, 18, 'Atelier de sensibilisation à la démarche zéro déchet.'),
('Journee du recyclage departement Info', 'Batiment A', '2025-11-25', 1, 26, 'Action de recyclage avec le département informatique.'),
('Grande collecte de livres', 'Bibliotheque', '2025-12-01', 2, 27, 'Collecte de livres pour donner une seconde vie aux ouvrages.'),
('Conference climat', 'Amphi Central', '2025-11-15', 5, 19, 'Conférence sur les enjeux climatiques actuels.'),
('Formation compostage', 'Jardin universitaire', '2025-11-18', 4, 20, 'Formation pratique au compostage sur site.'),
('Visite centre de tri', 'Hors campus', '2025-11-22', 6, 28, 'Visite guidée d’un centre de tri des déchets.'),
('Competition eco-gestes', 'Campus', '2025-12-05', 7, 21, 'Compétition d’éco-gestes avec remise de prix.'),
('Exposition recyclage artistique', 'Hall principal', '2025-12-10', 8, 29, 'Exposition d’œuvres réalisées à partir de matériaux recyclés.'),
('Nettoyage campus', 'Campus entier', '2025-11-28', 9, 22, 'Journée collective de nettoyage de l’ensemble du campus.'),
('Marche solidaire', 'Parking principal', '2025-12-15', 10, 30, 'Marche solidaire au profit d’une cause environnementale.');

-- 14. INSERTION DES INSCRIPTIONS AUX ÉVÉNEMENTS
INSERT INTO INSCRIPTION (Id_utilisateur, Id_evenement) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 3),
(1, 3),
(2, 4),
(16, 1),
(17, 4),
(7, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10),
(13, 11),
(14, 12),
(15, 1),
(3, 6);

-- modif web

INSERT INTO `Image_Evenement` (`Id_Image`, `Url_image`, `Id_evenement`) VALUES
(1, 'assets/images/events/atelier-tri.jpg', 1),
(2, 'assets/images/events/collecte-info.jpg', 2),
(3, 'assets/images/events/zero-dechet.jpg', 3),
(4, 'assets/images/events/recyclage-info.jpg', 4),
(5, 'assets/images/events/collecte-livres.jpg', 5),
(6, 'assets/images/events/conference-climat.jpg', 6),
(7, 'assets/images/events/compostage.jpg', 7),
(8, 'assets/images/events/visite-centre-tri.jpg', 8),
(9, 'assets/images/events/competition-eco.jpg', 9),
(10, 'assets/images/events/exposition.jpg', 10),
(11, 'assets/images/events/nettoyage-campus.jpg', 11),
(12, 'assets/images/events/marche-solidaire.jpg', 12);  



