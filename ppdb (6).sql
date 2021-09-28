-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2021 at 09:07 AM
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
-- Table structure for table `calon_siswa`
--

CREATE TABLE `calon_siswa` (
  `id_calon` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(125) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(11) NOT NULL,
  `pembayaran` varchar(11) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'SMA AL MULTAZAM', '20210904062355sip.png', '2021-08-28', '2021-09-30', '2021/2022');

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
(3, 'Marketing'),
(4, 'AP'),
(5, 'Multimedia');

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
(4, 'XII', 'RPL 1'),
(5, 'X', 'Multimedia'),
(6, 'XI', 'Multimedia'),
(7, 'X', 'Keperawatan');

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
(2, 'irwan', 'sd', 'buruh', 11),
(3, 'irwan', 'sd', 'web developer', 13),
(4, 'irwan', 'sd', 'web developer', 14),
(5, 'irwan', 'sd', 'buruh ', 15),
(6, 'irwan', 'sd', 'buruh tani', 16),
(7, 'irwan', 'sd', 'web developer', 17),
(8, 'irwan', 'sd', 'buruh', 18),
(9, 'irwan', 'sd', 'buruh', 20);

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `user_id`, `tagihan_id`, `jenis_pembayaran_id`, `jumlah`, `foto_bukti`, `konfirm`, `created_at`) VALUES
(8, 12, 1, 1, 1000000, 'Logo-UMT-Universitas-Muhammadiyah-Tangerang-Original.png', 1, '2021-09-15 07:08:26'),
(17, 14, 1, 3, 1000000, '20210920015823tanggal.png', 1, '2021-09-20 06:58:23'),
(18, 15, 2, 1, 1500000, '20210920060710Asset_1.png', 0, '2021-09-20 11:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id` int(11) NOT NULL,
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

INSERT INTO `tb_pendaftaran` (`id`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `no_telpon`, `upload_ijazah`, `upload_skhun`, `upload_kk`, `upload_akte`, `upload_ktp_ortu`, `bukti_pembayaran`, `status_bukti_bayar`, `kode_siswa`, `status`, `created`) VALUES
(11, '2321312412', 'verdian', 'Laki-Laki', 'Tangerang', '2000-02-29', 'islam', 'sepatan timur', '0895334930931', '20210828112046sip.png', '2021082811205612-1.jpg', '20210828112130download.jpg', '20210828112223download.jpg', '20210828112000igg.png', NULL, NULL, 'Q4SLZXPMIH', 0, '2021-08-28 12:03:09'),
(12, '12345678', 'Baliho', 'Laki-Laki', 'Tangerang', '2021-08-23', 'islam', 'jauh', '0895334930931', NULL, NULL, NULL, NULL, '', NULL, NULL, 'MLPTPYMW1U', 2, '2021-08-30 23:11:36'),
(13, '2321312412', 'muhamad aldi setiawan', 'Laki-Laki', 'tangerang', '2021-09-19', 'islam', 'tanah abang', '0893663817', NULL, NULL, NULL, NULL, '', '20210919065733peilbanir.png', 1, 'EROJWX8DKF', 0, '2021-09-19 11:56:05'),
(14, '0976222', 'aldino', 'Laki-Laki', 'tangerang', '2021-09-19', 'islam', 'sepatan', '0893663817', NULL, '20210919070340images.jpg', '20210919070346tanggal.png', '20210919070353ICON_HOME.jpeg', '20210919070400e8384959-ad1a-1b95-762b-2861496b886e.png', '20210919070409image.png', 1, '4QC7XI3JHT', 0, '2021-09-19 12:03:02'),
(15, '2321312412', 'Spanduk', 'Laki-Laki', 'tangerang', '2021-09-27', 'islam', 'tanah abang', '0893663817', NULL, '20210920060641filter.png', '20210920060648pencarian.png', '20210920060654tanggal.png', '20210920060701peilbanir.png', '20210920060710Asset_1.png', 1, 'ZYMP8JFHJV', 0, '2021-09-20 11:06:29'),
(16, '2321312412', 'alda', 'Laki-Laki', 'tangerang', '2021-09-26', 'islam', 'tanah abang', '6283852545114', '20210925020753Asset_10.png', '20210925020753Asset_101.png', '20210925020753Asset_102.png', '20210925020753Asset_103.png', '20210925020753Asset_104.png', NULL, NULL, '5QNBDJPTBQ', 0, '2021-09-25 07:07:53'),
(17, '2321312412', 'aaa', 'Laki-Laki', 'tangerang', '2021-09-27', 'islam', 'tanah merah', '89366381700', '20210926151700Asset_10.png', '20210926151700Asset_101.png', '20210926151700Asset_102.png', '20210926151700Asset_103.png', '20210926151700Asset_104.png', NULL, NULL, 'ISZB4WCDLP', 0, '2021-09-26 20:17:01'),
(18, '12345678', 'tofik', 'Laki-Laki', 'tangerang', '2021-09-01', 'islam', 'tanah merah', '6283852545114', '20210927094322WhatsApp_Image_2021-09-20_at_11_40_4', '20210927094322WhatsApp_Image_2021-09-20_at_11_40_4', '20210927094322WhatsApp_Image_2021-09-20_at_11_40_422.jpeg', '20210927094322WhatsApp_Image_2021-09-20_at_11_40_423.jpeg', '20210927094322WhatsApp_Image_2021-09-20_at_11_40_424.jpeg', NULL, NULL, 'D0FR9SLZMA', 0, '2021-09-27 14:43:22'),
(19, '12345678', 'faris', 'Laki-Laki', 'tangerang', '2021-09-28', 'islam', 'tanah merah', '6283852545114', NULL, NULL, '20210928090506LOGO_PT2.png', '20210928090506LOGO_PT3.png', '20210928090506LOGO_PT4.png', NULL, NULL, 'R6LCYNDT8U', 0, '2021-09-28 14:05:06');

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
(4, '2021-08-28', '2021', NULL, 11),
(5, '2021-09-26', '2021', NULL, 12),
(6, '2021-09-19', '2021', NULL, 13),
(7, '2021-09-19', '2021', NULL, 14),
(8, '2021-09-19', '2021', NULL, 14),
(9, '2021-09-19', '2021', NULL, 14),
(10, '2021-09-20', '2021', NULL, 15),
(11, '2021-09-20', '2021', NULL, 15),
(12, '2021-09-25', '2021', NULL, 16),
(13, '2021-09-26', '2021', NULL, 17),
(14, '2021-09-27', '2021', NULL, 18),
(15, '2021-09-28', '2021', NULL, 20);

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
(2, 1, '2021/2022', 'X', 1500000),
(3, 5, '2021/2022', 'X', 100000),
(4, 1, '2021/2022', 'X', 1000000),
(6, 6, '2021/2022', 'X', 1000000),
(7, 1, '2021/2022', 'XI', 100000);

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
(11, 11, 2, 4, 2, 1, 'verdian', 'verdian@gmail.com', '$2y$10$pba6iVt9mCxrEtn7MXj5QO7V6bdXqh3OWlYc8MHGGWDye2bhskqqq', 2, 1, '2021-08-28 12:03:09'),
(12, 12, 0, 5, 2, 1, 'Baliho', 'baliho@gmail.com', '$2y$10$6JAUffd3BcgfVr7JNm1ELeB4.SjYoKUT91l1BWdZVQrmw1hjkkH9u', 3, 1, '2021-08-30 23:11:36'),
(13, 13, 3, 6, 3, 0, 'muhamad aldi setiawan', 'setiawan@gmail.com', '$2y$10$TJD.WvqpDwZlybwr37ZWPee81A.xnGNbg/j5YMDaol8zF7NOyD7E2', 3, 0, '2021-09-19 11:56:05'),
(14, 14, 4, 7, 2, 1, 'aldino', 'aldino@gmail.com', '$2y$10$.WzJd/TaUVYOCJPRQzVfQ.ZwRqFYZtLuxHLhKY2u4K68DuxdML2be', 3, 1, '2021-09-19 12:03:02'),
(15, 15, 5, 10, 2, 5, 'Spanduk', 'lutfi@gmail.com', '$2y$10$APTNwkMU37sSGs57CzNrSO3TWkRCjT4iMMiZvQKLzsZN6R3Din0dO', 3, 1, '2021-09-20 11:06:29'),
(16, 16, 6, 12, 2, 0, 'alda', 'alda@gmail.com', '$2y$10$NwtPkZX/zyXTM9uOlyQuV.JeMfCRPRQeZJyCZeFo1fZxE6cv5PJkW', 2, 0, '2021-09-25 07:07:53'),
(17, 17, 7, 13, 2, 0, 'aaa', 'aaa@gmail.com', '$2y$10$wbbqwo4QBQjYGmmVUJNIn.FvceqFt8CJsaCwirvo2xb9xIdS29nia', 2, 0, '2021-09-26 20:17:01'),
(19, 0, 0, 0, 0, 0, 'Kepsek', 'kepsek@gmail.com', '$2y$10$026l9Fqv.dhvZFMDWup80eaDVoot59PRI013tK/LCSJ97yBhdWiny', 4, 1, '2021-09-28 13:25:56'),
(20, 19, 9, 15, 2, 0, 'faris', 'faris@gmail.com', '$2y$10$Sus4PzSgL090wRh6nGSm7OlcvL1joyb9m3zMsi/v0SHKjnaHSEpiC', 2, 0, '2021-09-28 14:05:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  ADD PRIMARY KEY (`id_calon`);

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
-- AUTO_INCREMENT for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_config`
--
ALTER TABLE `tb_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jenis_pembayaran`
--
ALTER TABLE `tb_jenis_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_orang_tua`
--
ALTER TABLE `tb_orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
