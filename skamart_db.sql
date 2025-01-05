-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2025 at 05:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skamart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint NOT NULL,
  `kode_user` bigint NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `kode_user`, `kode_barang`, `quantity`) VALUES
(10, 5, '4444', 2),
(11, 5, '1111', 1),
(13, 6, '9999', 1),
(14, 7, '333', 1),
(15, 5, '558653', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `kode_barang` varchar(255) NOT NULL,
  `kode_kategori` bigint NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `diskon` float NOT NULL,
  `gambar_barang` text NOT NULL,
  `stok` bigint NOT NULL,
  `varian` varchar(255) NOT NULL,
  `harga` bigint NOT NULL,
  `terjual` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`kode_barang`, `kode_kategori`, `nama_barang`, `deskripsi`, `satuan`, `rating`, `diskon`, `gambar_barang`, `stok`, `varian`, `harga`, `terjual`) VALUES
('0090', 4, 'Kelengkeng', 'Gak Tau', 'Kg', 0.2, 10, '677abc16ce94c2.72634767.png,677abc16cebc66.55945426.png,677abc16ceda01.84296051.png,677abc16cef899.89546325.png,677abc16cf10f3.44113001.png,677abc16cf2827.85318337.png', 1232, 'Coklat', 13545, 2),
('1111', 2, 'Le Minerale', 'Segar', 'Pcs', 0, 70, '677aba79ca5858.23203296.jpg,677aba79ca8361.90704011.jpg,677aba79caa6b0.94072294.jpg,677aba79cada14.35540718.jpg,677aba79cafb62.50164205.jpg,677aba79cb19f4.40216328.jpg', 333, 'Original', 9930, 0),
('2222', 1, 'Lays', 'Enak', 'Pcs', 0, 45, '677aba9db75850.89327534.jpg,677aba9db795f9.54195712.jpg,677aba9db7bac4.13316829.jpg,677aba9db7e2e5.00115459.jpg,677aba9db802a2.93358093.jpg,677aba9db82137.85508511.jpg', 333, 'Original', 4955, 0),
('333', 4, 'Jeruk', 'Kecut', 'Kg', 0.5, 70, '677abad1cec571.91691672.png,677abad1cee420.62242765.png,677abad1cef933.92338909.png,677abad1cf0cf1.85087284.png,677abad1cf2354.65932555.png,677abad1cf4033.01322950.png', 661, 'Original', 19930, 5),
('4444', 5, 'Roma Malkist', 'Enak', 'Pcs', 0.2, 70, '677abb00d56eb8.77212252.png,677abb00d59680.04182053.png,677abb00d5b577.26052930.png,677abb00d5d4c5.61424801.png,677abb00d5f176.55197109.png,677abb00d60ed3.90158353.png', 775, 'Coklat', 79930, 2),
('5555', 5, 'Brokoli', 'Segar', 'Kg', 0.1, 70, '677abb498ab5b6.61296885.png,677abb498ae0a2.63255478.png,677abb498b0983.22945687.png,677abb498b2843.56402941.png,677abb498b4868.03433277.png,677abb498b6694.86345176.png', 3433, 'Original', 29930, 1),
('558653', 3, 'Terasi', 'Bau', 'Kg', 0.1, 1, '677abca0bbac79.10730429.png,677abca0bbca55.03835730.png,677abca0bbe168.78080452.png,677abca0bbf739.49714031.png,677abca0bc0d77.50239899.png,677abca0bc21c2.15432254.png', 0, 'Original', 999, 1),
('64564', 6, 'Sabun', 'Sabun', 'Karton', 0, 43, '677abc54ea0c25.96471856.png,677abc54ea2f78.72572024.png,677abc54ea48b4.00047843.png,677abc54ea5ed5.36991451.png,677abc54ea75d8.35778346.png,677abc54ea8b16.67543940.png', 2332323, 'Original', 999957, 0),
('7777', 3, 'Mentega Blue', 'Bosok', 'Pcs', 0, 34, '677abb98b73db6.28290318.png,677abb98b76a56.95428249.png,677abb98b78f64.62760377.png,677abb98b7a6a9.48154002.png,677abb98b7bbc3.73835869.png,677abb98b7d329.75003974.png', 3333, 'Original', 49966, 0),
('9999', 2, 'Olatte', 'Seger', 'Kg', 0.3, 54, '677abbca92ed90.02756576.png,677abbca930b43.64081711.png,677abbca9320e0.22435529.png,677abbca9337f9.40621731.png,677abbca935258.72996192.png,677abbca9368d5.25366186.png', 9, 'Coklat', 19946, 3);

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `kode_kategori` bigint NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`kode_kategori`, `nama`) VALUES
(1, 'Jajanan'),
(2, 'Minuman'),
(3, 'Buah'),
(4, 'Sayuran'),
(5, 'Bumbu'),
(6, 'Kebutuhan Harian');

