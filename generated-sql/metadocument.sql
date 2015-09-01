
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- nationality
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `nationality`;

CREATE TABLE `nationality`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nationality` VARCHAR(50),
    `description` VARCHAR(256),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- countries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `country_name` VARCHAR(50),
    `description` VARCHAR(256),
    `iso_code` VARCHAR(10),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- locations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `location_name` VARCHAR(50),
    `description` VARCHAR(256),
    `iso_code` VARCHAR(10),
    `id_country` VARCHAR(10),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- cities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `city_name` VARCHAR(50),
    `description` VARCHAR(256),
    `iso_code` VARCHAR(10),
    `id_location` INTEGER,
    `id_country` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(50),
    `description` VARCHAR(256),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `rol_name` VARCHAR(50),
    `description` VARCHAR(256),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- admin_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(50),
    `password` VARCHAR(256),
    `g_folder` VARCHAR(256),
    `id_rol` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `admin_user_fi_537141` (`id_rol`),
    CONSTRAINT `admin_user_fk_537141`
        FOREIGN KEY (`id_rol`)
        REFERENCES `roles` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50),
    `rut` VARCHAR(50),
    `code` VARCHAR(50),
    `e_mail` VARCHAR(256),
    `address` VARCHAR(256),
    `gender` VARCHAR(5),
    `phone` VARCHAR(30),
    `id_city` INTEGER,
    `id_location` INTEGER,
    `id_country` INTEGER,
    `id_nationality` INTEGER,
    `id_type` INTEGER,
    `id_admin` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `user_fi_c76660` (`id_city`),
    INDEX `user_fi_4597a9` (`id_location`),
    INDEX `user_fi_3c2bc3` (`id_country`),
    INDEX `user_fi_d6b524` (`id_nationality`),
    INDEX `user_fi_982009` (`id_type`),
    INDEX `user_fi_42a191` (`id_admin`),
    CONSTRAINT `user_fk_c76660`
        FOREIGN KEY (`id_city`)
        REFERENCES `cities` (`id`),
    CONSTRAINT `user_fk_4597a9`
        FOREIGN KEY (`id_location`)
        REFERENCES `locations` (`id`),
    CONSTRAINT `user_fk_3c2bc3`
        FOREIGN KEY (`id_country`)
        REFERENCES `countries` (`id`),
    CONSTRAINT `user_fk_d6b524`
        FOREIGN KEY (`id_nationality`)
        REFERENCES `nationality` (`id`),
    CONSTRAINT `user_fk_982009`
        FOREIGN KEY (`id_type`)
        REFERENCES `user_type` (`id`),
    CONSTRAINT `user_fk_42a191`
        FOREIGN KEY (`id_admin`)
        REFERENCES `admin_user` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
