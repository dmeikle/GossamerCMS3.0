/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.28-0ubuntu0.20.04.3 : Database - gossamer3_phpunit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `gossamer3_phpunit`;

/*Table structure for table `blog_categories` */

DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `blog_comments` */

DROP TABLE IF EXISTS `blog_comments`;

CREATE TABLE `blog_comments` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `blogs_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_blgcmts_blgs` (`blogs_id`),
  CONSTRAINT `fk_blgcmnts_blgs` FOREIGN KEY (`blogs_id`) REFERENCES `blogs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contents` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `blog_categories_id` int NOT NULL,
  `allow_comments` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_blogs_blogs_categories_idx` (`blog_categories_id`),
  KEY `fk_blogs_users_created_idx` (`created_by`),
  KEY `fk_blogs_users_updated_idx` (`updated_by`),
  CONSTRAINT `fk_blogs_blog_categories` FOREIGN KEY (`blog_categories_id`) REFERENCES `blog_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `recipe_categories` */

DROP TABLE IF EXISTS `recipe_categories`;

CREATE TABLE `recipe_categories` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `category` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `keywords` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `priority` int NOT NULL,
  `slug` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `image` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `recipe_ratings` */

DROP TABLE IF EXISTS `recipe_ratings`;

CREATE TABLE `recipe_ratings` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `recipes_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rating` int NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rcprtngs_rcps` (`recipes_id`),
  CONSTRAINT `fk_rcprtngs_rcps` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Table structure for table `recipes` */

DROP TABLE IF EXISTS `recipes`;

CREATE TABLE `recipes` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `blogs_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prep_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cook_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `recipes_recipe_categories` */

DROP TABLE IF EXISTS `recipes_recipe_categories`;

CREATE TABLE `recipes_recipe_categories` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `recipes_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `recipe_categories_id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_recipes_recipe_categories_3_idx` (`recipes_id`,`recipe_categories_id`),
  KEY `fk_recipes_recipe_categories_1_idx` (`recipes_id`),
  KEY `fk_recipes_recipe_categories_2_idx` (`recipe_categories_id`),
  CONSTRAINT `fk_recipes_recipe_categories_1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `fk_recipes_recipe_categories_2` FOREIGN KEY (`recipe_categories_id`) REFERENCES `recipe_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `setting_groups` */

DROP TABLE IF EXISTS `setting_groups`;

CREATE TABLE `setting_groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `setting_groups_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
