DROP VIEW IF EXISTS Vue_Objets_Disponibles;
DELIMITER //
CREATE VIEW Vue_Objets_Disponibles AS
SELECT
    Nom_objet,
    Desc_objet,
    Nom_categorie_objet,
    Nom_point_de_collecte,
    Localisation_point_de_collecte,
    Nom_utilisateur,
    Nom_statut   -- Ajouté Nom_statut ici
FROM OBJET
INNER JOIN CATEGORIE_OBJET
    ON CATEGORIE_OBJET.Id_categorie_objet = OBJET.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE
    ON POINT_DE_COLLECTE.Id_point_collecte = OBJET.Id_point_collecte
INNER JOIN STATUT
    ON STATUT.Id_statut = OBJET.Id_statut
INNER JOIN UTILISATEUR
    ON UTILISATEUR.Id_utilisateur = OBJET.Id_utilisateur
WHERE Nom_statut = 'Disponible';
//
DELIMITER ;

DROP VIEW IF EXISTS Vue_Evenement_A_Venir;
DELIMITER //
CREATE VIEW Vue_Evenement_A_Venir AS
SELECT
    Nom_evenement,
    Localisation_evenement,
    Date_evenement,
    Nom_categorie_evenement,
    Nom_utilisateur AS Nom_Organisateur
FROM EVENEMENT
INNER JOIN CATEGORIE_EVENEMENT
    ON CATEGORIE_EVENEMENT.Id_categorie_evenement = EVENEMENT.Id_categorie_evenement
INNER JOIN UTILISATEUR
    ON UTILISATEUR.Id_utilisateur = EVENEMENT.Id_utilisateur
WHERE Date_evenement > NOW();
//
DELIMITER ;

DROP VIEW IF EXISTS Vue_Objets_Disponibles;
DELIMITER //
CREATE VIEW Vue_Objets_Disponibles AS
SELECT
    Nom_objet,
    Desc_objet,
    Nom_categorie_objet,
    Nom_point_de_collecte,
    Localisation_point_de_collecte,
    Nom_utilisateur,
    Nom_statut,-- Ajouté Nom_statut ici
    Url_photo
FROM OBJET
INNER JOIN CATEGORIE_OBJET
    ON CATEGORIE_OBJET.Id_categorie_objet = OBJET.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE
    ON POINT_DE_COLLECTE.Id_point_collecte = OBJET.Id_point_collecte
INNER JOIN STATUT
    ON STATUT.Id_statut = OBJET.Id_statut
INNER JOIN UTILISATEUR
    ON UTILISATEUR.Id_utilisateur = OBJET.Id_utilisateur
INNER JOIN photo
	ON photo.Id_objet = objet.Id_objet
WHERE Nom_statut = 'Disponible';
//
DELIMITER ;


-- Voir les objets disponibles
SELECT * FROM Vue_Objets_Disponibles;


DROP VIEW IF EXISTS Vue_Evenement_Passé;
DELIMITER //
CREATE VIEW Vue_Evenement_Passé AS
SELECT
    Nom_evenement,
    Localisation_evenement,
    Date_evenement,
    Nom_categorie_evenement,
    Nom_utilisateur AS Nom_Organisateur
FROM EVENEMENT
INNER JOIN CATEGORIE_EVENEMENT
    ON CATEGORIE_EVENEMENT.Id_categorie_evenement = EVENEMENT.Id_categorie_evenement
INNER JOIN UTILISATEUR
    ON UTILISATEUR.Id_utilisateur = EVENEMENT.Id_utilisateur
WHERE Date_evenement < NOW();
//
DELIMITER ;

SELECT * FROM Vue_Evenement_Passé;



DROP VIEW IF EXISTS Vue_ObjetComplet;
DELIMITER //
CREATE VIEW Vue_ObjetComplet AS
SELECT 
    o.Id_objet,
    o.Id_utilisateur,
    o.Id_statut,
    o.Nom_objet,
    c.Nom_categorie_objet,
    s.Nom_statut
FROM OBJET o
JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
JOIN STATUT s ON o.Id_statut = s.Id_statut;
//
DELIMITER ;

DROP VIEW IF EXISTS Vue_Id_ObjetDepartement;
DELIMITER //
CREATE VIEW Vue_Id_ObjetDepartement AS
SELECT 
    o.Id_objet,
    o.Id_utilisateur,
    u.Id_departement,
    o.Id_statut
FROM OBJET o
JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur;
//
DELIMITER ;

DROP VIEW IF EXISTS Vue_Statistiques_Departement;
DELIMITER //
CREATE VIEW Vue_Statistiques_Departement AS
SELECT 
    u.Id_departement,
    c.Nom_categorie_objet,
    COUNT(DISTINCT o.Id_objet) AS Nb_objets,
    COUNT(r.Id_reservation) AS Nb_reservations
FROM UTILISATEUR u
JOIN OBJET o ON u.Id_utilisateur = o.Id_utilisateur
JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
LEFT JOIN RESERVATION r ON o.Id_objet = r.Id_objet
GROUP BY u.Id_departement, c.Nom_categorie_objet;
//
DELIMITER ;

DROP VIEW IF EXISTS Vue_Objet_Departement;
DELIMITER //
CREATE VIEW Vue_Objet_Departement AS
SELECT 
    Objet.Id_objet,
    Objet.Nom_objet,
    Objet.Desc_objet,
    Categorie.Nom_categorie_objet,
    Statut.Nom_statut,
    Utilisateur.Nom_utilisateur,
    Utilisateur.Prenom_utilisateur,
    PointCollecte.Nom_point_de_collecte,
    PointCollecte.Localisation_point_de_collecte,
    Utilisateur.Id_departement
FROM OBJET AS Objet
JOIN CATEGORIE_OBJET AS Categorie ON Objet.Id_categorie_objet = Categorie.Id_categorie_objet
JOIN STATUT AS Statut ON Objet.Id_statut = Statut.Id_statut
JOIN UTILISATEUR AS Utilisateur ON Objet.Id_utilisateur = Utilisateur.Id_utilisateur
JOIN POINT_DE_COLLECTE AS PointCollecte ON Objet.Id_point_collecte = PointCollecte.Id_point_collecte;
//
DELIMITER ;