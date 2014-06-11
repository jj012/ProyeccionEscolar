SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `1638495_bdproy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `1638495_bdproy` ;

-- -----------------------------------------------------
-- Table `mydb`.`Ciclo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Ciclo` (
  `idCiclo` INT NOT NULL,
  `ciclo` VARCHAR(5) NOT NULL,
  `inicio` DATE NOT NULL,
  `fin` DATE NOT NULL,
  PRIMARY KEY (`idCiclo`),
  UNIQUE INDEX `_UNIQUE` (`ciclo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Academia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Academia` (
  `idAcademia` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAcademia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Materia` (
  `idMateria` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `Academia_idAcademia` INT NOT NULL,
  PRIMARY KEY (`idMateria`),
  INDEX `fk_Materia_Academia1_idx` (`Academia_idAcademia` ASC),
  CONSTRAINT `fk_Materia_Academia1`
    FOREIGN KEY (`Academia_idAcademia`)
    REFERENCES `mydb`.`Academia` (`idAcademia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Usuario` (
  `idUsuario` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidop` VARCHAR(45) NOT NULL,
  `apellidom` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(9) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Profesor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Profesor` (
  `idProfesor` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idProfesor`),
  INDEX `fk_Profesor_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_Profesor_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `mydb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Horarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Horarios` (
  `idHorarios` INT NOT NULL,
  `dia` INT NOT NULL,
  `entrada` VARCHAR(4) NOT NULL,
  `salida` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`idHorarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Curso` (
  `idCurso` INT NOT NULL,
  `nrc` VARCHAR(45) NOT NULL,
  `seccion` VARCHAR(45) NOT NULL,
  `Ciclo_idCiclo` INT NOT NULL,
  `Materia_idMateria` INT NOT NULL,
  `Profesor_idProfesor` INT NOT NULL,
  `Horarios_idHorarios` INT NOT NULL,
  PRIMARY KEY (`idCurso`),
  INDEX `fk_Curso_Ciclo1_idx` (`Ciclo_idCiclo` ASC),
  INDEX `fk_Curso_Materia1_idx` (`Materia_idMateria` ASC),
  INDEX `fk_Curso_Profesor1_idx` (`Profesor_idProfesor` ASC),
  INDEX `fk_Curso_Horarios1_idx` (`Horarios_idHorarios` ASC),
  CONSTRAINT `fk_Curso_Ciclo1`
    FOREIGN KEY (`Ciclo_idCiclo`)
    REFERENCES `mydb`.`Ciclo` (`idCiclo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Materia1`
    FOREIGN KEY (`Materia_idMateria`)
    REFERENCES `mydb`.`Materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Profesor1`
    FOREIGN KEY (`Profesor_idProfesor`)
    REFERENCES `mydb`.`Profesor` (`idProfesor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Horarios1`
    FOREIGN KEY (`Horarios_idHorarios`)
    REFERENCES `mydb`.`Horarios` (`idHorarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Alumnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Alumnos` (
  `idAlumnos` INT NOT NULL,
  `carrera` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(45) NULL,
  `github` VARCHAR(45) NULL,
  `web` VARCHAR(45) NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idAlumnos`),
  INDEX `fk_Alumnos_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_Alumnos_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `mydb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Toma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Toma` (
  `idToma` INT NOT NULL,
  `status` INT NOT NULL,
  `Alumnos_idAlumnos` INT NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  PRIMARY KEY (`idToma`),
  INDEX `fk_Asiste_Alumnos1_idx` (`Alumnos_idAlumnos` ASC),
  INDEX `fk_Asiste_Curso1_idx` (`Curso_idCurso` ASC),
  CONSTRAINT `fk_Asiste_Alumnos1`
    FOREIGN KEY (`Alumnos_idAlumnos`)
    REFERENCES `mydb`.`Alumnos` (`idAlumnos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asiste_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `mydb`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Administrador` (
  `idAdministrador` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  INDEX `fk_Administrador_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_Administrador_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `mydb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Calificaciones` (
  `idCalificaciones` INT NOT NULL,
  `calificacionFinal` VARCHAR(3) NOT NULL,
  `Alumnos_idAlumnos` INT NOT NULL,
  PRIMARY KEY (`idCalificaciones`),
  INDEX `fk_Calificaciones_Alumnos1_idx` (`Alumnos_idAlumnos` ASC),
  CONSTRAINT `fk_Calificaciones_Alumnos1`
    FOREIGN KEY (`Alumnos_idAlumnos`)
    REFERENCES `mydb`.`Alumnos` (`idAlumnos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Evaluacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Evaluacion` (
  `idEvaluacion` INT NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  `Calificaciones_idCalificaciones` INT NOT NULL,
  PRIMARY KEY (`idEvaluacion`),
  INDEX `fk_Evaluacion_Curso1_idx` (`Curso_idCurso` ASC),
  INDEX `fk_Evaluacion_Calificaciones1_idx` (`Calificaciones_idCalificaciones` ASC),
  CONSTRAINT `fk_Evaluacion_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `mydb`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evaluacion_Calificaciones1`
    FOREIGN KEY (`Calificaciones_idCalificaciones`)
    REFERENCES `mydb`.`Calificaciones` (`idCalificaciones`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Rubros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Rubros` (
  `idRubros` INT NOT NULL,
  `rubro` VARCHAR(45) NOT NULL,
  `porcentaje` INT NOT NULL,
  `Evaluacion_idEvaluacion` INT NOT NULL,
  PRIMARY KEY (`idRubros`),
  INDEX `fk_Rubros_Evaluacion1_idx` (`Evaluacion_idEvaluacion` ASC),
  CONSTRAINT `fk_Rubros_Evaluacion1`
    FOREIGN KEY (`Evaluacion_idEvaluacion`)
    REFERENCES `mydb`.`Evaluacion` (`idEvaluacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`HojasExtra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`HojasExtra` (
  `idHojasExtra` INT NOT NULL,
  `Rubros_idRubros` INT NOT NULL,
  PRIMARY KEY (`idHojasExtra`),
  INDEX `fk_HojasExtra_Rubros1_idx` (`Rubros_idRubros` ASC),
  CONSTRAINT `fk_HojasExtra_Rubros1`
    FOREIGN KEY (`Rubros_idRubros`)
    REFERENCES `mydb`.`Rubros` (`idRubros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Actividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Actividades` (
  `idActividades` INT NOT NULL,
  `HojasExtra_idHojasExtra` INT NOT NULL,
  `actividad` VARCHAR(45) NOT NULL,
  `porcentaje` INT NOT NULL,
  PRIMARY KEY (`idActividades`),
  INDEX `fk_Actividades_HojasExtra1_idx` (`HojasExtra_idHojasExtra` ASC),
  CONSTRAINT `fk_Actividades_HojasExtra1`
    FOREIGN KEY (`HojasExtra_idHojasExtra`)
    REFERENCES `mydb`.`HojasExtra` (`idHojasExtra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Asistencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`Asistencias` (
  `idAsistencias` INT NOT NULL,
  `dia` DATE NOT NULL,
  `Asistencia` INT NOT NULL,
  `Toma_idToma` INT NOT NULL,
  PRIMARY KEY (`idAsistencias`),
  INDEX `fk_Asistencias_Toma1_idx` (`Toma_idToma` ASC),
  CONSTRAINT `fk_Asistencias_Toma1`
    FOREIGN KEY (`Toma_idToma`)
    REFERENCES `mydb`.`Toma` (`idToma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DiasDescanso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `1638495_bdproy`.`DiasDescanso` (
  `idDiasDescanso` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `motivo` VARCHAR(45) NOT NULL,
  `Curso_idCurso` INT NOT NULL,
  PRIMARY KEY (`idDiasDescanso`),
  INDEX `fk_DiasDescanso_Curso1_idx` (`Curso_idCurso` ASC),
  CONSTRAINT `fk_DiasDescanso_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `mydb`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
