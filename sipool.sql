/*
SQLyog Ultimate v11.21 (64 bit)
MySQL - 5.5.27 : Database - sipool
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `gsfw_group_access` */

DROP TABLE IF EXISTS `gsfw_group_access`;

CREATE TABLE `gsfw_group_access` (
  `GroupId` bigint(20) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL DEFAULT '',
  `Description` text NOT NULL,
  `UnitappId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`GroupId`),
  UNIQUE KEY `uk_gsfw_group` (`GroupName`,`UnitappId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gsfw_group_access` */

insert  into `gsfw_group_access`(`GroupId`,`GroupName`,`Description`,`UnitappId`) values (1,'Administrator','Administrator Aplikasi',NULL),(2,'Manajer','Manajer Perusahaan',NULL);

/*Table structure for table `gsfw_group_menu` */

DROP TABLE IF EXISTS `gsfw_group_menu`;

CREATE TABLE `gsfw_group_menu` (
  `GroupMenuGroupId` bigint(20) NOT NULL,
  `GroupMenuMenuId` bigint(20) NOT NULL,
  KEY `gsfw_group_menu_userid` (`GroupMenuMenuId`),
  KEY `gsfw_group_menu_groupid` (`GroupMenuGroupId`),
  CONSTRAINT `gsfw_group_menu_groupid` FOREIGN KEY (`GroupMenuGroupId`) REFERENCES `gsfw_group_access` (`GroupId`),
  CONSTRAINT `gsfw_group_menu_menuid` FOREIGN KEY (`GroupMenuMenuId`) REFERENCES `gsfw_menu` (`MenuId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gsfw_group_menu` */

insert  into `gsfw_group_menu`(`GroupMenuGroupId`,`GroupMenuMenuId`) values (2,1),(2,7),(1,1),(1,2),(1,3),(1,4),(1,8),(1,5),(1,6),(1,7);

/*Table structure for table `gsfw_group_user` */

DROP TABLE IF EXISTS `gsfw_group_user`;

CREATE TABLE `gsfw_group_user` (
  `UserId` bigint(20) NOT NULL DEFAULT '0',
  `GroupId` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`,`GroupId`),
  KEY `gsfw_group_user_group` (`GroupId`),
  CONSTRAINT `gsfw_group_user_group` FOREIGN KEY (`GroupId`) REFERENCES `gsfw_group_access` (`GroupId`),
  CONSTRAINT `gsfw_group_user_id` FOREIGN KEY (`UserId`) REFERENCES `gsfw_user` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gsfw_group_user` */

insert  into `gsfw_group_user`(`UserId`,`GroupId`) values (1,1),(2,2);

/*Table structure for table `gsfw_menu` */

DROP TABLE IF EXISTS `gsfw_menu`;

CREATE TABLE `gsfw_menu` (
  `MenuId` bigint(20) NOT NULL AUTO_INCREMENT,
  `MenuParentId` bigint(20) NOT NULL,
  `MenuName` varchar(255) NOT NULL,
  `MenuIsShow` enum('Yes','No') NOT NULL,
  `MenuIcon` varchar(255) NOT NULL,
  `MenuOrder` char(10) DEFAULT NULL,
  PRIMARY KEY (`MenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `gsfw_menu` */

insert  into `gsfw_menu`(`MenuId`,`MenuParentId`,`MenuName`,`MenuIsShow`,`MenuIcon`,`MenuOrder`) values (1,0,'Dashboard','Yes','',NULL),(2,0,'Users Management','Yes','',NULL),(3,2,'Group Users','Yes','',NULL),(4,2,'Users','Yes','',NULL),(5,0,'Referency Management','Yes','',NULL),(6,5,'Company','Yes','',NULL),(7,0,'Project Management','Yes','',NULL),(8,2,'Tambahan User','Yes','',NULL);

/*Table structure for table `gsfw_user` */

DROP TABLE IF EXISTS `gsfw_user`;

