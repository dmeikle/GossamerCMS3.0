# ************************************************************
# Sequel Ace SQL dump
# Version 3038
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.6.3-MariaDB-1:10.6.3+maria~focal)
# Database: gossamer3
# Generation Time: 2021-08-17 03:50:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE IF NOT EXISTS `gossamer3`  DEFAULT CHARACTER SET utf8;
USE `gossamer3`;

# Dump of table address_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `address_types`;

CREATE TABLE `address_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `address_types` WRITE;
/*!40000 ALTER TABLE `address_types` DISABLE KEYS */;

INSERT INTO `address_types` (`id`, `name`)
VALUES
	(1,'Residential'),
	(2,'Commercial');

/*!40000 ALTER TABLE `address_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table email_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `email_types`;

CREATE TABLE `email_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `email_types` WRITE;
/*!40000 ALTER TABLE `email_types` DISABLE KEYS */;

INSERT INTO `email_types` (`id`, `name`)
VALUES
	(1,'Personal'),
	(2,'Business');

/*!40000 ALTER TABLE `email_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table emails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` varchar(36) NOT NULL,
  `email` varchar(45) NOT NULL,
  `email_types_id` int(11) NOT NULL,
  `is_preferred` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emls_emltps_idx` (`email_types_id`),
  CONSTRAINT `fk_emls_emltps` FOREIGN KEY (`email_types_id`) REFERENCES `email_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;

INSERT INTO `emails` (`id`, `email`, `email_types_id`, `is_preferred`)
VALUES
	('007938ad-f008-4a3a-83f7-f0df17b2a7a1','newuser@testwork.com',2,0),
	('06c6e697-3fd0-412b-bc8f-d08c2c4904a5','newuser@test.com',1,1),
	('1682ac15-4d3c-4c75-bc1a-8caf3f8053d0','newuser@testwork.com',2,0),
	('18badf21-34c2-4eb6-901a-894f4334a975','newuser@test.com',1,1),
	('1f603bc7-56c4-4ab9-b4a2-671ceec51ebb','newuser@test.com',1,1),
	('2163b6bc-6563-4621-bd68-4cb553e2663d','updated@junit.com',1,1),
	('2f69a13e-a4e2-4c23-954b-e4f7b55ffa60','newuser@testwork.com',2,0),
	('37c8eb51-faa4-4f0c-b238-d0e09143c13a','test@junit.com',1,1),
	('418b98a9-b385-40be-99be-7ac783f2f2c5','test@junit.com',1,1),
	('45eaecc5-9e0d-401f-a412-1f6a339a171a','test@junit.com',1,1),
	('494a8f9b-6378-4880-8793-d1ffce0c09a7','test@junit.com',1,1),
	('5265290c-9343-48be-8ef3-474cb3ad34f2','test@junit.com',1,1),
	('53301f41-da4b-4c11-92df-80ca1dc09995','newuser@test.com',1,1),
	('5b4458a8-0203-4233-9a5b-748dca7b462d','newuser@testwork.com',2,0),
	('6c36b9b0-c3b8-401d-8b03-e82a98ce99b8','newuser@testwork.com',2,0),
	('6c5c61b8-20c6-4618-ac59-c9f04a518a0b','newuser@test.com',1,1),
	('7650a1a1-0ef5-4795-a120-fe218b463758','newuser@test.com',1,1),
	('7f8efeeb-674d-4d74-bb16-9da3e58c50a2','newuser@testwork.com',2,0),
	('8ae28f9c-d326-4499-83ab-7844893190ee','test@junit.com',1,1),
	('96341d37-81ef-4bd3-8780-e487df7f70f6','newuser@testwork.com',2,0),
	('9766350e-74c3-4880-abad-0199b91230c2','newuser@test.com',1,1),
	('b493c611-74f8-4071-8c82-9217ed58d320','newuser@testwork.com',2,0),
	('bac09c19-4c70-4254-9458-6623c60e1fde','newuser@test.com',1,1),
	('d3c5b199-7a94-4c8b-ba00-1a54a270fdcc','test@junit.com',1,1),
	('d5b7fb66-cb31-4bf4-a1b8-3eb0e69a5b9c','test@junit.com',1,1),
	('d73dd2b5-437f-412c-8bb4-6210666f7e3b','test@junit.com',1,1),
	('f0b68d52-173b-4110-99af-7138327b2efa','test@junit.com',1,1);

/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table entities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entities`;

