-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 05:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjadwalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(64) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(0, 'admin', '$2y$10$EX0L5MeIQldpkCuTZW.mjujTaj.Yy20IW0GOluecU/c.es.9r6E5.', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(5) NOT NULL,
  `nik` int(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nik`, `email`, `password`, `nama_dosen`) VALUES
(14, 19871007, 'dyah@gmail.com', '$2y$10$ZYMcmkxNqvfmR4pagWFyOeSaR4pKelyJof597olVJXWGMFTEihvOu', 'Dyah Mustikasari, ST, M.Eng'),
(15, 19880728, 'ismail@gmail.com', '$2y$10$.g2MgbA2p4ANobGww/mWJekD5QY2C/hPSlMFxXhIXWsLK2g8temvG', 'Ismail Abdurrazzaq Zulkarnain, S.Kom., M.Kom'),
(16, 19800225, 'bhanusetyawan@gmail.com', '$2y$10$UBjGsPq7hgquiKUOaxAhvegPkrIClGNa.w09nqK7zQyRpRrb/sc42', 'Moh. Bhanu Setyawan, ST., M.Kom'),
(17, 19810221, 'YoviLitanianda@gmail.com', '$2y$10$TdElJL2m/NYBXfDfB/N3wuVPQynQeo1Xxqr6VZgSNR5YrGrJyLES2', 'Yovi Litanianda, S.Pd, M.Kom'),
(18, 19640103, 'aliyadi@gmail.com', '$2y$10$I6/K.B1QW/AZ4Zx6nir.qumM/TUrfkz5MHYqE03GysXy/Uxz0kPwi', 'Dr. Ir. Aliyadi, MM, M.Kom'),
(19, 19810316, 'Fauzan@gmail.com', '$2y$10$h2oerePZpNuTMzJbM8hCPO84TAJtDQFoqeFfab26UlbKE5pD.HImy', 'Fauzan Masykur, ST, M.Kom'),
(20, 19820819, 'Angga@gmail.com', '$2y$10$Qm6sZl76JUFXZusz5cmgIeTIlg.v/O/qRXzriN795RzGf/JBw4fKS', 'Angga Prasetyo, ST, M.Kom'),
(21, 19660417, 'Widaningrum@gmail.com', '$2y$10$G/79mtSewMnoyR7vtD42C.SA8oWAUrlt/8FnHD9eq1EZYuwKLks.q', 'Dra. Ida Widaningrum, M.Kom'),
(22, 19791107, 'Munirah@gmail.com', '$2y$10$qGxLp9JNcuE1FPkt3E2fsuqPrFzuNvY6tQmFKG7mICmbt1jgHFbLa', 'Munirah Muslim, S.Kom., MT'),
(23, 19720324, 'aslan@gmail.com', '$2y$10$jYLdIUog8s.Q/OqnXaVMwu9JWnd0SV2rfVFlo9fxMVnIF/Hzcdx3W', 'Dr. Aslan Alwi, S.SI, M.Cs'),
(24, 19640415, 'Rudianto@gmail.com', '$2y$10$dXANPmzpJLFkVUqM9jBC1u8mpRPDV46DM3YJfxSEP//K9SVjcJmgW', 'Drs. Rudianto,M. Ag'),
(25, 19850905, 'elisia@gmail.com', '$2y$10$r0WJlAG4YgG5jrw6lcmHOOKhQspZIwaMNy3n/cXjYWHbelEoegxPS', 'Ellisia Kumalasari, S.Pd., M.Pd'),
(26, 19780505, 'sugianti@gmail.com', '$2y$10$NqN0uNLVTAgDeti6GhYdNuzVW5N1EaexnGbNPSTsna0CufH25ldfC', 'Sugianti, S. SI., M.Kom'),
(27, 19900322, 'jamilah@gmail.com', '$2y$10$5TnCVgCu/A8d79S6S1whDult4lv6rVSB6R85BfyFrSzSGFYvDYhue', 'Jamilah Karaman, S.Kom., M.Kom'),
(28, 19890717, 'Yuliastuti@gmail.com', '$2y$10$p/rZdt8JflSsd7uPmoJ7H.QtPXaq0SKQJHLOVGgwpuGdQ5.l1SBpi', 'Arin Yuliastuti, S. Kom., M.Kom'),
(29, 19890502, 'Arief@gmail.com', '$2y$10$ONKLtJeAmslwPtg/aMMtD.ZwHVbzywmTQDs7mPSQDKLoUN2qltAo6', 'Dr. Arief Rahman Yusuf, S.Pd., M.Pd'),
(30, 19870723, 'Ghulam@gmail.com', '$2y$10$DiKfHl5T61QOQaaYIg144emGPCHQaTJDczaM2EF/q70MiROEwfSS.', 'Ghulam Asrofi Buntoro, ST., M.Eng'),
(31, 19910505, 'ElokPutri@gmail.com', '$2y$10$CCFZdBMWWfozHvRnvnvpte9GSCfrxnUzAmuir4gvLHzfsWsElKYkW', 'Elok Putri Nimasari, S.Pd.,M.Pd'),
(32, 19860424, 'Indah@gmail.com', '$2y$10$iLvJj5XOkKuuLOSc8rcXa.mamPHc9bAYu6CWTme6m4ZujnJyFe7/K', 'Indah Puji Astuti, S.Kom., M.Kom'),
(33, 19871204, 'Nurwanto@gmail.com', '$2y$10$Sr5XbUwMpxW4mA5NKj2WDet0oGolq307jiHBQlbic7dwOsCV5.yzm', 'Nurwanto, S.Kom,.,M.Kom'),
(34, 19920430, 'Khoiru@gmail.com', '$2y$10$fomvieKf7/ihB1sfqkDgU.mdERt9Geom9yoSwUviGvoZjy5WFR9zS', 'Khoiru Nurfitri, S.Kom., M.Kom'),
(35, 19770909, 'Dwiyono@gmail.com', '$2y$10$NULxwAi/jHedApzZ0sdVEuBpOSuKQ2TZgeK2MzKOZ/j/TY74hLNIu', 'Dwiyono Ariyadi, S. Kom., M. Kom'),
(36, 19840924, 'Fajaryanto@gmail.com', '$2y$10$/P266KgMZtoV0eF4ZZJuku6kg0/7ZTypsMikCOHcvVvUDlvANh3T6', 'Adi Fajaryanto Cobantoro, S. Kom, M.Kom'),
(37, 19710521, 'triyanto@gmail.com', '$2y$10$TDg1QVQH7Lecf.MlAmfPJOb0wn1y3hbmWKVod.e0qgUuqJnIJEH8i', 'Ir. ANDY TRIYANTO PUJO RAHARJO, M.Kom');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `jumlah_siswa` int(100) NOT NULL,
  `semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jumlah_siswa`, `semester`) VALUES
(3, 'TI 7A', 18, 7),
(4, 'TI 3B', 24, 3),
(5, 'TI 7D', 21, 7),
(6, 'TI 7B', 13, 7),
(7, 'TI 7C', 22, 7),
(8, 'TI 7E', 14, 7),
(9, 'TI 5A', 25, 5),
(10, 'TI 5B', 19, 5),
(11, 'TI 5C', 22, 5),
(12, 'TI 5D', 18, 5),
(14, 'TI 3A', 16, 3),
(16, 'TI 3C', 26, 3),
(17, 'TI 3D', 23, 3),
(18, 'TI 3E', 25, 3),
(19, 'TI 3F', 21, 3),
(20, 'TI 1A', 19, 1),
(21, 'TI 1B', 23, 1),
(22, 'TI 1D', 15, 1),
(23, 'TI 1C', 21, 1),
(24, 'TI 9F', 20, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matkul` int(10) NOT NULL,
  `kode_matakuliah` varchar(11) NOT NULL,
  `nama_matakuliah` varchar(50) NOT NULL,
  `SKS` int(10) NOT NULL,
  `semester` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matkul`, `kode_matakuliah`, `nama_matakuliah`, `SKS`, `semester`) VALUES
(6, 'MWP53102', 'algoritma dasar', 2, 1),
(7, 'MWP53102', 'pengantar teknologi informasi', 3, 1),
(8, 'MWP53103', 'kalkulus dasar', 3, 1),
(9, 'MWP53104', 'aljabar linier dan matriks', 3, 1),
(10, 'MWP53105', 'logika matematika', 3, 1),
(11, 'MWP53106', 'arsitektur komputer', 3, 1),
(12, 'MWU53101', 'agama islam', 2, 2),
(13, 'MWU53102', 'pancasila', 2, 2),
(14, 'MWP53108', 'pemrograman berorientasi objek', 3, 2),
(15, 'MWP53109', 'jaringan komputer dasar', 3, 2),
(16, 'MWP53110', 'sistem operasi', 3, 2),
(17, 'MWP53111', 'manajemen basis data', 2, 2),
(18, 'MWP53112', 'analisis desain sistem informasi', 3, 2),
(19, 'MWP53115', 'pemrograman visual', 3, 3),
(20, 'MWP53117', 'jaringan komputer dasar', 3, 3),
(21, 'MWP53118', 'sistem operasi', 3, 3),
(22, 'MWP53119', 'manajemen basis data', 2, 3),
(23, 'MWP53120', 'analisis dan desain sistem informasi', 3, 3),
(24, 'MWP53121', 'pemrograman visual', 3, 5),
(25, 'MWP53122', 'metode penelitian', 2, 5),
(26, 'MWU53106', 'keamanan komputer', 3, 5),
(27, 'MWP53124', 'komputasi paralel', 3, 5),
(28, 'MWP53123', 'pemrograman web lanjut', 3, 5),
(29, 'MWP53125', 'pembelajaran mesin', 3, 5),
(30, '', 'kemuhammadiyahan', 2, 7),
(31, '', 'bahasa inggris', 2, 7),
(32, '', 'etika profesi', 2, 7),
(33, '', 'technopreneurship', 3, 7),
(34, '', 'sistem cerdas', 3, 7),
(35, '', 'ilmu data', 3, 7),
(37, 'MWP53107', 'Praktikum algoritma dasar', 1, 1),
(38, 'MWP53113', 'praktikum pemrograman berorientasi objek', 1, 1),
(39, 'MWP53114 ', 'praktikum jaringan komputer', 1, 1),
(40, 'MWP53122 ', 'praktikum komputasi paralel', 1, 1),
(41, 'MWP53128', 'praktikum pemrograman bergerak', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengampu`
--

CREATE TABLE `pengampu` (
  `id_pengampu` int(11) NOT NULL,
  `id_dosen` int(50) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengampu`
--

INSERT INTO `pengampu` (`id_pengampu`, `id_dosen`, `id_matkul`, `id_kelas`) VALUES
(51, 14, 14, 4),
(56, 14, 14, 8),
(50, 14, 14, 14),
(52, 14, 14, 16),
(53, 14, 14, 17),
(54, 14, 14, 18),
(55, 14, 14, 19),
(57, 14, 14, 24),
(92, 16, 17, 8),
(83, 16, 17, 9),
(87, 16, 17, 11),
(82, 16, 17, 14),
(84, 16, 22, 3),
(86, 16, 22, 4),
(89, 16, 22, 5),
(85, 16, 22, 10),
(88, 16, 22, 16),
(90, 16, 22, 17),
(91, 16, 22, 18),
(26, 17, 7, 20),
(27, 17, 7, 21),
(29, 17, 7, 22),
(28, 17, 7, 23),
(59, 19, 15, 4),
(58, 19, 15, 14),
(60, 19, 15, 16),
(61, 19, 15, 17),
(62, 19, 15, 18),
(63, 19, 15, 19),
(44, 21, 10, 20),
(33, 25, 8, 20),
(32, 25, 8, 21),
(31, 25, 8, 22),
(30, 25, 8, 23),
(40, 26, 9, 20),
(39, 26, 9, 21),
(38, 26, 9, 22),
(37, 26, 9, 23),
(70, 28, 16, 4),
(77, 28, 16, 5),
(80, 28, 16, 8),
(71, 28, 16, 10),
(76, 28, 16, 11),
(64, 28, 16, 14),
(78, 28, 16, 17),
(79, 28, 16, 18),
(81, 28, 16, 19),
(75, 28, 21, 16),
(22, 34, 6, 20),
(23, 34, 6, 21),
(25, 34, 6, 22),
(24, 34, 6, 23),
(49, 37, 11, 20),
(47, 37, 11, 21),
(46, 37, 11, 22),
(45, 37, 11, 23);

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE `penjadwalan` (
  `id_jadwal` int(11) NOT NULL,
  `id_pengampu` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `jam_mulai` varchar(20) DEFAULT NULL,
  `jam_selesai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`id_jadwal`, `id_pengampu`, `id_ruang`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(57, 82, 2, 'Senin', '12:30', '14:10'),
(58, 52, 2, 'Rabu', '08:30', '10:10'),
(59, 45, 2, 'Senin', '08:30', '10:10'),
(60, 58, 2, 'Kamis', '06:50', '08:30'),
(61, 52, 3, 'Kamis', '06:50', '08:30');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(5) NOT NULL,
  `no_ruang` int(5) NOT NULL,
  `kapasitas` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `no_ruang`, `kapasitas`) VALUES
(2, 401, 35),
(3, 402, 35),
(4, 403, 35),
(5, 404, 35),
(6, 405, 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `pengampu`
--
ALTER TABLE `pengampu`
  ADD PRIMARY KEY (`id_pengampu`),
  ADD UNIQUE KEY `id_dosen` (`id_dosen`,`id_matkul`,`id_kelas`),
  ADD UNIQUE KEY `id_kelas` (`id_kelas`,`id_matkul`,`id_dosen`) USING BTREE,
  ADD UNIQUE KEY `id_matkul` (`id_matkul`,`id_kelas`,`id_dosen`) USING BTREE;

--
-- Indexes for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pengampu` (`id_pengampu`),
  ADD KEY `id_ruang` (`id_ruang`) USING BTREE;

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matkul` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pengampu`
--
ALTER TABLE `pengampu`
  MODIFY `id_pengampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD CONSTRAINT `penjadwalan_ibfk_1` FOREIGN KEY (`id_pengampu`) REFERENCES `pengampu` (`id_pengampu`),
  ADD CONSTRAINT `penjadwalan_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
