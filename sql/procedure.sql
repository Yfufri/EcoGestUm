DROP PROCEDURE IF EXISTS modifier_MonObjet;
DELIMITER //
CREATE PROCEDURE modifier_MonObjet(
    IN p_id_objet INT,
    IN p_id_utilisateur INT,
    IN p_nom_objet VARCHAR(100),
    IN p_desc_objet VARCHAR(500),
    IN p_id_categorie_objet INT
)
BEGIN
    DECLARE v_id_proprietaire INT;
    DECLARE v_statut INT;

    SELECT Id_utilisateur, Id_statut
    INTO v_id_proprietaire, v_statut
    FROM OBJET
    WHERE Id_objet = p_id_objet;

    IF v_id_proprietaire IS NULL THEN
        SELECT 'Erreur : Objet non trouvé.' AS Message;
    ELSEIF v_id_proprietaire <> p_id_utilisateur THEN
        SELECT 'Erreur : cet objet ne vous appartient pas.' AS Message;
    ELSEIF v_statut NOT IN (1,3) THEN
        SELECT 'Erreur : l objet ne peut pas être modifié (statut non autorisé).' AS Message;
    ELSEIF NOT EXISTS (SELECT 1 FROM CATEGORIE_OBJET WHERE Id_categorie_objet = p_id_categorie_objet) THEN
        SELECT 'Erreur : catégorie invalide.' AS Message;
    ELSE
        UPDATE OBJET
        SET Nom_objet = p_nom_objet,
            Desc_objet = p_desc_objet,
            Id_categorie_objet = p_id_categorie_objet
        WHERE Id_objet = p_id_objet;

        SELECT 
            OBJET.Id_objet,
            OBJET.Nom_objet,
            OBJET.Desc_objet,
            CATEGORIE_OBJET.Nom_categorie_objet AS Categorie,
            STATUT.Nom_statut AS Statut,
            CONCAT(UTILISATEUR.Nom_utilisateur, ' ', UTILISATEUR.Prenom_utilisateur) AS Proprietaire
        FROM OBJET
        JOIN CATEGORIE_OBJET ON OBJET.Id_categorie_objet = CATEGORIE_OBJET.Id_categorie_objet
        JOIN STATUT ON OBJET.Id_statut = STATUT.Id_statut
        JOIN UTILISATEUR ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
        WHERE OBJET.Id_utilisateur = p_id_utilisateur;
    END IF;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS filtrer_Objets_Disponibles;
DELIMITER //
CREATE PROCEDURE filtrer_Objets_Disponibles(
    IN categorie_Recherche VARCHAR(100),
    IN point_collecte_Recherche VARCHAR(100)
)
BEGIN
    SELECT
        Nom_objet,
        Desc_objet,
        Nom_categorie_objet,
        Nom_point_de_collecte,
        Nom_statut,
        Nom_utilisateur
    FROM Vue_Objets_Disponibles
    WHERE (categorie_Recherche IS NULL OR Nom_categorie_objet LIKE categorie_Recherche)
      AND (point_collecte_Recherche IS NULL OR Nom_point_de_collecte LIKE point_collecte_Recherche);
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS Procedure_Inventaire_Utilisateur;
DELIMITER //
CREATE PROCEDURE Procedure_Inventaire_Utilisateur(
    IN Id_Utilisateur INT
)
BEGIN
    SELECT
        Nom_objet,
        Desc_objet,
        Nom_categorie_objet,
        Nom_point_de_collecte,
        Nom_statut
    FROM UTILISATEUR
    RIGHT JOIN OBJET
        ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
    INNER JOIN CATEGORIE_OBJET
        ON CATEGORIE_OBJET.Id_categorie_objet = OBJET.Id_categorie_objet
    INNER JOIN POINT_DE_COLLECTE
        ON POINT_DE_COLLECTE.Id_point_collecte = OBJET.Id_point_collecte
    INNER JOIN STATUT
        ON STATUT.Id_statut = OBJET.Id_statut
    WHERE UTILISATEUR.Id_utilisateur = Id_Utilisateur;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS ReserverObjetAvecVue;
