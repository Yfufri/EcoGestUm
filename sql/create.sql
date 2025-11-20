--
-- Base de données : `SAE3`
--
-- --------------------------------------------------------
--
-- Structure de la table `CATEGORIE_EVENEMENT`
--
CREATE TABLE
  `CATEGORIE_EVENEMENT` (
    `Id_categorie_evenement` int NOT NULL,
    `Nom_categorie_evenement` varchar(255) DEFAULT NULL,
    `Desc_categorie_evenement` varchar(500) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `CATEGORIE_OBJET`
--
CREATE TABLE
  `CATEGORIE_OBJET` (
    `Id_categorie_objet` int NOT NULL,
    `Nom_categorie_objet` varchar(255) DEFAULT NULL,
    `Desc_categorie_objet` varchar(500) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `COMPOSANTE`
--
CREATE TABLE
  `COMPOSANTE` (
    `Id_composante` int NOT NULL,
    `Nom_composante` varchar(255) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `DEPARTEMENT`
--
CREATE TABLE
  `DEPARTEMENT` (
    `Id_departement` int NOT NULL,
    `Nom_departement` varchar(255) DEFAULT NULL,
    `Id_composante` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `EVENEMENT`
--
CREATE TABLE
  `EVENEMENT` (
    `Id_evenement` int NOT NULL,
    `Nom_evenement` varchar(255) DEFAULT NULL,
    `Localisation_evenement` varchar(255) DEFAULT NULL,
    `Date_evenement` date DEFAULT NULL,
    `Id_categorie_evenement` int NOT NULL,
    `Id_utilisateur` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `INSCRIPTION`
--
CREATE TABLE
  `INSCRIPTION` (
    `Id_inscription` int NOT NULL,
    `Id_utilisateur` int NOT NULL,
    `Id_evenement` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `OBJET`
--
CREATE TABLE
  `OBJET` (
    `Id_objet` int NOT NULL,
    `Nom_objet` varchar(255) DEFAULT NULL,
    `Desc_objet` varchar(500) DEFAULT NULL,
    `Id_utilisateur` int NOT NULL,
    `Id_categorie_objet` int NOT NULL,
    `Id_point_collecte` int NOT NULL,
    `Id_statut` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `PHOTO`
--
CREATE TABLE
  `PHOTO` (
    `Id_photo` int NOT NULL,
    `Url_photo` varchar(255) DEFAULT NULL,
    `Id_objet` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `POINT_DE_COLLECTE`
--
CREATE TABLE
  `POINT_DE_COLLECTE` (
    `Id_point_collecte` int NOT NULL,
    `Nom_point_de_collecte` varchar(255) DEFAULT NULL,
    `Desc_point_de_collecte` varchar(500) DEFAULT NULL,
    `Localisation_point_de_collecte` varchar(255) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `RESERVATION`
--
CREATE TABLE
  `RESERVATION` (
    `Id_reservation` int NOT NULL,
    `Date_reservation` date DEFAULT NULL,
    `Id_utilisateur` int NOT NULL,
    `Id_objet` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `ROLE`
--
CREATE TABLE
  `ROLE` (
    `Id_role` int NOT NULL,
    `Nom_role` varchar(255) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `SIGNALEMENT`
--
CREATE TABLE
  `SIGNALEMENT` (
    `Id_signalement` int NOT NULL,
    `Motif_signalement` varchar(500) DEFAULT NULL,
    `Date_signalement` date DEFAULT NULL,
    `Id_objet` int NOT NULL,
    `Id_utilisateur` int NOT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `STATUT`
--
CREATE TABLE
  `STATUT` (
    `Id_statut` int NOT NULL,
    `Nom_statut` varchar(255) DEFAULT NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `UTILISATEUR`
--
CREATE TABLE
  `UTILISATEUR` (
    `Id_utilisateur` int NOT NULL,
    `Nom_utilisateur` varchar(255) DEFAULT NULL,
    `Prenom_utilisateur` varchar(255) DEFAULT NULL,
    `Mail_utilisateur` varchar(255) DEFAULT NULL,
    `Id_departement` int NOT NULL,
    `Id_role` int NOT NULL
  );

--
-- Index pour les tables déchargées
--
--
-- Index pour la table `CATEGORIE_EVENEMENT`
--
ALTER TABLE `CATEGORIE_EVENEMENT` ADD PRIMARY KEY (`Id_categorie_evenement`);

--
-- Index pour la table `CATEGORIE_OBJET`
--
ALTER TABLE `CATEGORIE_OBJET` ADD PRIMARY KEY (`Id_categorie_objet`);

--
-- Index pour la table `COMPOSANTE`
--
ALTER TABLE `COMPOSANTE` ADD PRIMARY KEY (`Id_composante`);

--
-- Index pour la table `DEPARTEMENT`
--
ALTER TABLE `DEPARTEMENT` ADD PRIMARY KEY (`Id_departement`),
ADD KEY `fk_departement_composante` (`Id_composante`);

--
-- Index pour la table `EVENEMENT`
--
ALTER TABLE `EVENEMENT` ADD PRIMARY KEY (`Id_evenement`),
ADD KEY `fk_evenement_categorie` (`Id_categorie_evenement`),
ADD KEY `fk_evenement_utilisateur` (`Id_utilisateur`);

--
-- Index pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION` ADD PRIMARY KEY (`Id_inscription`),
ADD KEY `fk_inscription_utilisateur` (`Id_utilisateur`),
ADD KEY `fk_inscription_evenement` (`Id_evenement`);

--
-- Index pour la table `OBJET`
--
ALTER TABLE `OBJET` ADD PRIMARY KEY (`Id_objet`),
ADD KEY `fk_objet_utilisateur` (`Id_utilisateur`),
ADD KEY `fk_objet_categorie_objet` (`Id_categorie_objet`),
ADD KEY `fk_objet_point_collecte` (`Id_point_collecte`),
ADD KEY `fk_objet_statut` (`Id_statut`);

--
-- Index pour la table `PHOTO`
--
ALTER TABLE `PHOTO` ADD PRIMARY KEY (`Id_photo`),
ADD KEY `fk_photo_objet` (`Id_objet`);

--
-- Index pour la table `POINT_DE_COLLECTE`
--
ALTER TABLE `POINT_DE_COLLECTE` ADD PRIMARY KEY (`Id_point_collecte`);

--
-- Index pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION` ADD PRIMARY KEY (`Id_reservation`),
ADD KEY `fk_reservation_utilisateur` (`Id_utilisateur`),
ADD KEY `fk_reservation_objet` (`Id_objet`);

--
-- Index pour la table `ROLE`
--
ALTER TABLE `ROLE` ADD PRIMARY KEY (`Id_role`);

--
-- Index pour la table `SIGNALEMENT`
--
ALTER TABLE `SIGNALEMENT` ADD PRIMARY KEY (`Id_signalement`),
ADD KEY `fk_signalement_objet` (`Id_objet`),
ADD KEY `fk_signalement_utilisateur` (`Id_utilisateur`);

--
-- Index pour la table `STATUT`
--
ALTER TABLE `STATUT` ADD PRIMARY KEY (`Id_statut`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR` ADD PRIMARY KEY (`Id_utilisateur`),
ADD KEY `fk_utilisateur_departement` (`Id_departement`),
ADD KEY `fk_utilisateur_role` (`Id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `CATEGORIE_EVENEMENT`
--
ALTER TABLE `CATEGORIE_EVENEMENT` MODIFY `Id_categorie_evenement` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CATEGORIE_OBJET`
--
ALTER TABLE `CATEGORIE_OBJET` MODIFY `Id_categorie_objet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `COMPOSANTE`
--
ALTER TABLE `COMPOSANTE` MODIFY `Id_composante` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DEPARTEMENT`
--
ALTER TABLE `DEPARTEMENT` MODIFY `Id_departement` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `EVENEMENT`
--
ALTER TABLE `EVENEMENT` MODIFY `Id_evenement` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION` MODIFY `Id_inscription` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `OBJET`
--
ALTER TABLE `OBJET` MODIFY `Id_objet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `PHOTO`
--
ALTER TABLE `PHOTO` MODIFY `Id_photo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `POINT_DE_COLLECTE`
--
ALTER TABLE `POINT_DE_COLLECTE` MODIFY `Id_point_collecte` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION` MODIFY `Id_reservation` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ROLE`
--
ALTER TABLE `ROLE` MODIFY `Id_role` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `SIGNALEMENT`
--
ALTER TABLE `SIGNALEMENT` MODIFY `Id_signalement` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `STATUT`
--
ALTER TABLE `STATUT` MODIFY `Id_statut` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR` MODIFY `Id_utilisateur` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `DEPARTEMENT`
--
ALTER TABLE `DEPARTEMENT` ADD CONSTRAINT `fk_departement_composante` FOREIGN KEY (`Id_composante`) REFERENCES `COMPOSANTE` (`Id_composante`);

--
-- Contraintes pour la table `EVENEMENT`
--
ALTER TABLE `EVENEMENT` ADD CONSTRAINT `fk_evenement_categorie` FOREIGN KEY (`Id_categorie_evenement`) REFERENCES `CATEGORIE_EVENEMENT` (`Id_categorie_evenement`),
ADD CONSTRAINT `fk_evenement_utilisateur` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

--
-- Contraintes pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION` ADD CONSTRAINT `fk_inscription_evenement` FOREIGN KEY (`Id_evenement`) REFERENCES `EVENEMENT` (`Id_evenement`),
ADD CONSTRAINT `fk_inscription_utilisateur` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

--
-- Contraintes pour la table `OBJET`
--
ALTER TABLE `OBJET` ADD CONSTRAINT `fk_objet_categorie_objet` FOREIGN KEY (`Id_categorie_objet`) REFERENCES `CATEGORIE_OBJET` (`Id_categorie_objet`),
ADD CONSTRAINT `fk_objet_point_collecte` FOREIGN KEY (`Id_point_collecte`) REFERENCES `POINT_DE_COLLECTE` (`Id_point_collecte`),
ADD CONSTRAINT `fk_objet_statut` FOREIGN KEY (`Id_statut`) REFERENCES `STATUT` (`Id_statut`),
ADD CONSTRAINT `fk_objet_utilisateur` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

--
-- Contraintes pour la table `PHOTO`
--
ALTER TABLE `PHOTO` ADD CONSTRAINT `fk_photo_objet` FOREIGN KEY (`Id_objet`) REFERENCES `OBJET` (`Id_objet`);

--
-- Contraintes pour la table `RESERVATION`
--
ALTER TABLE `RESERVATION` ADD CONSTRAINT `fk_reservation_objet` FOREIGN KEY (`Id_objet`) REFERENCES `OBJET` (`Id_objet`),
ADD CONSTRAINT `fk_reservation_utilisateur` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

--
-- Contraintes pour la table `SIGNALEMENT`
--
ALTER TABLE `SIGNALEMENT` ADD CONSTRAINT `fk_signalement_objet` FOREIGN KEY (`Id_objet`) REFERENCES `OBJET` (`Id_objet`),
ADD CONSTRAINT `fk_signalement_utilisateur` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

--
-- Contraintes pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR` ADD CONSTRAINT `fk_utilisateur_departement` FOREIGN KEY (`Id_departement`) REFERENCES `DEPARTEMENT` (`Id_departement`),
ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY (`Id_role`) REFERENCES `ROLE` (`Id_role`);

COMMIT;

-- Modifications pour le web 
ALTER TABLE `EVENEMENT`
ADD COLUMN `Description` varchar(255) DEFAULT NULL;

CREATE TABLE
  `IMAGE_EVENEMENT` (
    `Id_Image` int NOT NULL,
    `Url_image` varchar(255) DEFAULT NULL,
    `Id_evenement` int NOT NULL
  );

ALTER TABLE `Image_Evenement` ADD PRIMARY KEY (`Id_Image`),
ADD KEY `fk_evenement_objet` (`Id_evenement`);

CREATE TABLE `CONNEXION` (
  `Identifiant` varchar(25) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL,
  `Id_utilisateur` int NOT NULL
);

ALTER TABLE `CONNEXION`
  ADD PRIMARY KEY (`Identifiant`),
  ADD KEY `fk_utilisateur_connexion` (`Id_utilisateur`),
  ADD CONSTRAINT `fk_utilisateur_connexion` FOREIGN KEY (`Id_utilisateur`) REFERENCES `UTILISATEUR` (`Id_utilisateur`);

