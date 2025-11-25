CREATE TABLE CATEGORIE_EVENEMENT (
Id_categorie_evenement INT NOT NULL AUTO_INCREMENT,
Nom_categorie_evenement VARCHAR(255) DEFAULT NULL,
Desc_categorie_evenement VARCHAR(500) DEFAULT NULL,
PRIMARY KEY (Id_categorie_evenement)
);

CREATE TABLE CATEGORIE_OBJET (
Id_categorie_objet INT NOT NULL AUTO_INCREMENT,
Nom_categorie_objet VARCHAR(255) DEFAULT NULL,
Desc_categorie_objet VARCHAR(500) DEFAULT NULL,
PRIMARY KEY (Id_categorie_objet)
);

CREATE TABLE COMPOSANTE (
Id_composante INT NOT NULL AUTO_INCREMENT,
Nom_composante VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (Id_composante)
);

CREATE TABLE POINT_DE_COLLECTE (
Id_point_collecte INT NOT NULL AUTO_INCREMENT,
Nom_point_de_collecte VARCHAR(255) DEFAULT NULL,
Desc_point_de_collecte VARCHAR(500) DEFAULT NULL,
Localisation_point_de_collecte VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (Id_point_collecte)
);

CREATE TABLE ROLE (
Id_role INT NOT NULL AUTO_INCREMENT,
Nom_role VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (Id_role)
);

CREATE TABLE STATUT (
Id_statut INT NOT NULL AUTO_INCREMENT,
Nom_statut VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (Id_statut)
);

CREATE TABLE DEPARTEMENT (
Id_departement INT NOT NULL AUTO_INCREMENT,
Nom_departement VARCHAR(255) DEFAULT NULL,
Id_composante INT NOT NULL,
PRIMARY KEY (Id_departement),
KEY fk_departement_composante (Id_composante),
CONSTRAINT fk_departement_composante FOREIGN KEY (Id_composante) REFERENCES COMPOSANTE (Id_composante)
);

CREATE TABLE UTILISATEUR (
Id_utilisateur INT NOT NULL AUTO_INCREMENT,
Nom_utilisateur VARCHAR(255) DEFAULT NULL,
Prenom_utilisateur VARCHAR(255) DEFAULT NULL,
Mail_utilisateur VARCHAR(255) DEFAULT NULL,
Password_utilisateur VARCHAR(255) DEFAULT NULL,
Id_departement INT NOT NULL,
Id_role INT NOT NULL,
PRIMARY KEY (Id_utilisateur),
KEY fk_utilisateur_departement (Id_departement),
KEY fk_utilisateur_role (Id_role),
CONSTRAINT fk_utilisateur_departement FOREIGN KEY (Id_departement) REFERENCES DEPARTEMENT (Id_departement),
CONSTRAINT fk_utilisateur_role FOREIGN KEY (Id_role) REFERENCES ROLE (Id_role)
);

CREATE TABLE EVENEMENT (
Id_evenement INT NOT NULL AUTO_INCREMENT,
Nom_evenement VARCHAR(255) DEFAULT NULL,
Localisation_evenement VARCHAR(255) DEFAULT NULL,
Date_evenement DATE DEFAULT NULL,
Id_categorie_evenement INT NOT NULL,
Id_utilisateur INT NOT NULL,
Description VARCHAR(255) DEFAULT NULL,
PRIMARY KEY (Id_evenement),
KEY fk_evenement_categorie (Id_categorie_evenement),
KEY fk_evenement_utilisateur (Id_utilisateur),
CONSTRAINT fk_evenement_categorie FOREIGN KEY (Id_categorie_evenement) REFERENCES CATEGORIE_EVENEMENT (Id_categorie_evenement),
CONSTRAINT fk_evenement_utilisateur FOREIGN KEY (Id_utilisateur) REFERENCES UTILISATEUR (Id_utilisateur)
);

CREATE TABLE INSCRIPTION (
Id_inscription INT NOT NULL AUTO_INCREMENT,
Id_utilisateur INT NOT NULL,
Id_evenement INT NOT NULL,
PRIMARY KEY (Id_inscription),
KEY fk_inscription_utilisateur (Id_utilisateur),
KEY fk_inscription_evenement (Id_evenement),
CONSTRAINT fk_inscription_evenement FOREIGN KEY (Id_evenement) REFERENCES EVENEMENT (Id_evenement),
CONSTRAINT fk_inscription_utilisateur FOREIGN KEY (Id_utilisateur) REFERENCES UTILISATEUR (Id_utilisateur)
);

