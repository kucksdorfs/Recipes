SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `Recipes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Recipes` ;

-- -----------------------------------------------------
-- Table `Recipes`.`recipes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recipes`.`recipes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `description` BLOB NULL ,
  `source` BLOB NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Recipes`.`ingredients`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recipes`.`ingredients` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `recipe_id` INT NOT NULL ,
  `order` INT NOT NULL ,
  `ingredient` VARCHAR(100) NOT NULL ,
  `amount` VARCHAR(50) NOT NULL ,
  `optional` TINYINT(1) NULL DEFAULT false ,
  PRIMARY KEY (`id`, `recipe_id`) ,
  INDEX `fk_Ingredients_1_idx` (`recipe_id` ASC) ,
  CONSTRAINT `fk_Ingredients_1`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `Recipes`.`recipes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Recipes`.`directions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Recipes`.`directions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `recipe_id` INT NOT NULL ,
  `order` INT NOT NULL ,
  `direction` BLOB NOT NULL ,
  PRIMARY KEY (`id`, `recipe_id`) ,
  INDEX `fk_Directions_1_idx` (`recipe_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_Directions_1`
    FOREIGN KEY (`recipe_id` )
    REFERENCES `Recipes`.`recipes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `Recipes` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
