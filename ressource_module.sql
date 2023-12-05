-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 22 mai 2020 à 06:59
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ressource_module`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`nom`, `prenom`, `email`, `password`, `id_admin`) VALUES 
('reguragui', 'abdelghani', 'abdelghanireguragui@gmail.com', 'mundiapolis', 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `af`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `af` (
`id_af` int(11)
,`nom_af` varchar(50)
,`id_filiere` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `annee_formation`
--

CREATE TABLE `annee_formation` (
  `id_af` int(11) NOT NULL,
  `nom_af` varchar(50) NOT NULL,
  `id_filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annee_formation`
--

INSERT INTO `annee_formation` (`id_af`, `nom_af`, `id_filiere`) VALUES
(75, 'Année 1 ', 59),
(76, 'Année 2', 59),
(84, 'Année 1', 70),
(85, 'Année 2', 70),
(86, 'Année 1', 71),
(87, 'Année 2', 71);

-- --------------------------------------------------------

--
-- Structure de la table `element_module`
--

CREATE TABLE `element_module` (
  `id_element_module` int(11) NOT NULL,
  `nom_element_module` varchar(50) NOT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `element_module`
--

INSERT INTO `element_module` (`id_element_module`, `nom_element_module`, `id_enseignant`, `id_module`) VALUES
(25, 'Element 1 Mod 1', 42, 26),
(26, 'Element 2 Mod 1', 43, 26),
(27, 'Element 3 Mod 1', 42, 26),
(28, 'Element 4 Mod 1', 43, 26),
(29, 'Element 1 Mod 2', 42, 27),
(30, 'Element 2 Mod 2', 43, 27);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `nom_enseignant` varchar(50) NOT NULL,
  `prenom_enseignant` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT 'mundiapolis'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `nom_enseignant`, `prenom_enseignant`, `email`, `password`) VALUES
(43, 'REGURAGUI', 'Abdelghani', 'abdelghanireguragui@gmail.com', 'mundiapolis');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `enseignants`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `enseignants` (
`id_enseignant` int(11)
,`nom_enseignant` varchar(50)
,`prenom_enseignant` varchar(50)
,`email` varchar(100)
,`password` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom_etudiant` varchar(50) NOT NULL,
  `prenom_etudiant` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT 'mundiapolis',
  `annee_formation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `email`, `password`, `annee_formation`) VALUES
(18, 'REG', 'Abdel', 'abdelghanireguragui@gmail.com', 'mundiapolis', 86);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `nom_filiere` varchar(50) NOT NULL,
  `id_enseignant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`, `id_enseignant`) VALUES
(70, 'Filiere 1', 42),
(71, 'Filiere 2', 43);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `fr`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `fr` (
`id_enseignant` int(11)
,`nom_enseignant` varchar(50)
,`prenom_enseignant` varchar(50)
,`email` varchar(100)
,`password` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id_module` int(11) NOT NULL,
  `nom_module` varchar(50) NOT NULL,
  `id_af` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id_module`, `nom_module`, `id_af`) VALUES
(11, 'de', 75),
(26, 'Module 1', 84),
(27, 'Module 2', 84);

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id_ressource` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `nom_fichier` varchar(100) NOT NULL,
  `chemin` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `nom_ressource` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id_ressource`, `id_section`, `nom_fichier`, `chemin`, `type`, `nom_ressource`, `description`) VALUES
(57, 31, 'deconf.png', '../contenu/Filiere 1/Année 1/Module 1/Element 1 Mod 1/Section 1/', 'image', 'Image 1', ' cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei cijed oiue odiez opeid poie dpoiez dpoiez dpoizeidop poei dpo ei'),
(58, 31, 'TP_chapitre5.pdf', '../contenu/Filiere 1/Année 1/Module 1/Element 1 Mod 1/Section 1/', 'autre', 'TP', 'khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"'),
(59, 31, 'small.mp4', '../contenu/Filiere 1/Année 1/Module 1/Element 1 Mod 1/Section 1/', 'video', 'Video de cours ', 'khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"khkéh oéiu ou oé\"iu eoé\"u eoiui uoiué eoiéuoie uoiéu\" eoiéu\" eoiu\"é eoi u\"éoieuoiue oi\"éu eoi\"éu oieu \"éoiue oi\"u eoié\"u eoiué oiu\"'),
(60, 32, 'Les piliers de motivation des employés - FINAL(1).pptx', '../contenu/Filiere 1/Année 1/Module 1/Element 3 Mod 1/Section 3/', 'autre', 'ressource 1', 'ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST ceci est UN TEST '),
(61, 32, 'Dialnet-TheoryOfConstraintsAndSixSigma-5680282.pdf', '../contenu/Filiere 1/Année 1/Module 1/Element 3 Mod 1/Section 3/', 'autre', 'cours de rien', 'ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  ceci est le cours pour devenir savant de la pensée volatile  '),
(62, 33, 'COURS_marketing_séance18032020.ppt', '../contenu/Filiere 1/Année 1/Module 2/Element 1 Mod 2/section qui sectionne /', 'autre', 'las plabras de Dios', 'volare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito aguavolare cantare por favor un poccito agua');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id_section` int(11) NOT NULL,
  `nom_section` varchar(50) NOT NULL,
  `id_element_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id_section`, `nom_section`, `id_element_module`) VALUES