DELIMITER //
CREATE PROCEDURE ReserverObjetAvecVue (
    IN IdUtilisateur INT,
    IN IdObjet INT
)
BEGIN
    DECLARE IdStatutDisponible INT;
    DECLARE IdStatutReserve INT;

    SELECT Id_statut INTO IdStatutDisponible FROM STATUT WHERE Nom_statut = 'Disponible' LIMIT 1;
    SELECT Id_statut INTO IdStatutReserve FROM STATUT WHERE Nom_statut = 'Reserve' LIMIT 1;

    IF NOT EXISTS (
        SELECT 1 FROM Vue_ObjetComplet
        WHERE Id_objet = IdObjet
          AND Id_statut = IdStatutDisponible
    ) THEN
        SELECT 'Erreur : objet non disponible ou n’existe pas' AS Message;
    ELSE
        INSERT INTO RESERVATION (Date_reservation, Id_utilisateur, Id_objet)
        VALUES (NOW(), IdUtilisateur, IdObjet);

        UPDATE OBJET
        SET Id_statut = IdStatutReserve
        WHERE Id_objet = IdObjet;

        SELECT 'Réservation effectuée avec succès. L''objet est maintenant réservé.' AS Message;
    END IF;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS Chef_ValiderOuRefuserObjetAvecVue;
DELIMITER //
CREATE PROCEDURE Chef_ValiderOuRefuserObjetAvecVue (
   IN IdChef INT,
   IN IdObjet INT,
   IN Decision VARCHAR(10)
)
BEGIN
    DECLARE IdDepartement INT;
    DECLARE IdStatutDisponible INT;
    DECLARE IdStatutNonDisponible INT;
    DECLARE IdStatutAttente INT;
    DECLARE nb INT;

    SELECT Id_departement INTO IdDepartement FROM UTILISATEUR WHERE Id_utilisateur = IdChef;

    SELECT Id_statut INTO IdStatutDisponible FROM STATUT WHERE Nom_statut = 'Disponible' LIMIT 1;
    SELECT Id_statut INTO IdStatutNonDisponible FROM STATUT WHERE Nom_statut = 'Non Disponible' LIMIT 1;
    SELECT Id_statut INTO IdStatutAttente FROM STATUT WHERE Nom_statut = 'En attente validation' LIMIT 1;

    SELECT COUNT(*) INTO nb FROM Vue_Id_ObjetDepartement
    WHERE Id_objet = IdObjet
      AND Id_statut = IdStatutAttente
      AND Id_departement = IdDepartement;

    IF nb = 0 THEN
        SELECT 'Erreur : Objet non valide ou n''appartient pas à votre département.' AS Message;
    ELSE
        IF Decision = 'Valider' THEN
            UPDATE OBJET SET Id_statut = IdStatutDisponible WHERE Id_objet = IdObjet;
            SELECT 'Objet validé avec succès.' AS Message;
        ELSEIF Decision = 'Refuser' THEN
            UPDATE OBJET SET Id_statut = IdStatutNonDisponible WHERE Id_objet = IdObjet;
            SELECT 'Objet refusé.' AS Message;
        ELSE
            SELECT 'Erreur : Décision invalide. Utilisez "Valider" ou "Refuser".' AS Message;
        END IF;
    END IF;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS CalculeStatsParDepartement;
DELIMITER //
CREATE PROCEDURE CalculeStatsParDepartement (
   IN IdChef INT
)
BEGIN
    DECLARE IdDepartement INT;
    SELECT Id_departement INTO IdDepartement FROM UTILISATEUR WHERE Id_utilisateur = IdChef;

    SELECT 
        s.Nom_categorie_objet,
        s.Nb_objets,
        s.Nb_reservations
    FROM Vue_Statistiques_Departement s
    WHERE s.Id_departement = IdDepartement
    ORDER BY s.Nom_categorie_objet;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS Procedure_Liste_Objet_Departement;
DELIMITER //
CREATE PROCEDURE Procedure_Liste_Objet_Departement (
    IN Id_Departement INT
)
BEGIN
    SELECT Nom_objet, Desc_objet, Nom_categorie_objet, Nom_statut, Nom_utilisateur, Prenom_utilisateur        
    FROM UTILISATEUR
    INNER JOIN OBJET ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
    INNER JOIN CATEGORIE_OBJET ON CATEGORIE_OBJET.Id_categorie_objet = OBJET.Id_categorie_objet
    INNER JOIN STATUT ON STATUT.Id_statut = OBJET.Id_statut
    WHERE UTILISATEUR.Id_departement = Id_Departement;
END;
//
DELIMITER ;
