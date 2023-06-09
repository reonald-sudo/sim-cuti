-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 01:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sim_cuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `golongan` varchar(50) NOT NULL,
  `pangkat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`golongan`, `pangkat`) VALUES
('1a', 'Juru Muda'),
('1b', 'Juru Muda Tingkat 1'),
('1c', 'Juru'),
('1d', 'Juru Tingkat 1'),
('2a', 'Pengatur Muda'),
('2b', 'Pengatur Muda Tingkat 1'),
('2c', 'Pengatur'),
('2d', 'Pengatur Tingkat 1'),
('3a', 'Penata Muda'),
('3b', 'Penata Muda Tingkat 1'),
('3c', 'Penata'),
('3d', 'Penata Tingkat 1'),
('4a', 'Pembina'),
('4b', 'Pembina Tingkat 1'),
('4c', 'Pembina Muda'),
('4d', 'Pembina Madya'),
('4e', 'Pembina Utama');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `golongan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `golongan`, `alamat`, `no_telp`, `email`) VALUES
('111', 'aldino', '2b', 'bjb', '02138137821', 'contoh@gmail.com'),
('333', 'M. Reonald. S,Kom', '2b', 'Bjb', '02138137821', 'contoh@gmail.com'),
('444', 'ALDI', '4a', 'bjb', '0812736421', 'contoh@gmail.com'),
('666', 'Cemara Puteri', '3a', 'bjb', '02138137821', 'contoh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `jam_masuk` varchar(50) NOT NULL,
  `jam_pulang` varchar(50) NOT NULL,
  `catatan` varchar(50) NOT NULL DEFAULT 'tanpa keterangan',
  `tunjangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `nip`, `nama`, `tanggal_absen`, `jam_masuk`, `jam_pulang`, `catatan`, `tunjangan`) VALUES
(282, '111', 'aldino', '2023-07-01', '08:50:26', '17:20:13', 'terlambat', '20000'),
(283, '111', 'aldino', '2023-07-02', '08:07:28', '08:11:37', 'terlambat', '20000'),
(284, '333', 'Mohamad Reonald. S,Kom', '2023-07-02', '08:52:12', 'belum tercatat', 'terlambat', '20000'),
(285, '333', 'Mohamad Reonald. S,Kom', '2023-07-03', '14:31:28', 'belum tercatat', 'terlambat', '20000'),
(286, '111', 'aldino', '2023-07-03', '15:29:03', '15:29:10', 'terlambat', '20000'),
(287, '333', 'Mohamad Reonald. S,Kom', '2023-07-04', '-', '-', 'tanpa keterangan', '0'),
(288, '333', 'Mohamad Reonald. S,Kom', '2023-07-06', '12:08:16', '18:44:38', 'terlambat', '20000'),
(289, '333', 'Mohamad Reonald. S,Kom', '2023-07-08', '13:23:09', 'belum tercatat', 'terlambat', '20000'),
(290, '333', 'Mohamad Reonald. S,Kom', '2023-07-10', '11:47:12', 'belum tercatat', 'terlambat', '20000'),
(292, '333', 'Mohamad Reonald. S,Kom', '2023-07-14', '04:36:53', 'Belum Tercatat', 'hadir', '44000'),
(293, '111', 'aldino', '2023-07-14', '05:21:33', 'Belum Tercatat', 'hadir', '44000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti`
--

CREATE TABLE `tb_cuti` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_cuti` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `tanggal_kembali` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `surat_pengajuan` varchar(50) NOT NULL,
  `alasan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cuti`
--

INSERT INTO `tb_cuti` (`id`, `nip`, `nama`, `tanggal_cuti`, `hari`, `tanggal_kembali`, `status`, `surat_pengajuan`, `alasan`) VALUES
(34, '333', 'Mohamad Reonald. S,Kom', '2023-07-01', '10', '2023-07-10', 'acc humas', 'cuti.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penggajian`
--

CREATE TABLE `tb_penggajian` (
  `kode_gaji` varchar(100) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `gaji` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penggajian`
--

INSERT INTO `tb_penggajian` (`kode_gaji`, `golongan`, `gaji`) VALUES
('AB2A', '2b', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tunjangan`
--

CREATE TABLE `tb_tunjangan` (
  `kode_tunjangan` varchar(100) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `hadir` varchar(100) NOT NULL,
  `terlambat` varchar(100) NOT NULL,
  `tanpa_keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tunjangan`
--

INSERT INTO `tb_tunjangan` (`kode_tunjangan`, `golongan`, `hadir`, `terlambat`, `tanpa_keterangan`) VALUES
('213AD', '2b', '33000', '15000', '0'),
('3BA31', '3b', '55000', '30000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tunjangan_dan_gaji_pegawai`
--

CREATE TABLE `tb_tunjangan_dan_gaji_pegawai` (
  `id_gaji` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah_hadir` varchar(100) NOT NULL,
  `jumlah_terlambat` varchar(100) NOT NULL,
  `jumlah_tanpa_keterangan` varchar(100) NOT NULL,
  `kode_gaji` varchar(100) NOT NULL,
  `kode_tunjangan` varchar(100) NOT NULL,
  `total_gaji` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_uang_ganti`
--

CREATE TABLE `tb_uang_ganti` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nominal` varchar(50) NOT NULL,
  `nota` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `alasan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_uang_ganti`
--

INSERT INTO `tb_uang_ganti` (`id`, `nip`, `nama`, `tanggal_transaksi`, `nominal`, `nota`, `status`, `alasan`) VALUES
(28, '333', 'Mohamad Reonald. S,Kom', '2023-07-08', '6755757', 'nota.jpg', 'ditolak', 'ga bisa ya'),
(29, '333', 'Mohamad Reonald. S,Kom', '2023-07-08', '76575445', 'nota.jpg', 'acc humas', ''),
(30, '111', 'aldino', '2023-07-08', '34252335', 'nota.jpg', 'acc admin', ''),
(31, '111', 'aldino', '2023-07-09', '1000', 'nota.jpg', 'acc humas', ''),
(32, '333', 'Mohamad Reonald. S,Kom', '2023-08-24', '20000', 'contoh nota.jpeg', 'acc humas', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `nama`, `hak_akses`, `password`) VALUES
('111', 'aldino', 'user', '111'),
('333', 'Mohamad Reonald. S,Kom', 'user', '333'),
('444', 'aldi', 'user', '444'),
('666', 'Cemara Puteri', 'user', '666'),
('admin', 'admin', 'admin', 'admin'),
('bendahara', 'bendahara', 'bendahara', 'bendahara'),
('humas', 'humas', 'humas', 'humas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`golongan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `golongan` (`golongan`);

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_penggajian`
--
ALTER TABLE `tb_penggajian`
  ADD PRIMARY KEY (`kode_gaji`),
  ADD KEY `golongan` (`golongan`);

--
-- Indexes for table `tb_tunjangan`
--
ALTER TABLE `tb_tunjangan`
  ADD PRIMARY KEY (`kode_tunjangan`),
  ADD KEY `golongan` (`golongan`);

--
-- Indexes for table `tb_tunjangan_dan_gaji_pegawai`
--
ALTER TABLE `tb_tunjangan_dan_gaji_pegawai`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `kode_gaji` (`kode_gaji`),
  ADD KEY `kode_tunjangan` (`kode_tunjangan`);

--
-- Indexes for table `tb_uang_ganti`
--
ALTER TABLE `tb_uang_ganti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_uang_ganti`
--
ALTER TABLE `tb_uang_ganti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`);

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Constraints for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD CONSTRAINT `tb_cuti_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Constraints for table `tb_penggajian`
--
ALTER TABLE `tb_penggajian`
  ADD CONSTRAINT `tb_penggajian_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`);

--
-- Constraints for table `tb_tunjangan`
--
ALTER TABLE `tb_tunjangan`
  ADD CONSTRAINT `tb_tunjangan_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`);

--
-- Constraints for table `tb_tunjangan_dan_gaji_pegawai`
--
ALTER TABLE `tb_tunjangan_dan_gaji_pegawai`
  ADD CONSTRAINT `tb_tunjangan_dan_gaji_pegawai_ibfk_1` FOREIGN KEY (`kode_gaji`) REFERENCES `tb_penggajian` (`kode_gaji`),
  ADD CONSTRAINT `tb_tunjangan_dan_gaji_pegawai_ibfk_2` FOREIGN KEY (`kode_tunjangan`) REFERENCES `tb_tunjangan` (`kode_tunjangan`);

--
-- Constraints for table `tb_uang_ganti`
--
ALTER TABLE `tb_uang_ganti`
  ADD CONSTRAINT `tb_uang_ganti_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
