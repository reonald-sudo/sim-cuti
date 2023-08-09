-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 10:28 AM
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
  `jabatan` varchar(255) NOT NULL,
  `jk` varchar(50) DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `t_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `golongan`, `jabatan`, `jk`, `agama`, `t_lahir`, `tgl_lahir`, `pendidikan`, `alamat`, `no_telp`, `email`) VALUES
('009', 'Ahmad Subaktie', '4a', '', 'L', 'Hindu', 'Pesayangan', '2023-08-05', 'S1 Fisika', 'Banjarmasin', '+62283484521', 'subaktieBjm@gmail.com'),
('046988087080830', 'Lalita Zulaika, S.H.I.', '3a', '', 'L', 'Islam', 'Coba', '1984-08-09', 'S1 Hukum', 'Martapura', '+62854978985', 'lalita226@gmail.com'),
('0812', 'Zimbabwe', '2a', 'Kepala Dinas', 'L', 'Islam', 'Kalteng', '2023-08-09', 'S1 Pendidikan Agama Islam', 'Bjb', '081237474152', 'zimbabwebjb@gmail.com'),
('083906892990302', 'Ade Dabukke, S.Kom.', '3a', '', 'L', 'Kristen', 'Binuang', '1988-08-06', 'S1 Pendidikan', 'Banjarbaru', '+6228293531359', 'dabukkeAde334@gmail.com'),
('1001', 'Jubay', '1c', 'petugas mediasi perdata', 'L', 'Islam', 'Surabaya', '2023-08-09', 'S1 Ilmu Hukum', 'Kandangan', '0812377412', 'jubaydillahkdg@gmail.com'),
('104621197737824', 'Banawa Thamrin, S.Si.', '2a', '', 'L', 'Islam', 'Martapura', '1990-08-31', 'S1 Kehutanan', 'Banjarbaru', '+6238590430104', 'banawaTham@gmail.com'),
('123456', 'Mamat', '3a', '', 'L', 'Islam', 'Kandangan', '2023-08-03', 'S1 Teknik Sipil', 'Banjarmasin', '+6223252526', 'mamatKdg@gmail.com'),
('124290454787808', 'Kawaya Haryanto, S.H.', '4b', '', 'L', 'Islam', 'Barabai', '1993-08-18', 'S1 Teknik', 'Kandangan', '+6233260920944', 'kaa_har@gmail.com'),
('125615399226617', 'Teguh Maheswara, S.Ag.', '4a', '', 'L', 'Islam', 'Banjarbaru', '1983-08-11', 'S1 Arsitektur', 'Amuntai', '+62876267233', 'mmhaesateguh45@gmail.com'),
('141305679454637', 'Bakti Zulkarnain, S.K.M.', '4b', '', 'L', 'Islam', 'Banjarbaru', '1993-08-04', 'S1 Psikologi', 'Batola', '+62411470055', 'baktiakbar209@gmail.com'),
('185968642362066', 'Darmana Latupono, S.Sn.', '3a', '', 'L', 'Islam', 'Banjarmasin', '1993-08-04', 'S1 Sipil', 'Banjarbaru', '+627664452072', 'darmajay22lat@gmail.com'),
('225587452011402', 'Ana Laksita, S.I.P.', '2d', '', 'P', 'Islam', 'Pekauman', '1993-08-04', 'S1 Matematika', 'Pekauman', '+62335397213', 'anaLaksita@gmail.com'),
('253154511280542', 'Najwa Padmasari, S.K.M.', '2d', '', 'P', 'Islam', 'Martapura', '1993-10-21', 'S1 Pendidikan', 'Banjarmasin', '+628846436733', 'nanajwaapat@gmail.com'),
('277890972795334', 'Galuh Putra, S.S.', '2d', '', 'L', 'Islam', 'Amuntai', '1993-01-06', 'S1 Farmasi', 'Banjarbaru', '+62827613369', 'galuhputra_256_2@gmail.com'),
('333', 'M. Reonald. S,Kom', '2b', '', 'L', 'Islam', 'Jember', '2000-07-26', 'S1 Teknik Informatika', 'Banjarbaru', '02138137821', 'mohamadreonald2607@gmail.com'),
('334243040747543', 'Prayitna Kusumo, S.E.', '3d', '', 'P', 'Hindu', 'Kelayan', '1990-11-12', 'S1 Sastra', 'Martapura', '+62864419794', 'prayitkusumaprajana88@gmail.ciom'),
('489010865403043', 'Yessi Oktaviani, S.Sos.', '4b', '', 'P', 'Kristen', 'Solo', '1981-08-04', 'S1 Arsitektur', 'Martapura', '+62873432001729', 'yessianiokta_bjb@gmail.com'),
('519797005981021', 'Jail Wahyudin, S.T.', '3b', '', 'L', 'Islam', 'Surabaya', '1991-03-10', 'S1 Arsitektur', 'Banjarmasin', '+6256794314960', 'wahyuniindirajail@gmail.com'),
('575685219345220', '', '3b', '', NULL, NULL, NULL, NULL, NULL, 'Pekauman', '+62711497215', 'gastipekaumanbjm_2@gmail.com'),
('578801727823295', 'Eman Pradana, S.Hum.', '3a', '', NULL, NULL, NULL, NULL, NULL, 'Banjarbaru', '+62613462071', 'pradanajukiemanbjb@gmail.com'),
('668962008418767', 'Pardi Jailani, S.Pd.I.', '3c', '', NULL, NULL, NULL, NULL, NULL, 'Kandangan', '+62413874127', 'pardijailani@gmail.com'),
('827335666195448', 'Wardi Budiyanto, M.Pd.', '4c', '', NULL, NULL, NULL, NULL, NULL, 'Amuntai', '+62249281767', 'wardiii256budi@gmail.com'),
('855618436241709', 'Chelsea Mandasari, M.T.', '4a', '', NULL, NULL, NULL, NULL, NULL, 'Banjarbaru', '+6226431021058', 'mandasarichealsea@gmail.com'),
('996533308158025', 'Slamet Prasetya, S.I.P.', '2c', '', NULL, NULL, NULL, NULL, NULL, 'Martapura', '+623246057263', 'slametprasetyabjb433@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `nip`, `golongan`, `nama`, `tanggal_absen`, `jam_masuk`, `jam_pulang`, `catatan`, `tunjangan`) VALUES
(321, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-19', '10:16:00', 'belum tercatat', 'terlambat', '15000'),
(322, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-03', '06:55:22', '17:51:31', 'hadir', '33000'),
(323, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-04', '06:33:22', '18:43:28', 'hadir', '33000'),
(324, '333', '2b', 'Mohamad Reonald, S.Kom', '2023-07-05', '08:12:33', '17:52:33', 'terlambat', '15000'),
(325, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-06', '07:11:44', '18:05:42', 'hadir', '33000'),
(326, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-07-07', '06:56:41', '17:11:41', 'hadir', '33000'),
(327, '333', '2b', 'Mohamad Reonald, S.Kom', '2023-07-10', '06:44:31', '17:18;44', 'hadir', '33000'),
(328, '333', '2b', 'Mohamad Reonald, S.Kom', '2023-07-11', '07:03:44', '17:05:12', 'hadir', '33000'),
(329, '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '2023-07-03', '07:15:00', '17:21:00', 'hadir', '37000'),
(330, '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '2023-07-04', '07:15:00', '17:21:00', 'hadir', '37000'),
(331, '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '2023-07-05', '07:15:00', '17:21:00', 'hadir', '37000'),
(332, '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '2023-07-06', '07:15:00', '17:21:00', 'hadir', '37000'),
(333, '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '2023-07-07', '07:15:00', '17:21:00', 'hadir', '37000'),
(334, '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '2023-07-03', '07:22:41', '17:33:50', 'hadir', '37000'),
(335, '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '2023-07-04', '07:22:41', '17:33:50', 'hadir', '37000'),
(336, '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '2023-07-05', '07:22:41', '17:33:50', 'hadir', '37000'),
(337, '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '2023-07-06', '07:22:41', '17:33:50', 'hadir', '37000'),
(338, '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '2023-07-07', '07:22:41', '17:33:50', 'hadir', '37000'),
(339, '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '2023-07-03', '07:08:11', '17:15:11', 'hadir', '31000'),
(340, '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '2023-07-04', '07:08:11', '17:15:11', 'hadir', '31000'),
(341, '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '2023-07-05', '07:08:11', '17:15:11', 'hadir', '31000'),
(342, '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '2023-07-06', '07:08:11', '17:15:11', 'hadir', '31000'),
(343, '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '2023-07-07', '07:08:11', '17:15:11', 'hadir', '31000'),
(344, '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '2023-07-03', '06:39:27', '17:44:12', 'hadir', '47000'),
(345, '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '2023-07-04', '06:39:27', '17:44:12', 'hadir', '47000'),
(346, '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '2023-07-05', '06:39:27', '17:44:12', 'hadir', '47000'),
(347, '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '2023-07-06', '06:39:27', '17:44:12', 'hadir', '47000'),
(348, '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '2023-07-07', '06:39:27', '17:44:12', 'hadir', '47000'),
(349, '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '2023-07-03', '06:56:18', '17:37:50', 'hadir', '45000'),
(350, '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '2023-07-04', '06:56:18', '17:37:50', 'hadir', '45000'),
(351, '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '2023-07-05', '06:56:18', '17:37:50', 'hadir', '45000'),
(352, '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '2023-07-06', '06:56:18', '17:37:50', 'hadir', '45000'),
(353, '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '2023-07-07', '06:56:18', '17:37:50', 'hadir', '45000'),
(354, '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '2023-07-03', '07:22:46', '17:01:20', 'hadir', '47000'),
(355, '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '2023-07-04', '07:22:46', '17:01:20', 'hadir', '47000'),
(356, '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '2023-07-05', '07:22:46', '17:01:20', 'hadir', '47000'),
(357, '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '2023-07-06', '07:22:46', '17:01:20', 'hadir', '47000'),
(358, '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '2023-07-07', '07:22:46', '17:01:20', 'hadir', '47000'),
(359, '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '2023-07-03', '07:16:31', '17:15:33', 'hadir', '37000'),
(360, '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '2023-07-04', '07:16:31', '17:15:33', 'hadir', '37000'),
(361, '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '2023-07-05', '07:16:31', '17:15:33', 'hadir', '37000'),
(362, '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '2023-07-06', '07:16:31', '17:15:33', 'hadir', '37000'),
(363, '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '2023-07-07', '07:16:31', '17:15:33', 'hadir', '37000'),
(364, '225587452011402', '2d', 'Ana Laksita, S.I.P.', '2023-07-03', '06:55:40', '17:17:19', 'hadir', '35000'),
(365, '225587452011402', '2d', 'Ana Laksita, S.I.P.', '2023-07-04', '06:55:40', '17:17:19', 'hadir', '35000'),
(366, '225587452011402', '2d', 'Ana Laksita, S.I.P.', '2023-07-05', '06:55:40', '17:17:19', 'hadir', '35000'),
(367, '225587452011402', '2d', 'Ana Laksita, S.I.P.', '2023-07-06', '06:55:40', '17:17:19', 'hadir', '35000'),
(368, '225587452011402', '2d', 'Ana Laksita, S.I.P.', '2023-07-07', '06:55:40', '17:17:19', 'hadir', '35000'),
(369, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-03', '06:55:40', '17:17:19', 'hadir', '35000'),
(370, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-04', '06:55:40', '17:17:19', 'hadir', '35000'),
(371, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-05', '06:55:40', '17:17:19', 'hadir', '35000'),
(372, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-06', '06:55:40', '17:17:19', 'hadir', '35000'),
(373, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-07', '06:55:40', '17:17:19', 'hadir', '35000'),
(374, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-03', '07:21:00', '17:24:15', 'hadir', '35000'),
(375, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-04', '07:21:00', '17:24:15', 'hadir', '35000'),
(376, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-05', '07:21:00', '17:24:15', 'hadir', '35000'),
(377, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-06', '07:21:00', '17:24:15', 'hadir', '35000'),
(378, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-07', '07:21:00', '17:24:15', 'hadir', '35000'),
(379, '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '2023-07-03', '07:21:00', '17:24:15', 'hadir', '44000'),
(380, '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '2023-07-04', '07:21:00', '17:24:15', 'hadir', '44000'),
(381, '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '2023-07-05', '07:21:00', '17:24:15', 'hadir', '44000'),
(382, '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '2023-07-06', '07:21:00', '17:24:15', 'hadir', '44000'),
(383, '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '2023-07-07', '07:21:00', '17:24:15', 'hadir', '44000'),
(384, '489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', '2023-07-03', '07:21:00', '17:24:15', 'hadir', '47000'),
(385, '489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', '2023-07-04', '07:21:00', '17:24:15', 'hadir', '47000'),
(386, '489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', '2023-07-05', '07:21:00', '17:24:15', 'hadir', '47000'),
(387, '489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', '2023-07-06', '07:21:00', '17:24:15', 'hadir', '47000'),
(388, '489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', '2023-07-07', '07:21:00', '17:24:15', 'hadir', '47000'),
(389, '519797005981021', '3b', 'Jail Wahyudin, S.T.', '2023-07-03', '06:43:22', '17:11:41', 'hadir', '40000'),
(390, '519797005981021', '3b', 'Jail Wahyudin, S.T.', '2023-07-04', '06:43:22', '17:11:41', 'hadir', '40000'),
(391, '519797005981021', '3b', 'Jail Wahyudin, S.T.', '2023-07-05', '06:43:22', '17:11:41', 'hadir', '40000'),
(392, '519797005981021', '3b', 'Jail Wahyudin, S.T.', '2023-07-06', '06:43:22', '17:11:41', 'hadir', '40000'),
(393, '519797005981021', '3b', 'Jail Wahyudin, S.T.', '2023-07-07', '06:43:22', '17:11:41', 'hadir', '40000'),
(394, '575685219345220', '3b', 'Gasti Mulyani, S.Si.', '2023-07-03', '06:43:22', '17:11:41', 'hadir', '40000'),
(395, '575685219345220', '3b', 'Gasti Mulyani, S.Si.', '2023-07-04', '06:43:22', '17:11:41', 'hadir', '40000'),
(396, '575685219345220', '3b', 'Gasti Mulyani, S.Si.', '2023-07-05', '06:43:22', '17:11:41', 'hadir', '40000'),
(397, '575685219345220', '3b', 'Gasti Mulyani, S.Si.', '2023-07-06', '06:43:22', '17:11:41', 'hadir', '40000'),
(398, '575685219345220', '3b', 'Gasti Mulyani, S.Si.', '2023-07-07', '06:43:22', '17:11:41', 'hadir', '40000'),
(399, '277890972795334', '2d', 'Galuh Putra, S.S.', '2023-07-19', '15:41:21', '15:41:36', 'terlambat', '17000'),
(400, '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '2023-07-19', '15:42:23', '15:42:29', 'terlambat', '17000'),
(401, '333', '2b', 'Mohamad Reonald. S,Kom', '2023-08-08', '14:38:50', 'belum tercatat', 'terlambat', '15000');

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
(37, '125615399226617', 'Teguh Maheswara, S.Ag.', '2023-07-19', '4', '2023-07-22', 'sedang proses', 'Surat Pernyataan Orang tua OK.pdf', ''),
(38, '141305679454637', 'Bakti Zulkarnain, S.K.M.', '2023-07-20', '3', '2023-07-22', 'acc humas', 'Surat Pernyataan Orang tua OK.pdf', ''),
(39, '253154511280542', 'Najwa Padmasari, S.K.M.', '2023-07-20', '3', '2023-07-23', 'acc humas', 'Surat Pernyataan Orang tua OK.pdf', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(11) NOT NULL,
  `id_gaji` varchar(100) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah_hadir` varchar(100) NOT NULL,
  `jumlah_terlambat` varchar(100) NOT NULL,
  `jumlah_tanpa_keterangan` varchar(100) NOT NULL,
  `kode_gaji` varchar(100) NOT NULL,
  `gaji` varchar(255) NOT NULL,
  `kode_tunjangan` varchar(100) NOT NULL,
  `tunjangan` varchar(255) NOT NULL,
  `total_gaji` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tunjangan_dan_gaji_pegawai`
--

INSERT INTO `tb_tunjangan_dan_gaji_pegawai` (`id`, `id_gaji`, `bulan`, `nip`, `golongan`, `nama`, `jumlah_hadir`, `jumlah_terlambat`, `jumlah_tanpa_keterangan`, `kode_gaji`, `gaji`, `kode_tunjangan`, `tunjangan`, `total_gaji`, `status`) VALUES
(8, 'AC2B', 'July-2023', '333', '2b', 'Mohamad Reonald. S,Kom', '6', '2', '0', 'AC2B', '2208400', '213AD', '228000', '2436400', 'acc humas'),
(9, '3ABB', 'July-2023', '046988087080830', '3a', 'Lalita Zulaika, S.H.I.', '5', '0', '0', '3ABB', '2579400', '3AGGF', '185000', '2764400', 'acc admin'),
(10, '3ABB', 'July-2023', '083906892990302', '3a', 'Ade Dabukke, S.Kom.', '5', '0', '0', '3ABB', '2579400', '3AGGF', '185000', '2764400', 'belum verifikasi'),
(11, 'AC2A', 'July-2023', '104621197737824', '2a', 'Banawa Thamrin, S.Si.', '5', '0', '0', 'AC2A', '2022200', '2ABBR', '155000', '2177200', 'belum verifikasi'),
(12, '4BFE', 'July-2023', '124290454787808', '4b', 'Kawaya Haryanto, S.H.', '5', '0', '0', '4BFE', '3173100', '4BTFT', '235000', '3408100', 'belum verifikasi'),
(13, '4AFE', 'July-2023', '125615399226617', '4a', 'Teguh Maheswara, S.Ag.', '5', '0', '0', '4AFE', '3044300', '4AGGH', '225000', '3269300', 'belum verifikasi'),
(14, '4BFE', 'July-2023', '141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', '5', '0', '0', '4BFE', '3173100', '4BTFT', '235000', '3408100', 'belum verifikasi'),
(15, '3ABB', 'July-2023', '185968642362066', '3a', 'Darmana Latupono, S.Sn.', '5', '0', '0', '3ABB', '2579400', '3AGGF', '185000', '2764400', 'belum verifikasi'),
(16, 'AC2D', 'July-2023', '225587452011402', '2d', 'Ana Laksita, S.I.P.', '5', '0', '0', 'AC2D', '2399200', '2DGTR', '175000', '2574200', 'belum verifikasi'),
(19, '3DBB', 'July-2023', '334243040747543', '3d', 'Prayitna Kusumo, S.E.', '5', '0', '0', '3DBB', '2920800', '3DGHTR', '220000', '3140800', 'belum verifikasi'),
(20, 'AC2D', 'July-2023', '277890972795334', '2d', 'Galuh Putra, S.S.', '5', '1', '0', 'AC2D', '2399200', '2DGTR', '192000', '2591200', 'belum verifikasi'),
(21, 'AC2D', 'July-2023', '253154511280542', '2d', 'Najwa Padmasari, S.K.M.', '5', '1', '0', 'AC2D', '2399200', '2DGTR', '192000', '2591200', 'belum verifikasi'),
(22, 'AC2B', 'August-2023', '333', '2b', 'Mohamad Reonald. S,Kom', '6', '2', '0', 'AC2B', '2208400', '213AD', '0', '2208400', 'belum verifikasi'),
(23, '4AFE', 'August-2023', '009', '4a', 'Ahmad Subaktie', '0', '0', '0', '4AFE', '3044300', '4AGGH', '0', '3044300', 'belum verifikasi');

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
(32, '333', 'Mohamad Reonald. S,Kom', '2023-08-24', '20000', 'contoh nota.jpeg', 'acc admin', ''),
(33, '104621197737824', 'Banawa Thamrin, S.Si.', '2023-07-14', '150000', 'nota.jpg', 'sedang proses', ''),
(34, '124290454787808', 'Kawaya Haryanto, S.H.', '2023-07-19', '750000', 'nota.jpg', 'sedang proses', ''),
(35, '046988087080830', 'Lalita Zulaika, S.H.I.', '2023-07-11', '888000', 'Tidak diupload', 'sedang proses', ''),
(36, '253154511280542', 'Najwa Padmasari, S.K.M.', '2023-07-19', '27700', 'nota.jpg', 'acc humas', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `golongan`, `nama`, `hak_akses`, `password`) VALUES
('009', '4a', 'Ahmad Subaktie', 'user', '009'),
('046988087080830', '3a', 'Lalita Zulaika, S.H.I.', 'user', '046988087080830'),
('083906892990302', '3a', 'Ade Dabukke, S.Kom.', 'user', '083906892990302'),
('104621197737824', '2a', 'Banawa Thamrin, S.Si.', 'user', '104621197737824'),
('123456', '3a', 'Mamat', 'user', '123456'),
('124290454787808', '4b', 'Kawaya Haryanto, S.H.', 'user', '124290454787808'),
('125615399226617', '4a', 'Teguh Maheswara, S.Ag.', 'user', '125615399226617'),
('141305679454637', '4b', 'Bakti Zulkarnain, S.K.M.', 'user', '141305679454637'),
('185968642362066', '3a', 'Darmana Latupono, S.Sn.', 'user', '185968642362066'),
('225587452011402', '2d', 'Ana Laksita, S.I.P.', 'user', '225587452011402'),
('253154511280542', '2d', 'Najwa Padmasari, S.K.M.', 'user', '253154511280542'),
('277890972795334', '2d', 'Galuh Putra, S.S.', 'user', '277890972795334'),
('333', '2b', 'Mohamad Reonald. S,Kom', 'user', '333'),
('334243040747543', '3d', 'Prayitna Kusumo, S.E.', 'user', '334243040747543'),
('489010865403043', '4b', 'Yessi Oktaviani, S.Sos.', 'user', '489010865403043'),
('519797005981021', '3b', 'Jail Wahyudin, S.T.', 'user', '519797005981021'),
('575685219345220', '3b', 'Gasti Mulyani, S.Si.', 'user', '575685219345220'),
('578801727823295', '3a', 'Eman Pradana, S.Hum.', 'user', '578801727823295'),
('668962008418767', '3c', 'Pardi Jailani, S.Pd.I.', 'user', '668962008418767'),
('827335666195448', '4c', 'Wardi Budiyanto, M.Pd.', 'user', '827335666195448'),
('855618436241709', '4a', 'Chelsea Mandasari, M.T.', 'user', '855618436241709'),
('996533308158025', '2c', 'Slamet Prasetya, S.I.P.', 'user', '996533308158025'),
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
  ADD KEY `tb_absensi_ibfk_2` (`golongan`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_gaji` (`kode_gaji`),
  ADD KEY `kode_tunjangan` (`kode_tunjangan`),
  ADD KEY `golongan` (`golongan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_tunjangan_dan_gaji_pegawai`
--
ALTER TABLE `tb_tunjangan_dan_gaji_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_uang_ganti`
--
ALTER TABLE `tb_uang_ganti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD CONSTRAINT `tb_cuti_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_penggajian`
--
ALTER TABLE `tb_penggajian`
  ADD CONSTRAINT `tb_penggajian_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tunjangan`
--
ALTER TABLE `tb_tunjangan`
  ADD CONSTRAINT `tb_tunjangan_ibfk_1` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tunjangan_dan_gaji_pegawai`
--
ALTER TABLE `tb_tunjangan_dan_gaji_pegawai`
  ADD CONSTRAINT `tb_tunjangan_dan_gaji_pegawai_ibfk_1` FOREIGN KEY (`kode_gaji`) REFERENCES `tb_penggajian` (`kode_gaji`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_tunjangan_dan_gaji_pegawai_ibfk_2` FOREIGN KEY (`kode_tunjangan`) REFERENCES `tb_tunjangan` (`kode_tunjangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_tunjangan_dan_gaji_pegawai_ibfk_3` FOREIGN KEY (`golongan`) REFERENCES `pangkat` (`golongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_uang_ganti`
--
ALTER TABLE `tb_uang_ganti`
  ADD CONSTRAINT `tb_uang_ganti_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
