-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 21 juin 2018 à 09:57
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `a_id` int(11) NOT NULL,
  `a_nom` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`a_id`, `a_nom`) VALUES
(1, 'Noir et blanc'),
(2, 'Portrait'),
(20, 'Panorama'),
(21, 'Paysages enneigés'),
(22, 'Nature'),
(24, 'Animaux');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `p_id` int(11) NOT NULL,
  `p_description` longtext,
  `p_title` varchar(25) DEFAULT NULL,
  `p_url` varchar(250) DEFAULT NULL,
  `a_id_fk` int(11) DEFAULT NULL,
  `u_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`p_id`, `p_description`, `p_title`, `p_url`, `a_id_fk`, `u_id_fk`) VALUES
(1, 'Photos prise au mus&eacute;e de Bourges', 'Visages de pierre', 'assets\\images\\tetes.jpg', 1, 2),
(22, 'Photo prise au bord de l\'eau, lors d\'un couch&eacute; de soleil', 'Couch&eacute; de soleil ', '.\\assets\\images\\94050.jpg', 22, NULL),
(23, 'Portrait pris en ext&eacute;rieur', 'Portait de femme', '.\\assets\\images\\59194.jpg', 2, NULL),
(24, 'Paysage enneig&eacute; avec vue sur les montagnes et couch&eacute; de soleil', 'Vue sur les montagnes', '.\\assets\\images\\32423.jpg', 21, 2),
(26, 'Photo prise dans la savane', 'Lion dans la savane', '.\\assets\\images\\61767.jpg', 24, NULL),
(35, 'A la D&eacute;fense, s&eacute;ance photo en noir et blanc', 'Buildings', '.\\assets\\images\\7687.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

CREATE TABLE `rang` (
  `r_id` int(11) NOT NULL,
  `r_label` varchar(25) DEFAULT NULL,
  `r_pouvoir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rang`
--

INSERT INTO `rang` (`r_id`, `r_label`, `r_pouvoir`) VALUES
(1, 'SuperAdmin', 3);

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `s_id` int(10) NOT NULL,
  `s_title` varchar(300) DEFAULT NULL,
  `s_main` longtext,
  `u_id_fk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`s_id`, `s_title`, `s_main`, `u_id_fk`) VALUES
(5, 'Lorem ipsum dolor sit amet !', 'Et interdum acciderat, ut siquid in penetrali secreto nullo citerioris vitae ministro praesente paterfamilias uxori susurrasset in aurem, velut Amphiarao referente aut Marcio, quondam vatibus inclitis, postridie disceret imperator. ideoque etiam parietes arcanorum soli conscii timebantur.\r\n\r\nEodem tempore Serenianus ex duce, cuius ignavia populatam in Phoenice Celsen ante rettulimus, pulsatae maiestatis imperii reus iure postulatus ac lege, incertum qua potuit suffragatione absolvi, aperte convictus familiarem suum cum pileo, quo caput operiebat, incantato vetitis artibus ad templum misisse fatidicum, quaeritatum expresse an ei firmum portenderetur imperium, ut cupiebat, et cunctum.\r\n\r\nEt licet quocumque oculos flexeris feminas adfatim multas spectare cirratas, quibus, si nupsissent, per aetatem ter iam nixus poterat suppetere liberorum, ad usque taedium pedibus pavimenta tergentes iactari volucriter gyris, dum exprimunt innumera simulacra, quae finxere fabulae theatrales.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `u_id` int(11) NOT NULL,
  `u_prenom` varchar(25) DEFAULT NULL,
  `u_nom` varchar(25) DEFAULT NULL,
  `u_pseudo` varchar(25) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_mail` varchar(150) DEFAULT NULL,
  `u_tempPwd` varchar(300) DEFAULT NULL,
  `r_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`u_id`, `u_prenom`, `u_nom`, `u_pseudo`, `u_password`, `u_mail`, `u_tempPwd`, `r_id_fk`) VALUES
(2, 'amandine', 'di bernardo', 'ornellaa', '$2y$10$s2Ireb.d0kuuBJI2UC9J2u6PgSiW2an03H4WhKICAfbiYsPorTvMC', 'amandine.dib@live.fr', '4b5752a3ed', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`a_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `FK_photo_a_id` (`a_id_fk`),
  ADD KEY `FK_photo_u_id` (`u_id_fk`);

--
-- Index pour la table `rang`
--
ALTER TABLE `rang`
  ADD PRIMARY KEY (`r_id`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `u_id_fk` (`u_id_fk`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `FK_utilisateur_r_id` (`r_id_fk`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `rang`
--
ALTER TABLE `rang`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_photo_a_id` FOREIGN KEY (`a_id_fk`) REFERENCES `album` (`a_id`),
  ADD CONSTRAINT `FK_photo_u_id` FOREIGN KEY (`u_id_fk`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`u_id_fk`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_utilisateur_r_id` FOREIGN KEY (`r_id_fk`) REFERENCES `rang` (`r_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
