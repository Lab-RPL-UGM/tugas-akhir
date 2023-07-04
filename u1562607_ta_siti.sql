/*
 Navicat Premium Data Transfer

 Source Server         : Niagahoster Cosmo Space
 Source Server Type    : MySQL
 Source Server Version : 100520 (10.5.20-MariaDB-cll-lve)
 Source Host           : srv159.niagahoster.com:3306
 Source Schema         : u1562607_ta_siti

 Target Server Type    : MySQL
 Target Server Version : 100520 (10.5.20-MariaDB-cll-lve)
 File Encoding         : 65001

 Date: 05/07/2023 00:18:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akademik
-- ----------------------------
DROP TABLE IF EXISTS `akademik`;
CREATE TABLE `akademik`  (
  `id_akademik` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `id_user` int NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_akademik`) USING BTREE,
  INDEX `id_user`(`id_user` ASC) USING BTREE,
  CONSTRAINT `akademik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akademik
-- ----------------------------
INSERT INTO `akademik` VALUES (3, 'kaprodi', 0, 4, '2018-04-10 19:40:07', '2023-06-09 00:33:01');
INSERT INTO `akademik` VALUES (4, 'Anang', 0, 12, '2018-04-11 11:35:54', '0000-00-00 00:00:00');
INSERT INTO `akademik` VALUES (5, 'Asisten', 0, 22, '2018-04-11 14:45:02', '0000-00-00 00:00:00');
INSERT INTO `akademik` VALUES (6, 'Aan', 0, 82, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `akademik` VALUES (7, 'Beta', 0, 83, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `akademik` VALUES (8, 'Cika', 0, 84, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `akademik` VALUES (9, 'Dwi', 0, 85, '2023-07-01 21:35:51', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for anggota_sidang
-- ----------------------------
DROP TABLE IF EXISTS `anggota_sidang`;
CREATE TABLE `anggota_sidang`  (
  `id_anggota_sidang` int NOT NULL AUTO_INCREMENT,
  `id_sidang` int NOT NULL,
  `id_dosen` int NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota_sidang`) USING BTREE,
  INDEX `id_sidang`(`id_sidang` ASC) USING BTREE,
  INDEX `id_dosen`(`id_dosen` ASC) USING BTREE,
  CONSTRAINT `anggota_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anggota_sidang_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota_sidang
-- ----------------------------
INSERT INTO `anggota_sidang` VALUES (52, 22, 11, '', 'ketua', '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (53, 22, 27, '', 'sekretaris', '2023-06-25 23:07:20', '2023-06-30 21:13:27');
INSERT INTO `anggota_sidang` VALUES (54, 22, 12, '', 'anggota', '2023-06-25 23:07:20', '2023-06-30 21:13:18');
INSERT INTO `anggota_sidang` VALUES (55, 23, 11, '', 'ketua', '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (56, 23, 26, '', 'sekretaris', '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (57, 23, 12, '', 'anggota', '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (58, 25, 12, '', 'ketua', '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (59, 25, 26, '', 'sekretaris', '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (60, 25, 11, '', 'anggota', '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (61, 24, 11, '', 'ketua', '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (62, 24, 27, '', 'sekretaris', '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (63, 24, 12, '', 'anggota', '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (64, 26, 12, '', 'ketua', '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (65, 26, 26, '', 'sekretaris', '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (66, 26, 11, '', 'anggota', '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (67, 28, 26, '', 'ketua', '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (68, 28, 12, '', 'sekretaris', '2023-07-02 23:27:18', '2023-07-03 00:17:43');
INSERT INTO `anggota_sidang` VALUES (69, 28, 11, '', 'anggota', '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (70, 29, 26, '', 'ketua', '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (71, 29, 12, '', 'sekretaris', '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (72, 29, 11, '', 'anggota', '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (73, 30, 26, '', 'ketua', '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (74, 30, 11, '', 'sekretaris', '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (75, 30, 30, '', 'anggota', '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (76, 31, 26, '', 'ketua', '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (77, 31, 11, '', 'sekretaris', '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (78, 31, 12, '', 'anggota', '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (79, 32, 26, '', 'ketua', '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (80, 32, 12, '', 'sekretaris', '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (81, 32, 30, '', 'anggota', '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (82, 33, 11, '', 'ketua', '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (83, 33, 30, '', 'sekretaris', '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (84, 33, 26, '', 'anggota', '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (85, 27, 26, '', 'ketua', '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (86, 27, 12, '', 'sekretaris', '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (87, 27, 11, '', 'anggota', '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (88, 35, 26, '', 'ketua', '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (89, 35, 12, '', 'sekretaris', '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `anggota_sidang` VALUES (90, 35, 11, '', 'anggota', '2023-07-04 23:34:36', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for berkas_sidang
-- ----------------------------
DROP TABLE IF EXISTS `berkas_sidang`;
CREATE TABLE `berkas_sidang`  (
  `id_berkas_sidang` int NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berkas_sidang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berkas_sidang
-- ----------------------------
INSERT INTO `berkas_sidang` VALUES (1, 'Usulan Sidang', 1, '2018-03-27 11:52:45', '2023-07-03 00:22:57');
INSERT INTO `berkas_sidang` VALUES (2, 'KRS Semester Terakhir [ACC DPA]', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:22');
INSERT INTO `berkas_sidang` VALUES (3, 'Rekap Nilai', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:37');
INSERT INTO `berkas_sidang` VALUES (4, 'Kartu Hasil Studi [Semester awal hingga akhir]', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:02');
INSERT INTO `berkas_sidang` VALUES (5, 'Kartu Bimbingan [Min. 6 pertemuan]', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:07');
INSERT INTO `berkas_sidang` VALUES (6, 'Kartu Tanda Mahasiswa', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:16');
INSERT INTO `berkas_sidang` VALUES (7, 'Riwayat Registrasi', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:42');
INSERT INTO `berkas_sidang` VALUES (8, 'Proposal Tugas Akhir', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:31');
INSERT INTO `berkas_sidang` VALUES (9, 'Laporan Tugas Akhir', 0, '2018-03-27 11:52:45', '2023-07-03 23:47:18');
INSERT INTO `berkas_sidang` VALUES (10, 'Cover Laporan TA [ACC dosen pembimbing]', 1, '2018-03-27 11:52:45', '2023-07-03 00:23:11');

-- ----------------------------
-- Table structure for berkas_yudisium
-- ----------------------------
DROP TABLE IF EXISTS `berkas_yudisium`;
CREATE TABLE `berkas_yudisium`  (
  `id_berkas_yudisium` int NOT NULL AUTO_INCREMENT,
  `nama_berkas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berkas_yudisium`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berkas_yudisium
-- ----------------------------
INSERT INTO `berkas_yudisium` VALUES (1, 'Permohonan Yudisium', 1, '2018-03-27 11:53:56', '2023-07-02 22:39:50');
INSERT INTO `berkas_yudisium` VALUES (2, 'Berita Acara', 1, '2018-03-27 11:53:56', '2023-07-02 22:39:55');
INSERT INTO `berkas_yudisium` VALUES (3, 'Surat Tanda Terima Menyerahkan Tugas Akhir & Bebas Perpustakaan UGM', 1, '2018-03-27 11:53:56', '2023-07-02 22:39:22');
INSERT INTO `berkas_yudisium` VALUES (4, 'Poster Hasil Tugas Akhir [ukuran A3]', 1, '2018-03-27 11:53:56', '2023-07-02 22:39:44');
INSERT INTO `berkas_yudisium` VALUES (5, 'Laporan Tugas Akhir [telah direvisi FINAL]', 0, '2018-03-27 11:53:56', '0000-00-00 00:00:00');
INSERT INTO `berkas_yudisium` VALUES (6, 'Ijazah SMA/K Terakhir', 1, '2018-03-27 11:53:56', '2023-07-02 22:40:01');
INSERT INTO `berkas_yudisium` VALUES (7, 'Sertifikat Kemampuan Bahasa Inggris [sesuai ketentuan berlaku]', 1, '2018-03-27 11:53:56', '2023-07-02 22:39:28');
INSERT INTO `berkas_yudisium` VALUES (8, 'Link drive/sistem Proyek Akhir', 0, '2023-07-03 21:52:51', '2023-07-03 22:06:17');
INSERT INTO `berkas_yudisium` VALUES (9, 'Link Proyek Akhir (drive/sistem0', 0, '2023-07-03 22:10:14', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for bimbingan
-- ----------------------------
DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE `bimbingan`  (
  `id_ta` int NOT NULL,
  `subject` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `progress_percentage` int NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bimbingan
-- ----------------------------
INSERT INTO `bimbingan` VALUES (59, 'Bab 2', '20230626220959-Doc1.pdf', 'Bimbingan bab 2', NULL, 0, 'pengajuan', 1, '2023-06-26 22:09:59');
INSERT INTO `bimbingan` VALUES (59, 'Bab 1,2', '20230626221101-Doc1.pdf', 'bab', NULL, 0, 'pengajuan', 2, '2023-06-26 22:11:01');
INSERT INTO `bimbingan` VALUES (59, 'Bab 3', '20230630214845-Doc1.pdf', 'aa', '', 100, 'diterima', 3, '2023-06-30 22:42:32');
INSERT INTO `bimbingan` VALUES (64, 'Bab 1', '20230701220722-Doc1.pdf', 'b', 'Yaa', 80, 'diterima', 4, '2023-07-02 08:30:27');
INSERT INTO `bimbingan` VALUES (65, 'a', '20230701222345-Doc1.pdf', 'b', 'okk', 80, 'diterima', 5, '2023-07-02 10:39:19');
INSERT INTO `bimbingan` VALUES (66, 'a', '20230701223228-Doc1.pdf', 'b', 'ok', 95, 'diterima', 6, '2023-07-02 10:40:47');
INSERT INTO `bimbingan` VALUES (67, 'Bab 1', '20230702081538-Cybersecurity_for_industry_4_0-Warsun_Najib.pdf', 'X', 'ok', 89, 'diterima', 7, '2023-07-03 11:19:54');
INSERT INTO `bimbingan` VALUES (64, 'B', '20230702083241-Cybersecurity_for_industry_4_0-Warsun_Najib.pdf', 'C', 'Ok', 100, 'diterima', 8, '2023-07-02 08:41:22');
INSERT INTO `bimbingan` VALUES (68, 'Bab 2', '20230702110509-Doc1.pdf', 's', 'a', 80, 'diterima', 9, '2023-07-02 11:06:22');
INSERT INTO `bimbingan` VALUES (68, 'b', '20230702110812-Doc1.pdf', 'b', 'ok', 100, 'diterima', 10, '2023-07-02 11:08:49');
INSERT INTO `bimbingan` VALUES (69, 'a', '20230702220044-Doc1.pdf', 'a', 'lanjuttkan', 100, 'diterima', 11, '2023-07-02 22:02:11');
INSERT INTO `bimbingan` VALUES (70, 'a3', '20230702230854-Doc1.pdf', 'a', 'v', 90, 'diterima', 12, '2023-07-02 23:11:07');
INSERT INTO `bimbingan` VALUES (70, 'a3', '20230702231755-Doc1.pdf', 'a', 'acc', 100, 'diterima', 13, '2023-07-02 23:20:28');
INSERT INTO `bimbingan` VALUES (71, 'b', '20230703005213-Doc1.pdf', 'b', 'okk', 89, 'diterima', 14, '2023-07-03 00:52:59');
INSERT INTO `bimbingan` VALUES (71, 'c', '20230703005401-Doc1.pdf', 'c', 'good', 100, 'diterima', 15, '2023-07-03 00:54:36');
INSERT INTO `bimbingan` VALUES (72, 'y', '20230703010435-Doc1.pdf', 'o', 'ok', 100, 'diterima', 16, '2023-07-03 01:05:06');
INSERT INTO `bimbingan` VALUES (67, 'Bab', '20230703112122-Doc1.pdf', 'x', 'ya', 100, 'diterima', 17, '2023-07-03 11:32:23');
INSERT INTO `bimbingan` VALUES (73, 'a', '20230703145922-Doc1.pdf', '', 'ok', 40, 'diterima', 18, '2023-07-03 15:01:44');
INSERT INTO `bimbingan` VALUES (73, 'b', '20230703145947-Doc1.pdf', 'adsfg', 'okk', 80, 'diterima', 19, '2023-07-03 15:02:02');
INSERT INTO `bimbingan` VALUES (73, 'b', '20230703150021-Doc1.pdf', 'x', 'aa', 100, 'diterima', 20, '2023-07-03 15:02:28');
INSERT INTO `bimbingan` VALUES (74, 'bab 5', '20230703152549-Doc1.pdf', 'laporan', 'x', 100, 'diterima', 21, '2023-07-03 15:32:19');
INSERT INTO `bimbingan` VALUES (66, 's', '20230703223457-Doc1.pdf', 'xx', 'oke', 100, 'diterima', 22, '2023-07-03 22:35:56');
INSERT INTO `bimbingan` VALUES (76, 'laporann dan sistem', '20230703234414-Doc1.pdf', 'xx', 'oke', 100, 'diterima', 23, '2023-07-03 23:44:14');
INSERT INTO `bimbingan` VALUES (77, 'Bimbingan laporan dan  sistem', '20230704011206-cth.pdf', 'Bimbingan laporan Bab 1, 2,3 dan sistem', 'Ok lanjutkan', 50, 'diterima', 24, '2023-07-04 01:12:06');
INSERT INTO `bimbingan` VALUES (77, 'Bab 4', '20230704011713-cth.pdf', 'Laporan bab 4', 'ok', 100, 'diterima', 25, '2023-07-04 01:17:13');
INSERT INTO `bimbingan` VALUES (77, 'bab 5', '20230704103056-cth.pdf', 'laporan', 'ok', 0, 'diterima', 26, '2023-07-04 10:30:56');
INSERT INTO `bimbingan` VALUES (77, 'laporan', '20230704103352-cth.pdf', 'laporan bab 1, 2, 3 4,5', NULL, 0, 'pengajuan', 27, '2023-07-04 10:33:52');

-- ----------------------------
-- Table structure for dosbing
-- ----------------------------
DROP TABLE IF EXISTS `dosbing`;
CREATE TABLE `dosbing`  (
  `id_dosbing` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `id_dosen` int NOT NULL,
  PRIMARY KEY (`id_dosbing`) USING BTREE,
  INDEX `id_dosen`(`id_dosen` ASC) USING BTREE,
  INDEX `id_mahasiswa`(`id_mahasiswa` ASC) USING BTREE,
  CONSTRAINT `dosbing_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dosbing_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dosbing
-- ----------------------------
INSERT INTO `dosbing` VALUES (3, 59, 11);
INSERT INTO `dosbing` VALUES (5, 59, 12);
INSERT INTO `dosbing` VALUES (8, 60, 12);
INSERT INTO `dosbing` VALUES (28, 44, 12);
INSERT INTO `dosbing` VALUES (34, 61, 12);
INSERT INTO `dosbing` VALUES (35, 61, 11);
INSERT INTO `dosbing` VALUES (37, 58, 12);
INSERT INTO `dosbing` VALUES (39, 57, 11);
INSERT INTO `dosbing` VALUES (41, 48, 12);
INSERT INTO `dosbing` VALUES (44, 56, 11);
INSERT INTO `dosbing` VALUES (46, 62, 11);
INSERT INTO `dosbing` VALUES (50, 51, 11);
INSERT INTO `dosbing` VALUES (51, 51, 26);
INSERT INTO `dosbing` VALUES (54, 55, 30);
INSERT INTO `dosbing` VALUES (57, 53, 30);
INSERT INTO `dosbing` VALUES (58, 53, 12);
INSERT INTO `dosbing` VALUES (60, 49, 12);
INSERT INTO `dosbing` VALUES (63, 50, 30);
INSERT INTO `dosbing` VALUES (65, 47, 11);
INSERT INTO `dosbing` VALUES (67, 54, 11);
INSERT INTO `dosbing` VALUES (68, 54, 26);
INSERT INTO `dosbing` VALUES (72, 66, 26);
INSERT INTO `dosbing` VALUES (73, 52, 12);

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen`  (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `skill` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mobile` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isDeleted` tinyint NOT NULL,
  `id_user` int NOT NULL,
  `kuota_mahasiswa` int NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `gelar_depan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gelar_belakang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dosen`) USING BTREE,
  INDEX `id_user`(`id_user` ASC) USING BTREE,
  CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dosen
-- ----------------------------
INSERT INTO `dosen` VALUES (11, '1332324324356', 'dosen', 'C++, PHP, Big Data, Javascript', 'imam@gmail.com', '089273833711', NULL, 0, 3, 20, '2018-04-10 19:39:28', '2023-06-25 14:51:10', NULL, NULL);
INSERT INTO `dosen` VALUES (12, '1123213213123', 'kaprodi', NULL, NULL, '08931782138', NULL, 0, 4, 20, '2018-04-10 19:40:07', '2023-06-15 22:12:43', NULL, NULL);
INSERT INTO `dosen` VALUES (26, '11234345234', 'Hanung', NULL, NULL, '085712337831', NULL, 0, 35, 20, '2018-04-17 17:16:22', '2023-06-15 21:50:16', 'Drs.', 'S.Kom, M.Kom');
INSERT INTO `dosen` VALUES (27, '11183341444', 'Bramantyo', NULL, NULL, '081238327383', NULL, 0, 36, 0, '2018-04-17 17:16:22', '2023-06-14 22:17:10', 'Prof.', 'S. Kom., M., Kom.');
INSERT INTO `dosen` VALUES (28, '13211323124', 'Coky', NULL, NULL, '085712371331', NULL, 0, 37, 0, '2018-04-17 17:16:22', '2018-04-30 15:27:30', NULL, NULL);
INSERT INTO `dosen` VALUES (29, '19231234325', 'Galuh', NULL, NULL, '089123831145', NULL, 1, 38, 0, '2018-04-17 17:16:22', '2023-06-25 13:55:14', NULL, NULL);
INSERT INTO `dosen` VALUES (30, '19108502', 'Aan', NULL, NULL, NULL, NULL, 0, 64, 5, '2023-06-15 22:35:16', '2023-07-04 00:48:31', 'Dr.', 'S. Kom., M., Kom.');
INSERT INTO `dosen` VALUES (31, '19108503', 'Beta', NULL, NULL, NULL, NULL, 0, 65, 0, '2023-06-15 22:35:16', '2023-06-21 14:58:08', '', 'S. Kom., M., Kom.');
INSERT INTO `dosen` VALUES (32, '19108504', 'Cika', NULL, NULL, NULL, NULL, 0, 66, 0, '2023-06-15 22:35:16', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `dosen` VALUES (33, '19108505', 'Dwi', NULL, NULL, NULL, NULL, 0, 67, 10, '2023-06-15 22:35:16', '2023-06-21 15:28:30', 'Prof.', 'S. Kom., M., Kom.');

-- ----------------------------
-- Table structure for jadwal_sidang
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_sidang`;
CREATE TABLE `jadwal_sidang`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_sidang` int NOT NULL,
  `waktu` time NULL DEFAULT NULL,
  `waktu_selesai` time NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `ruang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  INDEX `id_sidang`(`id_sidang` ASC) USING BTREE,
  CONSTRAINT `jadwal_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jadwal_sidang
-- ----------------------------
INSERT INTO `jadwal_sidang` VALUES (1, 22, '08:00:00', '10:00:00', '2023-07-04', 'gedung', '2023-06-25 23:07:20', '2023-07-02 11:30:34');
INSERT INTO `jadwal_sidang` VALUES (2, 23, '22:44:00', '09:35:00', '2023-06-29', '1', '2023-06-29 22:44:41', '2023-06-30 21:36:49');
INSERT INTO `jadwal_sidang` VALUES (3, 25, '08:00:00', '10:00:00', '2023-07-03', 'gedung', '2023-07-02 11:31:18', '2023-07-02 11:42:19');
INSERT INTO `jadwal_sidang` VALUES (4, 24, '14:04:00', '14:06:00', '2023-07-03', 'asdasd', '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (5, 26, '08:00:00', '10:00:00', '2023-07-03', 'gedung', '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (6, 28, '08:00:00', '09:26:00', '2023-07-07', 'sidang', '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (7, 29, '08:00:00', '10:00:00', '2023-07-04', 'gedung', '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (8, 30, '08:00:00', '10:00:00', '2023-07-07', 'gedung', '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (9, 31, '08:00:00', '10:00:00', '2023-07-04', 'Ruang', '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (10, 32, '08:00:00', '10:00:00', '2023-07-04', 'Ruang', '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (11, 33, '08:00:00', '10:00:00', '2023-07-07', 'Ruang', '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (12, 27, '08:00:00', '10:00:00', '2023-07-07', 'Ruang', '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `jadwal_sidang` VALUES (13, 35, '08:00:00', '10:00:00', '2023-07-07', 'gedung', '2023-07-04 23:34:36', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for kaprodi
-- ----------------------------
DROP TABLE IF EXISTS `kaprodi`;
CREATE TABLE `kaprodi`  (
  `id_kaprodi` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nid` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int NOT NULL,
  `id_dosen` int NOT NULL,
  `id_akademik` int NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kaprodi`) USING BTREE,
  INDEX `id_user`(`id_user` ASC) USING BTREE,
  INDEX `id_dosen`(`id_dosen` ASC) USING BTREE,
  INDEX `id_akademik`(`id_akademik` ASC) USING BTREE,
  CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kaprodi_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kaprodi_ibfk_3` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kaprodi
-- ----------------------------
INSERT INTO `kaprodi` VALUES (1, 'kaprodi', NULL, 4, 12, 3, 0, '2018-04-10 19:40:07', '2023-06-09 00:33:01');

-- ----------------------------
-- Table structure for komponen
-- ----------------------------
DROP TABLE IF EXISTS `komponen`;
CREATE TABLE `komponen`  (
  `id_komponen` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komponen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komponen
-- ----------------------------
INSERT INTO `komponen` VALUES (1, 'Tata Bahasa', 1, '2018-03-05 15:03:15', '2023-07-03 09:31:34');
INSERT INTO `komponen` VALUES (2, 'Bahasa', 1, '2018-04-03 19:50:01', '2023-07-03 09:31:15');
INSERT INTO `komponen` VALUES (3, 'Kesesuaian Rancangan dengan Hasil', 1, '2018-04-03 19:50:27', '2023-07-03 09:32:07');
INSERT INTO `komponen` VALUES (4, 'Inovasi/Kompleksitas/Aplikatif', 0, '2018-04-03 19:50:47', '0000-00-00 00:00:00');
INSERT INTO `komponen` VALUES (5, 'Rumusan Masalah', 1, '2018-04-03 19:50:55', '2023-07-03 09:31:28');
INSERT INTO `komponen` VALUES (6, 'Tujuan', 1, '2018-04-03 19:51:00', '2023-07-03 09:31:41');
INSERT INTO `komponen` VALUES (7, 'Metode dan Perancangan', 1, '2018-04-03 19:51:11', '2023-07-03 09:31:52');
INSERT INTO `komponen` VALUES (8, 'Analisis Hasil/Pembahasan', 0, '2018-04-03 19:51:24', '0000-00-00 00:00:00');
INSERT INTO `komponen` VALUES (9, 'Kesimpulan', 1, '2018-04-03 19:51:33', '2023-07-03 09:32:00');
INSERT INTO `komponen` VALUES (10, 'Presentasi', 0, '2018-04-03 19:51:40', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for komponen_nilai
-- ----------------------------
DROP TABLE IF EXISTS `komponen_nilai`;
CREATE TABLE `komponen_nilai`  (
  `id_komponen_nilai` int NOT NULL AUTO_INCREMENT,
  `id_komponen` int NOT NULL,
  `id_penilaian` int NOT NULL,
  `nilai` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komponen_nilai`) USING BTREE,
  INDEX `id_komponen`(`id_komponen` ASC) USING BTREE,
  INDEX `id_penilaian`(`id_penilaian` ASC) USING BTREE,
  CONSTRAINT `komponen_nilai_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `komponen_nilai_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 286 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komponen_nilai
-- ----------------------------
INSERT INTO `komponen_nilai` VALUES (1, 1, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (2, 2, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (3, 3, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (4, 4, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (5, 5, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (6, 6, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (7, 7, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (8, 8, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (9, 9, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (10, 10, 52, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (11, 1, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (12, 2, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (13, 3, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (14, 4, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (15, 5, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (16, 6, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (17, 7, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (18, 8, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (19, 9, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (20, 10, 53, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (21, 1, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (22, 2, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (23, 3, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (24, 4, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (25, 5, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (26, 6, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (27, 7, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (28, 8, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (29, 9, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (30, 10, 54, 0.00, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (31, 1, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (32, 2, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (33, 3, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (34, 4, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (35, 5, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (36, 6, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (37, 7, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (38, 8, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (39, 9, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (40, 10, 55, 4.00, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `komponen_nilai` VALUES (41, 1, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (42, 2, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (43, 3, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (44, 4, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (45, 5, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (46, 6, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (47, 7, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (48, 8, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (49, 9, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (50, 10, 56, 0.00, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (51, 1, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (52, 2, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (53, 3, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (54, 4, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (55, 5, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (56, 6, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (57, 7, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (58, 8, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (59, 9, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (60, 10, 57, 4.00, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `komponen_nilai` VALUES (61, 1, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (62, 2, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (63, 3, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (64, 4, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (65, 5, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (66, 6, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (67, 7, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (68, 8, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (69, 9, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (70, 10, 58, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (71, 1, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (72, 2, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (73, 3, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (74, 4, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (75, 5, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (76, 6, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (77, 7, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (78, 8, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (79, 9, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (80, 10, 59, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (81, 1, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (82, 2, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (83, 3, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (84, 4, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (85, 5, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (86, 6, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (87, 7, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (88, 8, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (89, 9, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (90, 10, 60, 0.00, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (91, 1, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (92, 2, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (93, 3, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (94, 4, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (95, 5, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (96, 6, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (97, 7, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (98, 8, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (99, 9, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (100, 10, 61, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (101, 1, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (102, 2, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (103, 3, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (104, 4, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (105, 5, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (106, 6, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (107, 7, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (108, 8, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (109, 9, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (110, 10, 62, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (111, 1, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (112, 2, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (113, 3, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (114, 4, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (115, 5, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (116, 6, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (117, 7, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (118, 8, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (119, 9, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (120, 10, 63, 0.00, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (121, 1, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (122, 2, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (123, 3, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (124, 4, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (125, 5, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (126, 6, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (127, 7, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (128, 8, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (129, 9, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (130, 10, 64, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (131, 1, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (132, 2, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (133, 3, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (134, 4, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (135, 5, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (136, 6, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (137, 7, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (138, 8, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (139, 9, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (140, 10, 65, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (141, 1, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (142, 2, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (143, 3, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (144, 4, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (145, 5, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (146, 6, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (147, 7, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (148, 8, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (149, 9, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (150, 10, 66, 0.00, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (151, 1, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (152, 2, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (153, 3, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (154, 4, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (155, 5, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (156, 6, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (157, 7, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (158, 8, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (159, 9, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (160, 10, 67, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (161, 1, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (162, 2, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (163, 3, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (164, 4, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (165, 5, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (166, 6, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (167, 7, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (168, 8, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (169, 9, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (170, 10, 68, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (171, 1, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (172, 2, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (173, 3, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (174, 4, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (175, 5, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (176, 6, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (177, 7, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (178, 8, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (179, 9, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (180, 10, 69, 0.00, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (181, 1, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (182, 2, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (183, 3, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (184, 4, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (185, 5, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (186, 6, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (187, 7, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (188, 8, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (189, 9, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (190, 10, 70, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (191, 1, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (192, 2, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (193, 3, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (194, 4, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (195, 5, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (196, 6, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (197, 7, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (198, 8, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (199, 9, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (200, 10, 71, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (201, 1, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (202, 2, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (203, 3, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (204, 4, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (205, 5, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (206, 6, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (207, 7, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (208, 8, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (209, 9, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (210, 10, 72, 0.00, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (211, 1, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (212, 2, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (213, 3, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (214, 4, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (215, 5, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (216, 6, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (217, 7, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (218, 8, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (219, 9, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (220, 10, 73, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (221, 1, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (222, 2, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (223, 3, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (224, 4, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (225, 5, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (226, 6, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (227, 7, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (228, 8, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (229, 9, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (230, 10, 74, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (231, 1, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (232, 2, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (233, 3, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (234, 4, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (235, 5, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (236, 6, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (237, 7, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (238, 8, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (239, 9, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (240, 10, 75, 0.00, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (241, 4, 76, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (242, 8, 76, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (243, 10, 76, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (244, 4, 77, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (245, 8, 77, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (246, 10, 77, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (247, 4, 78, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (248, 8, 78, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (249, 10, 78, 0.00, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (250, 4, 79, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (251, 8, 79, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (252, 10, 79, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (253, 4, 80, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (254, 8, 80, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (255, 10, 80, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (256, 4, 81, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (257, 8, 81, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (258, 10, 81, 0.00, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (259, 4, 82, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (260, 8, 82, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (261, 10, 82, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (262, 4, 83, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (263, 8, 83, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (264, 10, 83, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (265, 4, 84, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (266, 8, 84, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (267, 10, 84, 0.00, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (268, 4, 85, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (269, 8, 85, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (270, 10, 85, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (271, 4, 86, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (272, 8, 86, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (273, 10, 86, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (274, 4, 87, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (275, 8, 87, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (276, 10, 87, 0.00, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (277, 4, 88, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (278, 8, 88, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (279, 10, 88, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (280, 4, 89, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (281, 8, 89, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (282, 10, 89, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (283, 4, 90, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (284, 8, 90, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `komponen_nilai` VALUES (285, 10, 90, 0.00, '2023-07-04 23:34:36', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for log_pesan
-- ----------------------------
DROP TABLE IF EXISTS `log_pesan`;
CREATE TABLE `log_pesan`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `nama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_pesan
-- ----------------------------
INSERT INTO `log_pesan` VALUES (1, 59, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Perkuliahan</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-25 15:18:32', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (2, 44, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Kantin SV</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-25 16:06:47', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (3, 60, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>usul</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-25 21:15:45', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (4, 48, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Perpustakaan</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-25 22:00:01', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (5, 60, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023 pukul 08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (6, 48, 'Tugas akhir telah dinonaktifkan', 'Tugas akhir anda yang berjudul <strong>\"Sistem Informasi Perpustakaan\"</strong> telah dinonaktifkan', '2023-06-25 23:49:08', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (7, 44, 'Tugas akhir telah dinonaktifkan', 'Tugas akhir anda yang berjudul <strong>\"Sistem Informasi Kantin SV\"</strong> telah dinonaktifkan', '2023-06-26 21:38:32', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (8, 44, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>29/06/2023 pukul 22:44</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>1</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (9, 44, 'Lulus sidang', 'Selamat anda telah lulus sidang.', '2023-06-29 23:24:49', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (10, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:02:57', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (11, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:06:06', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (12, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:06:55', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (13, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:10:41', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (14, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:13:18', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (15, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:13:27', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (16, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:29:29', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (17, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:38:29', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (18, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>26/06/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-06-30 21:52:06', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (19, 61, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Kampus Berbasis Web</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-01 22:04:50', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (20, 58, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Judul Testing</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-01 22:22:25', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (21, 57, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Pelacak Kucing</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-01 22:30:21', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (22, 48, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>TUGAS</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 08:14:38', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (23, 56, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Android Presensi Mahasiswa</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 11:03:14', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (24, 60, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>04/07/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 11:30:34', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (25, 56, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>03/07/2023 pukul 08:00 sampai </strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (26, 56, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>03/07/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 11:42:19', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (27, 56, 'Lulus sidang dengan revisi.', 'Selamat anda telah lulus sidang dengan revisi yang telah diberikan oleh dosen penguji.', '2023-07-02 14:01:55', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (28, 61, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>03/07/2023 pukul 14:04 sampai 14:06</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>asdasd</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Bramantyo</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (29, 62, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Rs</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 21:59:39', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (30, 62, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>03/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (31, 62, 'Lulus sidang', 'Selamat anda telah lulus sidang.', '2023-07-02 22:20:25', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (32, 51, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Akademik Smp</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 23:01:28', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (33, 51, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023 pukul 08:00 sampai 09:26</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>sidang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (34, 51, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00 sampai 09:26</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>sidang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-02 23:27:28', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (35, 51, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00 sampai 09:26</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>sidang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 00:17:43', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (36, 51, 'Daftar ulang sidang.', 'Silahkan mendaftar ulang sidang.', '2023-07-03 00:25:36', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (37, 51, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>04/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (38, 51, 'Jadwal sidang diubah.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>04/07/2023</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Pukul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 00:29:58', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (39, 51, 'Lulus sidang', 'Selamat anda telah lulus sidang.', '2023-07-03 00:32:57', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (40, 61, 'Lulus sidang', 'Selamat anda telah lulus sidang.', '2023-07-03 00:43:10', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (41, 55, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>USUL IDE2</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Aan</strong></h4></td>\r\n                            </tr>\r\n                            \r\n                            </table> ', '2023-07-03 00:50:35', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (42, 53, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>B</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Aan</strong></h4></td>\r\n                            </tr>\r\n                            \r\n            <tr>\r\n            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing 2</h4></td>\r\n            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n            <td style=\"padding: 5px;\" ><h4><strong>Aan</strong></h4></td>\r\n            </tr>\r\n                            </table> ', '2023-07-03 00:59:19', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (43, 53, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Aan</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (44, 48, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>04/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Ruang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (45, 49, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Mesin Pencari Tugas Akhir</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            \r\n                            </table> ', '2023-07-03 14:55:33', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (46, 49, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>04/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Ruang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Aan</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (47, 50, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>SISTEM JURUSAN</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Aan</strong></h4></td>\r\n                            </tr>\r\n                            \r\n                            </table> ', '2023-07-03 15:24:54', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (48, 50, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Ruang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Aan</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (49, 47, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Komputer</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            \r\n                            </table> ', '2023-07-03 22:02:37', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (50, 54, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Informasi Perpustakaan</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>dosen</strong></h4></td>\r\n                            </tr>\r\n                            \r\n            <tr>\r\n            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing 2</h4></td>\r\n            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n            <td style=\"padding: 5px;\" ><h4><strong>Hanung</strong></h4></td>\r\n            </tr>\r\n                            </table> ', '2023-07-03 23:41:31', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (51, 66, 'Tugas akhir terplotting', 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Judul</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Sistem Pembelian Hewan</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Dosen Pembimbing</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Hanung</strong></h4></td>\r\n                            </tr>\r\n                            \r\n                            </table> ', '2023-07-04 01:08:34', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (52, 59, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>Ruang</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (53, 54, 'Jadwal sidang terplotting.', 'Sidang akan dilaksanakan pada : <br>\r\n                            <table>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Tanggal</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>07/07/2023 pukul 08:00 sampai 10:00</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ruang</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong>gedung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Ketua Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> Hanung</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Sekretaris Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> kaprodi</strong></h4></td>\r\n                            </tr>\r\n                            <tr>\r\n                            <td style=\"padding: 5px;\" ><h4>Anggota Penguji</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4>:</h4></td>\r\n                            <td style=\"padding: 5px;\" ><h4><strong> dosen</strong></h4></td>\r\n                            </tr>\r\n                            </table> ', '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `log_pesan` VALUES (54, 54, 'Lulus sidang', 'Selamat anda telah lulus sidang.', '2023-07-05 00:03:39', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa`  (
  `id_mahasiswa` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mobile` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ipk` double NULL DEFAULT NULL,
  `jumlah_SKS` int NULL DEFAULT NULL,
  `skill` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `foto` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengalaman` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `prodi` varchar(128) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT 'Teknologi Rekayasa Perangkat Lunak',
  `id_user` int NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mahasiswa`) USING BTREE,
  INDEX `id_user`(`id_user` ASC) USING BTREE,
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES (15, '15/384470/SV/08827', 'Havil Wintas Ernanda', '08912378321', 'havil@komsi.com', 3.8, 120, 'Makan', NULL, 'Makan banyak', 'Teknologi Rekayasa Perangkat Lunak', 24, 0, '2018-04-12 11:39:35', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (16, '15/384470/SV/08821', 'Peni Kurniawati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 25, 0, '2018-04-12 12:18:11', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (17, '15/384749/SV/08812', 'Nadya Prabaningrum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 26, 0, '2018-04-12 12:18:35', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (26, '15/386439/SV/08642', 'Sasmito Adi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 43, 0, '2018-04-17 17:27:23', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (27, '15/387498/SV/01379', 'Afif Imaduddin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 44, 0, '2018-04-17 17:27:23', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (28, '15/374910/SV/01380', 'Odiaz Bumma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 45, 0, '2018-04-17 17:27:23', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (29, '15/385919/SV/01381', 'Dandy Ari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 46, 0, '2018-04-17 17:27:23', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (32, '15/384372/SV/08812', 'Daniel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 49, 0, '2018-04-18 14:10:34', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (33, '14/331233/SV/01283', 'Aji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 50, 0, '2018-04-18 18:21:24', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (34, '14/331243/SV/02283', 'Prasetyo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 51, 0, '2018-04-18 18:28:04', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (35, '15/380436/SV/08243', 'Mardiana Dwi M', '081231992632', 'mardiana.dwi.m@mail.ugm.ac.id', 3.99, 103, 'makan, tidur', NULL, 'pernah bersamanya', 'Teknologi Rekayasa Perangkat Lunak', 52, 0, '2018-04-19 19:02:18', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (37, '15/383838/SV/08882', 'Gery Coklat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 54, 0, '2018-04-24 21:21:40', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (38, '15/323838/SV/90213', 'Toni', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 55, 0, '2018-04-25 09:43:40', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (39, '15/384213/SV/08812', 'Alviska Galuh N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 56, 0, '2018-04-26 14:54:31', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (40, '16/398323/SV/09673', 'Jamaludin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 57, 0, '2018-04-26 18:41:36', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (41, '16/398623/SV/09873', 'Suparman', '0857128371233', 'suparman@mail.com', 3.79, 120, 'Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor risus. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor risus.', 'Foto-1525073371.png', 'Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor risus. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor risus.', 'Teknologi Rekayasa Perangkat Lunak', 58, 0, '2018-04-26 18:41:36', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (42, '16/398393/SV/09573', 'Yaman', '08912378132', 'yaman@mail.com', 3.85, 120, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel cursus neque, at volutpat odio.', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel cursus neque, at volutpat odio. Aenean a erat augue. Integer non neque placerat, consequat mauris eu, hendrerit nisi. Cras eget ultrices massa, in laoreet lorem. Donec pharetra lectus in urna semper mollis. Praesent lacinia iaculis auctor. ', 'Teknologi Rekayasa Perangkat Lunak', 59, 0, '2018-04-26 18:41:36', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (43, '16/398723/SV/09973', 'Jacky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 60, 0, '2018-04-26 18:41:36', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (44, '21/483362/SV/20165', 'Mahasiswa', '08998788889', 'a@gmail.com', 3.59, 110, 'Menulis', NULL, 'membaca', 'Teknologi Rekayasa Perangkat Lunak', 61, 0, '2023-06-09 00:25:08', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (45, '21/483362/SV/20167', 'Siti', '09876554345', 'aa@gmail.com', 3.67, 111, 'aa', NULL, 'ab', 'Teknologi Rekayasa Perangkat Lunak', 62, 0, '2023-06-09 00:43:00', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (46, '21/123456/SV/12345', 'Mahasiswa2', '0874446789764', 'mhs2@gmail.com', 3.55, 110, 'd', NULL, 'a', 'Teknologi Rekayasa Perangkat Lunak', 63, 0, '2023-06-15 10:46:21', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (47, '20/488362/SV/21167', 'Mahasiswa3', '0866789999', 'b@gmail.com', 3.54, 110, 'aa', NULL, 'asd', 'Teknologi Rekayasa Perangkat Lunak', 68, 0, '2023-06-18 21:52:52', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (48, '20/473362/SV/20155', 'mhs', '097543356789', 'mhs@gmail.cpm', 3.76, 110, 'kkkk', NULL, 'ssss', 'Teknologi Rekayasa Perangkat Lunak', 69, 0, '2023-06-21 16:06:19', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (49, '21/473362/SV/20155', 'mhs2', '086433456778', 'mhs22@gmail.com', 3.23, 110, 'Menulis, membaca, mendengarkan', NULL, 'abbbb', 'Teknologi Rekayasa Perangkat Lunak', 70, 0, '2023-06-23 09:31:25', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (50, '18/483361/SV/23167', 'mhs3', '0811223344', 'ujang@mail.com', 3.05, 120, 'hj', NULL, 'gh', 'Teknologi Rekayasa Perangkat Lunak', 71, 0, '2023-06-24 20:48:53', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (51, '20/476762/SV/21155', 'aa3', '087765456789', 'aa3@gmail.com', 3.57, 110, 'A', NULL, 'A', 'Teknologi Rekayasa Perangkat Lunak', 72, 0, '2023-06-24 22:35:56', '2023-07-03 00:46:48');
INSERT INTO `mahasiswa` VALUES (52, '22/243675/SV/20146', 'Bb', '765455334567', 'bbbb@gmail.com', 3.68, 110, 'n', NULL, 'h', 'Teknologi Rekayasa Perangkat Lunak', 73, 0, '2023-06-24 22:35:56', '2023-07-03 15:37:25');
INSERT INTO `mahasiswa` VALUES (53, '21/483662/SV/20166', 'aa5', '98765434567', 'cc@gmail.com', 4, 110, 'ca', NULL, 'a', 'Teknologi Rekayasa Perangkat Lunak', 74, 0, '2023-06-24 22:35:56', '2023-07-03 00:57:44');
INSERT INTO `mahasiswa` VALUES (54, '20/473962/SV/20159', 'aa6', '086543234568', 'aa6@gmail.com', 3.78, 120, 'a', NULL, 'x', 'Teknologi Rekayasa Perangkat Lunak', 75, 0, '2023-06-24 22:35:56', '2023-07-03 23:38:04');
INSERT INTO `mahasiswa` VALUES (55, '19/431231/SV/10002', 'aa4', '0876556788652', 'bbb@gmail.com', 3.45, 120, 's', NULL, 's', 'Teknologi Rekayasa Perangkat Lunak', 76, 0, '2023-06-24 22:39:24', '2023-07-03 00:47:12');
INSERT INTO `mahasiswa` VALUES (56, '19/431233/SV/10003', 'A', '0876532546758', 'Aaaaa@gmail.com', 4, 120, 'b', NULL, 'c', 'Teknologi Rekayasa Perangkat Lunak', 77, 0, '2023-06-24 22:39:24', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (57, '19/431233/SV/10004', 'cobaproyek2', '098765432345', 'bb@gmail.com', 3.51, 112, 'f', NULL, 'g', 'Teknologi Rekayasa Perangkat Lunak', 78, 0, '2023-06-24 22:39:24', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (58, '19/431234/SV/10005', 'cobaproyek', '0765432345', 'c@gmail.com', 3.67, 110, 'h', NULL, 'f', 'Teknologi Rekayasa Perangkat Lunak', 79, 0, '2023-06-24 22:39:24', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (59, '22/245562/TP/33455', 'Mahasiswa1', '0855577756699', 'mhs1@gmail.com', 3.45, 110, 'Aaa', NULL, 'Aaaa', 'Teknologi Rekayasa Perangkat Lunak', 80, 0, '2023-06-25 15:07:11', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (60, '20/488462/SV/21137', 'mahasiswa usul', '057657867982', 'u@gmail.com', 3.56, 112, 's', NULL, 'a', 'Teknologi Rekayasa Perangkat Lunak', 81, 0, '2023-06-25 21:11:44', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (61, '21/473362/SV/20163', 'cobausul', '087654345676', 'cobausul@gmail.com', 3.56, 110, 'baca', NULL, 'tulis', 'Teknologi Rekayasa Perangkat Lunak', 86, 0, '2023-07-01 21:58:11', '2023-07-02 21:27:10');
INSERT INTO `mahasiswa` VALUES (62, '21/483262/SV/19167', 'aa2', '07654345678', 'aa2@gmail.com', 3.78, 112, 'h', NULL, 'f', 'Teknologi Rekayasa Perangkat Lunak', 87, 0, '2023-07-02 21:55:41', '2023-07-02 21:56:45');
INSERT INTO `mahasiswa` VALUES (63, 'Ara', 'Ara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 88, 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `mahasiswa` VALUES (64, 'Bina', 'Bina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 89, 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `mahasiswa` VALUES (65, 'Cici', 'Cici', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teknologi Rekayasa Perangkat Lunak', 90, 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `mahasiswa` VALUES (66, '20/499762/SV/21895', 'coba', '087654334567', 'coba@gmail.com', 3.87, 110, 'Menulis, membaca, mendengarkan', NULL, 'membaca', 'Teknologi Rekayasa Perangkat Lunak', 91, 0, '2023-07-04 00:29:13', '2023-07-04 01:03:16');

-- ----------------------------
-- Table structure for pengajuan_ta
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_ta`;
CREATE TABLE `pengajuan_ta`  (
  `id_pengajuan_ta` int NOT NULL AUTO_INCREMENT,
  `id_ta` int NOT NULL,
  `id_proyek` int NULL DEFAULT NULL,
  `pilihan` tinyint NOT NULL,
  `status` enum('diterima','proses') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'proses',
  `jenis` enum('usul','proyek') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengajuan_ta`) USING BTREE,
  INDEX `id_ta`(`id_ta` ASC) USING BTREE,
  INDEX `id_proyek`(`id_proyek` ASC) USING BTREE,
  CONSTRAINT `pengajuan_ta_ibfk_1` FOREIGN KEY (`id_ta`) REFERENCES `tugas_akhir` (`id_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_ta_ibfk_2` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_ta
-- ----------------------------
INSERT INTO `pengajuan_ta` VALUES (77, 59, 21, 1, 'diterima', 'proyek', '2023-06-25 15:10:34', '2023-06-25 15:18:32');
INSERT INTO `pengajuan_ta` VALUES (79, 61, NULL, 1, 'diterima', 'usul', '2023-06-25 21:14:16', '2023-06-25 21:15:45');
INSERT INTO `pengajuan_ta` VALUES (81, 63, NULL, 0, 'proses', 'usul', '2023-06-27 14:36:10', '2023-06-29 20:52:31');
INSERT INTO `pengajuan_ta` VALUES (82, 64, 35, 1, 'diterima', 'proyek', '2023-07-01 22:01:58', '2023-07-01 22:04:50');
INSERT INTO `pengajuan_ta` VALUES (83, 65, 34, 1, 'diterima', 'proyek', '2023-07-01 22:21:16', '2023-07-01 22:22:25');
INSERT INTO `pengajuan_ta` VALUES (84, 66, 24, 1, 'diterima', 'proyek', '2023-07-01 22:29:42', '2023-07-01 22:30:21');
INSERT INTO `pengajuan_ta` VALUES (85, 67, NULL, 1, 'diterima', 'usul', '2023-07-02 08:13:26', '2023-07-02 08:14:38');
INSERT INTO `pengajuan_ta` VALUES (86, 68, 26, 1, 'diterima', 'proyek', '2023-07-02 10:52:04', '2023-07-02 11:03:14');
INSERT INTO `pengajuan_ta` VALUES (87, 69, 32, 1, 'diterima', 'proyek', '2023-07-02 21:57:00', '2023-07-02 21:59:39');
INSERT INTO `pengajuan_ta` VALUES (88, 70, 25, 1, 'diterima', 'proyek', '2023-07-02 22:59:15', '2023-07-02 23:01:28');
INSERT INTO `pengajuan_ta` VALUES (89, 71, NULL, 0, 'diterima', 'usul', '2023-07-03 00:47:57', '2023-07-03 00:50:35');
INSERT INTO `pengajuan_ta` VALUES (90, 72, NULL, 1, 'diterima', 'usul', '2023-07-03 00:58:12', '2023-07-03 00:59:19');
INSERT INTO `pengajuan_ta` VALUES (91, 73, 33, 1, 'diterima', 'proyek', '2023-07-03 14:48:35', '2023-07-03 14:55:33');
INSERT INTO `pengajuan_ta` VALUES (92, 74, NULL, 0, 'diterima', 'usul', '2023-07-03 15:18:37', '2023-07-03 15:24:54');
INSERT INTO `pengajuan_ta` VALUES (93, 75, 27, 1, 'diterima', 'proyek', '2023-07-03 22:02:07', '2023-07-03 22:02:37');
INSERT INTO `pengajuan_ta` VALUES (94, 76, 12, 1, 'diterima', 'proyek', '2023-07-03 23:40:33', '2023-07-03 23:41:31');
INSERT INTO `pengajuan_ta` VALUES (95, 77, 39, 1, 'diterima', 'proyek', '2023-07-04 01:03:27', '2023-07-04 01:08:34');
INSERT INTO `pengajuan_ta` VALUES (96, 78, 13, 1, 'proses', 'proyek', '2023-07-04 10:37:56', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman`  (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengumuman`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------
INSERT INTO `pengumuman` VALUES (2, 'PENGUMUMAN TUGAS AKHIR', '<div style=\"text-align: left;\">Tugas akhir membutuhkan beberapa berkas</div>', NULL, '2018-04-26 16:21:18', '0000-00-00 00:00:00');
INSERT INTO `pengumuman` VALUES (3, 'Pengajuan TA', 'dibuka', '20230701212220-Doc1.pdf', '2023-07-01 21:21:03', '2023-07-01 21:22:20');

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian`  (
  `id_penilaian` int NOT NULL AUTO_INCREMENT,
  `nilai_akhir_dosen` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `id_anggota_sidang` int NULL DEFAULT NULL,
  `role` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sidang` int NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_penilaian`) USING BTREE,
  INDEX `id_sidang`(`id_sidang` ASC) USING BTREE,
  INDEX `peniaian_ibfk_3`(`id_anggota_sidang` ASC) USING BTREE,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
INSERT INTO `penilaian` VALUES (52, 0.00, 52, '', 22, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (53, 0.00, 53, '', 22, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (54, 0.00, 54, '', 22, '2023-06-25 23:07:20', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (55, 4.00, 55, '', 23, '2023-06-29 22:44:41', '2023-06-29 23:02:27');
INSERT INTO `penilaian` VALUES (56, 0.00, 56, '', 23, '2023-06-29 22:44:41', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (57, 4.00, 57, '', 23, '2023-06-29 22:44:41', '2023-06-29 22:46:58');
INSERT INTO `penilaian` VALUES (58, 0.00, 58, '', 25, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (59, 0.00, 59, '', 25, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (60, 0.00, 60, '', 25, '2023-07-02 11:31:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (61, 0.00, 61, '', 24, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (62, 0.00, 62, '', 24, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (63, 0.00, 63, '', 24, '2023-07-02 14:04:39', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (64, 0.00, 64, '', 26, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (65, 0.00, 65, '', 26, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (66, 0.00, 66, '', 26, '2023-07-02 22:04:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (67, 0.00, 67, '', 28, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (68, 0.00, 68, '', 28, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (69, 0.00, 69, '', 28, '2023-07-02 23:27:18', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (70, 0.00, 70, '', 29, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (71, 0.00, 71, '', 29, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (72, 0.00, 72, '', 29, '2023-07-03 00:28:31', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (73, 0.00, 73, '', 30, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (74, 0.00, 74, '', 30, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (75, 0.00, 75, '', 30, '2023-07-03 01:09:01', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (76, 0.00, 76, '', 31, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (77, 0.00, 77, '', 31, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (78, 0.00, 78, '', 31, '2023-07-03 11:36:52', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (79, 0.00, 79, '', 32, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (80, 0.00, 80, '', 32, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (81, 0.00, 81, '', 32, '2023-07-03 15:14:50', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (82, 0.00, 82, '', 33, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (83, 0.00, 83, '', 33, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (84, 0.00, 84, '', 33, '2023-07-03 15:34:23', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (85, 0.00, 85, '', 27, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (86, 0.00, 86, '', 27, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (87, 0.00, 87, '', 27, '2023-07-04 01:20:29', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (88, 0.00, 88, '', 35, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (89, 0.00, 89, '', 35, '2023-07-04 23:34:36', '0000-00-00 00:00:00');
INSERT INTO `penilaian` VALUES (90, 0.00, 90, '', 35, '2023-07-04 23:34:36', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for periode
-- ----------------------------
DROP TABLE IF EXISTS `periode`;
CREATE TABLE `periode`  (
  `id_periode` int NOT NULL AUTO_INCREMENT,
  `semester` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun_ajaran` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_periode` tinyint NOT NULL,
  `tgl_awal_regis_ta` date NULL DEFAULT NULL,
  `tgl_akhir_regis_ta` date NULL DEFAULT NULL,
  `tgl_awal_regis_yudisium` date NULL DEFAULT NULL,
  `tgl_akhir_regis_yudisium` date NULL DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_periode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of periode
-- ----------------------------
INSERT INTO `periode` VALUES (63, 'genap', '2022/2023', 1, '2023-06-19', '2023-07-05', '2023-06-27', '2023-07-05', '2023-06-25 15:08:18', '2023-07-03 23:52:41');

-- ----------------------------
-- Table structure for proyek
-- ----------------------------
DROP TABLE IF EXISTS `proyek`;
CREATE TABLE `proyek`  (
  `id_proyek` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_dosen` int NOT NULL,
  `klien` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('disetujui','pending','ditolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tools` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_proyek`) USING BTREE,
  INDEX `id_dosen`(`id_dosen` ASC) USING BTREE,
  CONSTRAINT `proyek_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyek
-- ----------------------------
INSERT INTO `proyek` VALUES (11, 'Sistem Informasi Tambang', 11, 'PT. Tambang', 'pending', 0, '2018-04-10 19:53:26', '2023-07-01 21:44:20', 's', 's');
INSERT INTO `proyek` VALUES (12, 'Sistem Informasi Perpustakaan', 11, 'PT. Perpus', 'disetujui', 0, '2018-04-10 19:58:41', '2023-06-23 10:24:21', NULL, NULL);
INSERT INTO `proyek` VALUES (13, 'Sistem Informasi Kantin SV', 12, 'Sekolah Vokasi', 'disetujui', 0, '2018-04-10 20:03:34', '2018-04-12 11:08:44', NULL, NULL);
INSERT INTO `proyek` VALUES (20, 'aa', 12, 'aa', 'pending', 1, '2018-04-12 11:08:56', '2018-04-12 11:09:03', NULL, NULL);
INSERT INTO `proyek` VALUES (21, 'Sistem Informasi Perkuliahan', 12, 'Sekolah Vokasi', 'disetujui', 0, '2018-04-19 19:18:51', '2018-04-19 19:22:33', NULL, NULL);
INSERT INTO `proyek` VALUES (22, 'Sistem Informasi Pelabuhan', 27, 'Pelabuhan', 'disetujui', 0, '2018-04-19 19:19:20', '2018-04-19 19:22:33', NULL, NULL);
INSERT INTO `proyek` VALUES (23, 'Sistem Informasi Ketahanan', 29, 'Ketahanan', 'disetujui', 1, '2018-04-19 19:22:30', '2023-07-01 21:43:36', NULL, NULL);
INSERT INTO `proyek` VALUES (24, 'Sistem Pelacak Kucing', 11, 'RS Hewan', 'disetujui', 0, '2018-04-19 19:26:19', '2023-07-01 21:41:41', 'sistemmm', 'web');
INSERT INTO `proyek` VALUES (25, 'Sistem Informasi Akademik Smp', 11, 'Smp Negeri 98', 'disetujui', 1, '2018-04-19 19:26:51', '2023-07-01 21:44:37', 'SI', 'Web');
INSERT INTO `proyek` VALUES (26, 'Android Presensi Mahasiswa', 11, '', 'disetujui', 0, '2018-04-19 19:27:37', '2023-06-30 22:36:01', 'a', 'B');
INSERT INTO `proyek` VALUES (27, 'Sistem Informasi Komputer', 11, 'Komputer Juara', 'disetujui', 0, '2018-04-19 19:28:29', '2018-04-19 19:29:53', NULL, NULL);
INSERT INTO `proyek` VALUES (28, 'Sistem Informasi Penjualan Penyu', 11, 'CP', 'ditolak', 1, '2018-04-19 19:29:40', '2023-07-01 21:42:13', NULL, NULL);
INSERT INTO `proyek` VALUES (29, 'Sistem Informasi Kontrakan', 12, 'Kontrakan', 'disetujui', 0, '2018-04-24 16:50:12', '2018-04-24 17:05:44', NULL, NULL);
INSERT INTO `proyek` VALUES (30, 'Sistem Informasi SMP 7', 27, 'SMP 7', 'disetujui', 0, '2018-04-25 13:07:46', '2018-04-25 13:07:48', NULL, NULL);
INSERT INTO `proyek` VALUES (31, 'Aplikasi Prodi', 30, 'Departemen', 'pending', 1, '2023-06-21 14:55:33', '2023-07-01 21:43:18', NULL, NULL);
INSERT INTO `proyek` VALUES (32, 'Sistem Rs', 11, 'Rsud', 'disetujui', 0, '2023-06-21 15:02:13', '2023-06-21 15:18:25', NULL, NULL);
INSERT INTO `proyek` VALUES (33, 'Mesin Pencari Tugas Akhir', 12, 'Kampus', 'disetujui', 0, '2023-06-28 22:16:39', '2023-07-01 21:43:46', 'Membangun search engine terbaik', 'Laravel, Elasticsearch');
INSERT INTO `proyek` VALUES (34, 'Judul Testing', 12, 'Jakarta Raya', 'disetujui', 0, '2023-06-28 22:33:33', '2023-06-28 22:35:04', 'Testing Judul', 'Laravel, elasticsearch, djangoa');
INSERT INTO `proyek` VALUES (35, 'Sistem Kampus Berbasis Web', 12, 'Kampus', 'disetujui', 0, '2023-06-29 08:33:02', '2023-06-29 08:33:44', 'Sistem mencakup administrasi', 'Berbasis web');
INSERT INTO `proyek` VALUES (36, 'Aplikasi Prodi', 11, 'ABC', 'pending', 0, '2023-06-29 08:47:58', '2023-06-30 22:03:23', 'Aplikasi prodi informatika', 'Berbasis Web, Laravel');
INSERT INTO `proyek` VALUES (37, 'a', 12, '', 'pending', 1, '2023-06-29 20:51:05', '2023-07-01 21:43:29', 'b', 'bbb');
INSERT INTO `proyek` VALUES (38, 'a', 12, '', 'ditolak', 0, '2023-06-29 21:05:29', '2023-07-01 21:41:56', 'a', 'g');
INSERT INTO `proyek` VALUES (39, 'Sistem Pembelian Hewan', 26, '', 'disetujui', 0, '2023-07-04 00:36:53', '2023-07-04 01:01:18', 'hewan kuraban', 'Website');
INSERT INTO `proyek` VALUES (40, 'Sistem Pembelian Hewan Jogja', 26, '', 'pending', 0, '2023-07-04 00:38:22', '2023-07-04 00:40:01', 'hewan sapi', 'Web');

-- ----------------------------
-- Table structure for revisi_sidang
-- ----------------------------
DROP TABLE IF EXISTS `revisi_sidang`;
CREATE TABLE `revisi_sidang`  (
  `id_revisi_sidang` int NOT NULL AUTO_INCREMENT,
  `id_anggota_sidang` int NOT NULL,
  `path` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_revisi_sidang`) USING BTREE,
  INDEX `id_anggota_sidang`(`id_anggota_sidang` ASC) USING BTREE,
  CONSTRAINT `revisi_sidang_ibfk_1` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of revisi_sidang
-- ----------------------------
INSERT INTO `revisi_sidang` VALUES (2, 57, 'revisi-1688053598-kaprodi.pdf');
INSERT INTO `revisi_sidang` VALUES (3, 57, 'revisi-1688053640-kaprodi.pdf');
INSERT INTO `revisi_sidang` VALUES (4, 60, 'revisi-1688281299-dosen.pdf');
INSERT INTO `revisi_sidang` VALUES (5, 60, 'revisi-1688281433-dosen.pdf');
INSERT INTO `revisi_sidang` VALUES (6, 70, 'revisi-1688319348-Hanung.pdf');
INSERT INTO `revisi_sidang` VALUES (7, 52, 'revisi-1688319611-dosen.pdf');
INSERT INTO `revisi_sidang` VALUES (8, 88, 'revisi-1688490309-Hanung.pdf');

-- ----------------------------
-- Table structure for sidang
-- ----------------------------
DROP TABLE IF EXISTS `sidang`;
CREATE TABLE `sidang`  (
  `id_sidang` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `id_periode` int NOT NULL,
  `nilai_akhir_sidang` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `status` enum('disetujui','pending','lulus','lulus_revisi','mengulang') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sidang`) USING BTREE,
  INDEX `id_mahasiswa`(`id_mahasiswa` ASC) USING BTREE,
  INDEX `id_periode`(`id_periode` ASC) USING BTREE,
  CONSTRAINT `sidang_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sidang_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sidang
-- ----------------------------
INSERT INTO `sidang` VALUES (22, 60, 63, 0.00, 'disetujui', '2023-06-25 23:05:50', '2023-06-25 23:07:20');
INSERT INTO `sidang` VALUES (23, 44, 63, 2.67, 'lulus', '2023-06-29 22:42:49', '2023-06-29 23:24:49');
INSERT INTO `sidang` VALUES (24, 61, 63, 0.00, 'lulus', '2023-07-02 08:42:07', '2023-07-03 00:43:10');
INSERT INTO `sidang` VALUES (25, 56, 63, 0.00, 'lulus_revisi', '2023-07-02 11:09:46', '2023-07-02 14:01:55');
INSERT INTO `sidang` VALUES (26, 62, 63, 0.00, 'lulus', '2023-07-02 22:02:39', '2023-07-02 22:20:25');
INSERT INTO `sidang` VALUES (27, 59, 63, 0.00, 'disetujui', '2023-07-02 22:25:26', '2023-07-04 01:20:29');
INSERT INTO `sidang` VALUES (28, 51, 63, 0.00, 'mengulang', '2023-07-02 23:23:37', '2023-07-03 00:25:36');
INSERT INTO `sidang` VALUES (29, 51, 63, 0.00, 'lulus', '2023-07-03 00:26:01', '2023-07-03 00:32:57');
INSERT INTO `sidang` VALUES (30, 53, 63, 0.00, 'disetujui', '2023-07-03 01:08:06', '2023-07-03 01:09:01');
INSERT INTO `sidang` VALUES (31, 48, 63, 0.00, 'disetujui', '2023-07-03 11:35:18', '2023-07-03 11:36:52');
INSERT INTO `sidang` VALUES (32, 49, 63, 0.00, 'disetujui', '2023-07-03 15:13:54', '2023-07-03 15:14:50');
INSERT INTO `sidang` VALUES (33, 50, 63, 0.00, 'disetujui', '2023-07-03 15:33:18', '2023-07-03 15:34:23');
INSERT INTO `sidang` VALUES (34, 57, 63, 0.00, 'pending', '2023-07-03 22:36:34', '0000-00-00 00:00:00');
INSERT INTO `sidang` VALUES (35, 54, 63, 0.00, 'lulus', '2023-07-04 23:11:25', '2023-07-05 00:03:39');

-- ----------------------------
-- Table structure for tugas_akhir
-- ----------------------------
DROP TABLE IF EXISTS `tugas_akhir`;
CREATE TABLE `tugas_akhir`  (
  `id_ta` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `status_pengambilan` enum('proses','terplotting','revisi') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'proses',
  `id_periode` int NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `reason` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `progress` int NOT NULL,
  PRIMARY KEY (`id_ta`) USING BTREE,
  INDEX `id_mahasiswa`(`id_mahasiswa` ASC) USING BTREE,
  INDEX `id_periode`(`id_periode` ASC) USING BTREE,
  CONSTRAINT `tugas_akhir_ibfk_6` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tugas_akhir_ibfk_7` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tugas_akhir
-- ----------------------------
INSERT INTO `tugas_akhir` VALUES (59, 59, 'terplotting', 63, '2023-06-25 15:10:34', '2023-06-30 22:42:32', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (61, 60, 'terplotting', 63, '2023-06-25 21:14:16', '2023-06-25 21:15:45', NULL, 0);
INSERT INTO `tugas_akhir` VALUES (63, 44, 'terplotting', 63, '2023-06-27 14:36:10', '2023-06-29 22:42:45', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (64, 61, 'terplotting', 63, '2023-07-01 22:01:58', '2023-07-02 08:41:22', 'ganti proyek lain', 100);
INSERT INTO `tugas_akhir` VALUES (65, 58, 'terplotting', 63, '2023-07-01 22:21:16', '2023-07-02 10:39:19', NULL, 80);
INSERT INTO `tugas_akhir` VALUES (66, 57, 'terplotting', 63, '2023-07-01 22:29:42', '2023-07-03 22:35:56', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (67, 48, 'terplotting', 63, '2023-07-02 08:13:26', '2023-07-03 11:32:23', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (68, 56, 'terplotting', 63, '2023-07-02 10:52:04', '2023-07-02 11:08:49', 'ganti judul lain', 100);
INSERT INTO `tugas_akhir` VALUES (69, 62, 'terplotting', 63, '2023-07-02 21:57:00', '2023-07-02 22:02:11', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (70, 51, 'terplotting', 63, '2023-07-02 22:59:15', '2023-07-02 23:20:28', 'ganti', 100);
INSERT INTO `tugas_akhir` VALUES (71, 55, 'terplotting', 63, '2023-07-03 00:47:57', '2023-07-03 00:54:36', 'judul revisi', 100);
INSERT INTO `tugas_akhir` VALUES (72, 53, 'terplotting', 63, '2023-07-03 00:58:12', '2023-07-03 01:05:06', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (73, 49, 'terplotting', 63, '2023-07-03 14:48:35', '2023-07-03 15:02:28', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (74, 50, 'terplotting', 63, '2023-07-03 15:18:37', '2023-07-03 15:32:19', 'ubah metode', 100);
INSERT INTO `tugas_akhir` VALUES (75, 47, 'terplotting', 63, '2023-07-03 22:02:07', '2023-07-03 22:02:37', NULL, 0);
INSERT INTO `tugas_akhir` VALUES (76, 54, 'terplotting', 63, '2023-07-03 23:40:33', '2023-07-03 23:45:04', NULL, 100);
INSERT INTO `tugas_akhir` VALUES (77, 66, 'terplotting', 63, '2023-07-04 01:03:27', '2023-07-04 10:32:15', NULL, 0);
INSERT INTO `tugas_akhir` VALUES (78, 52, 'revisi', 63, '2023-07-04 10:37:56', '2023-07-04 10:39:30', 'Mohon maaf judul sudah terploting mahasiswa lain', 0);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_user_role` tinyint NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isDeleted` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `id_user_role`(`id_user_role` ASC) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_role`) REFERENCES `user_role` (`id_user_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 2, 'akademik', '$2y$10$rOQbAZHEZwBGvfD9enKOBublQcW3vrhFvgNqzwVHr9Dda/dZGKIKi', 'akademik', 0, '2018-03-27 11:40:54', '2023-06-09 00:23:04');
INSERT INTO `user` VALUES (3, 3, 'dosen', '$2y$10$VbwVKmWbtcrbW6qMWkEziuRivjBTnj9AD.VUEYCyBgUtn8iIJRV2a', 'dosen', 0, '2018-04-10 19:39:28', '2023-06-09 00:35:01');
INSERT INTO `user` VALUES (4, 1, 'kaprodi', '$2y$10$Cv8F.46LUyaTcG4DsDwQyel0Pu/yoYLJAUa9B.UcIobyaifLTnuum', 'kaprodi', 0, '2018-04-10 19:40:07', '2023-06-09 00:33:01');
INSERT INTO `user` VALUES (12, 2, 'anang', '$2y$10$lphIgpo/qOuhZCMBDAl0kO9.fqXLa8bgBCy3347vopxwsijKYoDBq', 'Anang', 0, '2018-04-11 11:35:54', '2018-04-11 14:20:44');
INSERT INTO `user` VALUES (22, 2, 'asisten', '$2y$10$POog3Dowa/Wh7n.I4KXKMeQXTeB8rsl39gnxas4A/Wqb8EuozTaxy', 'Asisten', 0, '2018-04-11 14:45:02', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (24, 4, 'havil', '$2y$10$fQxlbjHnUzYO2FMJXjCcfeE8ZgyJyDKO01i5KO9x.VZv4WaWrpDa.', 'Havil Wintas Ernanda', 0, '2018-04-12 11:39:35', '2018-04-18 15:50:34');
INSERT INTO `user` VALUES (25, 4, 'peni', '$2y$10$NouSwRt2g3mlqm8tfYq.dOhT9WTrvx.qNXDqFUlewa4UMl5iG91bG', 'Peni Kurniawati', 0, '2018-04-12 12:18:11', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (26, 4, 'nadya', '$2y$10$OLsEM0w.8iFA3BDV9E6ECeWhCuYoGBDKrGL3iDDoAwAvv/HkpVShe', 'Nadya Prabaningrum', 0, '2018-04-12 12:18:35', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (35, 3, 'hanung', '$2y$10$.6XAHQYhFq.GTaF4S.bEDe4Nw7eV/S8iDZIG4WGBMlTJUGTn2ufQG', 'Hanung', 0, '2018-04-17 17:16:22', '2023-06-18 00:17:50');
INSERT INTO `user` VALUES (36, 3, '11183341444', '$2y$10$GE7L3D3Fj4KfKTb.XeQ3p.0fE6F0g3Km2GFB7.I3e5yoi7zs/bJ9O', 'Bramantyo', 0, '2018-04-17 17:16:22', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (37, 3, '13211323124', '$2y$10$/5V1iQbyu7/h2G9UKM8u0OAF9RMaUBRp1DjE20ADX5RnZh6/745rK', 'Coky', 0, '2018-04-17 17:16:22', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (38, 3, '19231234325', '$2y$10$LNtxjOwVASv1BQrcx0O2ZupcsfK4Twdez2B.NSM1Dy/zxgUvpPFAW', 'Galuh', 1, '2018-04-17 17:16:22', '2023-06-25 13:55:14');
INSERT INTO `user` VALUES (43, 4, '386439', '$2y$10$Lq3s.oL4WcQ6ONgVhjvgje3F0/d/Ibw6ozNp1XPD6HCWve/AOjk4e', 'Sasmito Adi', 0, '2018-04-17 17:27:23', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (44, 4, '387498', '$2y$10$/0Ed/vhALyDkbelcasbKQOe7rb.h025Q3YihWtBbC0k3jgPAYb/1.', 'Afif Imaduddin', 0, '2018-04-17 17:27:23', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (45, 4, 'odiaz', '$2y$10$QjcWONLOA8u0/h9gThHmv.2e8IFReWehDl.EF20.nnHERFIbca42m', 'Odiaz Bumma', 0, '2018-04-17 17:27:23', '2023-06-17 21:27:00');
INSERT INTO `user` VALUES (46, 4, '385919', '$2y$10$w0Xo1O9OCWK1WWprpOTkp.CzbD63tPzyol865IAF.bPhvr.uPmziW', 'Dandy Ari', 0, '2018-04-17 17:27:23', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (49, 4, '384372', '$2y$10$gHMWNCoVCIVf0UfG./M8jePDgz5Zx8076260LVzR5Ea14rrMREd5S', 'Daniel', 0, '2018-04-18 14:10:34', '2018-04-22 18:38:28');
INSERT INTO `user` VALUES (50, 4, '331233', '$2y$10$hYsGCiIaBbME3P6F7PJ85.Wucp24qoZjaVPboYbpmjiV3I9Pga2dC', 'Aji', 0, '2018-04-18 18:21:24', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (51, 4, '331243', '$2y$10$CVyXfT4fwD5NNHQwTevfDeWvqWuSASI5CaLnAT0dxgnQ9Y6HGhEyy', 'Prasetyo', 0, '2018-04-18 18:28:04', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (52, 4, '380436', '$2y$10$0TbXAxls8XE90XWzFEAlNeKpnBXKG5VgD4oEQ7KnniCvFIwkbWes2', 'Mardiana Dwi M', 0, '2018-04-19 19:02:18', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (54, 4, '383838', '$2y$10$JHby8OP8WGkbLit1pFjtDeTYzSZPHsGogH94RAEXLUIBjI.hddqUm', 'Gery Coklat', 0, '2018-04-24 21:21:40', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (55, 4, 'tonik', '$2y$10$Vlu1cQMgb5yJGOohRfgDluB5NhUFI1ITpG2iJRcyhn81fyxmJPzUa', 'Toni', 0, '2018-04-25 09:43:40', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (56, 4, 'alviska', '$2y$10$wHFcER88xDr/8ldMt5f4Ku6zWGeFBEMjU1m0NhhO/wMxCZvPsRBDa', 'Alviska Galuh N', 0, '2018-04-26 14:54:31', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (57, 4, '398323', '$2y$10$B2iKTp/CN24.cp4RqH10Pu80nmLMygd/lETWm7x7su.tdJtVQMi32', 'Jamaludin', 0, '2018-04-26 18:41:35', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (58, 4, '398623', '$2y$10$8L2c.7fVYyltMcYVATUB3uWgFb5xjd0DmBcpKERXMALLDbcZWhPoa', 'Suparman', 0, '2018-04-26 18:41:35', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (59, 4, '398393', '$2y$10$UMW28VnhPOfJQFPqC3sI9.zuTQmH0M4m384AOCDcY0bnb1AUhRxem', 'Yaman', 0, '2018-04-26 18:41:35', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (60, 4, '398723', '$2y$10$n95YQSduX/H.ROtgKqonReXndfycUZ9JIrJk5Sybo3r9UZZFNVM.e', 'Jacky', 0, '2018-04-26 18:41:35', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (61, 4, 'Mahasiswa', '$2y$10$fUN4cUrBs.mxYYlq40oQHe3tbOpe2HuGOqd5QHMYXitWYJ35hAjJu', 'Mahasiswa', 0, '2023-06-09 00:25:08', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (62, 4, 'siti', '$2y$10$/OrMUXRGjXak6ScK0M/oyuO97ObkrLpQ87N7M2MbDuwmjNH12ZmVO', 'Siti', 0, '2023-06-09 00:43:00', '2023-06-21 14:57:10');
INSERT INTO `user` VALUES (63, 4, 'mahasiswa2', '$2y$10$WGaGLu/DpB32z/YyAYw4OeW6fwzuDs533WnnVmhaFPevdUM63Dkgi', 'Mahasiswa2', 0, '2023-06-15 10:46:21', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (64, 3, 'Aan', '$2y$10$.yVLQy6L6UCAQq.HTdR7.OJs44JwfIPyi0LYWJVlN7i9gNeqZUwaC', 'Aan', 0, '2023-06-15 22:35:16', '2023-06-21 15:41:25');
INSERT INTO `user` VALUES (65, 3, '19108503', '$2y$10$AWFny9WiO1er1VbJkVR.6OgK9nMwnpWbhW4Tfn3SJJ5JV4Ddl2x3m', 'Beta', 0, '2023-06-15 22:35:16', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (66, 3, '19108504', '$2y$10$YtIlzZtZMzrvO3xxn0g7cOferd9MX9TwfBF7di21yMrK4ES7KtUfq', 'Cika', 0, '2023-06-15 22:35:16', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (67, 3, '19108505', '$2y$10$h3V42NCZ/rYYCYNnsM7nyOcg13Hu6voBOn83LFh5yB1GXJ0FvmMxW', 'Dwi', 0, '2023-06-15 22:35:16', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (68, 4, 'mahasiswa3', '$2y$10$7EOrTsRuwprdEazAg4L6D.2EZaAaWJ2ZV7gIZPQYcX51eiMHuATyW', 'Mahasiswa3', 0, '2023-06-18 21:52:52', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (69, 4, 'mhs', '$2y$10$PXxdazJ.eqP4gZBfJAgVe.96uIZtgxdg/bwOQy4OrSvan96X35FYO', 'mhs', 0, '2023-06-21 16:06:19', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (70, 4, 'mhs2', '$2y$10$c4TDZE.bft1NPJK.qavxI.5HVEcdmonFPSL75IetUGotN2iP3KTIm', 'mhs2', 0, '2023-06-23 09:31:25', '2023-07-03 14:47:19');
INSERT INTO `user` VALUES (71, 4, 'mhs3', '$2y$10$AKTZojKILMLCxee42XLuJO6v1.ghw3IBxQYUaseeAjhm.NYKv0UHS', 'mhs3', 0, '2023-06-24 20:48:53', '2023-07-03 14:47:54');
INSERT INTO `user` VALUES (72, 4, 'aa3', '$2y$10$qkxOR6fKH1z7u0sJpxkOWert8fwyb9I/w5smPP2ILxGN59ISdZRiG', 'aa3', 0, '2023-06-24 22:35:56', '2023-07-03 00:46:48');
INSERT INTO `user` VALUES (73, 4, 'bbb', '$2y$10$hZegY3d58VFJqVa2QIGfdOzCiwS78R7T2tE7l9YSW0m2joAhx.9I.', 'Bb', 0, '2023-06-24 22:35:56', '2023-07-03 15:35:43');
INSERT INTO `user` VALUES (74, 4, 'aa5', '$2y$10$QLBd1v6yPpS0qRcAHVHdZOo4BRhkSKraRu00led/XXQLky1FYV7IG', 'aa5', 0, '2023-06-24 22:35:56', '2023-07-03 00:56:47');
INSERT INTO `user` VALUES (75, 4, 'aa6', '$2y$10$LOzS0dN/bVoVO0Bn7ZQ5J.evPa.AWWJwqlCHx5mfuFrfTWZAcwZNG', 'aa6', 0, '2023-06-24 22:35:56', '2023-07-03 23:20:56');
INSERT INTO `user` VALUES (76, 4, 'aa4', '$2y$10$PxELsTQkTyiEw86FSYuS8uAulcKhD3PKmF4G.kxJsdnMSCbzY.9sS', 'aa4', 0, '2023-06-24 22:39:24', '2023-07-03 00:47:12');
INSERT INTO `user` VALUES (77, 4, 'Aa', '$2y$10$u4jiFw7hbkj6gYZ2Nan.feFKSPeR.Z2lq3Eg1qTvFzi5V4cN0VkHG', 'A', 0, '2023-06-24 22:39:24', '2023-07-02 10:47:40');
INSERT INTO `user` VALUES (78, 4, 'cobaproyek2', '$2y$10$583eGuaOK9wmZ2Hpoos6A.FyQnnZSOCei/.LHG7gDapNkYcojXb16', 'cobaproyek2', 0, '2023-06-24 22:39:24', '2023-07-01 22:27:56');
INSERT INTO `user` VALUES (79, 4, 'cobaproyek', '$2y$10$61zh1WfAdQsBSXZZ5sVLfOhlslc51haFsFLJ6tG0qRDYUuOLe.mt.', 'cobaproyek', 0, '2023-06-24 22:39:24', '2023-07-01 22:19:43');
INSERT INTO `user` VALUES (80, 4, 'mahasiswa1', '$2y$10$ANA7zPWbKrTYoEN2GKfGzeEB3WJLYgRgCIBIrdDOCFc5uJrSpZ0nu', 'Mahasiswa1', 0, '2023-06-25 15:07:11', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (81, 4, 'mahasiswausul', '$2y$10$.M5JpzFujgmRIEsHDWHmUew.g1EuT0vHOuUcGRgbOxATeODcb0gVO', 'mahasiswa usul', 0, '2023-06-25 21:11:44', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (82, 2, '1911108502', '$2y$10$iuEI3QZzz3VRohROHd/aGe.uUPgS.IrLAjKzLPEwyDADBvOlPXzei', 'Aan', 0, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (83, 2, '1910850344', '$2y$10$Hh7ahK2WVuDDycRzcb/toO1RIgsxHSZeWm9NYL/WgHWAvQIElB1Ly', 'Beta', 0, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (84, 2, '1910850433', '$2y$10$phFM1PHTuiV64QTmjjlAEO1Z4xieC6YiRMt02afQuyLWrY6pdlSiK', 'Cika', 0, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (85, 2, '1910850544', '$2y$10$57hEC2KhduhP2w0cYjj2Xuan0pIPj.R4w2d5SeK9znYb9iYTBgtXy', 'Dwi', 0, '2023-07-01 21:35:51', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (86, 4, 'cobausul', '$2y$10$3ww4CR3ZufTM9mfTCxAQb.IIG.7NmjV/I0Fk0qSECZZ05EAf9jSFq', 'cobausul', 0, '2023-07-01 21:58:11', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (87, 4, 'aa2', '$2y$10$tKmBGwnGIKOOL7Dy2Ljf7OrFe13iIZHqjqc.schXx5jUJinEoJvUK', 'aa2', 0, '2023-07-02 21:55:41', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (88, 4, 'Ara', '$2y$10$AGsNwWoS4xpB9/gOMyMEwuK0Cnn52QGGUnrYeEKRIYoWhzM17xtdG', 'Ara', 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (89, 4, 'Bina', '$2y$10$Qas4of5haTtTk7xEL9XyM.idIIJOEyI8pyw6W9AIbMNmg/aKhKaXO', 'Bina', 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (90, 4, 'Cici', '$2y$10$XQB8XKBj0SDrujJpfZ4fEu5F6nN2oju0YvpCdancjBdF.efz8PcXq', 'Cici', 0, '2023-07-04 00:29:13', '0000-00-00 00:00:00');
INSERT INTO `user` VALUES (91, 4, 'coba', '$2y$10$cJWhgbbLyKqEsHZHfN3xNeSQTJL.I1RuuqDSCV7Bmyts/RIzeHbcK', 'coba', 0, '2023-07-04 00:29:13', '2023-07-04 00:59:01');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id_user_role` tinyint NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user_role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 'Kaprodi', '2018-03-05 09:59:03', '2018-03-13 08:22:54');
INSERT INTO `user_role` VALUES (2, 'Akademik', '2018-03-05 09:59:58', '2018-03-13 08:22:51');
INSERT INTO `user_role` VALUES (3, 'Dosen', '2018-03-05 10:00:33', '2018-03-13 08:23:16');
INSERT INTO `user_role` VALUES (4, 'Mahasiswa', '2018-03-13 08:23:26', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for usulan
-- ----------------------------
DROP TABLE IF EXISTS `usulan`;
CREATE TABLE `usulan`  (
  `id_usulan` int NOT NULL AUTO_INCREMENT,
  `id_pengajuan_ta` int NOT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bisnis_rule` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_persetujuan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_dosen` int NULL DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usulan`) USING BTREE,
  INDEX `id_pengajuan_ta`(`id_pengajuan_ta` ASC) USING BTREE,
  INDEX `id_dosen`(`id_dosen` ASC) USING BTREE,
  CONSTRAINT `usulan_ibfk_1` FOREIGN KEY (`id_pengajuan_ta`) REFERENCES `pengajuan_ta` (`id_pengajuan_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usulan_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usulan
-- ----------------------------
INSERT INTO `usulan` VALUES (53, 79, 'usul', 'usulann', 'a', 'proposal-1687702456.pdf', 12, '2023-06-25 21:14:16', '2023-06-25 21:15:45');
INSERT INTO `usulan` VALUES (55, 81, 'AAA', NULL, 'b', 'proposal-1688047353.pdf', NULL, '2023-06-29 20:52:31', '2023-06-29 21:02:33');
INSERT INTO `usulan` VALUES (56, 85, 'TUGAS', NULL, 'TUGAS ', 'proposal-1688260406.pdf', 12, '2023-07-02 08:13:28', '2023-07-02 08:14:38');
INSERT INTO `usulan` VALUES (57, 89, 'USUL IDE2', NULL, 'x', 'proposal-1688320193.pdf', 30, '2023-07-03 00:47:57', '2023-07-03 00:50:35');
INSERT INTO `usulan` VALUES (58, 90, 'B', NULL, 'x', 'proposal-1688320692.pdf', 30, '2023-07-03 00:58:12', '2023-07-03 00:59:19');
INSERT INTO `usulan` VALUES (59, 92, 'SISTEM JURUSAN', NULL, '', 'proposal-1688372588.pdf', 30, '2023-07-03 15:18:37', '2023-07-03 15:24:54');

-- ----------------------------
-- Table structure for validasi_berkas_sidang
-- ----------------------------
DROP TABLE IF EXISTS `validasi_berkas_sidang`;
CREATE TABLE `validasi_berkas_sidang`  (
  `id_valid_sidang` int NOT NULL AUTO_INCREMENT,
  `id_sidang` int NOT NULL,
  `id_berkas_sidang` int NOT NULL,
  `path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isValid` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_valid_sidang`) USING BTREE,
  INDEX `id_sidang`(`id_sidang` ASC) USING BTREE,
  INDEX `id_berkas_sidang`(`id_berkas_sidang` ASC) USING BTREE,
  CONSTRAINT `validasi_berkas_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `validasi_berkas_sidang_ibfk_2` FOREIGN KEY (`id_berkas_sidang`) REFERENCES `berkas_sidang` (`id_berkas_sidang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 287 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of validasi_berkas_sidang
-- ----------------------------
INSERT INTO `validasi_berkas_sidang` VALUES (211, 22, 1, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (212, 22, 2, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (213, 22, 3, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (214, 22, 4, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (215, 22, 5, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (216, 22, 6, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (217, 22, 7, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (218, 22, 8, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (219, 22, 9, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (220, 22, 10, '', 0, '2023-06-25 23:05:50', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (221, 23, 1, 'sidang-1-1688270176.pdf', 2, '2023-06-29 22:42:49', '2023-07-02 10:58:31');
INSERT INTO `validasi_berkas_sidang` VALUES (222, 23, 2, 'sidang-2-1688270257.pdf', 2, '2023-06-29 22:42:49', '2023-07-02 10:58:37');
INSERT INTO `validasi_berkas_sidang` VALUES (223, 23, 3, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (224, 23, 4, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (225, 23, 5, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (226, 23, 6, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (227, 23, 7, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (228, 23, 8, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (229, 23, 9, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (230, 23, 10, '', 0, '2023-06-29 22:42:49', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (231, 24, 1, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (232, 24, 2, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (233, 24, 3, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (234, 24, 4, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (235, 24, 5, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (236, 24, 6, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (237, 24, 7, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (238, 24, 8, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (239, 24, 9, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (240, 24, 10, '', 0, '2023-07-02 08:42:07', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (241, 25, 1, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (242, 25, 2, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (243, 25, 3, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (244, 25, 4, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (245, 25, 5, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (246, 25, 6, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (247, 25, 7, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (248, 25, 8, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (249, 25, 9, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (250, 25, 10, '', 0, '2023-07-02 11:09:46', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (251, 26, 1, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (252, 26, 2, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (253, 26, 3, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (254, 26, 4, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (255, 26, 5, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (256, 26, 6, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (257, 26, 7, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (258, 26, 8, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (259, 26, 9, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (260, 26, 10, '', 0, '2023-07-02 22:02:39', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (261, 27, 1, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (262, 27, 2, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (263, 27, 3, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (264, 27, 4, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (265, 27, 5, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (266, 27, 6, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (267, 27, 7, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (268, 27, 8, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (269, 27, 9, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (270, 27, 10, '', 0, '2023-07-02 22:25:26', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (271, 29, 1, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (272, 29, 2, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (273, 29, 3, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (274, 29, 4, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (275, 29, 5, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (276, 29, 6, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (277, 29, 7, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (278, 29, 8, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (279, 29, 9, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (280, 29, 10, '', 0, '2023-07-02 23:23:37', '2023-07-03 00:26:01');
INSERT INTO `validasi_berkas_sidang` VALUES (281, 30, 9, '', 0, '2023-07-03 01:08:06', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (282, 31, 9, '', 0, '2023-07-03 11:35:18', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (283, 32, 9, '', 0, '2023-07-03 15:13:54', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (284, 33, 9, '', 0, '2023-07-03 15:33:18', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (285, 34, 9, '', 0, '2023-07-03 22:36:34', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_sidang` VALUES (286, 35, 9, 'sidang-9-1688487835.pdf', 1, '2023-07-04 23:11:25', '2023-07-04 23:23:55');

-- ----------------------------
-- Table structure for validasi_berkas_yudisium
-- ----------------------------
DROP TABLE IF EXISTS `validasi_berkas_yudisium`;
CREATE TABLE `validasi_berkas_yudisium`  (
  `id_valid_yudisium` int NOT NULL AUTO_INCREMENT,
  `id_yudisium` int NOT NULL,
  `id_berkas_yudisium` int NOT NULL,
  `path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isValid` tinyint NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_valid_yudisium`) USING BTREE,
  INDEX `id_yudisium`(`id_yudisium` ASC) USING BTREE,
  INDEX `id_berkas_yudisium`(`id_berkas_yudisium` ASC) USING BTREE,
  CONSTRAINT `validasi_berkas_yudisium_ibfk_1` FOREIGN KEY (`id_yudisium`) REFERENCES `yudisium` (`id_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `validasi_berkas_yudisium_ibfk_2` FOREIGN KEY (`id_berkas_yudisium`) REFERENCES `berkas_yudisium` (`id_berkas_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of validasi_berkas_yudisium
-- ----------------------------
INSERT INTO `validasi_berkas_yudisium` VALUES (22, 4, 1, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (23, 4, 2, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (24, 4, 3, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (25, 4, 4, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (26, 4, 5, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (27, 4, 6, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (28, 4, 7, '', 0, '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (29, 5, 5, 'yudisium-5-1688442526.pdf', 1, '2023-07-03 21:51:40', '2023-07-04 10:48:46');
INSERT INTO `validasi_berkas_yudisium` VALUES (30, 6, 5, '', 0, '2023-07-03 21:55:02', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (31, 6, 6, '', 0, '2023-07-03 21:55:02', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (32, 7, 5, '', 0, '2023-07-03 22:08:55', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (33, 7, 6, '', 0, '2023-07-03 22:08:55', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (34, 8, 5, '', 0, '2023-07-05 00:05:32', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (35, 8, 6, '', 0, '2023-07-05 00:05:32', '0000-00-00 00:00:00');
INSERT INTO `validasi_berkas_yudisium` VALUES (36, 8, 7, '', 0, '2023-07-05 00:05:32', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for yudisium
-- ----------------------------
DROP TABLE IF EXISTS `yudisium`;
CREATE TABLE `yudisium`  (
  `id_yudisium` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `id_periode` int NOT NULL,
  `status` enum('disetujui','pending') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_yudisium`) USING BTREE,
  INDEX `id_mahasiswa`(`id_mahasiswa` ASC) USING BTREE,
  INDEX `id_periode`(`id_periode` ASC) USING BTREE,
  CONSTRAINT `yudisium_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yudisium_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yudisium
-- ----------------------------
INSERT INTO `yudisium` VALUES (4, 62, 63, 'pending', '2023-07-02 22:31:19', '0000-00-00 00:00:00');
INSERT INTO `yudisium` VALUES (5, 44, 63, 'pending', '2023-07-03 21:51:40', '0000-00-00 00:00:00');
INSERT INTO `yudisium` VALUES (6, 51, 63, 'pending', '2023-07-03 21:55:02', '0000-00-00 00:00:00');
INSERT INTO `yudisium` VALUES (7, 61, 63, 'pending', '2023-07-03 22:08:55', '0000-00-00 00:00:00');
INSERT INTO `yudisium` VALUES (8, 54, 63, 'pending', '2023-07-05 00:05:32', '0000-00-00 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