(31, 'Section 1', 25),
(32, 'Section 3', 27),
(33, 'section qui sectionne ', 29);

-- --------------------------------------------------------

--
-- Structure de la vue `af`
--
DROP TABLE IF EXISTS `af`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `af`  AS  select `annee_formation`.`id_af` AS `id_af`,`annee_formation`.`nom_af` AS `nom_af`,`annee_formation`.`id_filiere` AS `id_filiere` from `annee_formation` ;

-- --------------------------------------------------------

--
-- Structure de la vue `enseignants`
--
DROP TABLE IF EXISTS `enseignants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `enseignants`  AS  select `enseignant`.`id_enseignant` AS `id_enseignant`,`enseignant`.`nom_enseignant` AS `nom_enseignant`,`enseignant`.`prenom_enseignant` AS `prenom_enseignant`,`enseignant`.`email` AS `email`,`enseignant`.`password` AS `password` from `enseignant` ;

-- --------------------------------------------------------

--
-- Structure de la vue `fr`
--
DROP TABLE IF EXISTS `fr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fr`  AS  select `enseignant`.`id_enseignant` AS `id_enseignant`,`enseignant`.`nom_enseignant` AS `nom_enseignant`,`enseignant`.`prenom_enseignant` AS `prenom_enseignant`,`enseignant`.`email` AS `email`,`enseignant`.`password` AS `password` from `enseignant` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `annee_formation`
--
ALTER TABLE `annee_formation`
  ADD PRIMARY KEY (`id_af`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Index pour la table `element_module`
--
ALTER TABLE `element_module`
  ADD PRIMARY KEY (`id_element_module`),
  ADD KEY `element_module_ibfk_2` (`id_module`),
  ADD KEY `element_module_ibfk_3` (`id_enseignant`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD UNIQUE KEY `id_enseignant` (`id_enseignant`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `etudiant_ibfk_1` (`annee_formation`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD UNIQUE KEY `nom_filiere` (`nom_filiere`),
  ADD UNIQUE KEY `id_enseignant` (`id_enseignant`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`),
  ADD KEY `module_ibfk_1` (`id_af`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id_ressource`),
  ADD KEY `ressource_ibfk_1` (`id_section`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id_section`),
  ADD KEY `section_ibfk_1` (`id_element_module`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annee_formation`
--
ALTER TABLE `annee_formation`
  MODIFY `id_af` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `element_module`
--
ALTER TABLE `element_module`
  MODIFY `id_element_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id_ressource` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annee_formation`
--
ALTER TABLE `annee_formation`
  ADD CONSTRAINT `annee_formation_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `element_module`
--
ALTER TABLE `element_module`
  ADD CONSTRAINT `element_module_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `element_module_ibfk_3` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`annee_formation`) REFERENCES `annee_formation` (`id_af`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`) ON DELETE SET NULL;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`id_af`) REFERENCES `annee_formation` (`id_af`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `ressource_ibfk_1` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`id_element_module`) REFERENCES `element_module` (`id_element_module`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