CREATE TABLE `gsfw_user` (
  `UserId` bigint(20) NOT NULL AUTO_INCREMENT,
  `RealName` varchar(100) NOT NULL DEFAULT '',
  `UserName` varchar(32) NOT NULL DEFAULT '',
  `Password` varchar(32) NOT NULL DEFAULT '',
  `Description` text,
  `NoPassword` enum('Yes','No') NOT NULL DEFAULT 'No',
  `Active` enum('Yes','No') NOT NULL DEFAULT 'No',
  `ForceLogout` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `uk_UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gsfw_user` */

insert  into `gsfw_user`(`UserId`,`RealName`,`UserName`,`Password`,`Description`,`NoPassword`,`Active`,`ForceLogout`) values (1,'Galihsamedia','galihsam','2d7d765cbffa9bd8b57d1c34b1c37777','Administrator','No','Yes','No'),(2,'Guest','guest','9ef522dc78da5c73e12b0ea6419fa08c','Administrator','No','Yes','No');

/*Table structure for table `proman_company_ref` */

DROP TABLE IF EXISTS `proman_company_ref`;

CREATE TABLE `proman_company_ref` (
  `CompanyId` bigint(20) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) NOT NULL,
  `CompanyAddress` varchar(100) NOT NULL,
  `CompanyNoTelp` varchar(15) DEFAULT NULL,
  `CompanyDescription` varchar(100) NOT NULL,
  `CompanyStatusAktif` enum('Active','Not Active') DEFAULT NULL,
  `CompanyCreationDate` datetime NOT NULL,
  `CompanyLastUpdate` datetime NOT NULL,
  `CompanyUserEntry` bigint(20) NOT NULL,
  PRIMARY KEY (`CompanyId`),
  UNIQUE KEY `uk_CompanyName` (`CompanyName`),
  KEY `proman_company_ref_user` (`CompanyUserEntry`),
  CONSTRAINT `proman_company_ref_user` FOREIGN KEY (`CompanyUserEntry`) REFERENCES `gsfw_user` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `proman_company_ref` */

insert  into `proman_company_ref`(`CompanyId`,`CompanyName`,`CompanyAddress`,`CompanyNoTelp`,`CompanyDescription`,`CompanyStatusAktif`,`CompanyCreationDate`,`CompanyLastUpdate`,`CompanyUserEntry`) values (1,'PT. PERTAMINA DRILLING SERVICES INDONESIA','Indonesia',NULL,'None','Active','2015-08-16 23:54:32','2015-08-17 02:55:40',1),(2,'PT. PERTAMINA EP','Indonesia',NULL,'None','Active','2015-08-16 23:55:19','2015-08-16 23:55:19',1),(3,'PT. COSL INDO - Cementing Div','Indonesia',NULL,'None','Active','2015-08-16 23:55:33','2015-08-17 00:52:57',1),(4,'PT. COSL INDO - Stimulation Div','Indonesia',NULL,'None','Active','2015-08-16 23:55:56','2015-08-16 23:55:56',1),(5,'PT. GALIHSAMEDIA INDONESIA RAYA','Yogyakarta, Indonesia.','+62857999977707','None...','Not Active','2015-08-20 10:44:11','2015-08-20 12:34:09',1);

/*Table structure for table `proman_project` */

DROP TABLE IF EXISTS `proman_project`;

CREATE TABLE `proman_project` (
  `ProjectId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ProjectCode` varchar(100) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `ProjectCompanyId` bigint(20) NOT NULL,
  `ProjectDescription` longtext NOT NULL,
  `ProjectStatus` enum('Processing','Done') DEFAULT NULL,
  `ProjectCreationDate` datetime NOT NULL,
  `ProjectLastUpdate` datetime NOT NULL,
  `ProjectUserEntry` bigint(20) NOT NULL,
  PRIMARY KEY (`ProjectId`),
  KEY `proman_project_userid` (`ProjectUserEntry`),
  KEY `proman_project_company` (`ProjectCompanyId`),
  CONSTRAINT `proman_project_company` FOREIGN KEY (`ProjectCompanyId`) REFERENCES `proman_company_ref` (`CompanyId`),
  CONSTRAINT `proman_project_userid` FOREIGN KEY (`ProjectUserEntry`) REFERENCES `gsfw_user` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `proman_project` */

insert  into `proman_project`(`ProjectId`,`ProjectCode`,`ProjectName`,`ProjectCompanyId`,`ProjectDescription`,`ProjectStatus`,`ProjectCreationDate`,`ProjectLastUpdate`,`ProjectUserEntry`) values (1,'PRO/COSL/15/A/01','Mob KJV/Ancol - Kurau/Riau',4,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-01-01 02:59:18','2015-01-01 02:59:18',1),(2,'PRO/COSL/15/A/02','Mob Moilong/Luwuk - KJV/Ancol',4,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-02-17 03:05:01','2015-02-17 03:05:01',1),(3,'PRO/EP/15/B/01','Mob X-tree : Batam/Kepri - Cepu/Jateng',2,'none','Done','2015-03-17 03:05:20','2015-03-17 03:05:20',1),(4,'PRO/PDSI/15/03','Mob Kapuk/Jkt - Lumut Balai/Sumsel',1,'none','Done','2015-04-17 03:05:37','2015-04-17 03:05:37',1),(5,'PRO/COSL/15/B/01','Sewa Crane 45 Ton - 1',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-05-17 03:06:02','2015-05-17 03:06:02',1),(6,'PRO/EP/15/B/02','Mob Lubricator : PDM Bekasi - Cepu/Jateng',2,'none','Done','2015-06-17 03:06:24','2015-06-17 03:06:24',1),(7,'PRO/COSL/15/B/02','Sewa Crane 45 Ton - 2',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Processing','2015-07-17 03:06:37','2015-07-17 03:06:37',1),(8,'PRO/PDSI/15/01','Mob Sunter/Jkt - Ullubellu/Lampung',1,'none','Done','2015-08-17 03:07:02','2015-08-12 03:07:02',1),(9,'PRO/PDSI/15/02','Mob Cilegon - Ullubellu/Lampung',1,'none','Processing','2015-08-14 03:07:13','2015-08-14 03:07:13',1),(10,'PRO/COSL/15/B/03','Sewa Crane 45 Ton - 3',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Processing','2015-08-18 03:07:33','2015-08-18 03:07:33',1),(11,'PRO/EP/15/A/01','Mob Casing : PT Citra Tubindo/Batam - Prabumulih/Sumsel',2,'none','Processing','2015-08-19 03:08:02','2015-08-19 03:08:02',1),(12,'PRO/COSL/15/B/04','Sewa Crane 45 Ton - 4',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Processing','2015-08-20 03:08:15','2015-08-20 03:08:15',1),(13,'PRO/COSL/15/B/06','Land Transportation : Bojonegoro Warehouse - Blora (Cepu)',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-01-17 03:08:28','2015-01-17 03:08:28',1),(14,'PRO/COSL/15/B/05','Sewa Crane 45 Ton - 5',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-02-17 03:08:42','2015-02-17 03:08:42',1),(15,'PRO/PDSI/15/04','Mob Plumpang - Prabumulih/Sumsel',1,'none','Done','2015-02-17 03:08:54','2015-02-17 03:08:54',1),(16,'PRO/PDSI/15/05','Mob Ullubellu - Kamojang/Jabar',1,'none','Done','2015-02-17 03:09:05','2015-02-17 03:09:05',1),(17,'PRO/COSL/15/B/07','Mob Tuban/Jatim - Cepu/Jatim - 2',3,'Lorem ipsum Consequat culpa velit nulla exercitation do laboris voluptate consectetur velit qui commodo nostrud ea do enim irure ea dolor nulla proident dolore voluptate ad nisi fugiat ad reprehenderit minim mollit sunt ea ullamco.','Done','2015-03-17 03:09:17','2015-03-17 03:09:17',1),(18,'PRO/PDSI/15/06','Mob Bunyu/Kaltim - Tarakan/Kaltim',1,'none','Done','2015-04-17 03:09:30','2015-04-17 03:09:30',1),(19,'PRO/EP/15/A/02','Mob Rantau Aceh - Pagardewa/Sumsel',2,'none','Processing','2015-04-17 03:09:41','2015-04-17 03:09:41',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
