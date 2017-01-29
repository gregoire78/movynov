-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP DATABASE IF EXISTS `movynov`;
CREATE DATABASE `movynov` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `movynov`;

DROP TABLE IF EXISTS `actors`;
CREATE TABLE `actors` (
  `id_actor` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `films`;
CREATE TABLE `films` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `series`;
CREATE TABLE `series` (
  `id_serie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `castings`;
CREATE TABLE `castings` (
  `role` varchar(255) NOT NULL,
  `id_film` int(11) DEFAULT NULL,
  `id_actor` int(11) NOT NULL,
  `id_serie` int(11) DEFAULT NULL,
  KEY `fk_id_film_idx` (`id_film`),
  KEY `fk_id_serie_idx` (`id_serie`),
  KEY `fk_id_actor_idx` (`id_actor`),
  CONSTRAINT `fk_id_actor` FOREIGN KEY (`id_actor`) REFERENCES `actors` (`id_actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_film` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_serie` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id_serie`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2017-01-28 01:26:25
