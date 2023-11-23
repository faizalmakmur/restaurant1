-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 08:03 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtobencafesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `full_name`, `username`, `password`) VALUES
(1, 'Agung Rashif Madani', 'armada', '123');

-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE `data_customer` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id_customer`, `customer_name`, `username`, `password`, `phone`) VALUES
(5, 'Agung Rashif Madani', 'arm', 'arm', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `data_menu`
--

CREATE TABLE `data_menu` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `available` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_menu`
--

INSERT INTO `data_menu` (`id_menu`, `menu_name`, `description`, `price`, `image_name`, `available`) VALUES
(8, 'Affogato', '', '10000.00', 'Menu-Name-2342.png', 'Ya'),
(9, 'Americano', '', '10000.00', 'Menu-Name-8209.png', 'Ya'),
(10, 'Ice Tea', '', '5000.00', 'Menu-Name-8199.png', 'Ya'),
(11, 'Latte', '', '10000.00', 'Menu-Name-6602.png', 'Ya'),
(12, 'Lemon Tea', '', '8000.00', 'Menu-Name-882.png', 'Ya'),
(13, 'Machiato', '', '10000.00', 'Menu-Name-3180.png', 'Ya'),
(14, 'French Fries', '', '8000.00', 'Menu-Name-4545.png', 'Ya'),
(15, 'Mendoan', '', '8000.00', 'Menu-Name-1270.png', 'Ya'),
(16, 'Pisang Goreng', '', '8000.00', 'Menu-Name-825.png', 'Ya'),
(17, 'Tahu Isi', '', '8000.00', 'Menu-Name-454.png', 'Ya'),
(18, 'Tempe Goreng', '', '8000.00', 'Menu-Name-5269.png', 'Ya'),
(19, 'Mi Goreng Ayam', '', '16000.00', 'Menu-Name-8259.png', 'Ya'),
(20, 'Mi Goreng Telur', '', '14000.00', 'Menu-Name-4653.png', 'Ya'),
(21, 'Mi Rebus', '', '12000.00', 'Menu-Name-1682.png', 'Ya'),
(22, 'Nasi Goreng', '', '12000.00', 'Menu-Name-2267.png', 'Ya'),
(23, 'Rice Bowl Chicken Katsu', '', '15000.00', 'Menu-Name-3282.png', 'Ya'),
(24, 'Tonkatsu', '', '15000.00', 'Menu-Name-4300.png', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `data_pesan`
--

CREATE TABLE `data_pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pesan`
--

INSERT INTO `data_pesan` (`id_pesan`, `id_menu`, `menu_name`, `price`, `quantity`, `order_date`, `order_id`) VALUES
(25, 10, 'Ice Tea', '5000.00', 3, '2022-06-09', '394658'),
(26, 21, 'Mi Rebus', '12000.00', 3, '2022-06-09', '394658');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

CREATE TABLE `data_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `transaksi_date` date NOT NULL DEFAULT current_timestamp(),
  `dibayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`id_transaksi`, `order_id`, `total_bayar`, `status`, `transaksi_date`, `dibayar`) VALUES
(13, '394658', 51000, 'sudah', '2022-06-09', 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_menu`
--
ALTER TABLE `data_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `data_pesan`
--
ALTER TABLE `data_pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `order_id_unique` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_menu`
--
ALTER TABLE `data_menu`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_pesan`
--
ALTER TABLE `data_pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
