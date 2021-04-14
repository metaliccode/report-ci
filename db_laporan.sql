-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Apr 2021 pada 03.13
-- Versi server: 5.7.24
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laporan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_durasi`
--

CREATE TABLE `tb_durasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_durasi`
--

INSERT INTO `tb_durasi` (`id`, `tanggal`) VALUES
(1, '2021-04-14'),
(2, '2021-04-15'),
(3, '2021-04-16'),
(4, '2021-04-17'),
(5, '2021-04-18'),
(6, '2021-04-19'),
(7, '2021-04-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id` int(11) NOT NULL,
  `instansi` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `training` varchar(225) NOT NULL,
  `duration_start` date NOT NULL,
  `duration_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id`, `instansi`, `name`, `training`, `duration_start`, `duration_end`) VALUES
(1, 'inixindo', 'ihsan', 'networking', '2021-04-13', '2021-04-15'),
(2, 'kkp', 'Miftahul', 'Database', '2021-04-13', '2021-04-16'),
(3, 'inixindo bandung', 'huda', 'IT Management', '2021-04-13', '2021-04-16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_durasi`
--
ALTER TABLE `tb_durasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_durasi`
--
ALTER TABLE `tb_durasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
