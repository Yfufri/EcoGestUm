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
INSERT INTO `utilisateur` (`Id_utilisateur`, `Nom_utilisateur`, `Prenom_utilisateur`, `Mail_utilisateur`, `Password_utilisateur`, `Id_departement`, `Id_role`) VALUES
(1, 'Dupont', 'Marie', 'marie.dupont@etu.univ-lemans.fr', '$2y$10$JprolcAHXLXFqX/Whp7kpufs6dvX/M6pKafAyzRgCEQj3h.J3n7Za', 1, 1),
(2, 'Martin', 'Lucas', 'lucas.martin@etu.univ-lemans.fr', '$2y$10$0z82Xg8T8UH1W/bDaxmRduLqDHyNivvQoz9mo1UcbB9FVKJWS7QO.', 1, 1),
(3, 'Bernard', 'Sophie', 'sophie.bernard@etu.univ-lemans.fr', '$2y$10$eoEN4wXLK9/9mlEARaLBUuOi8jM9sVPKmNGaJxzc2PHJbBHzcn1Jq', 2, 1),
(4, 'Petit', 'Thomas', 'thomas.petit@etu.univ-lemans.fr', '$2y$10$ViTz3c8ZnF.DaUH/eaXdsurDCPZhg5CLMK96uovT5TP7ziLjjAU2K', 3, 1),
(5, 'Dubois', 'Emma', 'emma.dubois@etu.univ-lemans.fr', '$2y$10$S78zWJpsgczBQO9GX9KVrO3XBrpBQJ5AgViCNsrZcQZXhyE5LDSq.', 4, 1),
(6, 'Leroy', 'Hugo', 'hugo.leroy@etu.univ-lemans.fr', '$2y$10$tVphVQMnpO.ucdCWXR2CFOSB/pFDErfmqfxawwK5ywgpsXSCUiDWG', 1, 1),
(7, 'Garnier', 'Lea', 'lea.garnier@etu.univ-lemans.fr', '$2y$10$a/o8CBJS15/MRi/ub/AlPO3UtHEhEspqOVLQZVLlXtNegrNUOMDnO', 5, 1),
(8, 'Rousseau', 'Nathan', 'nathan.rousseau@etu.univ-lemans.fr', '$2y$10$WbD.miI1i7cM9D5FffEjUO/e1xVrC67iFdexlKRyauCiVp7EwE6ia', 6, 1),
(9, 'Blanc', 'Camille', 'camille.blanc@etu.univ-lemans.fr', '$2y$10$u/rjNuDS.W7XNypOXlSa.OovPKMDb.lWMKBwLET30/Di0KaLQ5mpq', 7, 1),
(10, 'Girard', 'Alexandre', 'alexandre.girard@etu.univ-lemans.fr', '$2y$10$aGBDxwbxCaDqD4hlWgVCNO0kgjHg7FDKAi4d95v7f4WvIDy0Y8S16', 8, 1),
(11, 'Faure', 'Julie', 'julie.faure@etu.univ-lemans.fr', '$2y$10$tj1ij0asGvfNxZ38sdPBiupDwLk/DO6GlyxX0BcoJWObDsuNcljlS', 9, 1),
(12, 'Andre', 'Maxime', 'maxime.andre@etu.univ-lemans.fr', '$2y$10$zZZSMLJJUsDb7uH/goSyJeQ6O7ASgymD5jbzXY5kY4Kz9AB/ssaha', 10, 1),
(13, 'Mercier', 'Sarah', 'sarah.mercier@etu.univ-lemans.fr', '$2y$10$4ajkqgSMdr.oXyF17HeDvOh5TNgbkjj5Ai6YVxLKdWfKhoJAnzTXq', 11, 1),
(14, 'Lemoine', 'Antoine', 'antoine.lemoine@etu.univ-lemans.fr', '$2y$10$2FN6QC0d7g6bOZ3900F0pex3ngXJTaxyqJsQERg4siFcAkHcnM6NG', 12, 1),
(15, 'Mathieu', 'Clara', 'clara.mathieu@etu.univ-lemans.fr', '$2y$10$uQ2ed4YeqaAuTvNFCp7BQ.foFYq0xHWRMU5kTVC5LZW2MF2SH6SHG', 13, 1);


