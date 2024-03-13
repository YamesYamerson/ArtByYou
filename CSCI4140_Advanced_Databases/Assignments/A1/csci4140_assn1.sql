-- MySQL Script generated by MySQL Workbench
-- Fri May 19 19:07:45 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema csci4140_assn1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema csci4140_assn1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `csci4140_assn1` DEFAULT CHARACTER SET utf8 ;
USE `csci4140_assn1` ;

-- -----------------------------------------------------
-- Table `csci4140_assn1`.`parts771`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `csci4140_assn1`.`parts771` (
  `partNo` INT NOT NULL,
  `partName` VARCHAR(255) NOT NULL,
  `partDescription` VARCHAR(255) NOT NULL,
  `QoH` INT NOT NULL,
  `currentPrice` DECIMAL(2) NOT NULL,
  PRIMARY KEY (`partNo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `csci4140_assn1`.`clients771`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `csci4140_assn1`.`clients771` (
  `clientId` INT NOT NULL,
  `clientName` VARCHAR(45) NULL,
  `clientCity` VARCHAR(45) NULL,
  `clientCompanyPassword` VARCHAR(45) NULL,
  `dollarsOnOrder` VARCHAR(45) NULL,
  `moneyOwed` VARCHAR(45) NULL,
  `clientStatus` VARCHAR(45) NULL,
  PRIMARY KEY (`clientId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `csci4140_assn1`.`pos771`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `csci4140_assn1`.`pos771` (
  `poNo` INT NOT NULL AUTO_INCREMENT,
  `dateP0` DATETIME NULL,
  `status` VARCHAR(45) NULL,
  `clients771_clientId` INT NULL,
  PRIMARY KEY (`poNo`, `clients771_clientId`),
  INDEX `fk_pos771_clients771_idx` (`clients771_clientId` ASC) INVISIBLE,
  CONSTRAINT `fk_pos771_clients771`
    FOREIGN KEY (`clients771_clientId`)
    REFERENCES `csci4140_assn1`.`clients771` (`clientId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `csci4140_assn1`.`line771`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `csci4140_assn1`.`line771` (
  `line_item_number` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NULL,
  `pos771_poNo` INT NOT NULL,
  `parts771_partNo` INT NOT NULL,
  `discount` VARCHAR(45) NULL,
  PRIMARY KEY (`line_item_number`),
  INDEX `fk_line771_pos7711_idx` (`pos771_poNo` ASC) VISIBLE,
  INDEX `fk_line771_parts7711_idx` (`parts771_partNo` ASC) VISIBLE,
  CONSTRAINT `fk_line771_pos7711`
    FOREIGN KEY (`pos771_poNo`)
    REFERENCES `csci4140_assn1`.`pos771` (`poNo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_line771_parts7711`
    FOREIGN KEY (`parts771_partNo`)
    REFERENCES `csci4140_assn1`.`parts771` (`partNo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
