-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 08:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `BookMobilenumber` varchar(15) NOT NULL,
  `BookEmail` varchar(255) NOT NULL,
  `drivingdl` varchar(255) NOT NULL,
  `trip_start` datetime NOT NULL,
  `trip_end` datetime NOT NULL,
  `DriverNeeded` enum('Yes','No') NOT NULL DEFAULT 'No',
  `payment_option` enum('Cash','UPI') NOT NULL,
  `payment_confirmation_code` varchar(20) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `BookName`, `BookMobilenumber`, `BookEmail`, `drivingdl`, `trip_start`, `trip_end`, `DriverNeeded`, `payment_option`, `payment_confirmation_code`, `vehicle_id`, `TotalAmount`) VALUES
(1, 'ajith', '08217048300', 'ajithgpet@gmail.com', 'punith.jpg', '2025-02-04 22:05:00', '2025-02-04 22:05:00', 'No', 'Cash', NULL, 3, 0),
(2, 'ajith', '08217048300', 'ajithgpet@gmail.com', 'punith.jpg', '2025-02-04 22:09:00', '2025-02-28 22:09:00', 'No', 'Cash', NULL, 3, 0),
(3, 'ajith', '08217048300', 'ajithgpet@gmail.com', 'himalayan.webp', '2025-02-04 22:42:00', '2025-02-14 22:42:00', 'No', 'Cash', NULL, 2, 0),
(4, 'ajith', '08217048300', 'ajithakku33@gmail.com', 'himalayan.jpg', '2025-02-04 22:52:00', '2025-02-13 22:52:00', 'No', 'Cash', NULL, 2, 0),
(5, 'ajith', '08217048300', 'ajithakku33@gmail.com', 'himalayan.jpg', '2025-02-04 22:52:00', '2025-02-13 22:52:00', 'No', 'Cash', NULL, 2, 0),
(6, 'akku', '08217048300', 'ajithakku33@gmail.com', 'himalayan.jpg', '2025-02-04 22:56:00', '2025-02-28 22:56:00', 'No', 'Cash', NULL, 2, 0),
(7, 'akku', '08217048300', 'ajithakku33@gmail.com', 'activa-6g.jpeg', '2025-02-04 23:03:00', '2025-02-27 23:03:00', 'No', 'Cash', NULL, 2, 0),
(8, 'ak', '08217048300', 'ajithakku33@gmail.com', 'fortuner.png', '2025-02-04 23:07:00', '2025-02-20 23:07:00', 'No', 'Cash', NULL, 2, 0),
(9, 'a', '08217048300', 'ajithakku33@gmail.com', 'activa-6g.jpeg', '2025-02-04 23:33:00', '2025-02-28 23:33:00', 'No', 'Cash', NULL, 4, 0),
(10, 'ajithakku', '08217048300', 'ajithakku33@gmail.com', 'punith.jpg', '2025-02-05 08:36:00', '2025-02-07 08:36:00', 'No', 'Cash', NULL, 5, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(6) DEFAULT NULL,
  `code_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`, `verification_code`, `code_expiry`) VALUES
