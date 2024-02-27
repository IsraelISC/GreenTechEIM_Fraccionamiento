-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Fraccionamiento
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Fraccionamiento
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Fraccionamiento` DEFAULT CHARACTER SET utf8 ;
USE `Fraccionamiento` ;

-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_TipoResidente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_TipoResidente` (
  `idResidente` INT NOT NULL AUTO_INCREMENT,
  `Nombre_TR` VARCHAR(45) NOT NULL,
  `Status` TINYINT NOT NULL,
  PRIMARY KEY (`idResidente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_cat_Email`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_Email` (
  `idEmail` INT NOT NULL AUTO_INCREMENT,
  `nombreEmail_Email` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idEmail`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_cat_telefono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_telefono` (
  `idTelefono` INT NOT NULL AUTO_INCREMENT,
  `numeroTelefono_Telefono` VARCHAR(10) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idTelefono`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_cat_FotoPerfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_FotoPerfil` (
  `idFotoPerfil` INT NOT NULL AUTO_INCREMENT,
  `RutaImagen_FP` VARCHAR(200) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idFotoPerfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tbl_cat_Domicilio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_Domicilio` (
  `idDomicilio` INT NOT NULL AUTO_INCREMENT,
  `Manzana` VARCHAR(45) NOT NULL,
  `Lote` VARCHAR(45) NOT NULL,
  `Numero` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idDomicilio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_cat_Automovil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_Automovil` (
  `idAutomovil` INT NOT NULL AUTO_INCREMENT,
  `marca_Automovil` VARCHAR(45) NOT NULL,
  `modelo_Automovil` VARCHAR(45) NOT NULL,
  `placa_Automovil` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idAutomovil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_Residente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_Residente` (
  `idResidentePrimario` INT NOT NULL AUTO_INCREMENT,
  `nombre_RP` VARCHAR(45) NOT NULL,
  `ap_RP` VARCHAR(45) NOT NULL,
  `am_RP` VARCHAR(45) NOT NULL,
  `fechaNacimiento_RP` DATE NOT NULL,
  `idEmail_RP` INT NOT NULL,
  `idTelefono_RP` INT NOT NULL,
  `idImagen_RP` INT NOT NULL,
  `idTipoResidente` INT NOT NULL,
  `idDomicilio` INT NOT NULL,
  `idAutomovil` INT NOT NULL,
  PRIMARY KEY (`idResidentePrimario`),
  INDEX `idEmail_RP_idx` (`idEmail_RP` ASC) ,
  INDEX `idTelefono_RP_idx` (`idTelefono_RP` ASC) ,
  INDEX `idImagen_RP_idx` (`idImagen_RP` ASC) ,
  INDEX `idDomicilio_idx` (`idDomicilio` ASC) ,
  INDEX `idAutomovil_idx` (`idAutomovil` ASC) ,
  INDEX `idResidenteSecundario_idx` (`idTipoResidente` ASC) ,
  CONSTRAINT `idTipoResidente`
    FOREIGN KEY (`idTipoResidente`)
    REFERENCES `Fraccionamiento`.`tbl_TipoResidente` (`idResidente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idEmail_RP`
    FOREIGN KEY (`idEmail_RP`)
    REFERENCES `Fraccionamiento`.`tbl_cat_Email` (`idEmail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idTelefono_RP`
    FOREIGN KEY (`idTelefono_RP`)
    REFERENCES `Fraccionamiento`.`tbl_cat_telefono` (`idTelefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idImagen_RP`
    FOREIGN KEY (`idImagen_RP`)
    REFERENCES `Fraccionamiento`.`tbl_cat_FotoPerfil` (`idFotoPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idDomicilio`
    FOREIGN KEY (`idDomicilio`)
    REFERENCES `Fraccionamiento`.`tbl_cat_Domicilio` (`idDomicilio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idAutomovil`
    FOREIGN KEY (`idAutomovil`)
    REFERENCES `Fraccionamiento`.`tbl_cat_Automovil` (`idAutomovil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_cat_TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_cat_TipoUsuario` (
  `idTipoUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre_TU` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idTipoUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `usuario_Usuario` VARCHAR(45) NOT NULL,
  `password_Usuario` VARCHAR(250) NOT NULL,
  `idResidente` INT NOT NULL,
  `idTipoUsuario_Usuario` INT NOT NULL,
  `status_Usuario` INT NOT NULL,
  `fechaRegistro_Usuario` DATE NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `idResidentePrimario_idx` (`idResidente` ASC) ,
  INDEX `idTipoUsuario_idx` (`idTipoUsuario_Usuario` ASC) ,
  CONSTRAINT `idResidentePrimario`
    FOREIGN KEY (`idResidente`)
    REFERENCES `Fraccionamiento`.`tbl_Residente` (`idResidentePrimario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idTipoUsuario`
    FOREIGN KEY (`idTipoUsuario_Usuario`)
    REFERENCES `Fraccionamiento`.`tbl_cat_TipoUsuario` (`idTipoUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_Accesos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_Accesos` (
  `idAccesos` INT NOT NULL AUTO_INCREMENT,
  `idVehiculo_Acceso` VARCHAR(45) NOT NULL,
  `idPers` VARCHAR(45) NULL,
  PRIMARY KEY (`idAccesos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fraccionamiento`.`tbl_Pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fraccionamiento`.`tbl_Pago` (
  `id_Pagos` INT NOT NULL AUTO_INCREMENT,
  `montoPago_Pago` DOUBLE NOT NULL,
  `idResidente` INT NOT NULL,
  `fechaPago_Pago` INT NOT NULL,
  `referencia_Pago` VARCHAR(45) NOT NULL,
  `concepto_Pago` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_Pagos`),
  INDEX `idResidente_idx` (`idResidente` ASC) ,
  CONSTRAINT `idResidente`
    FOREIGN KEY (`idResidente`)
    REFERENCES `Fraccionamiento`.`tbl_Residente` (`idResidentePrimario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;