
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50),
    `description` VARCHAR(255),
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
    `password` VARCHAR(255),
    `name` VARCHAR(50),
    `email` VARCHAR(50),
    `folder_root` TEXT,
    `rol_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `admin_user_fi_97e680` (`rol_id`),
    CONSTRAINT `admin_user_fk_97e680`
        FOREIGN KEY (`rol_id`)
        REFERENCES `roles` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- folder_metadata_form
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `folder_metadata_form`;

CREATE TABLE `folder_metadata_form`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `folder_id` VARCHAR(255),
    `folder_params` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- document_metadata
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `document_metadata`;

CREATE TABLE `document_metadata`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `document_id` VARCHAR(255),
    `document_params` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- document_date
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `document_date`;

CREATE TABLE `document_date`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `document_id` VARCHAR(255),
    `metadata_id` VARCHAR(30),
    `metadata_date` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `document_id` (`document_id`),
    INDEX `metadata_id` (`metadata_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
