

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema deportes
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema deportes
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `deportes` DEFAULT CHARACTER SET utf8 ;
USE `deportes` ;

-- -----------------------------------------------------
-- Table `deportes`.`Localidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Localidad` (
  `idLocalidad` INT NOT NULL AUTO_INCREMENT,
  `TipoLocalidad` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idLocalidad`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `Rut` VARCHAR(20) NOT NULL,
  `Nombre` VARCHAR(25) NOT NULL,
  `ApPaterno` VARCHAR(25) NOT NULL,
  `ApMaterno` VARCHAR(25) NOT NULL,
  `Genero` VARCHAR(1) NOT NULL,
  `Fecha_Nacimiento` DATE NOT NULL,
  `Estado_Usuario` VARCHAR(10) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `Localidad_idLocalidad` INT NOT NULL,
  PRIMARY KEY (`idUsuario`, `Localidad_idLocalidad`),
  INDEX `fk_Usuario_Localidad1_idx` (`Localidad_idLocalidad` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`Acceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Acceso` (
  `idAcceso` INT NOT NULL AUTO_INCREMENT,
  `Login` VARCHAR(50) NOT NULL,
  `Password` VARCHAR(50) NOT NULL,
  `Tipo` VARCHAR(10) NOT NULL,
  `FechaCaducacion` DATE NOT NULL,
  `Dias` DATE NOT NULL,
  `EstadoAcceso` VARCHAR(10) NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idAcceso`, `Usuario_idUsuario`),
  INDEX `fk_Acceso_Usuario1_idx` (`Usuario_idUsuario` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`Deportes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Deportes` (
  `idDeportes` INT NOT NULL AUTO_INCREMENT,
  `NombreDeporte` VARCHAR(45) NOT NULL,
  `DescripDeporte` VARCHAR(45) NOT NULL,
  `EstadoDeporte` VARCHAR(10) NOT NULL,
  `Restriccion` INT NOT NULL,
  PRIMARY KEY (`idDeportes`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`DatoSensor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`DatoSensor` (
  `idDatoSensor` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATE NOT NULL,
  `Hora` TIME NOT NULL,
  `MedicionDatoSensor` INT NOT NULL,
  PRIMARY KEY (`idDatoSensor`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`CentroDeportivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`CentroDeportivo` (
  `idCentroDeportivo` INT NOT NULL AUTO_INCREMENT,
  `NombreCentroDeportivo` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `Telefono` INT NOT NULL,
  `Localidad_idLocalidad` INT NOT NULL,
  PRIMARY KEY (`idCentroDeportivo`, `Localidad_idLocalidad`),
  INDEX `fk_CentroDeportivo_Localidad1_idx` (`Localidad_idLocalidad` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`CentroDeportivo_has_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`CentroDeportivo_has_Usuario` (
  `CentroDeportivo_idCentroDeportivo` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`CentroDeportivo_idCentroDeportivo`, `Usuario_idUsuario`),
  INDEX `fk_CentroDeportivo_has_Usuario_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_CentroDeportivo_has_Usuario_CentroDeportivo1_idx` (`CentroDeportivo_idCentroDeportivo` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`Deportes_has_CentroDeportivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Deportes_has_CentroDeportivo` (
  `Deportes_idDeportes` INT NOT NULL,
  `CentroDeportivo_idCentroDeportivo` INT NOT NULL,
  PRIMARY KEY (`Deportes_idDeportes`, `CentroDeportivo_idCentroDeportivo`),
  INDEX `fk_Deportes_has_CentroDeportivo_CentroDeportivo1_idx` (`CentroDeportivo_idCentroDeportivo` ASC),
  INDEX `fk_Deportes_has_CentroDeportivo_Deportes1_idx` (`Deportes_idDeportes` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deportes`.`Registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deportes`.`Registro` (
  `idRegistro` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATE NOT NULL,
  `Deporte` VARCHAR(45) NOT NULL,
  `NombreCentroDeportivo` VARCHAR(45) NOT NULL,
  `Icap` INT NOT NULL,
  `Localidad_idLocalidad` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idRegistro`, `Localidad_idLocalidad`, `Usuario_idUsuario`),
  INDEX `fk_Registro_Localidad1_idx` (`Localidad_idLocalidad` ASC),
  INDEX `fk_Registro_Usuario1_idx` (`Usuario_idUsuario` ASC))
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
