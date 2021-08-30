-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 05:47 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_config`
--

CREATE TABLE `tb_config` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(225) DEFAULT NULL,
  `logo_sekolah` varchar(225) DEFAULT NULL,
  `buka_pendaftaran` date DEFAULT NULL,
  `tutup_pendaftaran` date DEFAULT NULL,
  `tahun_ajaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_config`
--

INSERT INTO `tb_config` (`id`, `nama_sekolah`, `logo_sekolah`, `buka_pendaftaran`, `tutup_pendaftaran`, `tahun_ajaran`) VALUES
(1, 'SMA AL MULTAZAM', '20210828120147sip.png', '2021-08-28', '2021-08-31', '2021/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_pembayaran`
--

CREATE TABLE `tb_jenis_pembayaran` (
  `id` int(11) NOT NULL,
  `jenis` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_pembayaran`
--

INSERT INTO `tb_jenis_pembayaran` (`id`, `jenis`) VALUES
(1, 'Pembayaran Pendaftaran'),
(3, 'SPP'),
(4, 'SKS'),
(5, 'Perpustakaan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id` int(11) NOT NULL,
  `nama_jurusan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id`, `nama_jurusan`) VALUES
(2, 'Rekayasa Perangkat Lunak'),
(3, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `grade` char(5) NOT NULL,
  `nama_kelas` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `grade`, `nama_kelas`) VALUES
(1, 'X', 'RPL 1'),
(3, 'XI', 'RPL 1'),
(4, 'XII', 'RPL 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orang_tua`
--

CREATE TABLE `tb_orang_tua` (
  `id` int(11) NOT NULL,
  `nama_ortu` varchar(225) NOT NULL,
  `pendidikan` varchar(225) NOT NULL,
  `pekerjaan` varchar(225) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_orang_tua`
--

INSERT INTO `tb_orang_tua` (`id`, `nama_ortu`, `pendidikan`, `pekerjaan`, `user_id`) VALUES
(1, 'Mama', 'SMP', 'Kerja', 9),
(2, 'irwan', 'sd', 'buruh', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `tagihan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran_id` int(11) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `foto_bukti` text NOT NULL,
  `konfirm` smallint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `user_id`, `tagihan_id`, `jenis_pembayaran_id`, `jumlah`, `foto_bukti`, `konfirm`, `created_at`) VALUES
(5, 9, 4, 1, 1000000, '2021081817195701d7cb9111b63a0c9736ed52b54767c4.jpg', 1, '0000-00-00 00:00:00'),
(6, 9, 2, 4, 200000, '202108241813173.jpg', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `nisn` varchar(30) DEFAULT NULL,
  `nama` varchar(40) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(13) NOT NULL,
  `upload_ijazah` varchar(50) DEFAULT NULL,
  `upload_skhun` varchar(50) DEFAULT NULL,
  `upload_kk` text DEFAULT NULL,
  `upload_akte` text DEFAULT NULL,
  `upload_ktp_ortu` text NOT NULL,
  `bukti_pembayaran` varchar(125) DEFAULT NULL,
  `status_bukti_bayar` int(11) DEFAULT NULL,
  `kode_siswa` char(10) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `no_telpon`, `upload_ijazah`, `upload_skhun`, `upload_kk`, `upload_akte`, `upload_ktp_ortu`, `bukti_pembayaran`, `status_bukti_bayar`, `kode_siswa`, `status`, `created`) VALUES
(10, NULL, '0027235268', 'Bendi Tandayu Saputra', 'Laki-Laki', 'Banjarnegara', '2005-02-16', 'Islam', 'Banjarnegara', '084526453274', '202108151631001.png', '2021081516330934-web_essential-128.png', '202108151633463.jpg', '2021081516341583944.jpg', '20210815163539twit.png', NULL, NULL, 'YLGFF5P0J3', 0, '2021-08-08 16:07:29'),
(11, NULL, '2321312412', 'verdian', 'Laki-Laki', 'Tangerang', '2000-02-29', 'islam', 'sepatan timur', '0895334930931', '20210828112046sip.png', '2021082811205612-1.jpg', '20210828112130download.jpg', '20210828112223download.jpg', '20210828112000igg.png', NULL, NULL, 'Q4SLZXPMIH', 0, '2021-08-28 12:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `tahun_masuk` char(10) NOT NULL,
  `tahun_keluar` char(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `tanggal_diterima`, `tahun_masuk`, `tahun_keluar`, `user_id`) VALUES
(3, '2021-08-23', '2021', NULL, 9),
(4, '2021-08-28', '2021', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `id` int(11) NOT NULL,
  `jenis_pembayaran_id` int(11) NOT NULL,
  `tahun_ajaran` char(20) NOT NULL,
  `grade_tagihan` char(11) NOT NULL,
  `jumlah_tagihan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`id`, `jenis_pembayaran_id`, `tahun_ajaran`, `grade_tagihan`, `jumlah_tagihan`) VALUES
(1, 3, '2021/2022', 'X', 1000000),
(2, 4, '2021/2022', 'X', 200000),
(3, 5, '2021/2022', 'X', 100000),
(4, 1, '2021/2022', 'X', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `orang_tua_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `pendaftaran_id`, `orang_tua_id`, `siswa_id`, `jurusan_id`, `kelas_id`, `nama`, `email`, `password`, `role_id`, `status`, `created`) VALUES
(3, 4, 0, 2, 0, 0, 'admin', 'admin@gmail.com', '$2y$10$Zu3BBoRwN365v3JOTTUw2eQyBjuOmqpcDUHarp9YSGF2LO0QrNQCe', 1, 1, '2021-07-28 22:50:05'),
(9, 10, 1, 3, 2, 1, 'Bendi Tandayu Saputra', 'bend@gmail.com', '$2y$10$8Jwxe3kh1pGsVFD48OHsxOmY5oLDzNR/qH8RxmsN783bT093EetHq', 3, 1, '2021-08-08 16:07:29'),
(10, 0, 0, 0, 0, 0, 'aldi', 'aldi@gmail.com', '$2y$10$ze88KawYZVX3oY3gIF3wu.NfYVa2oN9nUQr80euFBa4keDNPZpoy6', 0, 1, '2021-08-28 11:42:28'),
(11, 11, 2, 4, 2, 1, 'verdian', 'verdian@gmail.com', '$2y$10$pba6iVt9mCxrEtn7MXj5QO7V6bdXqh3OWlYc8MHGGWDye2bhskqqq', 2, 1, '2021-08-28 12:03:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_config`
--
ALTER TABLE `tb_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jenis_pembayaran`
--
ALTER TABLE `tb_jenis_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_orang_tua`
--
ALTER TABLE `tb_orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_pembayaran_id` (`jenis_pembayaran_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `jurusan_id` (`jurusan_id`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`),
  ADD KEY `ortu_id` (`orang_tua_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_config`
--
ALTER TABLE `tb_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jenis_pembayaran`
--
ALTER TABLE `tb_jenis_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_orang_tua`
--
ALTER TABLE `tb_orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`jenis_pembayaran_id`) REFERENCES `tb_jenis_pembayaran` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
