-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2024 pada 06.40
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_risingshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_game`
--

CREATE TABLE `tb_game` (
  `id_game` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name_game` varchar(20) NOT NULL,
  `top_up` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_game`
--

INSERT INTO `tb_game` (`id_game`, `file`, `name_game`, `top_up`, `status`) VALUES
('DF311', '1703671443_b5ac0e62510266d74708.jpg', 'PUBG', 'UC Card', 'Active'),
('DF312', '1703424197_072c0bf29deaebdb1608.png', 'Valorant', 'Valorant Point', 'Active'),
('DF313', '1709214127_2e923600c0019d241648.png', 'Free Fire', 'Diamond', 'Inactive'),
('DF314', '1703424217_978c94de5325a85f6dfa.jpg', 'Mobile Legend', 'Diamond', 'Active'),
('DF316', '1703424234_cb0e098cfcce471b8e6b.jpg', 'Genshin Impact', 'Genesis', 'Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(20) NOT NULL,
  `id_game` varchar(20) NOT NULL,
  `server_game` varchar(20) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `metode` varchar(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_game`, `server_game`, `customer`, `metode`, `jumlah`, `tanggal`) VALUES
(100037, 'DF312', 'G212F', 'Jaya', 'Dana', 75000, '2023-12-27'),
(100039, 'DF316', 'D1QSE', 'Jaya', 'OVO', 15000, '2023-12-27'),
(100040, 'DF312', 'G212F', 'Kinax', 'ShopeePay', 75000, '2023-12-27'),
(100041, 'DF311', 'TY21H', 'Kinax', 'BCA Mobile', 250000, '2023-12-27'),
(100042, 'DF314', '211212', 'Gues', 'Gopay', 75000, '2023-12-27'),
(100043, 'DF314', '211212', 'Gues', 'PayPal', 250000, '2023-12-27'),
(100044, 'DF316', 'D1QSE', 'Gues', 'Dana', 75000, '2023-12-27'),
(100045, 'DF311', 'TY21H', 'Kinax', 'OVO', 10000, '2023-12-27'),
(100053, 'DF311', '####', 'Kinax', 'Dana', 70000, '2024-01-02'),
(100054, 'DF312', 'D1QSE', 'Hexin', 'ShopeePay', 220000, '2024-01-02'),
(100057, 'DF316', '####', 'Jaya', 'BCA Mobile', 220000, '2024-01-04'),
(100060, 'DF316', 'asdad', 'example', 'OVO', 70000, '2024-02-29'),
(100061, 'DF312', 'D1QSE', 'Kinax', 'Dana', 40000, '2024-05-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `customer` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `phone_number` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`customer`, `email`, `password`, `country`, `phone_number`) VALUES
('admin', 'admin@gmail.com', 'admin123', 'Indonesia', 12441414),
('example', 'example@gmail.com', 'example', 'Indonesia', 11111),
('Gues', 'Gues232@gmail.com', 'gues', 'Indonesia', 81),
('Hexin', 'hexin@yahoo.com', 'hexin123', 'Singapore', 8892102),
('Jaya', 'jaya@gmail.com', 'jaya', 'Indonesia', 628888),
('Kinax', 'kinax@email.com', 'kinax', 'Japan', 8102912);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_game`
--
ALTER TABLE `tb_game`
  ADD PRIMARY KEY (`id_game`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_game` (`id_game`),
  ADD KEY `customer` (`customer`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`customer`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100062;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_tb_transaksi_customer` FOREIGN KEY (`customer`) REFERENCES `tb_user` (`customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_transaksi_game` FOREIGN KEY (`id_game`) REFERENCES `tb_game` (`id_game`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
