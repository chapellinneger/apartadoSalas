-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-04-2018 a las 23:42:43
-- Versión del servidor: 5.5.59-0ubuntu0.14.04.1
-- Versión de PHP: 5.6.35-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `reserva_salas_nueva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(10) NOT NULL AUTO_INCREMENT,
  `id_tipo_curso` varchar(7) NOT NULL,
  `id_sala` int(10) NOT NULL,
  `hora_ini` date NOT NULL,
  `hora_fin` date NOT NULL,
  `titulo_curso` varchar(30) NOT NULL,
  `descrip_curso` varchar(100) NOT NULL,
  `num_cedula` int(10) NOT NULL,
  `nombre_apellido` varchar(20) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE IF NOT EXISTS `salas` (
  `id_sala` int(10) NOT NULL AUTO_INCREMENT,
  `descrip_sala` varchar(20) NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id_sala`, `descrip_sala`) VALUES
(1, 'Mezzanina-Piso M'),
(2, 'Nery Castillo-Piso 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_curso`
--

CREATE TABLE IF NOT EXISTS `tipo_curso` (
  `id_tipo_curso` int(10) NOT NULL AUTO_INCREMENT,
  `descrip_tipo_curso` varchar(7) NOT NULL,
  PRIMARY KEY (`id_tipo_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_curso`
--

INSERT INTO `tipo_curso` (`id_tipo_curso`, `descrip_tipo_curso`) VALUES
(1, 'Curso'),
(2, 'Evento'),
(3, 'Reunión');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
