# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.16-MariaDB)
# Database: softuni_trips
# Generation Time: 2019-07-31 12:57:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `maker` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;

INSERT INTO `cars` (`id`, `maker`)
VALUES
	(1,'Audi'),
	(2,'BMW'),
	(3,'Mercedes'),
	(4,'Renault'),
	(5,'Opel'),
	(6,'Other');

/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table trips
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trips`;

CREATE TABLE `trips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) unsigned NOT NULL,
  `total_seats` int(10) NOT NULL,
  `taken_seats` int(10) NOT NULL DEFAULT 0,
  `car_id` int(10) unsigned NOT NULL,
  `from_town` varchar(255) NOT NULL DEFAULT '',
  `to_town` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL,
  `allowed_smokers` char(1) NOT NULL DEFAULT '0',
  `travel_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trips_car__id_cars_id` (`car_id`),
  KEY `FK_trips_user__id_users_id` (`user_id`),
  CONSTRAINT `FK_trips_car__id_cars_id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  CONSTRAINT `FK_trips_user__id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `money_spent` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `money_spent`)
VALUES
	(2,'pesho','$argon2i$v=19$m=1024,t=2,p=2$eHVIN2l1bjFIbXBPSU85WA$aqRCThTwVqPgUdNeSAJ+nVvrE/39sq2tAM8fOygqUm0','pesho','peshov',134.00),
	(3,'pesho2','$argon2i$v=19$m=1024,t=2,p=2$VDBrdktZSTZRMVZKWEdteA$01wCsKfZQ8y19qlKA8BnLWowJHK43D1CpvPeH1JqlkA','pesho','peshov',15.00),
	(4,'pesho3','$argon2i$v=19$m=1024,t=2,p=2$Rkp5RjE5YjJXbi9TZUVCcg$td5MmYAJlIZumO/YQI5NqSOujXJhn8BgIZXnU87ZhS4','Pesho','Peshov',769.00),
	(5,'nov_user','$argon2i$v=19$m=1024,t=2,p=2$MzF3aWtvS09FRllYVkpXSw$5Y6bBw57Vnewnvart05RcxITTXlrs5EzXAbbRB5G0mU','pesho','peshov',3.00),
	(6,'novia_2','$argon2i$v=19$m=1024,t=2,p=2$Zk1mUzdCdGlTdW9JenJlbA$B6i5Yz4ivXinhQ5/I9oOLE1nwor2OBGC51uSLQgZAOM','asdasdas','asdasda',23.00);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
