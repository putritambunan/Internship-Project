-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: log_insiden
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `insiden`
--

DROP TABLE IF EXISTS `insiden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insiden` (
  `no` int NOT NULL AUTO_INCREMENT,
  `waktu_mulai` varchar(50) DEFAULT NULL,
  `kejadian_insiden` text,
  `penyebab` text,
  `tindak_lanjut` text,
  `pencegahan` text,
  `waktu_selesai` varchar(50) DEFAULT NULL,
  `durasi_pencegahan_internal` varchar(50) DEFAULT NULL,
  `durasi_pencegahan_eksternal` varchar(50) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `sumber_laporan` varchar(50) DEFAULT NULL,
  `writen_by` varchar(50) DEFAULT NULL,
  `evidence` varchar(50) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `unit_kerja` varchar(50) DEFAULT NULL,
  `tipe_insiden` varchar(100) DEFAULT NULL,
  `akibat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insiden`
--

LOCK TABLES `insiden` WRITE;
/*!40000 ALTER TABLE `insiden` DISABLE KEYS */;
INSERT INTO `insiden` VALUES (1,'10/03/2025 12:00','IP Publik: api.kemenperin.go.id tidak bisa diakses','IP Publik dari SkiNet: api.kemenperin.go.id di-blacklist oleh Kemenperin','Menghubungi pihak ISP untuk melakukan routing IP lagi sehingga tidak di-blacklist oleh Kemenperin, merubah ip tkdn menjadi ip linknet','Mengamankan kenyamanan masyarkat','23/02/2024 16:00','00:05','46:40:00','Infrastruktur','Internal DTI','Budi','insiden-12.jpg','Luar SI','Luar SI','IP ISP terkena blacklist','User aplikasi TKDN tidak bisa memasukkan data TKDN untuk tender\"'),(2,'02/03/2024 19:00','Koneksi ping SI Palembang down.(ICMP error # 11010). Mulai hari Sabtu-Senin','ISP Cabang Palembang down','Menunggu ISP Cabang Up kembali','Mencoba','04/03/2024 12:40','00:05','41:40:00','Infrastruktur','PRTG','Budi','insiden-13.jpg','SI Palembang','Cab. Palembang','ISP Cabang mati','User cabang Palembang kemungkinan kesulitan untuk meng-akses aplikasi di server Data Center maupun Cloud'),(3,'14/05/2024 00:00','Koneksi ping serv. DRC-App(ICMP error # 11010). Mulai hari Senin jam 19.00','Maintenance rutin pihak pengelola gedung DRC Taman Tecno BSD','Mem-backup secara internal sementara di DataCenter DTI','','15/05/2024 00:00','00:05','24:00:00','Infrastruktur','Email','Budi','insiden17.jpg','DRC Taman Techno BSD','Disaster Recovery Center','Maintenance instalasi DRC','Untuk sementara proses backup dilakukan dan disimpan di DataCenter DTI'),(4,'18/05/2024 00:00','Koneksi ping serv. DRC-App(ICMP error # 11010). Mulai hari Senin jam 19.00','Maintenance rutin pihak pengelola gedung DRC Taman Tecno BSD','Mem-backup secara internal sementara di DataCenter DTI','membuat','19/05/2024 00:00','00:05','24:00:00','Infrastruktur','Email','Budi','gambar_08.jpg','DRC Taman Techno BSD','Disaster Recovery Center','Maintenance instalasi DRC','Untuk sementara proses backup dilakukan dan disimpan di DataCenter DTI'),(5,'07/06/2024 11:00','Koneksi ping SI Palembang down. (ICMP error # 11010). Mulai hari Jum\'at-Senin','ISP Cabang Palembang down','Menunggu ISP Cabang Up kembali','Isi tindakan pencegahan','10/06/2024 18:00','00:05','79:00:00','Infrastruktur','PRTG','Budi','Insiden-14.png','SI Palembang','Cab. Palembang','ISP Cabang mati','User cabang Palembang kemungkinan kesulitan untuk meng-akses aplikasi di server Data Center maupun Cloud'),(6,'19/06/2024 10:00','Server backup mengalami crash Windows di Proxmox dan backup terakhir tercatat tgl 16 Juni 2024','OS Windows di Server Backup (10.3.1.46) crash','Melakukan Roll-Back','','20/06/2024 09:00','00:05','23:00:00','Infrastruktur','PRTG','Budi','gambar_06.jpg','DataCenter DTI','SIHO','Server Backup Crash','Untuk sementara proses backup tidak bisa dilakukan'),(7,'26/06/2024 10:00','Listrik mati','Pemadaman Listrik dari PLN','Backup listrik menggunakan genset','','26/06/2024 13:00','00:05','03:00:00','Infrastruktur','Internal DTI','Budi','gambar_05.jpg','SIHO','SIHO','Pemadaman Listrik','Untuk sementara server/internet mati dan tidak bisa diakses'),(8,'27/06/2024 10:20','Mati listrik selama 10 detik (koneksi akses point lt. 11 terganggu)','Listrik PLN padam','Listrik sudah menyala kembali','','27/06/2024 10:35','00:05','00:15:00','Infrastruktur','PRTG','Budi','gambar_06.jpg','SIHO','SIHO','Pemadaman Listrik','Untuk sementara server/internet mati dan tidak bisa diakses'),(9,'27/06/2024 09:00','ISP Ski-Net down','BTS Adigraha terpantau down','Menunggu ISP Ski-Net Up kembali','','27/06/2024 12:00','00:05','03:00:00','Infrastruktur','PRTG','Budi','insiden-13.jpg','SIHO','SIHO','ISP SIHO down','Untuk sementara koneksi internet ada yang terputus atau lambat'),(10,'09/07/2024 14:00','ISP iForte down','Putus kabel','Menunggu ISP iForte Up kembali','','10/07/2024 06:00','00:05','16:00:00','Infrastruktur','Internal DTI','Budi','insiden17.jpg','SIHO','Lt. 9 (Ruang Direksi)','ISP Lt.9 Down','Jaringan internet dilantai 9 terputus'),(11,'16/07/2024 08:51','Koneksi ke VM gagal','Gangguan Cloud Deka Flexi','Rebuilding Open Virtual Network & Support Module','','16/07/2024 18:00','00:05','09:09:00','Infrastruktur','Internal DTI','Budi','insiden-12.jpg','DRC Taman Techno BSD','DTI','Gangguan Cloud Deka Flexi','Aplikasi di DRC tidak dapat di-akses'),(12,'24/08/2024 09:27','ISP iForte down','FO cut dijarak 190meter dari HH LM Pancoran kearah lastmile (Impact pekerjaan drainase)','Jumper kabel 300meter & Resplicing FO','','25/08/2024 11:20','00:05','25:53:00','Infrastruktur','Internal DTI','Budi','gambar_08.jpg','SIHO','Lt. 9 (Ruang Direksi)','ISP Lt.9 Down','Jaringan internet dilantai 9 terputus'),(13,'03/09/2024 06:52','Tidak bisa konek ke aplikasi SIREBOND, NAV, SIMOFI dari internet luar','IP SkiNet down','Menunggu perbaikan dari pihak ISP SkiNet','','03/09/2024 13:00','00:05','06:08:00','Infrastruktur','Internal DTI','Budi','insiden-11.jpg','Semua Cabang SI','Semua Cabang SI','Gangguan Internet SkiNet down','Aplikasi tidak dapat di akses diluar jaringan SIHO'),(14,'04/09/2024 01:52','Sebagian cabang tidak bisa konek ke aplikasi SIREBOND\r\n','IP SkiNet down\r\n','Menunggu perbaikan dari pihak ISP SkiNet\r\n',NULL,'04/09/2024 17:20','00:05','15:28:00','Infrastruktur','Internal DTI','Budi','Insiden-21.jpeg','SI Pekanbaru, SI Makassar','SI Pekanbaru, SI Makassar','Gangguan Internet SkiNet down\r\n\r\n','Aplikasi SIREBOND tidak bisa diakses di sebagian cabang'),(15,'13/09/2024 06:05','ISP iForte down\r\n','Hasil otdr indikasi fo cut di jarak 4,1km. \r\n','Menunggu perbaikan dari pihak ISP iForte\r\n',NULL,'13/09/2024 13:57','00:05','07:52:00','Infrastruktur','Internal DTI','Cipto','Insiden_15.png','SIHO','DTI','ISP Iforte Down\r\n\r\n','Website yang menggunakan ip public iforte tidak dapat diakses'),(16,'01/11/2024 06:42','ISP Lintasarta down','','Menunggu perbaikan dari pihak ISP Lintasarta','','03/11/2024 08:51','00:05','50:09:00','Infrastruktur','PRTG','Cipto','insiden-11.jpg','SIHO','DTI','ISP Lintasarta Down','Website yang menggunakan ip public lintasarta tidak dapat diakses. Terjadi perlambatan penggunaan akses internet di SIHO. Beberapa cabang tidak bisa mengakses jaringan di SIHO'),(17,'20/10/2024 13:24','Website e-tkdn berubah menjadi web judi online','Terkena serangan hacker dengan merubah konten website menjadi konten judi online dan berusaha menghapus file-file penting di server','-Segera mematikan dns e-tkdn di exabytes dan firewall sophos - Melakukan restore dari hasil backup tgl 15 Oktober 2024 - Mengganti password dan port akses SSH ke server serta meng-aktifkan WAF di firewall - Dilakukan Pen-Test secara internal untuk menilai kerentanan apa saja yang ada','','20/10/2024 22:45','00:05','09:21:00','Security','Internal DTI','Budi','Insiden-23.jpeg','DataCenter DTI','SIHO - DTI','Serangan hacker dari luar','Aplikasi e-tkdn berubah menjadi web judi online'),(18,'29/10/2024 08:54','Website Vendor Management System (VMS), tampilan hanya muncul Apache Web Server jika di-akses oleh sebagian Vendor, sedangkan user Vendor lain ada yang tampil sesuai aplikasi VMS\r\n','IP Publik dari server VMS jika diakses dari luar SIHO (139.255.214.220) tidak sesuai dengan IP yang diterima dari server VMS di dalam SIHO (139.255.214.210)\r\n','Mengganti IP Publik di server VMS dari (139.255.214.210) menjadi (139.255.214.220)\r\n',NULL,'30/10/2024 10:54','00:05','26:00:00','Infrastruktur','Internal DTI','Budi','Insiden-24.jpeg','Eksternal SIHO','SIHO - DMA','Adanya ketidaksesuaian IP Publik di server VMS yang diakses dari luar dan IP Publik yang di cek di i','Website VMS sebagian user ada yang bisa diakses normal, sebagian user lagi ada yang tidak sesuai (muncul Apache Server)'),(19,'25/11/2024 18:00','ISP iForte down\r\n','Hasil otdr dari tebet FO cut dijarak 4,7 km dari POP ke arah lastmile dan saat ini team sudah menemukan titik cut.\r\n','Menunggu perbaikan dari pihak ISP iForte\r\n',NULL,'26/11/2024 05:24','00:05','11:24:00','Infrastruktur','Internal DTI','Cipto','Insiden_17.jpg','SIHO','DTI','ISP Iforte Down\r\n\r\n','Website yang menggunakan ip public iforte tidak dapat diakses'),(20,'30/11/2024 16:17','ISP Lintasarta down','Port Firewall rusak','Mengganti koneksi Lintasarta ke port lain di firewall','membuat baru','02/12/2024 00:00','00:05','31:43:00','Infrastruktur','Internal DTI','Cipto','Insiden_20.png','SIHO','DTI','ISP Lintasarta Down','Website yang menggunakan ip public lintasarta tidak dapat diakses. Terjadi perlambatan penggunaan akses internet di SIHO. Beberapa cabang tidak bisa mengakses jaringan di SIHO'),(21,'31/12/2024 23:44','AC di ruang Server mati','Phase Relay terbakar','Mengganti Phase Relay AC dengan yang baru','Ketika ada jdwal maintenance harus di-cek AC sampai ke Phase Relay','01/01/2025 14:22','00:05','14:38:00','Infrastruktur','Internal DTI','Cipto','insiden-12.jpg','SIHO','DTI','AC Ruang server mati','Suhu ruang server tinggi dan jika tidak segera ditangani bisa merusak hardware server'),(22,'10/03/2025 12:00','terjadi kerusakan','kesalahan teknis','menjaga','merawat','01/01/2025 14:22','00:05','46:40:00','Infrastruktur','PRTG','Budi','gambar_01.jpg','Luar SI','DTI','IP ISP terkena blacklist','Untuk sementara proses backup dilakukan dan disimpan di DataCenter DTI');
/*!40000 ALTER TABLE `insiden` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-27  2:49:08