CREATE TABLE OBJET (
Id_objet INT NOT NULL AUTO_INCREMENT,
Nom_objet VARCHAR(255) DEFAULT NULL,
Desc_objet VARCHAR(500) DEFAULT NULL,
Id_utilisateur INT NOT NULL,
Id_categorie_objet INT NOT NULL,
Id_point_collecte INT NOT NULL,
Id_statut INT NOT NULL,
Date_de_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (Id_objet),
KEY fk_objet_utilisateur (Id_utilisateur),
KEY fk_objet_categorie_objet (Id_categorie_objet),
KEY fk_objet_point_collecte (Id_point_collecte),
KEY fk_objet_statut (Id_statut),
CONSTRAINT fk_objet_categorie_objet FOREIGN KEY (Id_categorie_objet) REFERENCES CATEGORIE_OBJET (Id_categorie_objet),
CONSTRAINT fk_objet_point_collecte FOREIGN KEY (Id_point_collecte) REFERENCES POINT_DE_COLLECTE (Id_point_collecte),
CONSTRAINT fk_objet_statut FOREIGN KEY (Id_statut) REFERENCES STATUT (Id_statut),
CONSTRAINT fk_objet_utilisateur FOREIGN KEY (Id_utilisateur) REFERENCES UTILISATEUR (Id_utilisateur)
);

CREATE TABLE PHOTO (
Id_photo INT NOT NULL AUTO_INCREMENT,
Url_photo VARCHAR(255) DEFAULT NULL,
Id_objet INT NOT NULL,
PRIMARY KEY (Id_photo),
KEY fk_photo_objet (Id_objet),
CONSTRAINT fk_photo_objet FOREIGN KEY (Id_objet) REFERENCES OBJET (Id_objet)
);

CREATE TABLE RESERVATION (
Id_reservation INT NOT NULL AUTO_INCREMENT,
Date_reservation DATE DEFAULT NULL,
Id_utilisateur INT NOT NULL,
Id_objet INT NOT NULL,
PRIMARY KEY (Id_reservation),
KEY fk_reservation_utilisateur (Id_utilisateur),
KEY fk_reservation_objet (Id_objet),
CONSTRAINT fk_reservation_objet FOREIGN KEY (Id_objet) REFERENCES OBJET (Id_objet),
CONSTRAINT fk_reservation_utilisateur FOREIGN KEY (Id_utilisateur) REFERENCES UTILISATEUR (Id_utilisateur)
);

CREATE TABLE SIGNALEMENT (
Id_signalement INT NOT NULL AUTO_INCREMENT,
Motif_signalement VARCHAR(500) DEFAULT NULL,
Date_signalement DATE DEFAULT NULL,
Id_objet INT NOT NULL,
Id_utilisateur INT NOT NULL,
PRIMARY KEY (Id_signalement),
KEY fk_signalement_objet (Id_objet),
KEY fk_signalement_utilisateur (Id_utilisateur),
CONSTRAINT fk_signalement_objet FOREIGN KEY (Id_objet) REFERENCES OBJET (Id_objet),
CONSTRAINT fk_signalement_utilisateur FOREIGN KEY (Id_utilisateur) REFERENCES UTILISATEUR (Id_utilisateur)
);

CREATE TABLE IMAGE_EVENEMENT (
Id_Image INT NOT NULL AUTO_INCREMENT,
Url_image VARCHAR(255) DEFAULT NULL,
Id_evenement INT NOT NULL,
PRIMARY KEY (Id_Image),
KEY fk_evenement_objet (Id_evenement),
CONSTRAINT fk_evenement_objet FOREIGN KEY (Id_evenement) REFERENCES EVENEMENT (Id_evenement)
);

CREATE TABLE IF NOT EXISTS INSCRIPTION_EXTERNE (
Id_inscription_externe INT AUTO_INCREMENT PRIMARY KEY,
Nom VARCHAR(100) NOT NULL,
Prenom VARCHAR(100) NOT NULL,
Email VARCHAR(255) NOT NULL,
Date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
Id_evenement INT NOT NULL,
FOREIGN KEY (Id_evenement) REFERENCES EVENEMENT(Id_evenement) ON DELETE CASCADE,
UNIQUE KEY unique_inscription (Email, Id_evenement)
);