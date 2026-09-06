-- =====================================================================
-- Instalasi baru TA-TRPL -- SATU file ini menggantikan elusi.sql /
-- tugas_akhir.sql + kelima file migration_*.sql (bidang, proyek_periode,
-- usulan_mitra, usulan_dosen2, sso), digabung jadi satu skema yang sudah
-- final (sudah termasuk semua kolom/tabel dari migrasi tersebut).
--
-- Database DIASUMSIKAN KOSONG (tabel-tabel yang sama akan di-DROP dulu
-- kalau kebetulan sudah ada -- lihat DROP TABLE IF EXISTS di bawah).
-- Ini bukan hasil gabungan manual, tapi mysqldump --no-data dari database
-- lokal yang SUDAH menjalankan kelima migrasi di atas, jadi dijamin cocok
-- dengan kode aplikasi saat ini.
--
-- Isi data HANYA yang wajib ada supaya aplikasi bisa dipakai:
--  - user_role (4 role tetap yang dipakai kode)
--  - SATU akun dosen (dinar.nugroho.p@ugm.ac.id) dengan is_admin=1, sehingga
--    akun ini otomatis dapat akses Panel Admin (Akademik) SEKALIGUS Panel
--    Dosen tanpa perlu akun admin terpisah -- login lewat SSO (Casdoor),
--    dicocokkan otomatis by email saat login pertama kali.
-- Tidak ada data contoh (proyek/periode/bidang/mahasiswa dll) -- tambahkan
-- sendiri lewat Panel Admin begitu siap membuka periode pendaftaran.
--
-- Cara pakai:
--   mysql -u <user> -p <nama_database_baru> < deploy_fresh_install.sql
-- =====================================================================

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `akademik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akademik` (
  `id_akademik` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_akademik`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE,
  CONSTRAINT `akademik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `anggota_sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota_sidang` (
  `id_anggota_sidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_sidang` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_anggota_sidang`) USING BTREE,
  KEY `id_sidang` (`id_sidang`) USING BTREE,
  KEY `id_dosen` (`id_dosen`) USING BTREE,
  CONSTRAINT `anggota_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anggota_sidang_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `berkas_sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `berkas_sidang` (
  `id_berkas_sidang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_berkas_sidang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `berkas_yudisium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `berkas_yudisium` (
  `id_berkas_yudisium` int(11) NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_berkas_yudisium`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_bidang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bimbingan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimbingan` (
  `id_ta` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `progress_percentage` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dosbing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosbing` (
  `id_dosbing` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  PRIMARY KEY (`id_dosbing`) USING BTREE,
  KEY `id_dosen` (`id_dosen`) USING BTREE,
  KEY `id_mahasiswa` (`id_mahasiswa`) USING BTREE,
  CONSTRAINT `dosbing_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dosbing_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `nid` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `skill` text DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `mobile` varchar(128) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kuota_mahasiswa` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dosen`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE,
  CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_sidang` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_sidang` int(11) NOT NULL,
  `waktu` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ruang` varchar(255) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  KEY `id_sidang` (`id_sidang`) USING BTREE,
  CONSTRAINT `jadwal_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `kaprodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaprodi` (
  `id_kaprodi` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nid` int(10) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_akademik` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kaprodi`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE,
  KEY `id_dosen` (`id_dosen`) USING BTREE,
  KEY `id_akademik` (`id_akademik`) USING BTREE,
  CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kaprodi_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kaprodi_ibfk_3` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `komponen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponen` (
  `id_komponen` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_komponen`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `komponen_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komponen_nilai` (
  `id_komponen_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_komponen` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL DEFAULT 0.00,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_komponen_nilai`) USING BTREE,
  KEY `id_komponen` (`id_komponen`) USING BTREE,
  KEY `id_penilaian` (`id_penilaian`) USING BTREE,
  CONSTRAINT `komponen_nilai_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `komponen_nilai_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `log_pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_pesan` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(18) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `ipk` double DEFAULT NULL,
  `jumlah_SKS` int(11) DEFAULT NULL,
  `skill` text DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `pengalaman` text DEFAULT NULL,
  `prodi` varchar(128) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT 'Teknologi Rekayasa Perangkat Lunak',
  `id_user` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_mahasiswa`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE,
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pengajuan_ta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengajuan_ta` (
  `id_pengajuan_ta` int(11) NOT NULL AUTO_INCREMENT,
  `id_ta` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `pilihan` tinyint(4) NOT NULL,
  `status` enum('diterima','proses') NOT NULL DEFAULT 'proses',
  `jenis` enum('usul','proyek') NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pengajuan_ta`) USING BTREE,
  KEY `id_ta` (`id_ta`) USING BTREE,
  KEY `id_proyek` (`id_proyek`) USING BTREE,
  CONSTRAINT `pengajuan_ta_ibfk_1` FOREIGN KEY (`id_ta`) REFERENCES `tugas_akhir` (`id_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_ta_ibfk_2` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pengumuman`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `penilaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_akhir_dosen` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_anggota_sidang` int(11) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `id_sidang` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_penilaian`) USING BTREE,
  KEY `id_sidang` (`id_sidang`) USING BTREE,
  KEY `peniaian_ibfk_3` (`id_anggota_sidang`) USING BTREE,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `status_periode` tinyint(4) NOT NULL,
  `tgl_awal_regis_ta` date DEFAULT NULL,
  `tgl_akhir_regis_ta` date DEFAULT NULL,
  `tgl_awal_regis_yudisium` date DEFAULT NULL,
  `tgl_akhir_regis_yudisium` date DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_periode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `proyek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `klien` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','pending','ditolak') NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `deskripsi` text DEFAULT NULL,
  `tools` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_proyek`) USING BTREE,
  KEY `id_dosen` (`id_dosen`) USING BTREE,
  KEY `id_periode` (`id_periode`),
  CONSTRAINT `fk_proyek_periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE SET NULL,
  CONSTRAINT `proyek_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `proyek_bidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyek_bidang` (
  `id_proyek_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyek` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  PRIMARY KEY (`id_proyek_bidang`),
  UNIQUE KEY `uniq_proyek_bidang` (`id_proyek`,`id_bidang`),
  KEY `id_proyek` (`id_proyek`),
  KEY `id_bidang` (`id_bidang`),
  CONSTRAINT `fk_proyek_bidang_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE CASCADE,
  CONSTRAINT `fk_proyek_bidang_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `revisi_sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revisi_sidang` (
  `id_revisi_sidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota_sidang` int(11) NOT NULL,
  `path` varchar(128) NOT NULL,
  PRIMARY KEY (`id_revisi_sidang`) USING BTREE,
  KEY `id_anggota_sidang` (`id_anggota_sidang`) USING BTREE,
  CONSTRAINT `revisi_sidang_ibfk_1` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sidang` (
  `id_sidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nilai_akhir_sidang` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('disetujui','pending','lulus','lulus_revisi','mengulang') NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_sidang`) USING BTREE,
  KEY `id_mahasiswa` (`id_mahasiswa`) USING BTREE,
  KEY `id_periode` (`id_periode`) USING BTREE,
  CONSTRAINT `sidang_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sidang_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tugas_akhir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tugas_akhir` (
  `id_ta` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `status_pengambilan` enum('proses','terplotting','revisi','lulus') NOT NULL DEFAULT 'proses',
  `id_periode` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `reason` text DEFAULT NULL,
  `progress` int(11) NOT NULL,
  PRIMARY KEY (`id_ta`) USING BTREE,
  KEY `id_mahasiswa` (`id_mahasiswa`) USING BTREE,
  KEY `id_periode` (`id_periode`) USING BTREE,
  CONSTRAINT `tugas_akhir_ibfk_6` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tugas_akhir_ibfk_7` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_role` tinyint(4) NOT NULL,
  `casdoor_id` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `uniq_casdoor_id` (`casdoor_id`),
  KEY `id_user_role` (`id_user_role`) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_role`) REFERENCES `user_role` (`id_user_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id_user_role` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user_role`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usulan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usulan` (
  `id_usulan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajuan_ta` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `mitra` text DEFAULT NULL,
  `file_persetujuan` varchar(128) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_dosen2` int(11) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usulan`) USING BTREE,
  KEY `id_pengajuan_ta` (`id_pengajuan_ta`) USING BTREE,
  KEY `id_dosen` (`id_dosen`) USING BTREE,
  KEY `usulan_ibfk_3` (`id_dosen2`),
  CONSTRAINT `usulan_ibfk_1` FOREIGN KEY (`id_pengajuan_ta`) REFERENCES `pengajuan_ta` (`id_pengajuan_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usulan_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usulan_ibfk_3` FOREIGN KEY (`id_dosen2`) REFERENCES `dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `validasi_berkas_sidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validasi_berkas_sidang` (
  `id_valid_sidang` int(11) NOT NULL AUTO_INCREMENT,
  `id_sidang` int(11) NOT NULL,
  `id_berkas_sidang` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isValid` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_valid_sidang`) USING BTREE,
  KEY `id_sidang` (`id_sidang`) USING BTREE,
  KEY `id_berkas_sidang` (`id_berkas_sidang`) USING BTREE,
  CONSTRAINT `validasi_berkas_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `validasi_berkas_sidang_ibfk_2` FOREIGN KEY (`id_berkas_sidang`) REFERENCES `berkas_sidang` (`id_berkas_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `validasi_berkas_yudisium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validasi_berkas_yudisium` (
  `id_valid_yudisium` int(11) NOT NULL AUTO_INCREMENT,
  `id_yudisium` int(11) NOT NULL,
  `id_berkas_yudisium` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isValid` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_valid_yudisium`) USING BTREE,
  KEY `id_yudisium` (`id_yudisium`) USING BTREE,
  KEY `id_berkas_yudisium` (`id_berkas_yudisium`) USING BTREE,
  CONSTRAINT `validasi_berkas_yudisium_ibfk_1` FOREIGN KEY (`id_yudisium`) REFERENCES `yudisium` (`id_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `validasi_berkas_yudisium_ibfk_2` FOREIGN KEY (`id_berkas_yudisium`) REFERENCES `berkas_yudisium` (`id_berkas_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `yudisium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yudisium` (
  `id_yudisium` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `status` enum('disetujui','pending') NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_yudisium`) USING BTREE,
  KEY `id_mahasiswa` (`id_mahasiswa`) USING BTREE,
  KEY `id_periode` (`id_periode`) USING BTREE,
  CONSTRAINT `yudisium_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yudisium_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

-- =====================================================================
-- SEED DATA -- database kosong, cuma data struktural yang WAJIB ada
-- supaya aplikasi bisa jalan, plus SATU akun dosen yang juga admin.
-- =====================================================================

-- user_role: 4 role tetap yang dipakai kode (ROLE_KAPRODI=1, ROLE_AKADEMIK=2,
-- ROLE_DOSEN=3, ROLE_MAHASISWA=4) -- bukan "sample data", tapi referensi wajib.
INSERT INTO `user_role` (`id_user_role`, `role`) VALUES
(1, 'Kaprodi'),
(2, 'Akademik'),
(3, 'Dosen'),
(4, 'Mahasiswa');

-- Satu akun dosen dengan is_admin=1 -- login lewat SSO (Casdoor) pakai email di
-- bawah, dicocokkan otomatis lewat Login_model::findUserByEmail() saat login
-- pertama kali (casdoor_id ke-link sendiri, tidak perlu diisi manual di sini).
-- Karena is_admin=1, akun ini otomatis dapat akses "Panel Admin" (Akademik)
-- SEKALIGUS "Panel Dosen" tanpa perlu akun kedua terpisah -- lihat
-- BaseController::isAkademik() ($isDosenAdmin bypass).
INSERT INTO `user` (`id_user_role`, `casdoor_id`, `username`, `password`, `nama`, `isDeleted`) VALUES
(3, NULL, 'dinar.nugroho.p', NULL, 'Dinar Nugroho Pratomo', 0);

INSERT INTO `dosen` (`nid`, `nama`, `email`, `mobile`, `isDeleted`, `id_user`, `kuota_mahasiswa`, `is_admin`) VALUES
(NULL, 'Dinar Nugroho Pratomo', 'dinar.nugroho.p@ugm.ac.id', NULL, 0, LAST_INSERT_ID(), 10, 1);

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

