-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2025 pada 00.32
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
-- Database: `blu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `air`
--

CREATE TABLE `air` (
  `id_air` int(11) NOT NULL,
  `nama_air` varchar(100) NOT NULL,
  `deskripsi_air` text NOT NULL,
  `kualitas` enum('Bahaya','Hati-hati','Aman') NOT NULL,
  `ph_air` float NOT NULL,
  `turbidity_air` float NOT NULL,
  `tds_air` float NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `air`
--

INSERT INTO `air` (`id_air`, `nama_air`, `deskripsi_air`, `kualitas`, `ph_air`, `turbidity_air`, `tds_air`, `id_user`) VALUES
(3, 'Air Mineral', 'Air mineral dengan kualitas baik', 'Aman', 7.5, 0.2, 150, 1),
(4, 'Air Sungaiasd', 'Air sungai yang tercemar limbahasd', 'Bahaya', 4.5, 5, 1000, 1),
(5, 'air kopi', 'air kopi dibuat sesuka hati yang senang dan tenang', 'Bahaya', 8, 1311, 100, 6),
(6, 'air bahaya ', 'air bahaya nih', 'Bahaya', 8, 1311, 100, 6),
(7, 'air kuningan', 'berbahaya kemarin', 'Bahaya', 8, 1311, 100, 6),
(11, 'air murni', 'murni dari gunung', 'Bahaya', 8, 1311, 100, 12),
(14, 'qwe', 'qwe', 'Bahaya', 8, 1311, 100, 1),
(15, 'asd', 'asd', 'Bahaya', 8, 1311, 100, 1),
(16, 'air keran fahreza', 'cukup bagus tapi bahaya juga nich', 'Bahaya', 6.29, 750, 291.2, 1),
(17, 'air minum le minerale', 'air minum le minerale baru', 'Bahaya', 6.07, 750, 271.12, 1),
(18, 'air keran', 'air keran yang digunakan untuk percobaan', 'Bahaya', 6.33, 750, 327.76, 14),
(19, 'air le minerale', 'air le minerale bagus untuk diminum', 'Bahaya', 6.1, 750, 149.36, 14),
(20, 'air kota meksiko El Muanidikora', 'air asal kota meksiko ini sangat baik untuk dipakai', 'Aman', 8, 500, 629, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluhan`
--

CREATE TABLE `keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `judul` varchar(20) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `judul`, `deskripsi`, `id_user`) VALUES
(1, 'masalah alat', 'alat tidak befungsi', 1),
(2, 'asd', 'asd', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `read_data`
--

CREATE TABLE `read_data` (
  `id_device` int(11) NOT NULL,
  `password_device` varchar(20) NOT NULL,
  `status` enum('Mati','Ready') NOT NULL,
  `tds` float NOT NULL,
  `turbidity` float NOT NULL,
  `ph` float NOT NULL,
  `hasil` enum('bahaya','hati-hati','aman') NOT NULL,
  `WAWQI` float DEFAULT NULL,
  `IKA` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `read_data`
--

INSERT INTO `read_data` (`id_device`, `password_device`, `status`, `tds`, `turbidity`, `ph`, `hasil`, `WAWQI`, `IKA`) VALUES
(1, 'abc', 'Mati', 629, 500, 8, 'aman', 30, 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id_device` int(10) UNSIGNED DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `id_device`, `role`) VALUES
(1, 'King Sudrajat', 'sudrajat@gmail.com', '123456', 1, 'user'),
(3, 'sujatmoko', 'sujatmoko@gmail.com', '123456', NULL, 'user'),
(6, 'sudibjo', 'sudibjo@gmail.com', '123456', NULL, 'user'),
(10, 'Ramdhan Si Tua', 'ramdhan@gmail.com', '123456', 1, 'user'),
(12, 'fahreza_5B', 'fahreza_5B@gmail.com', '12345678', NULL, 'user'),
(14, 'user', 'user@gmail.com', '123456', NULL, 'user'),
(15, 'admin', 'admin@gmail.com', 'sudrajatisking', NULL, 'admin'),
(18, 'king', 'king@gmail.com', '123456', NULL, 'user'),
(19, 'baruqweqwe', 'baruqweqwe@gmail.com', '123456qwe', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `air`
--
ALTER TABLE `air`
  ADD PRIMARY KEY (`id_air`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id_keluhan`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indeks untuk tabel `read_data`
--
ALTER TABLE `read_data`
  ADD PRIMARY KEY (`id_device`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `air`
--
ALTER TABLE `air`
  MODIFY `id_air` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `read_data`
--
ALTER TABLE `read_data`
  MODIFY `id_device` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `air`
--
ALTER TABLE `air`
  ADD CONSTRAINT `air_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
