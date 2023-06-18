-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2018 at 09:24 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bismillah`
--

-- --------------------------------------------------------

--
-- Table structure for table `akademik`
--

CREATE TABLE `akademik` (
  `id_akademik` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik`
--

INSERT INTO `akademik` (`id_akademik`, `nama`, `isDeleted`, `id_user`, `createdDtm`, `updatedDtm`) VALUES
(2, 'Kaprodi', 0, 7, '2018-04-27 13:27:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_sidang`
--

CREATE TABLE `anggota_sidang` (
  `id_anggota_sidang` int(11) NOT NULL,
  `id_sidang` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `role` enum('ketua','sekretaris','anggota') NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_sidang`
--

CREATE TABLE `berkas_sidang` (
  `id_berkas_sidang` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas_sidang`
--

INSERT INTO `berkas_sidang` (`id_berkas_sidang`, `nama_berkas`, `isDeleted`, `createdDtm`, `updateDtm`) VALUES
(1, 'Laporan Tugas Akhir', 0, '2018-04-27 12:58:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_yudisium`
--

CREATE TABLE `berkas_yudisium` (
  `id_berkas_yudisium` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosbing`
--

CREATE TABLE `dosbing` (
  `id_dosbing` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `skill` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nid`, `nama`, `foto`, `email`, `mobile`, `skill`, `isDeleted`, `id_user`, `createdDtm`, `updatedDtm`) VALUES
(4, '', 'Kaprodi', '', '', '', '', 0, 7, '2018-04-27 13:27:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidang`
--

CREATE TABLE `jadwal_sidang` (
  `id_jadwal` int(11) NOT NULL,
  `id_sidang` int(11) NOT NULL,
  `waktu` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ruang` varchar(255) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kaprodi`
--

CREATE TABLE `kaprodi` (
  `id_kaprodi` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nid` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_akademik` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kaprodi`
--

INSERT INTO `kaprodi` (`id_kaprodi`, `nama`, `nid`, `id_user`, `id_dosen`, `id_akademik`, `isDeleted`, `createdDtm`, `updatedDtm`) VALUES
(2, 'Kaprodi', '', 7, 4, 2, 0, '2018-04-27 13:27:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id_komponen` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komponen_nilai`
--

CREATE TABLE `komponen_nilai` (
  `id_komponen_nilai` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_pesan`
--

CREATE TABLE `log_pesan` (
  `id_log` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `ipk` decimal(10,2) NOT NULL,
  `jumlah_SKS` int(5) NOT NULL,
  `skill` text NOT NULL,
  `pengalaman` text NOT NULL,
  `prodi` varchar(128) NOT NULL DEFAULT 'Komsi',
  `id_user` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `email`, `mobile`, `foto`, `ipk`, `jumlah_SKS`, `skill`, `pengalaman`, `prodi`, `id_user`, `isDeleted`, `createdDtm`, `updatedDtm`) VALUES
(3, '15/392819/SV/09348', 'Mahasiswa', '', '', '', '0.00', 0, '', '', 'Komsi', 8, 0, '2018-04-27 13:28:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_ta`
--

CREATE TABLE `pengajuan_ta` (
  `id_pengajuan_ta` int(11) NOT NULL,
  `id_ta` int(11) DEFAULT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `pilihan` tinyint(4) NOT NULL,
  `status` enum('diterima','proses') NOT NULL DEFAULT 'proses',
  `jenis` enum('proyek','usul') NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lampiran` varchar(128) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nilai_akhir_dosen` decimal(10,2) DEFAULT '0.00',
  `id_anggota_sidang` int(11) DEFAULT NULL,
  `id_sidang` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `status_periode` tinyint(4) DEFAULT '0',
  `tgl_awal_regis_ta` date DEFAULT NULL,
  `tgl_akhir_regis_ta` date DEFAULT NULL,
  `tgl_awal_regis_yudisium` date DEFAULT NULL,
  `tgl_akhir_regis_yudisium` date DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `klien` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','pending','ditolak') NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `revisi_sidang`
--

CREATE TABLE `revisi_sidang` (
  `id_revisi_sidang` int(11) NOT NULL,
  `id_anggota_sidang` int(11) NOT NULL,
  `path` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sidang`
--

CREATE TABLE `sidang` (
  `id_sidang` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `nilai_akhir_sidang` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('disetujui','pending','lulus','lulus_revisi','mengulang') NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir`
--

CREATE TABLE `tugas_akhir` (
  `id_ta` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `status_pengambilan` enum('proses','terplotting') NOT NULL DEFAULT 'proses',
  `id_periode` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_user_role` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_user_role`, `username`, `password`, `nama`, `isDeleted`, `createdDtm`, `updatedDtm`) VALUES
(1, 2, 'akademik', '$2y$10$oSwiY0jqAkt3olf1Tp/ZXeUDKNiVDwyswxf6QnxW.gLS.swz1eOJG', 'Akademik', 0, '2018-04-27 12:55:45', '0000-00-00 00:00:00'),
(7, 1, 'kaprodi', '$2y$10$eT/TzxUgr2HP3iR6bmTvR.os/RHVww4F7bVmLvik/j5R3SXZKfWa6', 'Kaprodi', 0, '2018-04-27 13:27:58', '0000-00-00 00:00:00'),
(8, 4, 'mahasiswa', '$2y$10$rkGinwBOEqawFaTS.7iMgOJwOqYSqQewCX80loMvF.8.eZyb.PYOO', 'Mahasiswa', 0, '2018-04-27 13:28:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_user_role` tinyint(4) NOT NULL,
  `role` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_user_role`, `role`, `createdDtm`, `updateDtm`) VALUES
(1, 'Kaprodi', '2018-04-27 12:29:22', '0000-00-00 00:00:00'),
(2, 'Akademik', '2018-04-27 12:29:22', '0000-00-00 00:00:00'),
(3, 'Dosen', '2018-04-27 12:29:22', '0000-00-00 00:00:00'),
(4, 'Mahasiswa', '2018-04-27 12:29:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `id_usulan` int(11) NOT NULL,
  `id_pengajuan_ta` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `bisnis_rule` text NOT NULL,
  `file_persetujuan` varchar(128) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `validasi_berkas_sidang`
--

CREATE TABLE `validasi_berkas_sidang` (
  `id_valid_sidang` int(11) NOT NULL,
  `id_sidang` int(11) NOT NULL,
  `id_berkas_sidang` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isValid` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `validasi_berkas_yudisium`
--

CREATE TABLE `validasi_berkas_yudisium` (
  `id_valid_yudisium` int(11) NOT NULL,
  `id_yudisium` int(11) NOT NULL,
  `id_berkas_yudisium` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `isValid` tinyint(4) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `yudisium`
--

CREATE TABLE `yudisium` (
  `id_yudisium` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `status` enum('disetujui','pending') NOT NULL DEFAULT 'pending',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akademik`
--
ALTER TABLE `akademik`
  ADD PRIMARY KEY (`id_akademik`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `anggota_sidang`
--
ALTER TABLE `anggota_sidang`
  ADD PRIMARY KEY (`id_anggota_sidang`),
  ADD KEY `id_sidang` (`id_sidang`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `berkas_sidang`
--
ALTER TABLE `berkas_sidang`
  ADD PRIMARY KEY (`id_berkas_sidang`);

--
-- Indexes for table `berkas_yudisium`
--
ALTER TABLE `berkas_yudisium`
  ADD PRIMARY KEY (`id_berkas_yudisium`);

--
-- Indexes for table `dosbing`
--
ALTER TABLE `dosbing`
  ADD PRIMARY KEY (`id_dosbing`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_sidang` (`id_sidang`);

--
-- Indexes for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD PRIMARY KEY (`id_kaprodi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_akademik` (`id_akademik`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id_komponen`);

--
-- Indexes for table `komponen_nilai`
--
ALTER TABLE `komponen_nilai`
  ADD PRIMARY KEY (`id_komponen_nilai`),
  ADD KEY `id_komponen` (`id_komponen`),
  ADD KEY `id_penilaian` (`id_penilaian`);

--
-- Indexes for table `log_pesan`
--
ALTER TABLE `log_pesan`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pengajuan_ta`
--
ALTER TABLE `pengajuan_ta`
  ADD PRIMARY KEY (`id_pengajuan_ta`),
  ADD KEY `id_ta` (`id_ta`),
  ADD KEY `id_proyek` (`id_proyek`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_sidang` (`id_sidang`),
  ADD KEY `peniaian_ibfk_3` (`id_anggota_sidang`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `revisi_sidang`
--
ALTER TABLE `revisi_sidang`
  ADD PRIMARY KEY (`id_revisi_sidang`),
  ADD KEY `id_anggota_sidang` (`id_anggota_sidang`);

--
-- Indexes for table `sidang`
--
ALTER TABLE `sidang`
  ADD PRIMARY KEY (`id_sidang`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD PRIMARY KEY (`id_ta`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_role` (`id_user_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_user_role`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id_usulan`),
  ADD KEY `id_pengajuan_ta` (`id_pengajuan_ta`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `validasi_berkas_sidang`
--
ALTER TABLE `validasi_berkas_sidang`
  ADD PRIMARY KEY (`id_valid_sidang`),
  ADD KEY `id_sidang` (`id_sidang`),
  ADD KEY `id_berkas_sidang` (`id_berkas_sidang`);

--
-- Indexes for table `validasi_berkas_yudisium`
--
ALTER TABLE `validasi_berkas_yudisium`
  ADD PRIMARY KEY (`id_valid_yudisium`),
  ADD KEY `id_yudisium` (`id_yudisium`),
  ADD KEY `id_berkas_yudisium` (`id_berkas_yudisium`);

--
-- Indexes for table `yudisium`
--
ALTER TABLE `yudisium`
  ADD PRIMARY KEY (`id_yudisium`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_periode` (`id_periode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akademik`
--
ALTER TABLE `akademik`
  MODIFY `id_akademik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `anggota_sidang`
--
ALTER TABLE `anggota_sidang`
  MODIFY `id_anggota_sidang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `berkas_sidang`
--
ALTER TABLE `berkas_sidang`
  MODIFY `id_berkas_sidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `berkas_yudisium`
--
ALTER TABLE `berkas_yudisium`
  MODIFY `id_berkas_yudisium` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosbing`
--
ALTER TABLE `dosbing`
  MODIFY `id_dosbing` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kaprodi`
--
ALTER TABLE `kaprodi`
  MODIFY `id_kaprodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id_komponen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `komponen_nilai`
--
ALTER TABLE `komponen_nilai`
  MODIFY `id_komponen_nilai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_pesan`
--
ALTER TABLE `log_pesan`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengajuan_ta`
--
ALTER TABLE `pengajuan_ta`
  MODIFY `id_pengajuan_ta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `revisi_sidang`
--
ALTER TABLE `revisi_sidang`
  MODIFY `id_revisi_sidang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sidang`
--
ALTER TABLE `sidang`
  MODIFY `id_sidang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_user_role` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `validasi_berkas_sidang`
--
ALTER TABLE `validasi_berkas_sidang`
  MODIFY `id_valid_sidang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `validasi_berkas_yudisium`
--
ALTER TABLE `validasi_berkas_yudisium`
  MODIFY `id_valid_yudisium` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yudisium`
--
ALTER TABLE `yudisium`
  MODIFY `id_yudisium` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `akademik`
--
ALTER TABLE `akademik`
  ADD CONSTRAINT `akademik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota_sidang`
--
ALTER TABLE `anggota_sidang`
  ADD CONSTRAINT `anggota_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_sidang_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosbing`
--
ALTER TABLE `dosbing`
  ADD CONSTRAINT `dosbing_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosbing_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_sidang`
--
ALTER TABLE `jadwal_sidang`
  ADD CONSTRAINT `jadwal_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kaprodi_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kaprodi_ibfk_3` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen_nilai`
--
ALTER TABLE `komponen_nilai`
  ADD CONSTRAINT `komponen_nilai_ibfk_1` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komponen_nilai_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_ta`
--
ALTER TABLE `pengajuan_ta`
  ADD CONSTRAINT `pengajuan_ta_ibfk_1` FOREIGN KEY (`id_ta`) REFERENCES `tugas_akhir` (`id_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ta_ibfk_2` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `proyek_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `revisi_sidang`
--
ALTER TABLE `revisi_sidang`
  ADD CONSTRAINT `revisi_sidang_ibfk_1` FOREIGN KEY (`id_anggota_sidang`) REFERENCES `anggota_sidang` (`id_anggota_sidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sidang`
--
ALTER TABLE `sidang`
  ADD CONSTRAINT `sidang_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD CONSTRAINT `tugas_akhir_ibfk_6` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tugas_akhir_ibfk_7` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_role`) REFERENCES `user_role` (`id_user_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usulan`
--
ALTER TABLE `usulan`
  ADD CONSTRAINT `usulan_ibfk_1` FOREIGN KEY (`id_pengajuan_ta`) REFERENCES `pengajuan_ta` (`id_pengajuan_ta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usulan_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `validasi_berkas_sidang`
--
ALTER TABLE `validasi_berkas_sidang`
  ADD CONSTRAINT `validasi_berkas_sidang_ibfk_1` FOREIGN KEY (`id_sidang`) REFERENCES `sidang` (`id_sidang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `validasi_berkas_sidang_ibfk_2` FOREIGN KEY (`id_berkas_sidang`) REFERENCES `berkas_sidang` (`id_berkas_sidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `validasi_berkas_yudisium`
--
ALTER TABLE `validasi_berkas_yudisium`
  ADD CONSTRAINT `validasi_berkas_yudisium_ibfk_1` FOREIGN KEY (`id_yudisium`) REFERENCES `yudisium` (`id_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `validasi_berkas_yudisium_ibfk_2` FOREIGN KEY (`id_berkas_yudisium`) REFERENCES `berkas_yudisium` (`id_berkas_yudisium`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yudisium`
--
ALTER TABLE `yudisium`
  ADD CONSTRAINT `yudisium_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yudisium_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
