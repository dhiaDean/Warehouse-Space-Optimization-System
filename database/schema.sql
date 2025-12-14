-- Stock Management System Database Schema
-- Warehouse management system database structure
-- Contains CREATE TABLE statements for all system tables

-- Database creation (optional - uncomment if needed)
-- CREATE DATABASE IF NOT EXISTS stock CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE stock;

-- Table: stock (Articles/Products)
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeart` varchar(50) NOT NULL COMMENT 'Article code',
  `libart` varchar(255) NOT NULL COMMENT 'Article label/name',
  `prix` decimal(10,2) NOT NULL COMMENT 'Price',
  `langeur` decimal(10,2) NOT NULL COMMENT 'Length',
  `largeur` decimal(10,2) NOT NULL COMMENT 'Width',
  `hauteur` decimal(10,2) NOT NULL COMMENT 'Height',
  `classeABC` varchar(1) NOT NULL COMMENT 'ABC classification',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_codeart` (`codeart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stock articles/products table';

-- Table: emplacement (Storage Locations)
CREATE TABLE IF NOT EXISTS `emplacement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeemp` varchar(50) NOT NULL COMMENT 'Emplacement code',
  `libemp` varchar(255) NOT NULL COMMENT 'Emplacement label/name',
  `width` decimal(10,2) NOT NULL COMMENT 'Width',
  `height` decimal(10,2) NOT NULL COMMENT 'Height',
  `depth` decimal(10,2) NOT NULL COMMENT 'Depth',
  `classeABC` varchar(1) NOT NULL COMMENT 'ABC classification',
  `poidmax` decimal(10,2) NOT NULL COMMENT 'Maximum weight',
  `occupied` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Occupied status (1=Yes, 2=No)',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_codeemp` (`codeemp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Storage locations table';

-- Table: artstock (Article Stock Tracking - Links articles to emplacements)
CREATE TABLE IF NOT EXISTS `artstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_article` varchar(50) NOT NULL COMMENT 'Article code (FK to stock.codeart)',
  `desc` varchar(255) DEFAULT NULL COMMENT 'Description',
  `qte` int(11) NOT NULL COMMENT 'Quantity',
  `emp` varchar(50) NOT NULL COMMENT 'Emplacement code (FK to emplacement.codeemp)',
  PRIMARY KEY (`id`),
  KEY `idx_code_article` (`code_article`),
  KEY `idx_emp` (`emp`)
  -- Foreign key constraints (uncomment to enable referential integrity):
  -- FOREIGN KEY (`code_article`) REFERENCES `stock`(`codeart`) ON DELETE RESTRICT,
  -- FOREIGN KEY (`emp`) REFERENCES `emplacement`(`codeemp`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Article stock tracking table';

-- Table: users (User accounts)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User accounts table';

-- Table: groups (User groups/permissions)
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(150) NOT NULL,
  `permission` text COMMENT 'Serialized permissions array',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User groups and permissions table';

-- Foreign key constraints (uncomment to enable referential integrity)
-- ALTER TABLE `artstock` 
-- ADD CONSTRAINT `fk_artstock_stock` 
-- FOREIGN KEY (`code_article`) REFERENCES `stock`(`codeart`) 
-- ON DELETE RESTRICT;

-- ALTER TABLE `artstock` 
-- ADD CONSTRAINT `fk_artstock_emplacement` 
-- FOREIGN KEY (`emp`) REFERENCES `emplacement`(`codeemp`) 
-- ON DELETE RESTRICT;

