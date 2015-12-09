-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 08 Décembre 2015 à 16:15
-- Version du serveur :  5.6.25
-- Version de PHP :  5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immo`
--

-- --------------------------------------------------------

--
-- Structure de la table `annoncessauvegardees`
--

CREATE TABLE IF NOT EXISTS `annoncessauvegardees` (
  `id_locataire` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

CREATE TABLE IF NOT EXISTS `bien` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `quartier` varchar(100) NOT NULL,
  `surface` int(11) NOT NULL,
  `descriptif` text NOT NULL,
  `pieces` enum('1','2','3','4','5 et +') NOT NULL,
  `type` enum('appartement','maison','','') NOT NULL,
  `loyer` int(11) NOT NULL,
  `id_proprio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bien`
--

INSERT INTO `bien` (`id`, `titre`, `ville`, `quartier`, `surface`, `descriptif`, `pieces`, `type`, `loyer`, `id_proprio`) VALUES
(39, 'Appart ', 'Paris', 'Montorgueil', 64, 'Super appart', '3', 'appartement', 1800, 0),
(40, 'Petit studio', 'Lyon', 'Bellecour', 18, 'C''est vraiment petit', '1', 'appartement', 1200, 0),
(41, 'Petit studio', 'Toulouse', 'Rose', 75, 'Super appart', '3', 'appartement', 1400, 0),
(42, 'ttt', 'Dunkerque', 'Briques rouges', 15, 'Super nul', '1', 'appartement', 400, 0),
(43, 'ddd', 'Roubaix', '', 40, '', '2', 'appartement', 1000, 0),
(44, 'Louviers', 'Louviers', 'hh', 70, '', '1', 'appartement', 1400, 0),
(45, 'test', '', '', 0, '', '1', 'appartement', 0, 0),
(46, 'test', '', '', 0, '', '1', 'appartement', 0, 0),
(47, 'L''appart de Roger', 'Paris', 'Montmartre', 23, 'Le tres joli appart de Roro', '1', 'appartement', 956, 4);

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

CREATE TABLE IF NOT EXISTS `candidatures` (
  `id_locataire` int(11) NOT NULL,
  `id__bien` int(11) NOT NULL,
  `dateCandidature` date NOT NULL,
  `reponseProprio` enum('En cours','Oui','Non','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `locataire`
--

CREATE TABLE IF NOT EXISTS `locataire` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `tel_fixe` varchar(10) NOT NULL,
  `tel_portable` varchar(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ressources` int(11) NOT NULL,
  `fichePaie` text NOT NULL,
  `CNI` text NOT NULL,
  `ficheImpots` text NOT NULL,
  `RIB` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `locataire`
--

INSERT INTO `locataire` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel_fixe`, `tel_portable`, `email`, `password`, `ressources`, `fichePaie`, `CNI`, `ficheImpots`, `RIB`) VALUES
(9, 'fonfec', 'sophie', '12 rue des fleurs', '76000', 'rouen', '6', '0605040302', 'sophiefonfec@hotmail.fr', '$2y$10$wfKu5nGzJFE.O8SJIjO5wu5lzNoWE5HoMnSBxB84RBt/CFA3.xfku', 2500, '1449563155_exemple-bulletin-de-paie.jpg', '1449563155_cni.jpg', '1449563155_impot.gif', '1449563155_rib.gif');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_exp` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL,
  `dateHeure` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL,
  `bien_id` int(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `bien_id`, `photo`) VALUES
(6, 39, '1449585222_308va01.jpg'),
(7, 39, '1449585222_2012-05-APPARTEMENT-PARIS-PERSPECTIVE-4.jpg'),
(8, 40, '1449585285_308va01.jpg'),
(9, 40, '1449585285_2012-05-APPARTEMENT-PARIS-PERSPECTIVE-4.jpg'),
(10, 40, '1449585285_mg_2932.jpg'),
(11, 41, '1449585442_308va01.jpg'),
(12, 41, '1449585442_2012-05-APPARTEMENT-PARIS-PERSPECTIVE-4.jpg'),
(13, 41, '1449585442_cni.jpg'),
(14, 41, '1449585442_mg_2932.jpg'),
(15, 41, '1449585442_'),
(16, 42, '1449585640_308va01.jpg'),
(17, 42, '1449585640_2012-05-APPARTEMENT-PARIS-PERSPECTIVE-4.jpg'),
(18, 42, '1449585640_cni.jpg'),
(19, 42, '1449585640_mg_2932.jpg'),
(20, 42, '1449585640_'),
(21, 43, '1449585972_19971.jpg'),
(22, 43, '1449585972_appartement-deux-pieces-cannes.jpg'),
(23, 43, '1449585972_renovation-appartement2.jpg'),
(24, 44, '1449586013_19971.jpg'),
(25, 44, '1449586013_appartement-deux-pieces-cannes.jpg'),
(26, 44, '1449586013_cni.jpg'),
(27, 44, '1449586013_renovation-appartement2.jpg'),
(28, 45, '1449586106_'),
(29, 46, '1449586133_'),
(30, 47, '1449587353_19971.jpg'),
(31, 47, '1449587353_appartement-deux-pieces-cannes.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `tel_fixe` varchar(10) NOT NULL,
  `tel_portable` varchar(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `proprietaire`
--

INSERT INTO `proprietaire` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel_fixe`, `tel_portable`, `email`, `password`) VALUES
(1, 'dupont', 'michel', '5 rue de la paix', '75001', 'paris', '0102030405', '0607080910', 'mdupont@free.fr', '$2y$10$Fw4RMyP3vUNIyo.7Y1AJ1.YFnBS5gp7YCjsJGcqFkKlsj8oOlocei'),
(3, 'DURAND', 'Patrick', '10 rue des carmes', '27000', 'Evreux', '0235646464', '0635646464', 'pdurand@gmail.com', '$2y$10$oDIgAxgTmTPMP7jSwcnamOYrTrIcRMGw7Y9cCg9FeI0IXVcKtpXSi'),
(4, 'HANIN', 'Roger', '16 rue Montmartre', '75016', 'Paris', '0156565656', '0656565656', 'rhanin@gmail.com', '$2y$10$izLXx4P47984SPPOsWAe9eHluQHW2ChFGa6/6CUej0qghH778xLn6');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `locataire`
--
ALTER TABLE `locataire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bien`
--
ALTER TABLE `bien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `locataire`
--
ALTER TABLE `locataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