-- --------------------------------------------------------

--
-- Table structure for table `master_transaksi`
--

CREATE TABLE `master_transaksi` (
  `id` bigint NOT NULL,
  `kode_invoice` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `kode_user` bigint NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `total_barang` bigint NOT NULL,
  `dibayar` bigint DEFAULT NULL,
  `kembali` bigint DEFAULT NULL,
  `status` enum('pending','berhasil','gagal') NOT NULL DEFAULT 'pending',
  `tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_transaksi`
--

INSERT INTO `master_transaksi` (`id`, `kode_invoice`, `kode_barang`, `kode_user`, `lokasi`, `kode_pos`, `total_barang`, `dibayar`, `kembali`, `status`, `tanggal_transaksi`) VALUES
(71, 'INV-SKAMART-71', '0090', 5, 'Krian', '1234', 18545, 312313, 293768, 'berhasil', '2025-01-06 00:09:50'),
(72, 'INV-SKAMART-72', '333', 5, 'Krian', '3231', 41930, 321313, 279383, 'berhasil', '2025-01-06 00:10:01'),
(73, 'INV-SKAMART-73', '4444', 5, 'Krian', '3213', 84930, 322131, 237201, 'berhasil', '2025-01-06 00:10:13'),
(74, 'INV-SKAMART-74', '9999', 5, 'Krian', '32131', 42946, 6546654, 6503708, 'berhasil', '2025-01-06 00:10:23'),
(75, 'INV-SKAMART-75', '5555', 5, 'Krian', '4324', 52930, 432424, 379494, 'berhasil', '2025-01-06 00:10:51'),
(76, 'INV-SKAMART-76', '333', 5, 'Krian', '3213', 24930, 32133, 7203, 'berhasil', '2025-01-06 00:11:03'),
(77, 'INV-SKAMART-77', '558653', 5, NULL, NULL, 999, NULL, NULL, 'pending', '2025-01-06 00:11:38'),
(78, 'INV-SKAMART-78', '333', 6, 'Krian', '4342', 24930, 432423, 407493, 'berhasil', '2025-01-06 00:12:29'),
(79, 'INV-SKAMART-79', '0090', 6, 'Krian', '43243', 35545, 432424, 396879, 'berhasil', '2025-01-06 00:12:41'),
(80, 'INV-SKAMART-80', '9999', 6, 'Krian', '43242', 24946, 432423, 407477, 'berhasil', '2025-01-06 00:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `kode_user` bigint NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`kode_user`, `username`, `email`, `password`, `created_at`) VALUES
(5, 'rafi', 'rafi@gmail.com', '$2y$10$Jm0tHrXF4v7rXtsQYTiUW.P55DaI31n6FqmdcTK.D1HTAiVTDSJ9q', '2025-01-05 17:09:05'),
(6, 'joko', 'rr@gmail.com', '$2y$10$ifWsGc984A/oJ53tzRfdO.LKH/aYLd5SYpS/oh2Sq5VgdsbPSGuG6', '2025-01-05 17:12:18'),
(7, 'rodri', 'koko@gmail.com', '$2y$10$aBBOxn.2zyPtUwFp1fc7puF5hkHnajVIOU8Byw0Lj9VEJncQQuVHS', '2025-01-05 17:13:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD UNIQUE KEY `kode_barang_unique` (`kode_barang`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `master_transaksi`
--
ALTER TABLE `master_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang_transaksi` (`kode_barang`),
  ADD KEY `kode_user_tran` (`kode_user`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`kode_user`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `kode_kategori` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_transaksi`
--
ALTER TABLE `master_transaksi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `kode_user` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `kode_barang` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_user` FOREIGN KEY (`kode_user`) REFERENCES `master_user` (`kode_user`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `kode_kategori` FOREIGN KEY (`kode_kategori`) REFERENCES `master_kategori` (`kode_kategori`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `master_transaksi`
--
ALTER TABLE `master_transaksi`
  ADD CONSTRAINT `kode_barang_transaksi` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_user_tran` FOREIGN KEY (`kode_user`) REFERENCES `master_user` (`kode_user`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
