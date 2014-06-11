-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: fdb7.biz.nf
-- Tiempo de generación: 10-06-2014 a las 15:55:28
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `1638495_bdproy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correoElectronico` varchar(40) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  PRIMARY KEY (`idAdministrador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `correoElectronico`, `contraseña`) VALUES
(3000000, 'Miguel Angel Ochoa Vazquez', 'ochoadmin@hotmail.com', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `codigo` char(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `carrera` int(11) NOT NULL,
  `correoElectronico` varchar(40) NOT NULL,
  `celular` char(10) DEFAULT NULL,
  `cuentaGit` varchar(20) DEFAULT NULL,
  `paginaWeb` varchar(45) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `contraseña` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`codigo`, `nombre`, `carrera`, `correoElectronico`, `celular`, `cuentaGit`, `paginaWeb`, `estado`, `contraseña`) VALUES
('208091714', 'Javier Agustín Rizo Orozco', 3, 'jrorozco92@yahoo.com.mx', '3334565330', 'agustinRO', NULL, 1, 'subaru'),
('208091715', 'Michell Anahi Campos Vazquez', 2, 'mich_anahi@hotmail.com', '3354665308', 'Mich', NULL, 1, 'banana'),
('208091716', 'Hugo Arturo Sanchez Barron', 2, 'hugox232@yahoo.com', '3312448999', 'Wolf', NULL, 1, '12345'),
('301026704', 'Uriel Resendez Muñoz', 2, 'chronozresende@gmail.com', '3340592922', 'Resendez', NULL, 1, 'pokemon'),
('i200912301', 'Elizabeth Serrano Velasco', 7, 'liz_kat@hotmail.com', NULL, 'Kat_Liz', NULL, 1, 'pudin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `Alumno_codigo` char(10) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  `Asistio` int(11) NOT NULL DEFAULT '1',
  `dia` date NOT NULL,
  PRIMARY KEY (`Alumno_codigo`,`Curso_idCurso`),
  KEY `fk_Alumno_has_Curso_Curso1_idx` (`Curso_idCurso`),
  KEY `fk_Alumno_has_Curso_Alumno1_idx` (`Alumno_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `calificacion` varchar(10) NOT NULL,
  `Alumno_codigo` char(10) NOT NULL,
  `idCalificacion` int(11) NOT NULL,
  PRIMARY KEY (`idCalificacion`),
  KEY `fk_Calificacion_Alumno1_idx` (`Alumno_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE IF NOT EXISTS `ciclo` (
  `idCiclo` int(11) NOT NULL,
  `ciclo` char(5) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `Administrador_idAdministrador` int(11) NOT NULL,
  PRIMARY KEY (`idCiclo`),
  KEY `fk_Ciclo_Administrador1_idx` (`Administrador_idAdministrador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciclo`
--

INSERT INTO `ciclo` (`idCiclo`, `ciclo`, `fechaInicio`, `fechaFin`, `Administrador_idAdministrador`) VALUES
(20142, '2014B', '2014-08-18', '2014-12-13', 3000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `seccion` varchar(45) NOT NULL,
  `nrc` varchar(6) NOT NULL,
  `academia` varchar(45) NOT NULL,
  `Maestro_idMaestro` int(11) NOT NULL,
  `Ciclo_idCiclo` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `fk_Curso_Maestro1_idx` (`Maestro_idMaestro`),
  KEY `fk_Curso_Ciclo1_idx` (`Ciclo_idCiclo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `nombre`, `seccion`, `nrc`, `academia`, `Maestro_idMaestro`, `Ciclo_idCiclo`) VALUES
(302300, 'Programacion Web', 'D03', '07259 ', 'Ciencias Computacionales', 20000002, 20142);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diadescanso`
--

CREATE TABLE IF NOT EXISTS `diadescanso` (
  `idDiasDescanso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Ciclo_idCiclo` int(11) NOT NULL,
  PRIMARY KEY (`idDiasDescanso`),
  KEY `fk_DiaDescanso_Ciclo1_idx` (`Ciclo_idCiclo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `diadescanso`
--

INSERT INTO `diadescanso` (`idDiasDescanso`, `fecha`, `Ciclo_idCiclo`) VALUES
(201434, '2014-09-15', 20142);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `idEvaluacion` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `porcentaje` varchar(10) NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idEvaluacion`),
  KEY `fk_Evaluacion_Curso1_idx` (`Curso_idCurso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`idEvaluacion`, `nombre`, `porcentaje`, `Curso_idCurso`) VALUES
(0, 'Practicas', '15%', 302300),
(1, 'Examenes', '15%', 302300),
(2, 'Avances', '30%', 302300),
(3, 'Proyecto', '40%', 302300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionextra`
--

CREATE TABLE IF NOT EXISTS `evaluacionextra` (
  `idEvaluacionExtra` int(11) NOT NULL,
  `nombreExtra` varchar(30) NOT NULL,
  `calificacion` varchar(10) NOT NULL,
  `Evaluacion_idEvaluacion` int(11) NOT NULL,
  PRIMARY KEY (`idEvaluacionExtra`),
  KEY `fk_EvaluacionExtra_Evaluacion1_idx` (`Evaluacion_idEvaluacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  `Curso_idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `fk_Horario_Curso1_idx` (`Curso_idCurso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `fecha`, `horaInicio`, `horaFinal`, `Curso_idCurso`) VALUES
(0, '2014-08-19', '07:00:00', '08:55:00', 302300),
(1, '2014-03-20', '07:00:00', '08:55:00', 302300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE IF NOT EXISTS `maestro` (
  `idMaestro` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correoElectronico` varchar(45) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  PRIMARY KEY (`idMaestro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`idMaestro`, `nombre`, `correoElectronico`, `contraseña`) VALUES
(20000000, 'Abelardo Gomez Andrade', 'automatum@gmail.com', 'automatas'),
(20000001, 'Nancy Michelle Torres Villanueva', 'lic.nancy.torres@gmail.com', 'maestra'),
(20000002, 'Luis Alberto Casillas Santillan', 'casillasia@gmail.com', 'sistemas'),
(20000003, 'Hassem Ruben Macias Brambila', 'hassempoo@gmail.com', 'poo'),
(20000004, 'Alejandra Santoyo Sanchez', 'alexa_turtle@gmail.com', 'operativos');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
