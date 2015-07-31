-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-07-2015 a las 10:49:20
-- Versión del servidor: 5.5.42-37.1-log
-- Versión de PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `metadocu_dbdocument`
--
CREATE DATABASE `metadocu_dbdocument` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `metadocu_dbdocument`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `g_folder` varchar(256) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_user_fi_537141` (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `admin_user`
--

INSERT INTO `admin_user` (`id`, `user`, `password`, `g_folder`, `id_rol`) VALUES
(1, 'admin', '6d8d6b24ab341e1633679987bcf0449570b6282b89efe3825bfc4706921a5515:c893bad68927b457dbed39460e6afd62', '0B89z_nEGskBCfmU5YWJKckdvMHV6QzBQSHg1T2FqeFFPRmNZRlhFSHgzSTJWZ2ZSN00weFU', 1),
(2, 'wnuken@gmail.com', '107133505868938079482', '0B89z_nEGskBCfjd4RjhPTUV2UEVRTG9tZmVuSzUyOE9NcFdYWUVvazdYNk9wazNqSXZyLTA', 2),
(3, 'user1', 'c1daae029f354725976492e5a04362fdf9fdfd1098a60de2f928076e062e5989:639cd568883ab1103be9b069a30ad6e5', '0B6Uf2s-14mS6SVFPRmJkeWtHNm8', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `iso_code` varchar(10) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `iso_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `iso_code` varchar(10) DEFAULT NULL,
  `id_country` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nationality`
--

DROP TABLE IF EXISTS `nationality`;
CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nationality` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol_name`, `description`) VALUES
(1, 'Administrador', NULL),
(2, 'Usuario', NULL),
(3, 'Control', NULL),
(4, 'Invitado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `rut` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `e_mail` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `id_city` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `id_nationality` int(11) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_fi_c76660` (`id_city`),
  KEY `user_fi_4597a9` (`id_location`),
  KEY `user_fi_3c2bc3` (`id_country`),
  KEY `user_fi_d6b524` (`id_nationality`),
  KEY `user_fi_982009` (`id_type`),
  KEY `user_fi_42a191` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin_user`
--
ALTER TABLE `admin_user`
  ADD CONSTRAINT `admin_user_fk_537141` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_fk_3c2bc3` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `user_fk_42a191` FOREIGN KEY (`id_admin`) REFERENCES `admin_user` (`id`),
  ADD CONSTRAINT `user_fk_4597a9` FOREIGN KEY (`id_location`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `user_fk_982009` FOREIGN KEY (`id_type`) REFERENCES `user_type` (`id`),
  ADD CONSTRAINT `user_fk_c76660` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `user_fk_d6b524` FOREIGN KEY (`id_nationality`) REFERENCES `nationality` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