-- Enseignants 
INSERT INTO `utilisateur` (`Id_utilisateur`, `Nom_utilisateur`, `Prenom_utilisateur`, `Mail_utilisateur`, `Password_utilisateur`, `Id_departement`, `Id_role`) VALUES
(16, 'Moreau', 'Pierre', 'pierre.moreau@univ-lemans.fr', '$2y$10$am2R7oCf9Q0RKCL.aRJDHO24dVjGUU8KDb3wITCfC0dWwk7j6iGoq', 1, 2),
(17, 'Simon', 'Claire', 'claire.simon@univ-lemans.fr', '$2y$10$jQqlZ6SJPgk.wM4AFgbvV.SwPN9HF7xGR3DxpOSiWKw7tb1LtJ88C', 2, 2),
(18, 'Laurent', 'Jean', 'jean.laurent@univ-lemans.fr', '$2y$10$NNsq9etMdcauZaiKYW47VOkmI.irT2MVi3e0NLv7uzhUIwcBovQLC', 3, 2),
(19, 'Lefebvre', 'Anne', 'anne.lefebvre@univ-lemans.fr', '$2y$10$0/sDP1.32th0OvNJf899lOyqfk9v1mtj9Kri.4AzgTpD6Xre8Fw9.', 4, 2),
(20, 'Michel', 'Francois', 'francois.michel@univ-lemans.fr', '$2y$10$o2b/0oWMlogzSK9A3NXxmuc9SvqFG7MO.A.fBgGyQg8mWO0rCYWf.', 5, 2),
(21, 'Garcia', 'Isabelle', 'isabelle.garcia@univ-lemans.fr', '$2y$10$pM34kEs8KyeE3lv7mXzysui9MpwS2g4t5nrgPEj9WRAT0fMTSC2r6', 6, 2),
(22, 'David', 'Laurent', 'laurent.david@univ-lemans.fr', '$2y$10$XEslBF5j0e7fAuwdGzvdu.YfzLt/5eri.ZOz3Hygpnp9/EZ5L//5e', 1, 2),
(23, 'Bertrand', 'Sophie', 'sophie.bertrand@univ-lemans.fr', '$2y$10$KPyiQDzEQYJ6QxHWADTkXOavXpv86ju7LentulIDVbHwRK28C26Fy', 2, 2),
(24, 'Robert', 'Michel', 'michel.robert@univ-lemans.fr', '$2y$10$0Ry2MKjdQ/s7mBi3Q.Q24.8WSFeVG8ROQfVhofv2rmckbG28isUTu', 3, 2),
(25, 'Thomas', 'Marie', 'marie.thomas@univ-lemans.fr', '$2y$10$cHbqWqPstsuiD0Nut.yec.z3owSprBdjpZkqHtwsYx89vPqgnz19G', 4, 2);

