-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 21 Décembre 2018 à 10:39
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portefeuilleNumerique`
--

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `id_compte` int(11) NOT NULL,
  `date` date NOT NULL,
  `nom` varchar(500) NOT NULL,
  `login` varchar(500) NOT NULL,
  `motDePasse` varchar(500) NOT NULL,
  `dateChangementMdp` date NOT NULL,
  `id_service` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Compte`
--

INSERT INTO `Compte` (`id_compte`, `date`, `nom`, `login`, `motDePasse`, `dateChangementMdp`, `id_service`) VALUES
(1, '2018-12-06', 'Mail professionnel', 'eric.dondelinger@ac-nancy-metz.fr', '1234', '2018-12-02', 1),
(2, '2018-12-06', 'Compte professionnel', 'lucaas855', 'azerty213', '2018-12-06', 2),
(3, '2018-12-06', 'Compte professionnel', 'Fabien55', '@azerty213', '2018-07-10', 2);

-- --------------------------------------------------------

--
-- Structure de la table `Service`
--

CREATE TABLE `Service` (
  `id_service` int(11) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(500) NOT NULL,
  `port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Service`
--

INSERT INTO `Service` (`id_service`, `nom`, `date`, `url`, `port`) VALUES
(1, 'FTP serveur Web', '2018-12-03', '192.138.56.112', 5222),
(2, 'SSH', '2018-12-06', '192.69.201.2', 51456);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `Compte_Service_FK` (`id_service`);

--
-- Index pour la table `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Compte`
--
ALTER TABLE `Compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Service`
--
ALTER TABLE `Service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD CONSTRAINT `Compte_Service_FK` FOREIGN KEY (`id_service`) REFERENCES `Service` (`id_service`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
