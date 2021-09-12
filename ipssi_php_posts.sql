-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 12 sep. 2021 à 19:51
-- Version du serveur :  8.0.21
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ipssi_php_posts_ouss`
--
CREATE DATABASE IF NOT EXISTS `ipssi_php_posts_ouss` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `ipssi_php_posts_ouss`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `createdAt` varchar(255) NOT NULL DEFAULT '',
  `updatedAt` varchar(255) NOT NULL DEFAULT '',
  `userId` int UNSIGNED NOT NULL,
  `postId` int UNSIGNED NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `category_id` int NOT NULL,
  `createdAt` varchar(255) NOT NULL DEFAULT '',
  `updatedAt` varchar(255) NOT NULL DEFAULT '',
  `userId` int UNSIGNED NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Ulysse', 'ARNAUD', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
