SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `short_url` varchar(255) NOT NULL,
  `long_url` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `urls` (`id`, `short_url`, `long_url`, `created_at`) VALUES
(0000000001,	'/bUNvBq',	'/my-url',	'2020-11-12 22:51:34'),
(0000000002,	'/bUNE0z',	'/example',	'2020-11-13 08:54:09');
