-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 08:45 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `golongan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `jam_masuk` varchar(50) NOT NULL,
  `jam_pulang` varchar(50) NOT NULL,
  `catatan` varchar(50) NOT NULL DEFAULT 'tanpa keterangan',
  `tunjangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `nip`, `golongan`, `nama`, `tanggal_absen`, `jam_masuk`, `jam_pulang`, `catatan`, `tunjangan`) VALUES
(307, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-16', '-', '-', 'Libur', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penggajian`
--

INSERT INTO `tb_penggajian` (`kode_gaji`, `golongan`, `gaji`) VALUES
('1ACC', '1a', '1560800'),
('1BCD', '1b', '1851800'),
('1CFFG', '1c', '1776600'),
('1DEA', '1d', '1851800'),
('3ABB', '3a', '2579400'),
('3BBB', '3b', '2688500'),
('3CBB', '3c', '2802300'),
('3DBB', '3d', '2920800'),
('4AFE', '4a', '3044300'),
('4BFE', '4b', '3173100'),
('4CFE', '4c', '3307300'),
('4DFE', '4d', '3447200'),
('4EFE', '4e', '3593100'),
('AC2A', '2a', '2022200'),
('AC2B', '2b', '2208400'),
('AC2C', '2c', '2301800'),
('AC2D', '2d', '2399200');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tunjangan`
--

INSERT INTO `tb_tunjangan` (`kode_tunjangan`, `golongan`, `hadir`, `terlambat`, `tanpa_keterangan`) VALUES
('1ABR', '1a', '23000', '11000', '0'),
('1BCCD', '1b', '27000', '13000', '0'),
('1CDFJ', '1c', '29000', '14000', '0'),
('1DRRA', '1d', '30000', '15000', '0'),
('213AD', '2b', '33000', '15000', '0'),
('2ABBR', '2a', '31000', '15000', '0'),
('2CDFA', '2c', '33000', '16000', '0'),
('2DGTR', '2d', '35000', '17000', '0'),
('3AGGF', '3a', '37000', '18000', '0'),
('3BFR', '3b', '40000', '18000', '0'),
('3CGEA', '3c ', '42000', '20000', '0'),
('3DGHTR', '3d', '44000', '21000', '0'),
('4AGGH', '4a', '45000', '22000', '0'),
('4BTFT', '4b', '47000', '22000', '0'),
('4CGRT', '4c', '47000', '25000', '0'),
('4DPPO', '4d', '49000', '26000', '0'),
('4EHYT', '4e', '50000', '25000', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `golongan` varchar(255) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `golongan`, `nama`, `hak_akses`, `password`) VALUES
('111', '2c', 'aldino', 'user', '111'),
('123', '2b', 'rizka', 'user', '123'),
('333', '2b', 'Mohamad Reonald. S,Kom', 'user', '333'),
('444', '2b', 'aldi', 'user', '444'),
('666', '2b', 'Cemara Puteri', 'user', '666'),
('admin', '', 'admin', 'admin', 'admin'),
('bendahara', '', 'bendahara', 'bendahara', 'bendahara'),
('humas', '', 'humas', 'humas', 'humas');

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
  ADD KEY `nip` (`nip`),
  ADD KEY `golongan` (`golongan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

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
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`),
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`);

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
