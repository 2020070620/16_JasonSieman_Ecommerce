SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `register_login` (
  `id` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `register_login` (`id`, `email`, `username`, `password`, `name`, `phone`, `address`, `birth`) VALUES
(9, 'jason@gmail.com', '123qwe', '$2y$10$jxJz.B4p2cxHvME3A9UobO.XPdk8eSuCsJ6wdWetJLORDgDvKYZ4e', 'qwerty', '+62323432454354543', 'qwerty', '2025-11-30'),
(10, 'j4s@gmail.com', 'zxc', '$2y$10$MxZa6rhQP6g663fh4q4JweyZ03tpgejtDD2WB.UrN7IRVy.KqAjZe', 'zxc', '+6255555555', 'cvbvcb', '2025-11-30');

CREATE TABLE `transaksi` (
  `transaksi_id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksi` (`transaksi_id`, `username`, `phone`, `address`, `product`, `jumlah`, `total`, `payment_method`, `tanggal`) VALUES
(1, '123qwe', '+62323432454354543', 'qwerty', 'Garlickoe Bawang Hitam Tunggal 250gr', 13, 1169987, 'COD', '2025-11-15 21:08:16'),
(2, 'zxc', '+6255555555', 'cvbvcb', 'Garlickoe Bawang Hitam Tunggal 1kg', 16, 5760000, 'Transfer Bank', '2025-11-17 03:12:32'),
(3, 'zxc', '+6255555555', 'cvbvcb', 'Garlickoe Bawang Hitam Tunggal 1kg', 16, 5760000, 'Transfer Bank', '2025-11-17 03:13:22');

ALTER TABLE `register_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `fk_transaksi_username` (`username`);

ALTER TABLE `register_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_username` FOREIGN KEY (`username`) REFERENCES `register_login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