CREATE TABLE `entities` (
  `id` varchar(36) NOT NULL,
  `entity_id` varchar(36) NOT NULL,
  `entity_types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ents_enttp_idx` (`entity_types_id`),
  CONSTRAINT `ents_enttp` FOREIGN KEY (`entity_types_id`) REFERENCES `entity_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `entities` WRITE;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;

INSERT INTO `entities` (`id`, `entity_id`, `entity_types_id`)
VALUES
	('0796da0e-f65d-4ddb-bb62-6e328418b330','5b5def5a-8962-4416-90c3-edbb48b338a7',2),
	('140dfebd-9184-4f05-8b0f-4d3501cabcb0','3067e9f3-63c3-4f70-97a8-477b95aeb981',1),
	('157dd03b-ae7c-4d3a-ba0c-9db38b72f6eb','e2f56fd1-19a8-4cd4-9a44-8a4b51ea5160',2),
	('1d3180a2-daf5-476e-8e60-58ec470a5f36','5b9a5f2f-39f6-4b46-b595-6a412cb083ea',2),
	('2ebe5bb9-7d4b-437f-83e0-5a05c9359959','b90beaba-22c2-454f-90ce-0c89764c3c86',1),
	('30e089ff-0705-4a7b-a968-2ee48d43488f','4f486a67-046f-4b80-99a3-ca52f11f5ee4',2),
	('366be87d-947e-48d5-b1ed-cc8d93d21a6b','3d6b7bd7-6b32-4dd0-b52d-4af73afdc972',2),
	('401cef4e-e8fd-4da5-bedb-c32c1f47ff07','909d2211-740e-4b43-ab06-61fa29e34116',2),
	('4fca7b21-e3fa-4fd2-8428-542a1885a9fd','23fd6b7a-51c1-45b6-9cae-5aa6d2984eae',1),
	('58b81468-83bc-4506-a02b-6a9d0d8fc420','42612737-268d-40c2-89d6-262553d172fe',1),
	('5e2d43d9-eff2-4813-a208-5ad0def6e9e7','0250a745-cdcd-4b3b-8db4-c877ea5c1a10',2),
	('5ecc2203-7306-41ce-9f1f-90ee20a96f87','4f262688-6a9c-4cd2-acd6-0e36a2240b92',2),
	('5f739dbb-59da-483d-b230-ec64307ba90e','d73cc933-0331-42ba-a631-9a470ad13731',2),
	('68040e5d-1a53-4f4f-8bdc-c24e41b23de6','f2f1f77f-fb14-4e5d-8efd-f7afd11ac346',1),
	('681f92f2-f170-4fa8-8dcc-2be73f6da2a8','0de79355-7173-44ce-9772-3994dfaa6fc2',2),
	('68fbb612-82f8-4c15-8f9f-87f91c55b80d','416c37ba-36bd-47c6-8297-31ca302b1e26',2),
	('69927f15-8c5d-4404-a424-48337ac7a57b','e394fce3-049b-4c0f-a395-240c53b37a09',1),
	('71c63c80-7b28-4d4d-ab4f-986f9a2ad32c','2c56de89-0d6f-4309-a504-acbda2f69749',2),
	('72e5a20d-c3b1-4066-8998-8387eb83d32e','ebf0a5b8-3984-4913-bf98-27e85c75f479',1),
	('78016dc5-ba5f-4bb4-a9a7-01b6a147102f','18452ba5-e8d6-4d20-9d7d-333660a9e693',2),
	('82eefe5e-0158-4700-93a5-69510dcade52','2ec6f422-ce83-4056-ac7b-c30ad3eaf8d9',2),
	('85144be5-923e-4f6c-b130-bc4bd600a4d4','600aec5a-d220-4c40-aba4-17e7b32b4e98',2),
	('889f6361-1f1b-446c-a1e4-6b491d105917','1fcf2a9b-9ec2-4f2b-a139-7f61f6e77025',1),
	('905aa49c-d654-4813-a2a7-91cc1e5e9ff5','339eb63b-b279-4c2b-b77a-02a3f2651158',1),
	('911762c3-9ca8-4b48-9b2e-e8a57aa6734d','eaef76ba-cece-4c7d-99e4-56c0586e2490',1),
	('95efb26f-be84-4a22-b64b-22d27ecd983f','948f855d-4e31-4f7c-9b2c-a7d5f23a98be',1),
	('98759fa2-9681-4e76-8ee8-4cc23d5208b7','f2fe125e-cc96-4628-a1fb-e821b64bdbeb',1),
	('a022a50a-79e3-40cf-9c74-24aaa16653e9','f8b93b7e-2241-4ae1-b336-88456161af27',1),
	('ac14b9d7-a222-440d-b123-34f971ba1b12','0a0d028c-b782-417b-8b76-e6dc7daa33d8',1),
	('b4f51eec-3da3-4aaf-a29a-03790cd9f87e','bd1676ae-a8f1-46d3-beb0-0c48ee69eb14',1),
	('b79452be-effb-4b05-a8f9-3229c5c49cc9','9a3ba8ef-f66d-46cb-a278-1cf4beaaffa4',1),
	('be5361f0-b5eb-4f56-8082-c0efa6d6e172','3e4a044b-7db4-449b-85c9-216a28f0d39e',2),
	('c82a2376-ed6b-41a1-a91d-42e09bbf92b3','c1a48d1c-6770-4cd4-a7d9-a68adcfbe218',1),
	('ea52c55b-cf07-45e7-8446-1fbd8c68032a','91a8eded-f02a-4fbe-8d03-d740ec9a8f59',2),
	('ee17a656-e9da-45d0-a111-5ab289e3eaa6','9860db01-d8bf-4828-8702-15021842fcb5',2),
	('ee564754-d37c-4670-9248-b298a4872b42','e6fc5979-8d0f-4b92-8786-734b63fd71cc',1),
	('f579d1db-73ac-47e5-a205-da0652e40f5f','46eb6118-488a-40c7-a9cf-f09a1330d60d',2),
	('f5f8b19c-e0e1-4080-bb3b-9cec58a09015','b0aeee95-e999-4e21-9eae-fb89010cb938',2),
	('fa654500-f4da-41ba-a914-2769a6607dc7','a1a1491f-3544-43fa-9b1e-f4f4b0bdff27',2),
	('ff28be43-80d6-43c6-b3db-d5afb3dbb023','8d37ef76-02b9-4a10-9bd4-f13c59d373e5',1);

/*!40000 ALTER TABLE `entities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table entity_addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entity_addresses`;

CREATE TABLE `entity_addresses` (
  `id` varchar(36) NOT NULL,
  `entities_id` varchar(36) NOT NULL,
  `address_types_id` int(11) NOT NULL,
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(2) NOT NULL,
  `country` varchar(3) NOT NULL,
  `zip` varchar(12) NOT NULL,
  `is_preferred` tinyint(4) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entaddr_addrtps_idx` (`address_types_id`),
  KEY `fk_entaddr_ents_idx` (`entities_id`),
  CONSTRAINT `fk_entaddr_addrtps` FOREIGN KEY (`address_types_id`) REFERENCES `address_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_entaddr_ents` FOREIGN KEY (`entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `entity_addresses` WRITE;
/*!40000 ALTER TABLE `entity_addresses` DISABLE KEYS */;

INSERT INTO `entity_addresses` (`id`, `entities_id`, `address_types_id`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `is_preferred`, `longitude`, `latitude`, `is_active`, `date_created`, `last_modified`)
VALUES
	('17858797-d34f-4031-8454-fccd971e0165','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-15 17:04:42','2021-08-15 17:04:42'),
	('2bfc0025-afc8-4b51-a088-d3753b883e45','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-16 20:47:40','2021-08-16 20:47:40'),
	('2e2ea5fb-5966-4bdf-a9e3-961dd7bd5927','ea52c55b-cf07-45e7-8446-1fbd8c68032a',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-15 17:11:42','2021-08-15 17:11:42'),
	('362c7284-60bf-4e43-956b-26c524cb3a0f','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,NULL,'2021-08-16 20:49:31'),
	('38b12ea4-431b-4be0-b3c9-d5340e18fea6','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-15 17:11:43','2021-08-15 17:11:43'),
	('4cb1e000-97b1-4372-9ada-5d7844befe51','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-16 20:36:13','2021-08-16 20:36:13'),
	('4e8cf51a-0f2f-4d1e-a3a0-ff4d93ed6fb8','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-15 17:01:29','2021-08-15 17:01:29'),
	('565956d2-8d20-421a-aa72-d998cbd9316e','85144be5-923e-4f6c-b130-bc4bd600a4d4',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-16 20:39:17','2021-08-16 20:39:17'),
	('660c8b4f-6e9b-4b11-ba0b-00fba4812136','1d3180a2-daf5-476e-8e60-58ec470a5f36',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-16 20:47:39','2021-08-16 20:47:39'),
	('7bec9c0b-6f3b-49e1-80d9-5ebbe2df374e','85144be5-923e-4f6c-b130-bc4bd600a4d4',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-16 20:39:17','2021-08-16 20:39:17'),
	('7ff35ec9-47a6-4342-9592-71b993fafa3a','fa654500-f4da-41ba-a914-2769a6607dc7',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-16 20:36:12','2021-08-16 20:36:12'),
	('8dc880bc-3b33-4641-bb64-38476e886b90','68fbb612-82f8-4c15-8f9f-87f91c55b80d',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-15 17:10:55','2021-08-15 17:10:55'),
	('98fa9897-1900-4094-8544-b444484080fa','fa654500-f4da-41ba-a914-2769a6607dc7',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-16 20:36:12','2021-08-16 20:36:12'),
	('9ca5b0fc-40f7-4176-a41c-f4bd246db088','0796da0e-f65d-4ddb-bb62-6e328418b330',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-16 20:46:00','2021-08-16 20:46:00'),
	('a1fa69e1-f59b-45c4-be16-51d8f992b2e5','82eefe5e-0158-4700-93a5-69510dcade52',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-16 20:49:30','2021-08-16 20:49:30'),
	('a4fbab15-1737-47fc-92b2-bc763a60ecbe','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-16 20:46:02','2021-08-16 20:46:02'),
	('abb2e4b4-9d6b-401d-9a8a-c5864997a99d','68fbb612-82f8-4c15-8f9f-87f91c55b80d',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-15 17:10:55','2021-08-15 17:10:55'),
	('ad733417-4d18-43d2-affb-beaf3f8bd238','1d3180a2-daf5-476e-8e60-58ec470a5f36',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-16 20:47:39','2021-08-16 20:47:39'),
	('b46042a8-fa5c-4f79-b56e-2fa37a4b9d46','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-15 17:10:56','2021-08-15 17:10:56'),
	('b7228db6-481e-4658-bef6-809e00c9cd0c','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-16 20:49:31','2021-08-16 20:49:31'),
	('bb140323-11d7-4b68-98ce-28b33d5ccce7','5ecc2203-7306-41ce-9f1f-90ee20a96f87',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-15 17:10:25','2021-08-15 17:10:25'),
	('c1a4c090-6018-4170-bbdb-0ced098f51d2','ea52c55b-cf07-45e7-8446-1fbd8c68032a',1,'123 main st','personal','Mesa','AZ','US','85201',1,-123,52,1,'2021-08-15 17:11:42','2021-08-15 17:11:42'),
	('c232b6af-bc65-4f91-ae8c-468173d68177','2ebe5bb9-7d4b-437f-83e0-5a05c9359959',2,'streeet number','unit nunber','mesa','AZ','US','85201',1,0,0,1,'2021-08-16 20:39:18','2021-08-16 20:39:18'),
	('e37ec891-422c-4af6-a28e-d92646627423','82eefe5e-0158-4700-93a5-69510dcade52',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-16 20:49:30','2021-08-16 20:49:30'),
	('f2fc9163-3a6b-4451-a8b2-90b5d8e44991','0796da0e-f65d-4ddb-bb62-6e328418b330',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-16 20:46:01','2021-08-16 20:46:00'),
	('fe948e8f-7657-4ab6-896e-4ead852cae64','5ecc2203-7306-41ce-9f1f-90ee20a96f87',2,'234 main st','business','Mesa','AZ','US','85201',0,-123,52,1,'2021-08-15 17:10:25','2021-08-15 17:10:25');

/*!40000 ALTER TABLE `entity_addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table entity_emails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entity_emails`;

CREATE TABLE `entity_emails` (
  `id` varchar(36) NOT NULL,
  `entities_id` varchar(36) NOT NULL,
  `emails_id` varchar(36) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_enteml_emls_idx1` (`emails_id`),
  KEY `fk_enteml_ents2` (`entities_id`),
  CONSTRAINT `fk_enteml_emls1` FOREIGN KEY (`emails_id`) REFERENCES `emails` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_enteml_ents2` FOREIGN KEY (`entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `entity_emails` WRITE;
/*!40000 ALTER TABLE `entity_emails` DISABLE KEYS */;

INSERT INTO `entity_emails` (`id`, `entities_id`, `emails_id`)
VALUES
	('077044fa-f912-4c9a-94f1-2cf0337af0c1','5f739dbb-59da-483d-b230-ec64307ba90e','45eaecc5-9e0d-401f-a412-1f6a339a171a'),
	('0923c2c8-6d30-442b-ac73-6a0800ffd74d','85144be5-923e-4f6c-b130-bc4bd600a4d4','53301f41-da4b-4c11-92df-80ca1dc09995'),
	('0fe12cd0-4c6b-4347-ae67-6601f691e6fd','82eefe5e-0158-4700-93a5-69510dcade52','b493c611-74f8-4071-8c82-9217ed58d320'),
	('112eea27-51f4-41c1-92b8-5796a0f98550','0796da0e-f65d-4ddb-bb62-6e328418b330','2f69a13e-a4e2-4c23-954b-e4f7b55ffa60'),
	('1a2daadb-7c26-41a3-8316-ebe453b256e4','5f739dbb-59da-483d-b230-ec64307ba90e','d5b7fb66-cb31-4bf4-a1b8-3eb0e69a5b9c'),
	('2163b6bc-6563-4621-bd68-4cb553e2663d','5f739dbb-59da-483d-b230-ec64307ba90e','2163b6bc-6563-4621-bd68-4cb553e2663d'),
	('2ca81419-aaec-4172-8faf-e8d491e29b74','5f739dbb-59da-483d-b230-ec64307ba90e','8ae28f9c-d326-4499-83ab-7844893190ee'),
	('2d9a2723-3311-4804-87d4-08c54278233b','fa654500-f4da-41ba-a914-2769a6607dc7','7f8efeeb-674d-4d74-bb16-9da3e58c50a2'),
	('36317658-f174-4d69-8698-a46dea527db4','5f739dbb-59da-483d-b230-ec64307ba90e','5265290c-9343-48be-8ef3-474cb3ad34f2'),
	('59f0d8a4-3050-47c8-8410-0a2305e59a29','5f739dbb-59da-483d-b230-ec64307ba90e','f0b68d52-173b-4110-99af-7138327b2efa'),
	('65679a43-52eb-409e-8336-8c81596ae525','5f739dbb-59da-483d-b230-ec64307ba90e','418b98a9-b385-40be-99be-7ac783f2f2c5'),
	('69660f68-1375-4da0-8709-5a3810f50913','5ecc2203-7306-41ce-9f1f-90ee20a96f87','6c5c61b8-20c6-4618-ac59-c9f04a518a0b'),
	('6ada03d8-b566-468f-9dfc-789235eaff45','5f739dbb-59da-483d-b230-ec64307ba90e','494a8f9b-6378-4880-8793-d1ffce0c09a7'),
	('7953f61e-405b-4778-8929-ffd120dc25e9','fa654500-f4da-41ba-a914-2769a6607dc7','7650a1a1-0ef5-4795-a120-fe218b463758'),
	('8244821e-7a78-4558-81db-5e86a547990e','ea52c55b-cf07-45e7-8446-1fbd8c68032a','1f603bc7-56c4-4ab9-b4a2-671ceec51ebb'),
	('8c70b7d1-179b-49a5-be0c-d21aac0336a2','5f739dbb-59da-483d-b230-ec64307ba90e','d3c5b199-7a94-4c8b-ba00-1a54a270fdcc'),
	('954b50f4-792b-4719-a8c7-658a563d41d1','ea52c55b-cf07-45e7-8446-1fbd8c68032a','6c36b9b0-c3b8-401d-8b03-e82a98ce99b8'),
	('9ba7917d-321e-4d52-921a-9446d501366d','1d3180a2-daf5-476e-8e60-58ec470a5f36','18badf21-34c2-4eb6-901a-894f4334a975'),
	('b23ed361-f156-415e-8dfb-1f890ad86a47','68fbb612-82f8-4c15-8f9f-87f91c55b80d','5b4458a8-0203-4233-9a5b-748dca7b462d'),
	('ca09a02e-c480-4168-96ef-39edf008c3a4','68fbb612-82f8-4c15-8f9f-87f91c55b80d','bac09c19-4c70-4254-9458-6623c60e1fde'),
	('d074ef05-0fb9-47d9-acaf-7c6cfdbe0f0f','82eefe5e-0158-4700-93a5-69510dcade52','9766350e-74c3-4880-abad-0199b91230c2'),
	('d46cffe2-8770-4cf1-92ed-c0b17cf5be33','0796da0e-f65d-4ddb-bb62-6e328418b330','06c6e697-3fd0-412b-bc8f-d08c2c4904a5'),
	('d7ea5fda-0965-4d83-8fb8-d16ece0f2c6b','5ecc2203-7306-41ce-9f1f-90ee20a96f87','96341d37-81ef-4bd3-8780-e487df7f70f6'),
	('dc41c2d8-25a0-47d8-a7b5-8878af4d949b','5f739dbb-59da-483d-b230-ec64307ba90e','d73dd2b5-437f-412c-8bb4-6210666f7e3b'),
	('dd1da951-03cb-422d-81da-b498c371b474','5f739dbb-59da-483d-b230-ec64307ba90e','37c8eb51-faa4-4f0c-b238-d0e09143c13a'),
	('ea46c04b-f37a-43ca-8664-0b6adf91bb5f','1d3180a2-daf5-476e-8e60-58ec470a5f36','1682ac15-4d3c-4c75-bc1a-8caf3f8053d0'),
	('ecc193b4-c5e4-42f2-8436-2a222ea9fe7d','85144be5-923e-4f6c-b130-bc4bd600a4d4','007938ad-f008-4a3a-83f7-f0df17b2a7a1');

/*!40000 ALTER TABLE `entity_emails` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table entity_telephones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entity_telephones`;

CREATE TABLE `entity_telephones` (
  `id` varchar(36) NOT NULL,
  `entities_id` varchar(36) DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL,
  `telephone_types_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enttel_teltps_idx` (`telephone_types_id`),
  KEY `fk_enttel_ent_idx` (`entities_id`),
  CONSTRAINT `fk_enttel_ent` FOREIGN KEY (`entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_enttel_teltps` FOREIGN KEY (`telephone_types_id`) REFERENCES `telephone_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `entity_telephones` WRITE;
/*!40000 ALTER TABLE `entity_telephones` DISABLE KEYS */;

INSERT INTO `entity_telephones` (`id`, `entities_id`, `number`, `telephone_types_id`, `is_active`, `date_created`, `last_modified`)
VALUES
	('0838781d-5d86-458f-9d41-672556f54360','82eefe5e-0158-4700-93a5-69510dcade52','123-123-1234',1,0,'2021-08-16 20:49:30','2021-08-16 20:49:30'),
	('1865d9c6-c604-45aa-8058-4a8e406fbdde','68fbb612-82f8-4c15-8f9f-87f91c55b80d','123-123-1234',2,0,'2021-08-15 17:10:55','2021-08-15 17:10:55'),
	('19338be8-3098-447f-9560-64a3d1728abf','1d3180a2-daf5-476e-8e60-58ec470a5f36','123-123-1234',2,0,'2021-08-16 20:47:39','2021-08-16 20:47:39'),
	('2212b15a-6419-4a7b-8906-77f3434ba2a2','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-15 17:11:42','2021-08-15 17:11:42'),
	('289976b8-a0d1-4e46-94e0-a6cac3ed9019','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-16 20:47:39','2021-08-16 20:47:39'),
	('35edb87e-937d-4441-bd89-6646ce4c5bd1','85144be5-923e-4f6c-b130-bc4bd600a4d4','123-123-1234',1,0,'2021-08-16 20:39:17','2021-08-16 20:39:17'),
	('4325bc12-ba7d-4833-b00f-5ce68ab9f7ab','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-15 17:10:55','2021-08-15 17:10:55'),
	('4fc4c20e-bf37-4fa1-944a-02ac1b2b47e2','5ecc2203-7306-41ce-9f1f-90ee20a96f87','123-123-1234',1,0,'2021-08-15 17:10:25','2021-08-15 17:10:25'),
	('6cbef1cf-7f6a-4d51-a335-a27e55cb1a53','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-16 20:49:29','2021-08-16 20:49:29'),
	('75cd7574-4ad9-4e91-b42b-5cd544b2b76a','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-15 17:04:40','2021-08-15 17:04:40'),
	('77d7102b-bde2-476d-bb08-30fa63e4db3d','fa654500-f4da-41ba-a914-2769a6607dc7','123-123-1234',2,0,'2021-08-16 20:36:12','2021-08-16 20:36:12'),
	('7d727bb9-fb39-4c9b-b725-5b43f757ed08','1d3180a2-daf5-476e-8e60-58ec470a5f36','123-123-1234',1,0,'2021-08-16 20:47:39','2021-08-16 20:47:39'),
	('8aac2332-94e0-4b7c-93fe-907f94887db0','85144be5-923e-4f6c-b130-bc4bd600a4d4','123-123-1234',2,0,'2021-08-16 20:39:17','2021-08-16 20:39:17'),
	('8ebfc05d-8c3c-45a8-bcf4-853175beeb9b','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-16 20:39:17','2021-08-16 20:39:17'),
	('9a441b1f-51cb-4993-aa6a-ad82f18f884c','ea52c55b-cf07-45e7-8446-1fbd8c68032a','123-123-1234',2,0,'2021-08-15 17:11:42','2021-08-15 17:11:42'),
	('9f99d334-8ca1-4d04-bf68-80d2cadf7b3f','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-15 16:45:31','2021-08-15 16:45:31'),
	('a0470535-3e29-46c5-af7e-e94c0bc6fa37','0796da0e-f65d-4ddb-bb62-6e328418b330','123-123-1234',2,0,'2021-08-16 20:46:00','2021-08-16 20:46:00'),
	('a4ba015b-aeae-48b1-adbc-8f78b9b6183c','0796da0e-f65d-4ddb-bb62-6e328418b330','123-123-1234',1,0,'2021-08-16 20:46:00','2021-08-16 20:46:00'),
	('b016ff77-edd1-4582-a36b-1898f7178d8e','82eefe5e-0158-4700-93a5-69510dcade52','123-123-1234',2,0,'2021-08-16 20:49:30','2021-08-16 20:49:30'),
	('b26ee2c3-7d7a-43d6-aef4-8236e7ea6809','68fbb612-82f8-4c15-8f9f-87f91c55b80d','123-123-1234',1,0,'2021-08-15 17:10:55','2021-08-15 17:10:55'),
	('b51a070b-5edc-4a5b-8aa4-9c7e739427fe','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-16 20:36:11','2021-08-16 20:36:11'),
	('bc70e478-d4cf-47fd-bf25-e18c4cd51de1','fa654500-f4da-41ba-a914-2769a6607dc7','123-123-1234',1,0,'2021-08-16 20:36:12','2021-08-16 20:36:12'),
	('d0ce0b46-7dd7-4014-902e-ba0ba62960f3','ea52c55b-cf07-45e7-8446-1fbd8c68032a','123-123-1234',1,0,'2021-08-15 17:11:42','2021-08-15 17:11:42'),
	('d4a2a7d6-bc83-48a3-af28-3215afa0459f','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-16 20:46:00','2021-08-16 20:46:00'),
	('e8d550e1-068c-4ab8-a36b-d1726b248c65','5f739dbb-59da-483d-b230-ec64307ba90e','123-456-7890',1,0,'2021-08-15 17:01:29','2021-08-15 17:01:29'),
	('f9031725-0c85-4ee5-9122-6c3a5f87d47a','5ecc2203-7306-41ce-9f1f-90ee20a96f87','123-123-1234',2,0,'2021-08-15 17:10:25','2021-08-15 17:10:25');

/*!40000 ALTER TABLE `entity_telephones` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table entity_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entity_types`;

CREATE TABLE `entity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `entity_types` WRITE;
/*!40000 ALTER TABLE `entity_types` DISABLE KEYS */;

INSERT INTO `entity_types` (`id`, `name`)
VALUES
	(1,'Organization'),
	(2,'User');

/*!40000 ALTER TABLE `entity_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table incident_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incident_types`;

CREATE TABLE `incident_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `severity` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `incident_types` WRITE;
/*!40000 ALTER TABLE `incident_types` DISABLE KEYS */;

INSERT INTO `incident_types` (`id`, `name`, `description`, `severity`)
VALUES
	(1,'minor injury','something here to edit','minor'),
	(2,'major injury','something here to edit','major'),
	(3,'equipment damage','something here to edit','major');

/*!40000 ALTER TABLE `incident_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table incidents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incidents`;

CREATE TABLE `incidents` (
  `id` varchar(36) NOT NULL,
  `date_created` datetime NOT NULL,
  `organizations_users_id` varchar(36) NOT NULL,
  `incident_types_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `resolution` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_incdts_orgsusrs_idx` (`organizations_users_id`),
  KEY `fk_incdts_inctps_idx` (`incident_types_id`),
  CONSTRAINT `fk_incdts_inctps` FOREIGN KEY (`incident_types_id`) REFERENCES `incident_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_incdts_orgsusrs` FOREIGN KEY (`organizations_users_id`) REFERENCES `organizations_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table industries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `industries`;

CREATE TABLE `industries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `industries` WRITE;
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;

INSERT INTO `industries` (`id`, `name`)
VALUES
	(1,'Mining'),
	(2,'Oil');

/*!40000 ALTER TABLE `industries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table legal_sub_divisions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `legal_sub_divisions`;

CREATE TABLE `legal_sub_divisions` (
  `id` varchar(36) NOT NULL,
  `quarter` varchar(6) NOT NULL,
  `section` varchar(3) NOT NULL,
  `township` varchar(3) NOT NULL,
  `area_range` varchar(3) NOT NULL DEFAULT '',
  `meridian` varchar(6) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `entered_by_entities_id` varchar(36) NOT NULL,
  `organization_entities_id` varchar(36) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lsd_ebeid_idx` (`entered_by_entities_id`),
  KEY `fk_lsd_oeid_idx` (`organization_entities_id`),
  CONSTRAINT `fk_lsd_ebeid` FOREIGN KEY (`entered_by_entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lsd_oeid` FOREIGN KEY (`organization_entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `legal_sub_divisions` WRITE;
/*!40000 ALTER TABLE `legal_sub_divisions` DISABLE KEYS */;

INSERT INTO `legal_sub_divisions` (`id`, `quarter`, `section`, `township`, `area_range`, `meridian`, `latitude`, `longitude`, `name`, `description`, `date_created`, `entered_by_entities_id`, `organization_entities_id`, `last_modified`)
VALUES
	('383540a9-fd2c-4bf1-b67c-455b218ebbe0','ac','dc','qwe','rng','mer',-53,123,'junit test','this is a description','2021-08-16 20:46:02','5f739dbb-59da-483d-b230-ec64307ba90e','2ebe5bb9-7d4b-437f-83e0-5a05c9359959','2021-08-16 20:46:02'),
	('5b6a693c-d28c-466b-922f-ef73a7b208a0','ac','dc','qwe','rng','mer',-53,123,'junit update test','this is a description','2021-08-16 20:49:31','5f739dbb-59da-483d-b230-ec64307ba90e','2ebe5bb9-7d4b-437f-83e0-5a05c9359959','2021-08-16 20:49:31'),
	('b6f06e26-6d12-421c-93fc-5e628eb88954','ac','dc','qwe','rng','mer',-53,123,'junit test','this is a description','2021-08-16 20:47:40','5f739dbb-59da-483d-b230-ec64307ba90e','2ebe5bb9-7d4b-437f-83e0-5a05c9359959','2021-08-16 20:47:40'),
	('c285e9fa-a82e-494c-a803-6a344eb763a3','ac','dc','qwe','rng','mer',-53,123,'junit test','this is a description','2021-08-16 20:49:31','5f739dbb-59da-483d-b230-ec64307ba90e','2ebe5bb9-7d4b-437f-83e0-5a05c9359959','2021-08-16 20:49:31'),
	('d804a1f3-7594-43b8-ae0c-40e2b06174c5','ac','dc','qwe','rng','mer',-53,123,'junit test','this is a description','2021-08-16 20:44:12','5f739dbb-59da-483d-b230-ec64307ba90e','2ebe5bb9-7d4b-437f-83e0-5a05c9359959','2021-08-16 20:44:12');

/*!40000 ALTER TABLE `legal_sub_divisions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table organizations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organizations`;

CREATE TABLE `organizations` (
  `id` varchar(36) NOT NULL,
  `name` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;

INSERT INTO `organizations` (`id`, `name`, `date_created`, `last_modified`, `is_active`)
VALUES
	('09e84663-6dc9-4ca3-8857-85bb046465b2','quantumunit2','2021-06-18 23:24:44','2021-06-18 23:24:44',1),
	('0a0d028c-b782-417b-8b76-e6dc7daa33d8','junit test','2021-08-16 20:36:12','2021-08-16 20:36:12',1),
	('1304228d-b8a2-42da-90fc-c5c4d9ebfea4','quantumunit3','2021-06-18 23:31:21','2021-06-18 23:31:21',1),
	('1fcf2a9b-9ec2-4f2b-a139-7f61f6e77025','junit test','2021-08-16 20:39:17','2021-08-16 20:39:17',1),
	('23fd6b7a-51c1-45b6-9cae-5aa6d2984eae','junit test','2021-08-16 20:39:17','2021-08-16 20:39:17',1),
	('299ab7c4-cac7-4011-9f00-6fce042b5853','quantumunit4','2021-06-18 23:28:59','2021-06-18 23:28:59',1),
	('3067e9f3-63c3-4f70-97a8-477b95aeb981','junit test','2021-08-16 20:49:30','2021-08-16 20:49:30',1),
	('339eb63b-b279-4c2b-b77a-02a3f2651158','junit test','2021-08-15 17:04:41','2021-08-15 17:04:41',1),
	('35cb7e9f-1358-4bdd-9cff-662c7ef4347e','quantumunit','2021-06-18 23:23:57','2021-06-18 23:23:57',1),
	('40ed8e80-4540-4cd7-95e2-4b9865d11e86','quantumunit','2021-06-18 23:18:48','2021-06-18 23:18:48',1),
	('42612737-268d-40c2-89d6-262553d172fe','junit test','2021-08-16 20:46:01','2021-08-16 20:46:01',1),
	('4eb1d64b-98e2-4730-bf7d-6d8d28554cd3','quantumunit','2021-06-18 23:26:02','2021-06-18 23:26:02',1),
	('8d37ef76-02b9-4a10-9bd4-f13c59d373e5','junit test','2021-08-15 17:04:41','2021-08-15 17:04:41',1),
	('948f855d-4e31-4f7c-9b2c-a7d5f23a98be','junit test','2021-08-15 17:04:11','2021-08-15 17:04:10',1),
	('9a3ba8ef-f66d-46cb-a278-1cf4beaaffa4','junit test','2021-08-16 20:47:39','2021-08-16 20:47:39',1),
	('b90beaba-22c2-454f-90ce-0c89764c3c86','quantumunit1','2021-06-18 23:15:18','2021-06-18 23:15:18',1),
	('bd1676ae-a8f1-46d3-beb0-0c48ee69eb14','junit test','2021-08-15 17:10:55','2021-08-15 17:10:55',1),
	('c1a48d1c-6770-4cd4-a7d9-a68adcfbe218','junit test','2021-08-15 17:11:42','2021-08-15 17:11:42',1),
	('e394fce3-049b-4c0f-a395-240c53b37a09','junit test','2021-08-16 20:36:12','2021-08-16 20:36:12',1),
	('e6fc5979-8d0f-4b92-8786-734b63fd71cc','junit test','2021-08-15 17:04:41','2021-08-16 20:49:30',1),
	('eaef76ba-cece-4c7d-99e4-56c0586e2490','junit test','2021-08-16 20:49:30','2021-08-16 20:49:30',1),
	('ebf0a5b8-3984-4913-bf98-27e85c75f479','junit test','2021-08-16 20:47:39','2021-08-16 20:47:39',1),
	('f2f1f77f-fb14-4e5d-8efd-f7afd11ac346','junit test','2021-08-15 17:10:55','2021-08-15 17:10:55',1),
	('f2fe125e-cc96-4628-a1fb-e821b64bdbeb','junit test','2021-08-15 17:11:42','2021-08-15 17:11:42',1),
	('f8b93b7e-2241-4ae1-b336-88456161af27','junit test','2021-08-16 20:46:01','2021-08-16 20:46:01',1);

/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table organizations_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organizations_users`;

CREATE TABLE `organizations_users` (
  `id` varchar(36) NOT NULL,
  `Organizations_id` varchar(36) NOT NULL,
  `Users_id` varchar(36) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orgusr_usr_idx` (`Users_id`),
  CONSTRAINT `fk_orgusr_usr` FOREIGN KEY (`Users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `organizations_users` WRITE;
/*!40000 ALTER TABLE `organizations_users` DISABLE KEYS */;

INSERT INTO `organizations_users` (`id`, `Organizations_id`, `Users_id`, `from_date`, `to_date`)
VALUES
	('09d2b64d-3bf1-4660-a651-0aadbda00fa5','b90beaba-22c2-454f-90ce-0c89764c3c86','5b9a5f2f-39f6-4b46-b595-6a412cb083ea','2021-08-16 20:47:39',NULL),
	('29c65cee-648d-4b16-848e-d594ef00f622','b90beaba-22c2-454f-90ce-0c89764c3c86','416c37ba-36bd-47c6-8297-31ca302b1e26','2021-08-15 17:10:55',NULL),
	('2ab57da8-208a-4bb0-86c6-4ecf1b2b04d0','b90beaba-22c2-454f-90ce-0c89764c3c86','a1a1491f-3544-43fa-9b1e-f4f4b0bdff27','2021-08-16 20:36:11',NULL),
	('58367931-8127-4e05-a5cd-479b6705f2a6','b90beaba-22c2-454f-90ce-0c89764c3c86','5b5def5a-8962-4416-90c3-edbb48b338a7','2021-08-16 20:46:00',NULL),
	('841fe1b5-7db5-4b03-9f2a-71a840621cb1','b90beaba-22c2-454f-90ce-0c89764c3c86','2ec6f422-ce83-4056-ac7b-c30ad3eaf8d9','2021-08-16 20:49:30',NULL),
	('9a4e8c5d-8104-4dd1-af4d-e3c1b370f88a','b90beaba-22c2-454f-90ce-0c89764c3c86','91a8eded-f02a-4fbe-8d03-d740ec9a8f59','2021-08-15 17:11:42',NULL),
	('9d6c7667-40da-4e83-9a40-afeef52a6bad','b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731','2021-01-01 00:00:00','2025-12-31 00:00:00'),
	('fee0538a-a97f-4e46-bf8b-7434cac0bdbf','b90beaba-22c2-454f-90ce-0c89764c3c86','4f262688-6a9c-4cd2-acd6-0e36a2240b92','2021-08-15 17:09:44',NULL),
	('ff438af1-7452-4ba4-bb63-f2a6b5db11fc','b90beaba-22c2-454f-90ce-0c89764c3c86','600aec5a-d220-4c40-aba4-17e7b32b4e98','2021-08-16 20:39:17',NULL);

/*!40000 ALTER TABLE `organizations_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table organizations_users_preferences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `organizations_users_preferences`;

CREATE TABLE `organizations_users_preferences` (
  `id` varchar(36) NOT NULL,
  `organizations_users_id` varchar(36) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orgusrpref_orgusrs_idx` (`organizations_users_id`),
  CONSTRAINT `fk_orgusrpref_orgusrs` FOREIGN KEY (`organizations_users_id`) REFERENCES `organizations_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `organizations_users_preferences` WRITE;
/*!40000 ALTER TABLE `organizations_users_preferences` DISABLE KEYS */;

INSERT INTO `organizations_users_preferences` (`id`, `organizations_users_id`, `roles`, `is_active`)
VALUES
	('024b42f8-66dd-4c28-9075-9a09c7913b20','2ab57da8-208a-4bb0-86c6-4ecf1b2b04d0','[ANONYMOUS_USER, BASIC_USER]',1),
	('2224937f-bbd3-495a-97b6-f88b07313d36','9d6c7667-40da-4e83-9a40-afeef52a6bad','[ANONYMOUS_USER, BASIC_USER]',1),
	('54a14c70-ca72-4818-99cd-82c6f7c6c36e','09d2b64d-3bf1-4660-a651-0aadbda00fa5','[ANONYMOUS_USER, BASIC_USER]',1),
	('583aad49-f608-48ab-9f7e-defc453a00ba','841fe1b5-7db5-4b03-9f2a-71a840621cb1','[ANONYMOUS_USER, BASIC_USER]',1),
	('58479103-4bc8-4fff-a718-69b761302754','ff438af1-7452-4ba4-bb63-f2a6b5db11fc','[ANONYMOUS_USER, BASIC_USER]',1),
	('902f210e-66ff-4752-b8c8-a40649331ce4','9a4e8c5d-8104-4dd1-af4d-e3c1b370f88a','[ANONYMOUS_USER, BASIC_USER]',1),
	('92722e85-2cb5-42e7-ab72-81a30fa5f40b','fee0538a-a97f-4e46-bf8b-7434cac0bdbf','[ANONYMOUS_USER, BASIC_USER]',1),
	('998bc505-03e9-4d63-a5b9-ca89271bd843','58367931-8127-4e05-a5cd-479b6705f2a6','[ANONYMOUS_USER, BASIC_USER]',1),
	('c412ed3e-0724-4525-859e-0d5692f7c085','29c65cee-648d-4b16-848e-d594ef00f622','[ANONYMOUS_USER, BASIC_USER]',1);

/*!40000 ALTER TABLE `organizations_users_preferences` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `role`)
VALUES
	(1,'ANONYMOUS_USER'),
	(2,'BASIC_USER'),
	(3,'MANAGER_USER'),
	(4,'DEVELOPER'),
	(5,'OMNIPOTENT_USER');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table survey_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_answers`;


CREATE TABLE IF NOT EXISTS `gossamer3`.`survey_answers` (
  `id` VARCHAR(36) NOT NULL,
  `date_created` DATETIME NOT NULL,
  `answer` VARCHAR(200) NOT NULL,
  `is_active` TINYINT(4) NOT NULL DEFAULT 1,
  `Survey_Questions_id` varchar(36) NOT NULL,
  `priority` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


# Dump of table survey_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_categories`;

CREATE TABLE `survey_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `survey_categories` WRITE;
/*!40000 ALTER TABLE `survey_categories` DISABLE KEYS */;

INSERT INTO `survey_categories` (`id`, `name`)
VALUES
	(1,'Wellness');

/*!40000 ALTER TABLE `survey_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table survey_question_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_question_answers`;

CREATE TABLE `survey_question_answers` (
  `id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `Survey_Questions_id` varchar(36) NOT NULL,
  `Survey_Answers_id` varchar(36) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_srvqstsnrs_srvqstns_idx` (`Survey_Questions_id`),
  KEY `fk_srvqstsnrs_srvansrs_idx` (`Survey_Answers_id`),
  CONSTRAINT `fk_srvqstsnrs_srvansrs` FOREIGN KEY (`Survey_Answers_id`) REFERENCES `survey_answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_srvqstsnrs_srvqstns` FOREIGN KEY (`Survey_Questions_id`) REFERENCES `survey_questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table survey_question_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_question_types`;

CREATE TABLE `survey_question_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `survey_question_types` WRITE;
/*!40000 ALTER TABLE `survey_question_types` DISABLE KEYS */;

INSERT INTO `survey_question_types` (`id`, `name`)
VALUES
	(1,'Radio Button');

/*!40000 ALTER TABLE `survey_question_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table survey_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_questions`;

CREATE TABLE `survey_questions` (
  `id` varchar(36) NOT NULL,
  `date_created` datetime NOT NULL,
  `Survey_Question_Types_id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `Surveys_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_srvqst_srvqsttps_idx` (`Survey_Question_Types_id`),
  CONSTRAINT `fk_srvqst_srvqsttps` FOREIGN KEY (`Survey_Question_Types_id`) REFERENCES `survey_question_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `survey_questions` WRITE;
/*!40000 ALTER TABLE `survey_questions` DISABLE KEYS */;

INSERT INTO `survey_questions` (`id`, `date_created`, `Survey_Question_Types_id`, `question`, `priority`, `is_active`, `Surveys_id`)
VALUES
	('35f516bb-7027-4382-979f-43260fcf6575','2021-08-16 20:49:06',1,'Is this a question?',1,1,'a3422f55-982d-4632-affa-859c5d965594'),
	('e5938604-3e0e-4b49-a574-4bf95328e9a1','2021-08-16 20:49:30',1,'Is this a question?',1,1,'a3422f55-982d-4632-affa-859c5d965594');

/*!40000 ALTER TABLE `survey_questions` ENABLE KEYS */;
UNLOCK TABLES;

# Dump of table survey_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_templates`;

CREATE TABLE `survey_templates` (
  `id` varchar(36) NOT NULL,
  `date_created` datetime NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `Industries_id` int(11) NOT NULL,
  `Survey_Categories_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_srvtmp_indst_idx` (`Industries_id`),
  KEY `fk_srvtmp_srvctgs_idx` (`Survey_Categories_id`),
  CONSTRAINT `fk_srvtmp_indst` FOREIGN KEY (`Industries_id`) REFERENCES `industries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_srvtmp_srvctgs` FOREIGN KEY (`Survey_Categories_id`) REFERENCES `survey_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `survey_templates` WRITE;
/*!40000 ALTER TABLE `survey_templates` DISABLE KEYS */;

INSERT INTO `survey_templates` (`id`, `date_created`, `name`, `description`, `Industries_id`, `Survey_Categories_id`, `is_active`)
VALUES
	('c70202d0-e36f-459b-a3ee-32ca13e25c5c','2021-08-16 00:00:00','test','test',1,1,1);

/*!40000 ALTER TABLE `survey_templates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table surveys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `surveys`;

CREATE TABLE `surveys` (
  `id` varchar(36) NOT NULL,
  `date_created` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `Survey_Templates_id` varchar(36) NOT NULL,
  `Organizations_id` varchar(36) NOT NULL,
  `start_Date` date NOT NULL,
  `end_Date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_srvs_srvtmps_idx` (`Survey_Templates_id`),
  KEY `fk_srvs_orgs_idx` (`Organizations_id`),
  CONSTRAINT `fk_srvs_orgs` FOREIGN KEY (`Organizations_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_srvs_srvtmps` FOREIGN KEY (`Survey_Templates_id`) REFERENCES `survey_templates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;

INSERT INTO `surveys` (`id`, `date_created`, `name`, `description`, `Survey_Templates_id`, `Organizations_id`, `start_Date`, `end_Date`)
VALUES
	('46524d32-f804-4491-bf1a-bc4039901ec6','2021-08-16 20:47:16','unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16'),
	('5659ed00-fa75-4ffe-ae86-6c54197c100a','2021-08-16 20:39:18','unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16'),
	('64e9713e-a1f8-4e9b-96a1-1f0873131c05','2021-08-16 20:47:40','unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16'),
	('74a78dcb-cb03-4550-bfa8-e526f984fa5a','2021-08-16 20:46:02','unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16'),
	('a3422f55-982d-4632-affa-859c5d965594','2021-08-16 20:38:49','updated unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16'),
	('fb26194c-0a7a-4dfb-a0aa-3059b47309d9','2021-08-16 20:49:31','unit test','this is a unit test','c70202d0-e36f-459b-a3ee-32ca13e25c5c','b90beaba-22c2-454f-90ce-0c89764c3c86','2021-08-16','2021-08-16');

/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table surveys_responses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `surveys_responses`;

CREATE TABLE `surveys_responses` (
  `id` int(11) NOT NULL,
  `Survey_Response_Headers_id` varchar(36) NOT NULL,
  `Survey_Questions_id` varchar(36) NOT NULL,
  `Survey_Question_Answers_id` varchar(36) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_srvsrspns_srvrspnshdrs_idx` (`Survey_Response_Headers_id`),
  KEY `fk_srvsrspns_srvqstns_idx` (`Survey_Questions_id`),
  KEY `fk_srvsrspns_srvrqstnanswrs_idx` (`Survey_Question_Answers_id`),
  CONSTRAINT `fk_srvsrspns_srvqstns` FOREIGN KEY (`Survey_Questions_id`) REFERENCES `surveys_survey_questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_srvsrspns_srvrqstnanswrs` FOREIGN KEY (`Survey_Question_Answers_id`) REFERENCES `survey_question_answers` (`Survey_Questions_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_srvsrspns_srvrspnshdrs` FOREIGN KEY (`Survey_Response_Headers_id`) REFERENCES `survey_response_headers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





/*commenting out because mysql won't pull this in without errors

CREATE TABLE IF NOT EXISTS `gossamer3`.`survey_response_answers` (
    `id` VARCHAR(36) NOT NULL,
    `survey_response_headers_id` VARCHAR(36) NOT NULL,
    `survey_questions_id` VARCHAR(36) NOT NULL,
    `survey_question_answers_id` VARCHAR(36) NULL,
    `answer` VARCHAR(100) NULL
    PRIMARY KEY (`id`)
   )
    ENGINE = InnoDB;
    INDEX `fk_sra_ansrs_id_idx` (`survey_question_answers_id` ASC) ,
    INDEX `fk_sra_srh_id_idx` (`survey_response_headers_id` ASC) ,
    INDEX `fk_sra_sq_id_idx` (`survey_questions_id` ASC)
--     CONSTRAINT `fk_sra_ansrs_id`
    FOREIGN KEY (`survey_question_answers_id`)
    REFERENCES `gossamer3`.`survey_answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_sra_srh_id`
    FOREIGN KEY (`survey_response_headers_id`)
    REFERENCES `gossamer3`.`survey_response_headers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_sra_sq_id`
    FOREIGN KEY (`survey_questions_id`)
    REFERENCES `gossamer3`.`survey_questions` (`id`)
     ON DELETE NO ACTION
    ON UPDATE NO ACTION
*/

# Dump of table telephone_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `telephone_types`;

CREATE TABLE `telephone_types` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `telephone_types` WRITE;
/*!40000 ALTER TABLE `telephone_types` DISABLE KEYS */;

INSERT INTO `telephone_types` (`id`, `name`)
VALUES
	(1,'Mobile'),
	(2,'Office'),
	(3,'Fax');

/*!40000 ALTER TABLE `telephone_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_invites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_invites`;

CREATE TABLE `user_invites` (
  `id` varchar(36) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `entities_id` varchar(36) DEFAULT NULL,
  `organizations_id` varchar(36) DEFAULT NULL,
  `inviter_user_id` varchar(36) DEFAULT NULL,
  `date_onboarded` datetime DEFAULT NULL,
  `date_invited` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usrinvts_ents_idx` (`entities_id`),
  KEY `fk_usrinvts_orgs_idx` (`organizations_id`),
  KEY `fk_usrinvts_invtr_idx` (`inviter_user_id`),
  CONSTRAINT `fk_usrinvts_ents` FOREIGN KEY (`entities_id`) REFERENCES `entities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usrinvts_invtr` FOREIGN KEY (`inviter_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usrinvts_orgs` FOREIGN KEY (`organizations_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_invites` WRITE;
/*!40000 ALTER TABLE `user_invites` DISABLE KEYS */;

INSERT INTO `user_invites` (`id`, `firstname`, `lastname`, `email`, `entities_id`, `organizations_id`, `inviter_user_id`, `date_onboarded`, `date_invited`)
VALUES
	('36c57b3e-7791-4393-89b7-919e76d24a4f','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-15 17:04:41'),
	('4e7a5eab-22e5-43fa-8693-d57b7e53825a','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-16 20:47:39'),
	('6f3099d3-f346-48c7-8d05-b8627d8e6818','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-16 20:49:30'),
	('717ad939-d70d-45c1-bff7-327b79e0f2ce','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-16 20:36:12'),
	('973c1568-866e-4435-94d0-d29941312187','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-16 20:46:01'),
	('a375b312-947e-49c5-bb22-cd7e4da205d5','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-15 16:45:31'),
	('a81d8699-9a3d-45cb-a7b5-534c9dcdf15c','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-15 17:11:42'),
	('b07818b1-74d4-40d9-aaeb-2d4557206a09','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-16 20:39:17'),
	('f048ef56-5382-4fa2-8655-8f23d04ab1d9','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-15 17:01:29'),
	('faa1225b-03f3-4015-b6a3-17caafad31a7','David','Meikle','davemeikle@ymail.com',NULL,'b90beaba-22c2-454f-90ce-0c89764c3c86','d73cc933-0331-42ba-a631-9a470ad13731',NULL,'2021-08-15 17:10:55');

/*!40000 ALTER TABLE `user_invites` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `date_onboarded` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `dob`, `date_created`, `last_modified`, `is_active`, `date_onboarded`)
VALUES
	('0250a745-cdcd-4b3b-8db4-c877ea5c1a10','Unit','Test',NULL,'2021-08-15 17:01:28','2021-08-15 17:01:28',0,NULL),
	('0de79355-7173-44ce-9772-3994dfaa6fc2','Unit','Test',NULL,'2021-08-15 17:10:54','2021-08-15 17:10:54',0,NULL),
	('18452ba5-e8d6-4d20-9d7d-333660a9e693','Unit','Test',NULL,'2021-08-15 17:11:41','2021-08-15 17:11:41',0,NULL),
	('2c56de89-0d6f-4309-a504-acbda2f69749','Unit','Test',NULL,'2021-08-16 20:36:11','2021-08-16 20:36:11',0,NULL),
	('2ec6f422-ce83-4056-ac7b-c30ad3eaf8d9','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-16 20:49:30','2021-08-16 20:49:30',0,NULL),
	('3d6b7bd7-6b32-4dd0-b52d-4af73afdc972','Unit','Test',NULL,'2021-08-16 20:46:00','2021-08-16 20:46:00',0,NULL),
	('3e4a044b-7db4-449b-85c9-216a28f0d39e','Unit','Test',NULL,'2021-08-15 16:45:31','2021-08-15 16:45:31',0,NULL),
	('416c37ba-36bd-47c6-8297-31ca302b1e26','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-15 17:10:55','2021-08-15 17:10:55',0,NULL),
	('46eb6118-488a-40c7-a9cf-f09a1330d60d','Unit','Test',NULL,'2021-08-16 20:49:29','2021-08-16 20:49:29',0,NULL),
	('4f262688-6a9c-4cd2-acd6-0e36a2240b92','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-15 17:10:16','2021-08-15 17:10:16',0,NULL),
	('4f486a67-046f-4b80-99a3-ca52f11f5ee4','Unit','Test',NULL,'2021-06-19 17:18:50','2021-06-19 17:18:50',1,NULL),
	('5b5def5a-8962-4416-90c3-edbb48b338a7','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-16 20:46:00','2021-08-16 20:46:00',0,NULL),
	('5b9a5f2f-39f6-4b46-b595-6a412cb083ea','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-16 20:47:39','2021-08-16 20:47:39',0,NULL),
	('5dbfee9d-6a86-4b4a-81a5-b5a0fcd36222','Unit','Test',NULL,'2021-06-19 16:52:04','2021-06-19 16:52:01',1,NULL),
	('600aec5a-d220-4c40-aba4-17e7b32b4e98','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-16 20:39:17','2021-08-16 20:39:17',0,NULL),
	('6473a323-98d9-4c2f-a6c6-a1922e22a44c','Unit','Test',NULL,'2021-06-19 17:05:30','2021-06-19 17:05:29',1,NULL),
	('682339bb-4ed1-4db9-9637-bfbb9cf09b23','Unit','Test',NULL,'2021-06-19 17:03:12','2021-06-19 17:03:12',1,NULL),
	('86964f1f-b243-4b62-aee5-38433a02e6c0','Unit','Test',NULL,'2021-06-19 16:49:45','2021-06-19 16:49:43',1,NULL),
	('909d2211-740e-4b43-ab06-61fa29e34116','Unit','Test',NULL,'2021-08-16 20:39:16','2021-08-16 20:39:16',0,NULL),
	('91a8eded-f02a-4fbe-8d03-d740ec9a8f59','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-15 17:11:42','2021-08-15 17:11:42',0,NULL),
	('9681bcd0-71db-4917-ad02-32efc86411dc','Unit','Test',NULL,'2021-06-19 16:55:50','2021-06-19 16:55:49',1,NULL),
	('9860db01-d8bf-4828-8702-15021842fcb5','Unit','Test',NULL,'2021-08-15 17:04:40','2021-08-15 17:04:40',0,NULL),
	('9e4ae795-1cd1-418c-8dcd-87c57181c7b5','david2','Meikle',NULL,'2021-06-18 10:15:53','2021-06-18 10:15:53',1,NULL),
	('a1a1491f-3544-43fa-9b1e-f4f4b0bdff27','emails/userinvites/test','emails/userinvites/test',NULL,'2021-08-16 20:36:12','2021-08-16 20:36:12',0,NULL),
	('abcf8a2b-d065-4687-b529-c0fc6f497b3d','david','Meikle',NULL,'2021-06-18 23:08:53','2021-06-18 23:08:53',1,NULL),
	('b0aeee95-e999-4e21-9eae-fb89010cb938','Unit','Test',NULL,'2021-06-19 17:30:13','2021-06-19 17:30:13',1,NULL),
	('bce46582-3c8f-4fb3-896c-5ddbe0778458','david','Meikle',NULL,'2021-06-18 23:08:25','2021-06-18 23:08:25',1,NULL),
	('ce565e86-4d4f-4773-a5c0-a63a3c588160','Unit','Test',NULL,'2021-06-19 16:34:06','2021-06-19 16:34:06',1,NULL),
	('ce81e114-090d-4d02-93e9-8b01cb9a82b5','Unit','Test',NULL,'2021-06-19 17:14:38','2021-06-19 17:14:37',1,NULL),
	('d062152d-03a7-4484-a951-e6fabd2ccce6','Unit','Test',NULL,'2021-06-19 17:06:45','2021-06-19 17:06:45',1,NULL),
	('d73cc933-0331-42ba-a631-9a470ad13731','Unit','Test',NULL,'2021-06-18 23:04:17','2021-08-16 20:49:29',1,NULL),
	('e14305f9-8264-4d59-ad71-ee32b9c41251','david','Meikle',NULL,'2021-06-18 23:07:12','2021-06-18 23:07:12',1,NULL),
	('e2f56fd1-19a8-4cd4-9a44-8a4b51ea5160','Unit','Test',NULL,'2021-08-16 20:47:38','2021-08-16 20:47:38',0,NULL),
	('e430dad1-74fe-4119-aad5-d54dcfb935e5','Unit','Test',NULL,'2021-06-19 16:35:46','2021-06-19 16:35:46',1,NULL),
	('e6fc5979-8d0f-4b92-8786-734b63fd71cc','Unit','Test',NULL,'2021-06-19 17:33:40','2021-06-19 17:33:40',1,NULL),
	('f7838968-9ea1-4b59-911c-8996249241a2','Unit','Test',NULL,'2021-06-19 16:53:51','2021-06-19 16:53:50',1,NULL);



/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

# Dump of table survey_response_headers
# ------------------------------------------------------------
/*
DROP TABLE IF EXISTS `surveys_user_response_headers`;

CREATE TABLE IF NOT EXISTS `gossamer3`.`surveys_user_response_headers` (
    `id` VARCHAR(36) NOT NULL,
    `Surveys_id` VARCHAR(36) NOT NULL,
    `date_created` DATETIME NULL,
    `Organizations_Users_id` VARCHAR(36) NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_surh_srvs_idx` (`Surveys_id` ASC),
    INDEX `fk_surh_oui_idx` (`Organizations_Users_id` ASC),
    CONSTRAINT `fk_surh_srvs`
    FOREIGN KEY (`Surveys_id`)
    REFERENCES `gossamer3`.`surveys` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_surh_oui`
    FOREIGN KEY (`Organizations_Users_id`)
    REFERENCES `gossamer3`.`organizations_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

*/
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
