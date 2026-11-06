-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2025 pada 04.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(10) NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `nama_alternatif`) VALUES
(21, 'A1', 'Dicoding'),
(22, 'A2', 'Binar Academy'),
(23, 'A3', 'Hacktiv8'),
(24, 'A4', 'Orbit Future Academy'),
(25, 'A5', 'DQLab'),
(26, 'A6', 'Purwadhika'),
(27, 'A7', 'Rakamin Academy'),
(28, 'A8', 'Progate Indonesia'),
(29, 'A9', 'CodePolitan'),
(30, 'A10', 'Arkademi'),
(31, 'A11', 'Sekolah Koding'),
(32, 'A12', 'BuildWith Angga'),
(33, 'A13', 'SanberCode'),
(34, 'A14', 'dibimbing.id'),
(39, 'A15', 'Eudeka'),
(40, 'A16', 'Markoding'),
(41, 'A17', 'Coding Studio'),
(42, 'A18', 'Digital Skola'),
(43, 'A19', 'Techarea Academy'),
(44, 'A20', 'IDCamp'),
(45, 'A21', 'Gamelab Indonesia'),
(46, 'A22', 'IDNetworkers'),
(47, 'A23', 'Infinite Learning Batam'),
(48, 'A24', 'Refactory Indonesia'),
(49, 'A25', 'Enigma Camp'),
(50, 'A26', 'Digitalent Kominfo'),
(51, 'A27', 'DevHandal'),
(52, 'A28', 'Glints Academy'),
(53, 'A29', 'Alterra Academy'),
(54, 'A30', 'Bangkit Academy'),
(55, 'A31', 'Cisco Networking Academy'),
(56, 'A32', 'AWS Academy'),
(57, 'A33', 'Google Cloud Skills'),
(58, 'A34', 'Microsoft Learn'),
(59, 'A35', 'IBM SkillsBuild'),
(60, 'A36', 'Udacity'),
(61, 'A37', 'Codecademy'),
(62, 'A38', 'FreeCodeCamp'),
(63, 'A39', 'DataCamp'),
(64, 'A40', 'Pluralsight'),
(65, 'A41', 'The Odin Project'),
(66, 'A42', 'HackTheBox Academy'),
(67, 'A43', 'TryHackMe'),
(68, 'A44', 'Cakap'),
(69, 'A45', 'Revou'),
(70, 'A46', 'Pintaar by Telkom'),
(71, 'A47', 'Pijar Mahir'),
(72, 'A48', 'RedHat Training Indonesia'),
(73, 'A49', 'Oracle Academy Indonesia'),
(74, 'A50', 'Android Developer Kejar'),
(75, 'A51', 'Javacode Geeks Indonesia'),
(76, 'A52', 'Vokasi Kemdikbud - Digital Talent'),
(77, 'A53', 'DTS FGA Kominfo (Fresh Graduate Academy)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_kriteria`, `bobot`) VALUES
(6, 0.333333),
(7, 0.333333),
(8, 0.333333),
(9, 0.333333),
(10, 0.333333),
(11, 0.333333),
(12, 0.0348208),
(13, 0.0677776),
(14, 0.13435),
(15, 0.260232),
(16, 0.50282);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_topsis`
--

CREATE TABLE `hasil_topsis` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai_preferensi` double NOT NULL,
  `ranking` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_topsis`
--

INSERT INTO `hasil_topsis` (`id_hasil`, `id_alternatif`, `nilai_preferensi`, `ranking`, `tanggal`) VALUES
(1, 41, 1, 1, '2025-12-18 13:52:07'),
(2, 62, 0.9362781048544, 2, '2025-12-18 13:52:07'),
(3, 66, 0.90488460023562, 3, '2025-12-18 13:52:07'),
(4, 65, 0.89978944511386, 4, '2025-12-18 13:52:07'),
(5, 67, 0.89978944511386, 5, '2025-12-18 13:52:07'),
(6, 59, 0.86266840104471, 6, '2025-12-18 13:52:07'),
(7, 57, 0.86046495516145, 7, '2025-12-18 13:52:07'),
(8, 51, 0.84565656548015, 8, '2025-12-18 13:52:07'),
(9, 58, 0.84364477681784, 9, '2025-12-18 13:52:07'),
(10, 64, 0.84207377958777, 10, '2025-12-18 13:52:07'),
(11, 63, 0.83862699177513, 11, '2025-12-18 13:52:07'),
(12, 25, 0.73800382400509, 12, '2025-12-18 13:52:07'),
(13, 55, 0.73557788598206, 13, '2025-12-18 13:52:07'),
(14, 61, 0.73157227401311, 14, '2025-12-18 13:52:07'),
(15, 34, 0.70811562837988, 15, '2025-12-18 13:52:07'),
(16, 42, 0.70636880821906, 16, '2025-12-18 13:52:07'),
(17, 60, 0.70636880821906, 17, '2025-12-18 13:52:07'),
(18, 56, 0.70634564992134, 18, '2025-12-18 13:52:07'),
(19, 44, 0.69818188004017, 19, '2025-12-18 13:52:07'),
(20, 45, 0.69818188004017, 20, '2025-12-18 13:52:07'),
(21, 50, 0.69818188004017, 21, '2025-12-18 13:52:07'),
(22, 49, 0.6963722470987, 22, '2025-12-18 13:52:07'),
(23, 53, 0.69224689770701, 23, '2025-12-18 13:52:07'),
(24, 29, 0.64282837268461, 24, '2025-12-18 13:52:07'),
(25, 32, 0.63978969659383, 25, '2025-12-18 13:52:07'),
(26, 30, 0.63968331641628, 26, '2025-12-18 13:52:07'),
(27, 71, 0.60869665814341, 27, '2025-12-18 13:52:07'),
(28, 33, 0.60607708640334, 28, '2025-12-18 13:52:07'),
(29, 26, 0.60273068335443, 29, '2025-12-18 13:52:07'),
(30, 27, 0.60147110242259, 30, '2025-12-18 13:52:07'),
(31, 70, 0.58991077246553, 31, '2025-12-18 13:52:07'),
(32, 28, 0.57390450071977, 32, '2025-12-18 13:52:07'),
(33, 48, 0.56533861586672, 33, '2025-12-18 13:52:07'),
(34, 54, 0.56533861586672, 34, '2025-12-18 13:52:07'),
(35, 31, 0.56203825298239, 35, '2025-12-18 13:52:07'),
(36, 47, 0.56180924051076, 36, '2025-12-18 13:52:07'),
(37, 52, 0.55732769709678, 37, '2025-12-18 13:52:07'),
(38, 73, 0.51384285887834, 38, '2025-12-18 13:52:07'),
(39, 24, 0.51206679132528, 39, '2025-12-18 13:52:07'),
(40, 72, 0.5092714038057, 40, '2025-12-18 13:52:07'),
(41, 46, 0.50023393583392, 41, '2025-12-18 13:52:07'),
(42, 21, 0.45547340110985, 42, '2025-12-18 13:52:07'),
(43, 23, 0.44890586470367, 43, '2025-12-18 13:52:07'),
(44, 76, 0.40168433865051, 44, '2025-12-18 13:52:07'),
(45, 77, 0.40168433865051, 45, '2025-12-18 13:52:07'),
(46, 69, 0.3877105009429, 46, '2025-12-18 13:52:07'),
(47, 68, 0.31116958887129, 47, '2025-12-18 13:52:07'),
(48, 22, 0.2743374576882, 48, '2025-12-18 13:52:07'),
(49, 39, 0.2642055515366, 49, '2025-12-18 13:52:07'),
(50, 40, 0.25264002674002, 50, '2025-12-18 13:52:07'),
(51, 43, 0.25264002674002, 51, '2025-12-18 13:52:07'),
(52, 74, 0.14885146487503, 52, '2025-12-18 13:52:07'),
(53, 75, 0.14885146487503, 53, '2025-12-18 13:52:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `sifat` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `sifat`) VALUES
(12, 'C1', 'Biaya', 'cost'),
(13, 'C2', 'Fasilitas', 'benefit'),
(14, 'C3', 'Tenaga Pengajar', 'benefit'),
(15, 'C4', 'Total Pertemuan', 'benefit'),
(16, 'C5', 'Fleksibilitas Waktu & Akses', 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrix_ahp`
--

CREATE TABLE `matrix_ahp` (
  `id_kriteria_i` int(11) NOT NULL,
  `id_kriteria_j` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matrix_ahp`
--

INSERT INTO `matrix_ahp` (`id_kriteria_i`, `id_kriteria_j`, `nilai`) VALUES
(12, 12, 1),
(12, 13, 0.333333),
(12, 14, 0.2),
(12, 15, 0.142857),
(12, 16, 0.111111),
(13, 12, 3),
(13, 13, 1),
(13, 14, 0.333333),
(13, 15, 0.2),
(13, 16, 0.142857),
(14, 12, 5),
(14, 13, 3),
(14, 14, 1),
(14, 15, 0.333333),
(14, 16, 0.2),
(15, 12, 7),
(15, 13, 5),
(15, 14, 3),
(15, 15, 1),
(15, 16, 0.333333),
(16, 12, 9),
(16, 13, 7),
(16, 14, 5),
(16, 15, 3),
(16, 16, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(23, 21, 12, 100),
(24, 21, 13, 100),
(25, 21, 14, 80),
(26, 21, 15, 20),
(27, 21, 16, 80),
(28, 22, 12, 80),
(29, 22, 13, 60),
(30, 22, 14, 80),
(31, 22, 15, 20),
(32, 22, 16, 60),
(33, 23, 12, 100),
(34, 23, 13, 80),
(35, 23, 14, 100),
(36, 23, 15, 100),
(37, 23, 16, 40),
(38, 24, 12, 20),
(39, 24, 13, 60),
(40, 24, 14, 100),
(41, 24, 15, 80),
(42, 24, 16, 60),
(43, 25, 12, 20),
(44, 25, 13, 100),
(45, 25, 14, 80),
(46, 25, 15, 60),
(47, 25, 16, 100),
(48, 26, 12, 100),
(49, 26, 13, 100),
(50, 26, 14, 80),
(51, 26, 15, 60),
(52, 26, 16, 80),
(53, 27, 12, 60),
(54, 27, 13, 60),
(55, 27, 14, 80),
(56, 27, 15, 60),
(57, 27, 16, 80),
(58, 28, 12, 20),
(59, 28, 13, 100),
(60, 28, 14, 80),
(61, 28, 15, 20),
(62, 28, 16, 100),
(63, 29, 12, 20),
(64, 29, 13, 80),
(65, 29, 14, 80),
(66, 29, 15, 40),
(67, 29, 16, 100),
(68, 30, 12, 20),
(69, 30, 13, 60),
(70, 30, 14, 80),
(71, 30, 15, 40),
(72, 30, 16, 100),
(73, 31, 12, 20),
(74, 31, 13, 60),
(75, 31, 14, 60),
(76, 31, 15, 20),
(77, 31, 16, 100),
(78, 32, 12, 60),
(79, 32, 13, 80),
(80, 32, 14, 80),
(81, 32, 15, 40),
(82, 32, 16, 100),
(83, 33, 12, 60),
(84, 33, 13, 80),
(85, 33, 14, 80),
(86, 33, 15, 60),
(87, 33, 16, 80),
(88, 34, 12, 20),
(89, 34, 13, 80),
(90, 34, 14, 100),
(91, 34, 15, 80),
(92, 34, 16, 80),
(93, 39, 12, 20),
(94, 39, 13, 40),
(95, 39, 14, 60),
(96, 39, 15, 20),
(97, 39, 16, 60),
(98, 40, 12, 20),
(99, 40, 13, 20),
(100, 40, 14, 40),
(101, 40, 15, 20),
(102, 40, 16, 60),
(103, 41, 12, 20),
(104, 41, 13, 100),
(105, 41, 14, 100),
(106, 41, 15, 100),
(107, 41, 16, 100),
(108, 42, 12, 60),
(109, 42, 13, 100),
(110, 42, 14, 100),
(111, 42, 15, 80),
(112, 42, 16, 80),
(113, 43, 12, 20),
(114, 43, 13, 20),
(115, 43, 14, 40),
(116, 43, 15, 20),
(117, 43, 16, 60),
(118, 44, 12, 20),
(119, 44, 13, 80),
(120, 44, 14, 80),
(121, 44, 15, 80),
(122, 44, 16, 80),
(123, 45, 12, 20),
(124, 45, 13, 80),
(125, 45, 14, 80),
(126, 45, 15, 80),
(127, 45, 16, 80),
(128, 46, 12, 60),
(129, 46, 13, 80),
(130, 46, 14, 80),
(131, 46, 15, 80),
(132, 46, 16, 60),
(133, 47, 12, 60),
(134, 47, 13, 80),
(135, 47, 14, 80),
(136, 47, 15, 100),
(137, 47, 16, 60),
(138, 48, 12, 20),
(139, 48, 13, 80),
(140, 48, 14, 80),
(141, 48, 15, 100),
(142, 48, 16, 60),
(143, 49, 12, 40),
(144, 49, 13, 80),
(145, 49, 14, 80),
(146, 49, 15, 80),
(147, 49, 16, 80),
(148, 50, 12, 20),
(149, 50, 13, 80),
(150, 50, 14, 80),
(151, 50, 15, 80),
(152, 50, 16, 80),
(153, 51, 12, 20),
(154, 51, 13, 80),
(155, 51, 14, 80),
(156, 51, 15, 80),
(157, 51, 16, 100),
(158, 52, 12, 100),
(159, 52, 13, 80),
(160, 52, 14, 80),
(161, 52, 15, 100),
(162, 52, 16, 60),
(163, 53, 12, 80),
(164, 53, 13, 100),
(165, 53, 14, 80),
(166, 53, 15, 80),
(167, 53, 16, 80),
(168, 54, 12, 20),
(169, 54, 13, 80),
(170, 54, 14, 80),
(171, 54, 15, 100),
(172, 54, 16, 60),
(173, 55, 12, 20),
(174, 55, 13, 80),
(175, 55, 14, 80),
(176, 55, 15, 60),
(177, 55, 16, 100),
(178, 56, 12, 40),
(179, 56, 13, 80),
(180, 56, 14, 100),
(181, 56, 15, 80),
(182, 56, 16, 80),
(183, 57, 12, 40),
(184, 57, 13, 100),
(185, 57, 14, 100),
(186, 57, 15, 80),
(187, 57, 16, 100),
(188, 58, 12, 40),
(189, 58, 13, 80),
(190, 58, 14, 80),
(191, 58, 15, 80),
(192, 58, 16, 100),
(193, 59, 12, 20),
(194, 59, 13, 100),
(195, 59, 14, 100),
(196, 59, 15, 80),
(197, 59, 16, 100),
(198, 60, 12, 60),
(199, 60, 13, 100),
(200, 60, 14, 100),
(201, 60, 15, 80),
(202, 60, 16, 80),
(203, 61, 12, 60),
(204, 61, 13, 80),
(205, 61, 14, 80),
(206, 61, 15, 60),
(207, 61, 16, 100),
(208, 62, 12, 20),
(209, 62, 13, 100),
(210, 62, 14, 80),
(211, 62, 15, 100),
(212, 62, 16, 100),
(213, 63, 12, 60),
(214, 63, 13, 80),
(215, 63, 14, 80),
(216, 63, 15, 80),
(217, 63, 16, 100),
(218, 64, 12, 60),
(219, 64, 13, 100),
(220, 64, 14, 80),
(221, 64, 15, 80),
(222, 64, 16, 100),
(223, 65, 12, 80),
(224, 65, 13, 80),
(225, 65, 14, 80),
(226, 65, 15, 100),
(227, 65, 16, 100),
(228, 66, 12, 80),
(229, 66, 13, 100),
(230, 66, 14, 80),
(231, 66, 15, 100),
(232, 66, 16, 100),
(233, 67, 12, 80),
(234, 67, 13, 80),
(235, 67, 14, 80),
(236, 67, 15, 100),
(237, 67, 16, 100),
(238, 68, 12, 80),
(239, 68, 13, 80),
(240, 68, 14, 100),
(241, 68, 15, 60),
(242, 68, 16, 40),
(243, 69, 12, 80),
(244, 69, 13, 80),
(245, 69, 14, 100),
(246, 69, 15, 80),
(247, 69, 16, 40),
(248, 70, 12, 40),
(249, 70, 13, 60),
(250, 70, 14, 60),
(251, 70, 15, 60),
(252, 70, 16, 80),
(253, 71, 12, 40),
(254, 71, 13, 80),
(255, 71, 14, 80),
(256, 71, 15, 60),
(257, 71, 16, 80),
(258, 72, 12, 80),
(259, 72, 13, 80),
(260, 72, 14, 100),
(261, 72, 15, 80),
(262, 72, 16, 60),
(263, 73, 12, 40),
(264, 73, 13, 80),
(265, 73, 14, 100),
(266, 73, 15, 80),
(267, 73, 16, 60),
(268, 74, 12, 60),
(269, 74, 13, 40),
(270, 74, 14, 40),
(271, 74, 15, 40),
(272, 74, 16, 40),
(273, 75, 12, 60),
(274, 75, 13, 40),
(275, 75, 14, 40),
(276, 75, 15, 40),
(277, 75, 16, 40),
(278, 76, 12, 40),
(279, 76, 13, 60),
(280, 76, 14, 60),
(281, 76, 15, 60),
(282, 76, 16, 60),
(283, 77, 12, 40),
(284, 77, 13, 60),
(285, 77, 14, 60),
(286, 77, 15, 60),
(287, 77, 16, 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `matrix_ahp`
--
ALTER TABLE `matrix_ahp`
  ADD PRIMARY KEY (`id_kriteria_i`,`id_kriteria_j`),
  ADD KEY `id_kriteria_j` (`id_kriteria_j`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD UNIQUE KEY `uniq_penilaian` (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=818;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD CONSTRAINT `hasil_topsis_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Ketidakleluasaan untuk tabel `matrix_ahp`
--
ALTER TABLE `matrix_ahp`
  ADD CONSTRAINT `matrix_ahp_ibfk_1` FOREIGN KEY (`id_kriteria_i`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `matrix_ahp_ibfk_2` FOREIGN KEY (`id_kriteria_j`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
