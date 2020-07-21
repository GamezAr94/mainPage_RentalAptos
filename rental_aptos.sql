-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 06:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_aptos`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartaments`
--

CREATE TABLE `apartaments` (
  `apts_id` int(11) NOT NULL,
  `apts_strtNum` tinytext NOT NULL,
  `apts_strtName` tinytext NOT NULL,
  `apts_price` double(10,2) NOT NULL,
  `apts_shortDesc` tinytext DEFAULT NULL,
  `apts_longDesc` text DEFAULT NULL,
  `apts_postCode` varchar(7) NOT NULL,
  `apts_uniNum` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apartaments`
--

INSERT INTO `apartaments` (`apts_id`, `apts_strtNum`, `apts_strtName`, `apts_price`, `apts_shortDesc`, `apts_longDesc`, `apts_postCode`, `apts_uniNum`) VALUES
(5, '1875', 'Robson', 1450.00, 'Es un bonito depto', 'muy buen departamento', 'V6Z3C1', 906),
(6, '939', 'Beatty', 2200.00, 'big appartment in the heart of downtown', 'it is hugeeee', 'V6Z3C1', 506);

-- --------------------------------------------------------

--
-- Table structure for table `aptocontract`
--

CREATE TABLE `aptocontract` (
  `ac_id` int(11) NOT NULL,
  `ac_startD` date NOT NULL,
  `ac_endD` date NOT NULL,
  `apts_fk` int(11) NOT NULL,
  `ac_rent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aptocontract`
--

INSERT INTO `aptocontract` (`ac_id`, `ac_startD`, `ac_endD`, `apts_fk`, `ac_rent`) VALUES
(7, '2017-05-21', '2021-02-15', 5, '2000.00'),
(8, '2017-05-21', '2019-05-21', 6, '2200.00');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `name_member` varchar(20) NOT NULL,
  `lastN_member` varchar(30) NOT NULL,
  `phone_member` varchar(12) DEFAULT NULL,
  `email_member` varchar(25) NOT NULL,
  `pass_member` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `name_member`, `lastN_member`, `phone_member`, `email_member`, `pass_member`) VALUES
(1, 'Jeny', 'Montesinos', '23699', 'jen@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `paymet`
--

CREATE TABLE `paymet` (
  `id_payment` int(11) NOT NULL,
  `type_payment` varchar(20) NOT NULL,
  `amount_payment` decimal(10,2) NOT NULL,
  `desc_payment` varchar(30) DEFAULT NULL,
  `date_payment` date NOT NULL,
  `ro_us_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymet`
--

INSERT INTO `paymet` (`id_payment`, `type_payment`, `amount_payment`, `desc_payment`, `date_payment`, `ro_us_fk`) VALUES
(1, 'Rent', '1400.00', '-', '2020-08-10', 10),
(2, 'Internet', '90.00', '-', '2020-09-10', 10),
(3, 'Penalty', '30.00', 'Loud music', '2020-10-10', 10),
(4, 'BCHydro', '50.00', '-', '2020-11-10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `request_type` varchar(20) NOT NULL,
  `request_subject` varchar(40) NOT NULL,
  `request_message` mediumtext NOT NULL,
  `ro_us_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_date`, `request_type`, `request_subject`, `request_message`, `ro_us_fk`) VALUES
(1, '2020-07-18 00:00:00', 'other_Maintenance', 't', 't', 10),
(2, '2020-07-18 00:00:00', 'other_Maintenance', 't', 't', 10),
(3, '2020-07-19 00:00:00', 'replace', 'the tv is broken', 'bla bla bla bla bla', 10),
(4, '2020-07-19 00:00:00', 'Cleanning', 'Apartament dirty', 'i ds osdo sdos dosd odfdpf mdfpm cpmdpc dpodfj dmps dsoido nc cnjcos oksd snxosn d', 11),
(5, '2020-07-20 00:00:00', 'other_Maintenance', 'a', 'asra', 10),
(6, '2020-07-20 00:00:00', 'other_Maintenance', 'one', 'more time', 10),
(7, '2020-07-20 00:00:00', 'other_Maintenance', 'now', 'prueba now', 10),
(8, '2020-07-20 20:04:33', 'other_Maintenance', 'now', 'now time', 10);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_title` varchar(15) NOT NULL,
  `room_desc` text NOT NULL,
  `apts_fk` int(11) NOT NULL,
  `room_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_title`, `room_desc`, `apts_fk`, `room_price`) VALUES
