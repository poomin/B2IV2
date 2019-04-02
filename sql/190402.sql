-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_b2i_v2
CREATE DATABASE IF NOT EXISTS `db_b2i_v2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_b2i_v2`;

-- Dumping structure for table db_b2i_v2.b2i_school
DROP TABLE IF EXISTS `b2i_school`;
CREATE TABLE IF NOT EXISTS `b2i_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) NOT NULL COMMENT 'ชื่อโรงเรียน',
  `address` varchar(255) DEFAULT NULL COMMENT 'ที่อยู่',
  `subdistrict` varchar(255) DEFAULT NULL COMMENT 'ตำบล',
  `district` varchar(255) DEFAULT NULL COMMENT 'อำเภอ',
  `province` varchar(255) DEFAULT NULL COMMENT 'จังหวัด',
  `code` varchar(255) DEFAULT NULL COMMENT 'รหัสไปรษณี',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_name` (`school_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_b2i_v2.b2i_user
DROP TABLE IF EXISTS `b2i_user`;
CREATE TABLE IF NOT EXISTS `b2i_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `schoolname` varchar(255) DEFAULT NULL,
  `schoolregion` varchar(255) DEFAULT NULL COMMENT 'ภาค เหนือ ใต้ ออก ตก ตะวันออกเฉียงเหนือ',
  `role` enum('student','teacher','admin','board','company') NOT NULL DEFAULT 'student' COMMENT 'สถานะ student , teacher , admin , board ,company',
  `confirmemail` enum('n','y') NOT NULL DEFAULT 'n',
  `userremove` enum('n','y') NOT NULL DEFAULT 'n',
  `image_path` varchar(255) DEFAULT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ข้อมูลสมาชิก';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
