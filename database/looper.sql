-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.26 - MySQL Community Server - GPL
-- SE du serveur:                Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour db_exerciselooper
CREATE DATABASE IF NOT EXISTS `db_exerciselooper` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_exerciselooper`;

-- Listage de la structure de la table db_exerciselooper. exercises
CREATE TABLE IF NOT EXISTS `exercises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exercises_status1_idx` (`status_id`),
  CONSTRAINT `fk_exercises_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.exercises : ~0 rows (environ)
DELETE FROM `exercises`;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;
/*!40000 ALTER TABLE `exercises` ENABLE KEYS */;

-- Listage de la structure de la table db_exerciselooper. questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  `exercise_id` int NOT NULL,
  `states_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fields_exercises_idx` (`exercise_id`),
  KEY `fk_questions_states1_idx` (`states_id`),
  CONSTRAINT `fk_fields_exercises` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`),
  CONSTRAINT `fk_questions_states1` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.questions : ~0 rows (environ)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Listage de la structure de la table db_exerciselooper. responses
CREATE TABLE IF NOT EXISTS `responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(1000) NOT NULL,
  `question_id` int NOT NULL,
  `serie_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_responses_questions1_idx` (`question_id`),
  KEY `fk_responses_series1_idx` (`serie_id`),
  CONSTRAINT `fk_responses_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `fk_responses_series1` FOREIGN KEY (`serie_id`) REFERENCES `series` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.responses : ~0 rows (environ)
DELETE FROM `responses`;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;

-- Listage de la structure de la table db_exerciselooper. series
CREATE TABLE IF NOT EXISTS `series` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `exercise_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_series_exercises1_idx` (`exercise_id`),
  CONSTRAINT `fk_series_exercises1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.series : ~0 rows (environ)
DELETE FROM `series`;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
/*!40000 ALTER TABLE `series` ENABLE KEYS */;

-- Listage de la structure de la table db_exerciselooper. states
CREATE TABLE IF NOT EXISTS `states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.states : ~0 rows (environ)
DELETE FROM `states`;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `name`, `slug`) VALUES
	(1, 'single_line', 'SIN'),
	(2, 'single_line_list', 'LIS'),
	(3, 'multi_line', 'MUL');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;

-- Listage de la structure de la table db_exerciselooper. status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table db_exerciselooper.status : ~0 rows (environ)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `value`, `slug`) VALUES
	(1, 'underconstruct', 'UND'),
	(2, 'answered', 'ANS'),
	(3, 'terminate', 'TER');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
