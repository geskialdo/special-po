-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2023 at 02:20 PM
-- Server version: 8.0.32
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `special_po`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `username`, `password`, `name`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'superadmin', '$2y$10$Can8lhKQdSBzXS28bZUh9.3YDYPcCsJVVBO0iWq3LSIUGxyM1pTdq', 'Superadmin Diskominfo', '2023-06-29 16:47:38', NULL, NULL),
(2, 'admin', '$2y$10$nxGDCwhgbRj1VDdLUlT.5.0mp9N3E8tLC0uF5vLkc4DXj7GqYTNG2', 'Admin BPKD', '2023-07-03 03:41:15', NULL, NULL),
(3, 'aderayendra', '$2y$10$rzdZedTRKjCPvP.lqOLERe4n.06YLnMRHoikDf4..p1GFZ/znl44C', 'Ade Rayendra', '2023-07-03 03:42:59', NULL, NULL),
(4, 'superuser', '$2y$10$t.y3.g2p.7EhI.hpjHCxD.25HGNccDNhmMBcbxhnNmWQ3ZuhRMNga', 'Super Duper User', '2023-07-03 04:37:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user_role`
--

CREATE TABLE `m_user_role` (
  `id_user` int NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'SUPERADMIN, ADMIN, WAJIB PAJAK, PPTA (TAMBAHKAN YG LAIN SESUAI KEBUTUHAN)',
  `unique_comb` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `m_user_role`
--

INSERT INTO `m_user_role` (`id_user`, `role`, `unique_comb`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'SUPERADMIN', '1-SUPERADMIN', '2023-06-29 17:00:36', NULL, NULL),
(2, 'ADMIN', '2-ADMIN', '2023-07-03 03:41:39', NULL, NULL),
(3, 'WAJIB PAJAK', '3-WAJIB PAJAK', '2023-07-03 03:43:15', NULL, NULL),
(4, 'ADMIN', '4-ADMIN', '2023-07-03 04:37:25', NULL, NULL),
(4, 'SUPERADMIN', '4-SUPERADMIN', '2023-07-03 04:37:37', NULL, NULL),
(4, 'WAJIB PAJAK', '4-WAJIB PAJAK', '2023-07-03 04:37:53', NULL, NULL),
(3, 'PPATK', '3-PPATK', '2023-07-04 03:11:12', NULL, NULL);

--
-- Triggers `m_user_role`
--
DELIMITER $$
CREATE TRIGGER `bi_komb_unik_detail_level_pengguna` BEFORE INSERT ON `m_user_role` FOR EACH ROW BEGIN
	SET NEW.role = TRIM(NEW.role);
	SET NEW.unique_comb = CONCAT(NEW.id_user, "-", NEW.role);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bu_komb_unik_detail_level_pengguna` BEFORE UPDATE ON `m_user_role` FOR EACH ROW SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Tidak diizinkan mengedit'
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `m_user_role`
--
ALTER TABLE `m_user_role`
  ADD UNIQUE KEY `komb_unik` (`unique_comb`),
  ADD KEY `fk_id_pengguna_on_detail_level_pengguna` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_user_role`
--
ALTER TABLE `m_user_role`
  ADD CONSTRAINT `fk_id_pengguna_on_detail_level_pengguna` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
