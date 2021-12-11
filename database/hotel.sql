-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2021 pada 02.52
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kamar`
--

CREATE TABLE `jenis_kamar` (
  `id_jenis_kamar` int(11) NOT NULL,
  `jenis_kamar` varchar(100) NOT NULL,
  `harga_jenis_kamar` int(11) NOT NULL,
  `jml_jenis_kamar` int(11) NOT NULL,
  `foto_jenis_kamar` text NOT NULL,
  `video_jenis_kamar` text NOT NULL,
  `is_active_jenis_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_kamar`
--

INSERT INTO `jenis_kamar` (`id_jenis_kamar`, `jenis_kamar`, `harga_jenis_kamar`, `jml_jenis_kamar`, `foto_jenis_kamar`, `video_jenis_kamar`, `is_active_jenis_kamar`) VALUES
(4, 'Standar', 100000, 5, '16390687133.jpg', '16390606811.mp4', 1),
(5, 'Deluxe', 750000, 5, '16390687001.jpg', '16390606811.mp4', 1),
(6, 'Eksekutif', 1250000, 5, '16390687072.jpg', '16390606811.mp4', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `nama_pemesanan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_jenis_kamar` int(11) NOT NULL,
  `tgl_pemesanan` int(11) NOT NULL,
  `durasi_menginap` int(11) NOT NULL,
  `breakfast` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `is_active_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `nama_pemesanan`, `jenis_kelamin`, `nik`, `id_jenis_kamar`, `tgl_pemesanan`, `durasi_menginap`, `breakfast`, `total_pembayaran`, `no_kamar`, `is_active_pemesanan`) VALUES
(1, 'Andri Firman Saputra', 'pria', '3674072901021001', 4, 1639100688, 4, 1, 680000, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `is_active_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `is_active_user`) VALUES
(1, 'admin', '$2y$10$vb98X5xB3wipROu0kzb0xeaUFW1BRHhCQYN3ew8oEMDt4fzi26Aie', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_kamar`
--
ALTER TABLE `jenis_kamar`
  ADD PRIMARY KEY (`id_jenis_kamar`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_jenis_kamar` (`id_jenis_kamar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_kamar`
--
ALTER TABLE `jenis_kamar`
  MODIFY `id_jenis_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
