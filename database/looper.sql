-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_exerciselooper
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_exerciselooper` ;

-- -----------------------------------------------------
-- Schema db_exerciselooper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_exerciselooper` DEFAULT CHARACTER SET utf8 ;
USE `db_exerciselooper` ;

-- -----------------------------------------------------
-- Table `db_exerciselooper`.`status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`status` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exerciselooper`.`exercises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`exercises` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `status_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exercises_status1_idx` (`status_id` ASC) VISIBLE,
  CONSTRAINT `fk_exercises_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `db_exerciselooper`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exerciselooper`.`states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`states` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`states` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exerciselooper`.`questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`questions` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(45) NOT NULL,
  `exercise_id` INT NOT NULL,
  `state_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_fields_exercises_idx` (`exercise_id` ASC) VISIBLE,
  INDEX `fk_questions_states1_idx` (`state_id` ASC) VISIBLE,
  CONSTRAINT `fk_fields_exercises`
    FOREIGN KEY (`exercise_id`)
    REFERENCES `db_exerciselooper`.`exercises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `db_exerciselooper`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exerciselooper`.`series`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`series` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`series` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `exercise_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_series_exercises1_idx` (`exercise_id` ASC) VISIBLE,
  CONSTRAINT `fk_series_exercises1`
    FOREIGN KEY (`exercise_id`)
    REFERENCES `db_exerciselooper`.`exercises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_exerciselooper`.`responses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_exerciselooper`.`responses` ;

CREATE TABLE IF NOT EXISTS `db_exerciselooper`.`responses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(1000) NOT NULL,
  `question_id` INT NOT NULL,
  `serie_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_responses_questions1_idx` (`question_id` ASC) VISIBLE,
  INDEX `fk_responses_series1_idx` (`serie_id` ASC) VISIBLE,
  CONSTRAINT `fk_responses_questions1`
    FOREIGN KEY (`question_id`)
    REFERENCES `db_exerciselooper`.`questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_responses_series1`
    FOREIGN KEY (`serie_id`)
    REFERENCES `db_exerciselooper`.`series` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- Listage des données de la table db_exerciselooper.states : ~0 rows (environ)
DELETE FROM `states`;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `name`, `slug`) VALUES
	(1, 'Single line text', 'SINGLE_LINE'),
	(2, 'List of single lines', 'SINGLE_LINE_LIST'),
	(3, 'Multi-line text', 'MULTI_LINE');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;

-- Listage des données de la table db_exerciselooper.status : ~0 rows (environ)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `value`, `slug`) VALUES
	(1, 'underconstruct', 'UNDE'),
	(2, 'answered', 'ANSW'),
	(3, 'terminate', 'TERM');