(8, 'Main', 'Nice huge bedroom', 5, '1500'),
(9, 'Solarium', 'Huge solarium with a nice view', 5, '500');

-- --------------------------------------------------------

--
-- Table structure for table `room_users`
--

CREATE TABLE `room_users` (
  `room_fk` int(11) DEFAULT NULL,
  `users_fk` int(11) NOT NULL,
  `ru_startD` date NOT NULL,
  `ru_endD` date NOT NULL,
  `ro_us` int(15) NOT NULL,
  `apto_fk` int(11) DEFAULT NULL,
  `ru_rent` decimal(10,2) NOT NULL,
  `ru_damageD` decimal(10,2) NOT NULL,
  `ru_internet` decimal(10,2) NOT NULL,
  `ru_otherPay` decimal(10,2) NOT NULL,
  `ru_bcHydro` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_users`
--

INSERT INTO `room_users` (`room_fk`, `users_fk`, `ru_startD`, `ru_endD`, `ro_us`, `apto_fk`, `ru_rent`, `ru_damageD`, `ru_internet`, `ru_otherPay`, `ru_bcHydro`) VALUES
(NULL, 9, '2017-10-12', '2021-03-10', 10, 5, '1400.00', '700.00', '90.00', '30.00', '50.00'),
(8, 9, '2019-01-22', '2021-05-10', 11, 5, '900.00', '450.00', '30.00', '0.00', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name_users` varchar(20) NOT NULL,
  `lastN_users` varchar(30) NOT NULL,
  `phone_users` varchar(12) DEFAULT NULL,
  `email_users` varchar(25) NOT NULL,
  `pass_users` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name_users`, `lastN_users`, `phone_users`, `email_users`, `pass_users`) VALUES
(9, 'Arturo', 'Gamez O.', '58350606', 'arturo@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartaments`
--
ALTER TABLE `apartaments`
  ADD PRIMARY KEY (`apts_id`);

--
-- Indexes for table `aptocontract`
--
ALTER TABLE `aptocontract`
  ADD PRIMARY KEY (`ac_id`),
  ADD KEY `apts_fk` (`apts_fk`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `paymet`
--
ALTER TABLE `paymet`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `ro_us_fk` (`ro_us_fk`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `ro_us_fk` (`ro_us_fk`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `apts_fk` (`apts_fk`);

--
-- Indexes for table `room_users`
--
ALTER TABLE `room_users`
  ADD PRIMARY KEY (`ro_us`),
  ADD KEY `room_fk` (`room_fk`),
  ADD KEY `users_fk` (`users_fk`),
  ADD KEY `apto_fk` (`apto_fk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartaments`
--
ALTER TABLE `apartaments`
  MODIFY `apts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aptocontract`
--
ALTER TABLE `aptocontract`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paymet`
--
ALTER TABLE `paymet`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room_users`
--
ALTER TABLE `room_users`
  MODIFY `ro_us` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aptocontract`
--
ALTER TABLE `aptocontract`
  ADD CONSTRAINT `aptocontract_ibfk_1` FOREIGN KEY (`apts_fk`) REFERENCES `apartaments` (`apts_id`);

--
-- Constraints for table `paymet`
--
ALTER TABLE `paymet`
  ADD CONSTRAINT `paymet_ibfk_1` FOREIGN KEY (`ro_us_fk`) REFERENCES `room_users` (`ro_us`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`ro_us_fk`) REFERENCES `room_users` (`ro_us`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`apts_fk`) REFERENCES `apartaments` (`apts_id`);

--
-- Constraints for table `room_users`
--
ALTER TABLE `room_users`
  ADD CONSTRAINT `apto_fk` FOREIGN KEY (`apto_fk`) REFERENCES `apartaments` (`apts_id`),
  ADD CONSTRAINT `room_users_ibfk_1` FOREIGN KEY (`room_fk`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `room_users_ibfk_2` FOREIGN KEY (`users_fk`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