(1, 'sanathan ns', 'sanathanns41@gmail.com', '$2y$10$4IvpnyHBk5PPmciTaeQkOeja3yfVvPvGODBmU1suprNnE8wWV8F/a', '2025-01-13 06:45:58', NULL, NULL),
(2, 'swaroop', 'swaroop@gmail.com', '$2y$10$PNbAP/roysRm0qrUUuya3O0kobV.eW4UgvMjeag.1v7Cz4DbTJvNm', '2025-01-13 06:51:50', NULL, NULL),
(3, 'punith', 'punith@gmail.com', '$2y$10$Bu9pwjYKb.Hjn4TXeVAYVeNotDZW3TSsY2m9VHIMT0y1.gC/G7reS', '2025-01-13 06:53:52', NULL, NULL),
(4, 'ajith', 'ajith@gmail.com', '$2y$10$819xMwyd1pj8DI.xyYx2ceGX2V13scrBA3JiC5TlJh7VCbBkRw9ty', '2025-01-13 06:54:45', '359468', '2025-02-01 14:11:54'),
(5, 'suraj', 'suraj@gmail.com', '$2y$10$l7n1Wn6um.N/7WWIHeAZM.p5O83aRx/tc7bqcmteVskXL93FPkiEi', '2025-01-13 07:30:03', NULL, NULL),
(6, 'akku', 'ajithakku33@gmail.com', '$2y$10$4JlwsN18n7YtfTvb18uCS.8Jp4uy6xOGKMhwn7O37d0FnM2S4xdR6', '2025-01-19 12:45:24', NULL, NULL),
(7, 'ajith', 'ajithgpet@gmail.com', '$2y$10$z3enkmX2hEbnQ9impoT9VeOo3qClQqbjOX4bFi9LAZVEjkB1y8KS.', '2025-01-20 06:40:29', '316159', '2025-01-20 11:13:11'),
(8, 'admin', 'ajithm@gmail.com', '$2y$10$jQLBQtS1vnlUkoqd1lY1I.6LkTAuqOZJLdQ5eYQ9BTfYnVltYY47W', '2025-01-20 08:57:31', NULL, NULL),
(9, 'varu', 'varuuumys143@gmail.com', '$2y$10$ynKnLqnWfG7D8Qxve4F3LOfddtFG2U0DNJPI2myobpdWUsqN./n/K', '2025-01-24 03:56:34', '365130', '2025-01-24 09:42:41'),
(10, 'akku', 'akkuajith358@gmail.com', '$2y$10$U0GVP.8NYEPKZ.xRoNrBNeSP9rHQa/KSHW.wv2RiELGS6OMWQpX9y', '2025-01-30 06:39:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `VehiclesType` varchar(100) DEFAULT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` varchar(100) DEFAULT NULL,
  `VehiclesOverview` longtext DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `VehiclesBranch` varchar(255) NOT NULL,
  `VehiclesAvailability` datetime DEFAULT NULL,
  `VehiclesUnAvailability` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `VehiclesType`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`, `VehiclesBranch`, `VehiclesAvailability`, `VehiclesUnAvailability`) VALUES
(1, 'Car', 'Swift', 'Maruti Suzuki', '• AC \r\n• Power Steering \r\n• ABS \r\n• Central Locking\r\n\r\n', 2500, 'Petrol', 2020, 5, 'swift.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 03:37:42', '2025-02-04 05:08:24', 'mysore', '2025-02-04 10:38:09', NULL),
(2, 'Car', 'Thar', 'Mahindra', 'ABS with EBD\r\nElectronic Stability Program (ESP)\r\nDual airbags\r\nDrivetrain: 4x4 as standar', 3500, 'Diesel', 2020, 5, 'thar.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 03:48:26', '2025-02-04 05:08:41', 'mangalore', '2025-02-20 10:38:29', NULL),
(3, 'Car', 'Innova', 'Toyota', 'Cruise control\r\nRear AC vents\r\nCaptain seats (in high-end variants)\r\nABS with EBD, Airbags (up to 7)', 4000, 'Diesel', 2022, 8, 'innova.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 04:24:39', '2025-02-04 05:08:52', 'bengalore', '2025-02-13 10:38:47', NULL),
(4, 'Car', 'Fortuner', 'Toyota', 'Bold Exterior Design - LED Headlamps, DRLs, Chrome Grille\r\nPremium Interior - Leather Seats, 8-inch Touchscreen, JBL Sound System\r\nComfort & Convenience - Ventilated Seats, Cruise Control, Automatic Climate Control\r\nOff-Road Capabilities - 4x4, Locking Differential, Hill Descent Control\r\n\r\n', 7000, 'Diesel', 2020, 8, 'fortuner.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 04:40:45', '2025-02-04 05:09:00', 'mysore', '2025-02-25 10:38:55', NULL),
(5, 'car', 'Polo GT', 'Volkswagen', 'GT Badging – Sporty aesthetics\r\nAlloy Wheels – 16-inch diamond-cut wheels\r\nTouchscreen Infotainment – With Apple CarPlay & Android Auto\r\nAutomatic Climate Control', 50000, 'Petrol', 2018, 5, 'polo gt.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 04:47:15', '2025-02-04 05:09:31', 'mysore', '2025-02-04 10:39:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
