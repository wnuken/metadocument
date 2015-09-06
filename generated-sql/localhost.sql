-- --------------------------------------------------------
-- Host:                         192.168.33.10
-- Versión del servidor:         5.6.25-73.1 - Percona Server (GPL), Release 73.1, Revision 07b797f
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla metadocu_dbdocument.admin_user
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `folder_root` text,
  `rol_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_user_fi_97e680` (`rol_id`),
  CONSTRAINT `admin_user_fk_97e680` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla metadocu_dbdocument.admin_user: ~1 rows (aproximadamente)
DELETE FROM `admin_user`;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` (`id`, `user`, `password`, `name`, `email`, `folder_root`, `rol_id`) VALUES
	(1, '107133505868938079482', 'https://plus.google.com/107133505868938079482', 'Brian Sanabria', 'wnuken@gmail.com', 'root', 2),
	(2, 'user1', 'c1daae029f354725976492e5a04362fdf9fdfd1098a60de2f928076e062e5989:639cd568883ab1103be9b069a30ad6e5', 'Usuario', 'maa', '0B2NQWKe78Nf4UWhocmJ6WHQxams', 2),
	(3, 'admin', '6d8d6b24ab341e1633679987bcf0449570b6282b89efe3825bfc4706921a5515:c893bad68927b457dbed39460e6afd62', 'Administrador', 'softwareagil@softwareagil.com', 'root', 1);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;


-- Volcando estructura para tabla metadocu_dbdocument.document_metadata
DROP TABLE IF EXISTS `document_metadata`;
CREATE TABLE IF NOT EXISTS `document_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` varchar(255) DEFAULT NULL,
  `document_params` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla metadocu_dbdocument.document_metadata: ~1 rows (aproximadamente)
DELETE FROM `document_metadata`;
/*!40000 ALTER TABLE `document_metadata` DISABLE KEYS */;
INSERT INTO `document_metadata` (`id`, `document_id`, `document_params`) VALUES
	(1, '0B89z_nEGskBCQWFIN2x4UURMYmc', '{"1441462568":{"name":"Nombre","value":"Brian","id":1441462568},"1441462578":{"name":"Direcci\\u00f3n","value":"Calle 123","id":1441462578}}');
/*!40000 ALTER TABLE `document_metadata` ENABLE KEYS */;


-- Volcando estructura para tabla metadocu_dbdocument.folder_metadata_form
DROP TABLE IF EXISTS `folder_metadata_form`;
CREATE TABLE IF NOT EXISTS `folder_metadata_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` varchar(255) DEFAULT NULL,
  `folder_params` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla metadocu_dbdocument.folder_metadata_form: ~1 rows (aproximadamente)
DELETE FROM `folder_metadata_form`;
/*!40000 ALTER TABLE `folder_metadata_form` DISABLE KEYS */;
INSERT INTO `folder_metadata_form` (`id`, `folder_id`, `folder_params`) VALUES
	(1, '0B89z_nEGskBCVzlzT3JPWGxqX1E', '{"1441462568":{"name":"Nombre","type":"text","id":1441462568},"1441462578":{"name":"Direcci\\u00f3n","type":"text","id":1441462578},"1441481218":{"name":"Fecha","type":"date","id":1441481218}}');
/*!40000 ALTER TABLE `folder_metadata_form` ENABLE KEYS */;


-- Volcando estructura para tabla metadocu_dbdocument.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla metadocu_dbdocument.roles: ~4 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
	(1, 'Administrator', 'Admin'),
	(2, 'User', 'User'),
	(3, 'Editor', 'Editor'),
	(4, 'Guest', 'Guest');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
