-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2025 pada 11.34
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_product` int NOT NULL,
  `qty` int NOT NULL,
  `subtotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `slug`, `title`) VALUES
(1, 'transmisi', 'Transmisi'),
(2, 'hydraulic', 'Hydraulic'),
(4, 'front-axle', 'Front Axle'),
(5, 'engine', 'Engine');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `date` date NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `total` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('waiting','paid','delivered','cancel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `date`, `invoice`, `total`, `name`, `address`, `phone`, `status`) VALUES
(1, 5, '2020-03-18', '520200318210456', 36000000, 'Hakim', 'Kampung Malang Kulon 1/38-A', '087855777360', 'delivered'),
(2, 5, '2020-03-19', '520200319181238', 500000, 'Jotaro Kujo', 'Western', '218838383', 'delivered'),
(3, 5, '2020-03-24', '520200324223408', 3000000, 'Amir Muhammad Hakim', 'Kampung Malang Kulon 1/38-A', '087855777360', 'waiting'),
(4, 4, '2024-08-18', '420240818133315', 800000, 'Ibnu', 'Kotabaru', '08972676622', 'delivered'),
(5, 4, '2024-01-04', '420240104133725', 1000000, 'Salahudin', 'Cindai Alus', '0886757676', 'delivered'),
(6, 4, '2024-02-22', '420240222133909', 85600000, 'Amat', 'Banjarbaru', '08993922828', 'delivered'),
(7, 7, '2024-01-30', '720240130134445', 87000000, 'Anggi', 'Cantung', '08234555222', 'delivered'),
(8, 4, '2024-08-18', '420240818135111', 3000000, 'Bilal', 'Serongga', '0987272928', 'cancel'),
(9, 4, '2024-08-18', '420240818135300', 85000000, 'Angga', 'Padang', '0856237819', 'paid'),
(10, 4, '2024-08-18', '420240818135743', 3000000, 'Anjar', 'Manado', '051197826321', 'paid'),
(11, 4, '2024-03-21', '420240321140550', 6150000, 'Nandang', 'JL. Sulawesi', '08972937292', 'paid'),
(12, 4, '2024-04-11', '420240411140831', 170000000, 'Triana', 'BJB', '089968268762', 'paid'),
(13, 4, '2024-05-28', '420240528141038', 21600000, 'Rusbandiansyah', 'JL. Perdagangan', '08788782932', 'paid'),
(14, 4, '2024-06-19', '420240619141226', 232150000, 'PT. Arutmin Indonesia', 'Satui, Tanah Bumbu', '080923082320', 'paid'),
(15, 4, '2024-07-30', '420240730141357', 92200000, 'Muhan', 'Suka Mara', '08929382', 'paid'),
(16, 5, '2025-01-19', '520250119084426', 1000000, 'Faisal Faisal', 'Jl. HKSN', '0882121921', 'waiting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_confirm`
--

CREATE TABLE `orders_confirm` (
  `id` int NOT NULL,
  `id_orders` int NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `nominal` int NOT NULL,
  `note` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `orders_confirm`
--

INSERT INTO `orders_confirm` (`id`, `id_orders`, `account_name`, `account_number`, `nominal`, `note`, `image`) VALUES
(1, 1, 'Amir', '42424123333', 36000000, '-', '520200318210456-20200319173859.jpg'),
(2, 2, 'Dio Brando', '344312321', 500000, 'Mantap kang', '520200319181238-20200319181447.jpg'),
(3, 4, 'Muhan', '0898278', 8000000, 'Delivered', '420240818133315-20240818133436.jpg'),
(4, 5, 'Salahudin', '092732998', 1000000, 'Delivered', '420240104133725-20240104133756.jpg'),
(5, 6, 'Amat', '0798292827', 85600000, 'Delivered', '420240222133909-20240222133949.jpg'),
(6, 7, 'Anggi', '0992838', 87000000, 'Indent', '720240130134445-20240130134517.jpg'),
(7, 11, 'Nandang', '0809080923', 6150000, 'Delivered', '420240321140550-20240321140622.jpg'),
(8, 12, 'Triana', '08982979', 170000000, 'Diterima', '420240411140831-20240411140903.jpg'),
(9, 13, 'Rusbandiansyah', '0878387', 21600000, 'Diterima', '420240528141038-20240528141114.jpg'),
(10, 14, 'PT. Arutmin Indonesia', '0809082', 232150000, 'Diterima', '420240619141226-20240619141302.jpg'),
(11, 15, 'Muhan', '008092093', 92200000, 'Diterima', '420240730141357-20240730141432.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_history`
--

CREATE TABLE `orders_history` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `date` date NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `total` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('waiting','paid','delivered','cancel') NOT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `orders_history`
--

INSERT INTO `orders_history` (`id`, `id_user`, `date`, `invoice`, `total`, `name`, `address`, `phone`, `status`, `date_update`) VALUES
(1, 5, '2020-03-18', '520200318210456', 36000000, 'Hakim', 'Kampung Malang Kulon 1/38-A', '087855777360', 'delivered', '2024-09-26 11:05:47'),
(2, 5, '2020-03-19', '520200319181238', 500000, 'Jotaro Kujo', 'Western', '218838383', 'delivered', '2024-09-26 11:05:47'),
(3, 5, '2020-03-24', '520200324223408', 3000000, 'Amir Muhammad Hakim', 'Kampung Malang Kulon 1/38-A', '087855777360', 'waiting', '2024-09-26 11:05:47'),
(4, 4, '2024-08-18', '420240818133315', 800000, 'Ibnu', 'Kotabaru', '08972676622', 'delivered', '2024-09-26 11:05:47'),
(5, 4, '2024-01-04', '420240104133725', 1000000, 'Salahudin', 'Cindai Alus', '0886757676', 'delivered', '2024-09-26 11:05:47'),
(6, 4, '2024-02-22', '420240222133909', 85600000, 'Amat', 'Banjarbaru', '08993922828', 'delivered', '2024-09-26 11:05:47'),
(7, 7, '2024-01-30', '720240130134445', 87000000, 'Anggi', 'Cantung', '08234555222', 'delivered', '2024-09-26 11:05:47'),
(8, 4, '2024-08-18', '420240818135111', 3000000, 'Bilal', 'Serongga', '0987272928', 'cancel', '2024-09-26 11:05:47'),
(9, 4, '2024-08-18', '420240818135300', 85000000, 'Angga', 'Padang', '0856237819', 'waiting', '2024-09-26 11:05:47'),
(10, 4, '2024-08-18', '420240818135743', 3000000, 'Anjar', 'Manado', '051197826321', 'waiting', '2024-09-26 11:05:47'),
(11, 4, '2024-03-21', '420240321140550', 6150000, 'Nandang', 'JL. Sulawesi', '08972937292', 'paid', '2024-09-26 11:05:47'),
(12, 4, '2024-04-11', '420240411140831', 170000000, 'Triana', 'BJB', '089968268762', 'paid', '2024-09-26 11:05:47'),
(13, 4, '2024-05-28', '420240528141038', 21600000, 'Rusbandiansyah', 'JL. Perdagangan', '08788782932', 'paid', '2024-09-26 11:05:47'),
(14, 4, '2024-06-19', '420240619141226', 232150000, 'PT. Arutmin Indonesia', 'Satui, Tanah Bumbu', '080923082320', 'paid', '2024-09-26 11:05:47'),
(15, 4, '2024-07-30', '420240730141357', 92200000, 'Muhan', 'Suka Mara', '08929382', 'paid', '2024-09-26 11:05:47'),
(17, 4, '2024-08-18', '420240818135743', 3000000, 'Anjar', 'Manado', '051197826321', 'paid', '2024-09-26 10:51:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `id_orders` int NOT NULL,
  `id_product` int NOT NULL,
  `qty` int NOT NULL,
  `subtotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_orders`, `id_product`, `qty`, `subtotal`) VALUES
(1, 1, 4, 6, 30000000),
(2, 1, 3, 2, 6000000),
(3, 2, 2, 1, 500000),
(4, 3, 3, 1, 3000000),
(5, 4, 8, 4, 800000),
(6, 5, 5, 1, 1000000),
(7, 6, 7, 1, 85000000),
(8, 6, 9, 1, 600000),
(9, 7, 5, 1, 1000000),
(10, 7, 7, 1, 85000000),
(11, 7, 8, 5, 1000000),
(12, 8, 5, 3, 3000000),
(13, 9, 7, 1, 85000000),
(14, 10, 5, 3, 3000000),
(15, 11, 5, 1, 1000000),
(16, 11, 8, 3, 600000),
(17, 11, 10, 7, 4550000),
(18, 12, 7, 2, 170000000),
(19, 13, 5, 6, 6000000),
(20, 13, 9, 26, 15600000),
(21, 14, 7, 2, 170000000),
(22, 14, 10, 43, 27950000),
(23, 14, 9, 57, 34200000),
(24, 15, 7, 1, 85000000),
(25, 15, 5, 3, 3000000),
(26, 15, 9, 7, 4200000),
(27, 16, 5, 1, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `id_category` int NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `modal` int NOT NULL,
  `is_available` int NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `id_category`, `slug`, `title`, `description`, `price`, `modal`, `is_available`, `image`) VALUES
(5, 4, 'ball-joint-assy', 'Ball Joint Assy', 'Ready', 1000000, 800000, 4, 'ball-joint-assy-20240818125941.jpg'),
(7, 1, 'housing-transmisi', 'Housing Transmisi', 'Ready', 85000000, 80000000, 3, 'housing-transmisi-20240818131336.jpg'),
(8, 5, 'oil-filter', 'Oil Filter', 'Ready', 200000, 180000, 8, 'oil-filter-20240818131645.jpg'),
(9, 2, 'hydraulic-pipe', 'Hydraulic Pipe', 'Ready', 600000, 500000, 14, 'hydraulic-pipe-20240818131856.jpg'),
(10, 2, 'hydraulic-filter', 'Hydraulic Filter', 'Ready', 650000, 600000, 22, 'hydraulic-filter-20240818132250.jpg'),
(11, 5, 'gasket-cylinder-head', 'Gasket Cylinder Head', 'Ready', 400000, 360000, 0, 'gasket-cylinder-head-20240818132516.jpg'),
(12, 5, 'cylinder-head-gasket', 'Cylinder Head Gasket', 'Ready', 400000, 350000, 0, 'cylinder-head-gasket-20240818132709.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_product`
--

CREATE TABLE `stok_product` (
  `id` int NOT NULL,
  `id_product` int NOT NULL,
  `stok` int NOT NULL,
  `tanggal` date NOT NULL,
  `supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_product`
--

INSERT INTO `stok_product` (`id`, `id_product`, `stok`, `tanggal`, `supplier`) VALUES
(1, 2, 1, '2024-07-20', '1'),
(2, 2, 1, '2024-08-16', '2'),
(3, 2, 3, '2024-08-17', '1'),
(4, 4, 2, '2024-08-17', '1'),
(5, 2, 1, '2024-08-17', '2'),
(6, 4, 1, '2024-08-17', '2'),
(7, 5, 3, '2024-08-18', '3'),
(8, 7, 2, '2024-08-18', '4'),
(9, 8, 20, '2024-08-18', '2'),
(10, 9, 7, '2024-08-18', '3'),
(11, 10, 7, '2024-08-18', '3'),
(12, 5, 20, '2024-08-18', '1'),
(13, 7, 9, '2024-08-18', '1'),
(14, 9, 98, '2024-08-18', '1'),
(15, 10, 65, '2024-08-18', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `alamat`, `no_hp`, `email`) VALUES
(1, 'PT Anu', 'Jl. Mandastana', '082191949321', 'ptanu@gmail.com'),
(2, 'PT Senada', 'Jl Suungai Andai', '082191949376', 'faisal.jynerso@gmail.com'),
(3, 'PT. Satrindo Agro Permana', 'JL. A. Yani KM 19', '0898728638267', 'Satrindoagropermana@gmail.com'),
(4, 'PT. Agritama', 'JL. A. Yani KM 25', '089672676382', 'Agritama@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `point` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `is_active`, `image`, `point`) VALUES
(4, 'Admin', 'admin@admin.com', '$2y$10$kuFx0WJdsgk1S31P1xPpj.ybLksN2vwlEEpp0Up5W2tY.e4OLHGDy', 'admin', 1, 'admin-20200315212825.png', 0),
(5, 'Member', 'member@member.com', '$2y$10$OoN2vk3QdnD9OxEpL4NJweulU6VqLqi1aCFBAJI.dSjqjlj2t/SkK', 'member', 1, 'member-20200315232137.png', 500),
(6, 'Ical', 'ical@gmail.com', '$2y$10$ZC8ZIGE6RWeUPksFWii0TOwYEsrEGd4O6ggRsGMwyWLF9/fXaZ54S', 'member', 1, NULL, 0),
(7, 'Amatari', 'amatari@gmail.com', '$2y$10$ylRcI5Z7/p1LbmWR985JDumM1UvtNz442YEG7VmhfijlLHjG6imNe', 'member', 1, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_confirm`
--
ALTER TABLE `orders_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_history`
--
ALTER TABLE `orders_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_product`
--
ALTER TABLE `stok_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `orders_confirm`
--
ALTER TABLE `orders_confirm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `orders_history`
--
ALTER TABLE `orders_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `stok_product`
--
ALTER TABLE `stok_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