-- Chefs de département
INSERT INTO `utilisateur` (`Id_utilisateur`, `Nom_utilisateur`, `Prenom_utilisateur`, `Mail_utilisateur`, `Password_utilisateur`, `Id_departement`, `Id_role`) VALUES
(26, 'Roux', 'Philippe', 'philippe.roux@univ-lemans.fr', '$2y$10$FnJMoTdBfk5bk.7AQ4G2lOhmqh5WtVObGUAKru.lEKF0Ya/nxNrfa', 1, 3),
(27, 'Fournier', 'Isabelle', 'isabelle.fournier@univ-lemans.fr', '$2y$10$9UG/LO///nxI.BTPoND0ku4VrZskqYSjyFWdjJ63YnirFgSgRwcGy', 2, 3),
(28, 'Girard', 'Marc', 'marc.girard@univ-lemans.fr', '$2y$10$DSV9udE7xHuBdaHaz8dWL.US07.b0nS8Xyq.FeiAkumNcpAEPQ1U6', 3, 3),
(29, 'Morel', 'Christine', 'christine.morel@univ-lemans.fr', '$2y$10$/SqftTDo/1qMki6HoK08heHrHsTxSK/JZNOWf087uvfvJj39agfCq', 4, 3),
(30, 'Fontaine', 'Paul', 'paul.fontaine@univ-lemans.fr', '$2y$10$P5BIRKcRj6LpZjZLFaX/xOmcZBjn9L.wK9/lZ7QSAGPBRBx0c.W6S', 5, 3),
(31, 'Chevalier', 'Valerie', 'valerie.chevalier@univ-lemans.fr', '$2y$10$irbY9yiwAlVufgoSAV.uGufVm6eBRwxPkS14Xy5.KM2RN.2VusXqa', 6, 3),
(32, 'Gautier', 'Jacques', 'jacques.gautier@univ-lemans.fr', '$2y$10$bUBQbjuu6KzfzuwxGhFq4.ed.oTsqi7mPfKezra3xmVTevKWbt64C', 7, 3),
(33, 'Perrin', 'Sylvie', 'sylvie.perrin@univ-lemans.fr', '$2y$10$Zkevu6fknHPUx7Hnjy/rgehVnTWJU5.TBnHhcYNkSX6rJS2uymkOW', 8, 3),
(34, 'Robin', 'Daniel', 'daniel.robin@univ-lemans.fr', '$2y$10$kwAjXnKtuec5XLGmxfNOEu2Z22RQvrfng3HXbNIzBCWwqTepgtkpW', 9, 3),
(35, 'Clement', 'Nathalie', 'nathalie.clement@univ-lemans.fr', '$2y$10$0aG42LQclggZ6BBy1RePSe4ZEMmq7KiKEAUuV5b.KZJxGsgkW9weG', 10, 3);
-- 9. INSERTION DES OBJETS 
INSERT INTO OBJET (Nom_objet, Desc_objet, Id_utilisateur, Id_categorie_objet, Id_point_collecte, Id_statut, Date_de_publication) VALUES
('Livre Java avance', 'Livre de programmation Java en bon etat', 1, 1, 1, 2, '2025-10-15'),
('Chaise de bureau', 'Chaise pivotante noire', 2, 3, 2, 1, '2025-11-15'),
('Calculatrice scientifique', 'TI-84 Plus en parfait etat', 3, 4, 1, 2, '2025-09-17'),
('Manuel de biologie', 'Manuel de biologie cellulaire 3e edition', 4, 1, 3, 1, '2025-10-10'),
('Cable HDMI', 'Cable HDMI 2m', 1, 2, 1, 1, '2025-10-15'),
('Lampe de bureau', 'Lampe LED reglable', 5, 3, 2, 1, '2025-10-15'),
('Ecran 24 pouces', 'Ecran Dell 24 pouces Full HD', 16, 2, 4, 2, '2025-09-15'),
('Lot de stylos', 'Lot de 20 stylos bille bleus', 17, 4, 4, 1, '2025-11-23'),
('Livres mathematiques', 'Collection de 5 livres de mathematiques', 17, 1, 2, 2, '2025-09-10'),
('Classeurs vides', 'Lot de 10 classeurs A4', 19, 4, 3, 1, '2025-11-11'),
('Ordinateur portable', 'HP Pavilion i5, 8Go RAM', 26, 2, 4, 1, '2025-10-11'),
('Bureau en bois', 'Bureau 120x60 cm en bon etat', 27, 3, 2, 1, '2025-10-13'),
('Raquette de tennis', 'Raquette Wilson Pro Staff', 6, 5, 5, 1, '2025-11-05'),
('Dictionnaire anglais', 'Oxford Advanced Learner Dictionary', 7, 1, 2, 2, '2025-09-16'),
('Clavier sans fil', 'Clavier Logitech K380', 8, 2, 1, 2, '2025-09-12'),
('Etagere murale', 'Etagere blanche 80cm', 9, 3, 6, 1, '2025-11-08'),
('Microscope', 'Microscope optique Leica', 18, 9, 6, 2, '2025-09-29'),
('Guitare acoustique', 'Guitare Yamaha F310', 10, 10, 7, 1, '2025-10-28'),
('Imprimante', 'Imprimante HP DeskJet 2630', 11, 2, 9, 2, '2025-09-27'),
('Tableau blanc', 'Tableau blanc 120x90 cm avec support', 20, 8, 4, 2, '2025-09-26'),
('Sac a dos', 'Sac a dos Eastpak noir', 12, 7, 8, 2, '2025-09-25'),
('Cafetiere', 'Cafetiere Senseo', 13, 6, 3, 2, '2025-09-24'),
('Plantes vertes', 'Lot de 3 plantes en pot', 14, 8, 9, 3, '2025-10-23'),
('Balance de laboratoire', 'Balance precision Sartorius', 21, 9, 6, 2, '2025-09-22'),
('Livres de droit', 'Collection Code Civil et annexes', 15, 1, 2, 1, '2025-10-21');

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
INSERT INTO `EVENEMENT` (`Id_evenement`, `Nom_evenement`, `Localisation_evenement`, `Date_evenement`, `Id_categorie_evenement`, `Id_utilisateur`, `Description`) VALUES
(1, 'Atelier tri selectif', 'Amphi A - Le Mans', '2026-11-05', 1, 16, 'Atelier sur le tri sélectif et bonnes pratiques éco-responsables.'),
(2, 'Collecte de materiel informatique', 'Hall principal - Le Mans', '2026-11-12', 2, 17, 'Collecte de matériels informatiques usagés pour recyclage.'),
(3, 'Sensibilisation zero dechet', 'Salle B12 - Le Mans', '2026-11-20', 3, 18, 'Atelier de sensibilisation à la démarche zéro déchet.'),
(4, 'Journee du recyclage departement Info', 'Batiment A - Le Mans', '2026-11-25', 1, 26, 'Action de recyclage avec le département informatique.'),
(5, 'Grande collecte de livres', 'Bibliotheque - Le Mans', '2026-12-01', 2, 27, 'Collecte de livres pour donner une seconde vie aux ouvrages.'),
(6, 'Conference climat', 'Amphi Central - Laval', '2026-11-15', 5, 19, 'Conférence sur les enjeux climatiques actuels.'),
(7, 'Formation compostage', 'Jardin universitaire - Laval', '2026-11-18', 4, 20, 'Formation pratique au compostage sur site.'),
(8, 'Visite centre de tri', 'Hors campus - Laval', '2026-11-22', 6, 28, 'Visite guidée d’un centre de tri des déchets.'),
(9, 'Competition eco-gestes', 'Campus - Laval', '2026-12-05', 7, 21, 'Compétition d’éco-gestes avec remise de prix.'),
(10, 'Exposition recyclage artistique', 'Hall principal - Laval', '2026-12-10', 8, 29, 'Exposition d’œuvres réalisées à partir de matériaux recyclés.'),
(11, 'Nettoyage campus', 'Campus entier - Le Mans', '2026-11-28', 9, 22, 'Journée collective de nettoyage de l’ensemble du campus.'),
(12, 'Marche solidaire', 'Parking principal - Laval', '2026-12-15', 10, 30, 'Marche solidaire au profit d’une cause environnementale.');

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



