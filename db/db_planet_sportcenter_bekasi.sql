/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.11-MariaDB : Database - db_planet_sportcenter_bekasi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_planet_sportcenter_bekasi` /*!40100 DEFAULT  */;

USE `db_planet_sportcenter_bekasi`;

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(30)  DEFAULT NULL,
  `nama_rekening` varchar(30)  DEFAULT NULL,
  `no_rekening` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id_bank`,`nama_bank`,`nama_rekening`,`no_rekening`) values 
(1,'BCA','PT. Planet Sport Center Bekasi',77889966);

/*Table structure for table `bayar` */

DROP TABLE IF EXISTS `bayar`;

CREATE TABLE `bayar` (
  `id_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `bank` varchar(30) DEFAULT NULL,
  `no_rekening` varchar(30) DEFAULT NULL,
  `jumlah_transfer` int(11) DEFAULT NULL,
  `file` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bayar` */

insert  into `bayar`(`id_bayar`,`id_transaksi`,`bank`,`no_rekening`,`jumlah_transfer`,`file`) values 
(8,2020050007,'asd','12314',100000,'2020050007.png');

/*Table structure for table `harga` */

DROP TABLE IF EXISTS `harga`;

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL AUTO_INCREMENT,
  `id_lapangan` int(11) DEFAULT NULL,
  `id_hari` int(11) DEFAULT NULL,
  `id_waktu` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_harga`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `harga` */

insert  into `harga`(`id_harga`,`id_lapangan`,`id_hari`,`id_waktu`,`harga`) values 
(1,1,2,1,0),
(17,1,2,2,10),
(3,1,2,3,180000),
(4,2,2,3,180000),
(5,2,2,2,0),
(6,2,2,1,0),
(14,3,3,3,200000),
(8,3,3,4,100000),
(12,1,2,4,200000),
(13,1,2,5,200000),
(15,1,1,15,150000),
(16,1,2,6,100000),
(18,2,1,15,150000);

/*Table structure for table `hari` */

DROP TABLE IF EXISTS `hari`;

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hari` varchar(10)  DEFAULT NULL,
  PRIMARY KEY (`id_hari`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `hari` */

insert  into `hari`(`id_hari`,`nama_hari`) values 
(1,'Minggu'),
(2,'Senin'),
(3,'Selasa'),
(4,'Rabu'),
(5,'Kamis'),
(6,'Jumat'),
(7,'Sabtu');

/*Table structure for table `jenis_lapangan` */

DROP TABLE IF EXISTS `jenis_lapangan`;

CREATE TABLE `jenis_lapangan` (
  `id_jenis_lapangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_lapangan` varchar(50)  DEFAULT NULL,
  `deskripsi` text  DEFAULT NULL,
  PRIMARY KEY (`id_jenis_lapangan`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_lapangan` */

insert  into `jenis_lapangan`(`id_jenis_lapangan`,`nama_jenis_lapangan`,`deskripsi`) values 
(1,'LANTAI KARPET VINYL','Lapangan terbuat dari karet empuk'),
(2,'LANTAI KAYU','Lantai lapangan terbuat dari papan kayu keset');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` text  DEFAULT NULL,
  `id_harga` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

insert  into `keranjang`(`id_keranjang`,`id_session`,`id_harga`,`tanggal`,`tgl_transaksi`) values 
(20,'m4e87alj95jvrud9enbork3kma',7,'2020-05-12','2020-05-12');

/*Table structure for table `lapangan` */

DROP TABLE IF EXISTS `lapangan`;

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lapangan` varchar(30)  DEFAULT NULL,
  `id_jenis_lapangan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lapangan`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `lapangan` */

insert  into `lapangan`(`id_lapangan`,`nama_lapangan`,`id_jenis_lapangan`) values 
(1,'Lapangan 1',1),
(2,'Lapangan 2',1),
(3,'Lapangan 3',1),
(4,'Lapangan 1',2),
(5,'Lapangan 2',2),
(6,'Lapangan 3',2);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(30)  DEFAULT NULL,
  `no_telp` varchar(13)  DEFAULT NULL,
  `email` varchar(30)  DEFAULT NULL,
  `password` varchar(10)  DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`no_telp`,`email`,`password`) values 
(1,'test','08998899022','test@gmail.com','123456'),
(5,'s','1111','s@gmail.com','123456');

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `nama_profil` varchar(50)  DEFAULT NULL,
  `no_telp` varchar(13)  DEFAULT NULL,
  `no_hp` varchar(13)  DEFAULT NULL,
  `email` varchar(30)  DEFAULT NULL,
  `alamat` text  DEFAULT NULL,
  `about` text  DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `profil` */

insert  into `profil`(`id_profil`,`nama_profil`,`no_telp`,`no_hp`,`email`,`alamat`,`about`) values 
(1,'PT. Planet Sport Center Bekasi','123456','98566776655',NULL,'Jl. Cut mutiah No. 19 Bekasi','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `status` enum('MENUNGGU PEMBAYARAN','DIPROSES','BATAL','SELESAI')  DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=2020050010 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_pelanggan`,`status`,`tgl_transaksi`,`id_bayar`) values 
(2020050009,1,'MENUNGGU PEMBAYARAN','2020-05-12',NULL),
(2020050008,1,'MENUNGGU PEMBAYARAN','2020-05-12',NULL),
(2020050007,5,'SELESAI','2020-05-11',8),
(2020050006,5,'BATAL','2020-05-11',NULL),
(2020050005,5,'BATAL','2020-05-11',NULL);

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_tansaksi_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_hari` int(11) DEFAULT NULL,
  `id_waktu` int(11) DEFAULT NULL,
  `id_lapangan` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tansaksi_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`id_tansaksi_detail`,`id_transaksi`,`tanggal`,`id_hari`,`id_waktu`,`id_lapangan`,`harga`) values 
(1,2020050001,'2020-05-11',2,3,2,180000),
(2,2020050002,'2020-05-12',3,3,3,100000),
(3,2020050003,'2020-05-11',2,3,1,180000),
(4,2020050004,'2020-05-11',2,3,1,180000),
(5,2020050005,'2020-05-11',2,3,1,180000),
(6,2020050005,'2020-05-11',2,3,2,180000),
(7,2020050006,'2020-05-12',3,4,3,100000),
(8,2020050006,'2020-05-12',3,3,3,100000),
(9,2020050007,'2020-05-11',2,3,2,1800000),
(10,2020050007,'2020-05-11',2,3,1,180000),
(11,2020050008,'2020-05-12',3,3,3,200000),
(12,2020050009,'2020-05-18',2,2,1,10);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama`,`username`,`password`) values 
(1,'admin','admin','123456');

/*Table structure for table `waktu` */

DROP TABLE IF EXISTS `waktu`;

CREATE TABLE `waktu` (
  `id_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` varchar(20)  DEFAULT NULL,
  PRIMARY KEY (`id_waktu`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `waktu` */

insert  into `waktu`(`id_waktu`,`waktu`) values 
(1,'00.00 - 01.00'),
(2,'01.00 - 02.00'),
(3,'06.00 - 07.00'),
(4,'07.00 - 08.00'),
(5,'08.00 - 09.00'),
(6,'09.00 - 10.00'),
(7,'10.00 - 11.00'),
(8,'11.00 - 12.00'),
(9,'12.00 - 13.00'),
(10,'13.00 - 14.00'),
(11,'14.00 - 15.00'),
(12,'15.00 - 16.00'),
(13,'16.00 - 17.00'),
(14,'17.00 - 18.00'),
(15,'18.00 - 19.00'),
(16,'19.00 - 20.00'),
(17,'20.00 - 21.00'),
(18,'21.00 - 22.00'),
(19,'22.00 - 23.00'),
(20,'23.00 - 24.00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
