-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 12:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `murarka_enterprizes`
--

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `pincode_id` int(11) NOT NULL,
  `pincode_name` varchar(150) NOT NULL,
  `area_name` varchar(150) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `inserted_id` int(11) NOT NULL,
  `edited_by_id` int(11) NOT NULL,
  `inserted_date` date NOT NULL,
  `edited_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`pincode_id`, `pincode_name`, `area_name`, `city_name`, `state`, `zone_id`, `inserted_id`, `edited_by_id`, `inserted_date`, `edited_date`, `status`) VALUES
(1, '700023', 'pan bazar', 'kolkata', 'west bengal', 2, 1, 0, '2020-12-14', '0000-00-00', 0),
(2, '700023', 'pan bazar', 'kolkata', 'west bengal', 3, 1, 0, '2020-12-14', '0000-00-00', 0),
(3, '700023', 'pan bazar', 'kolkata', 'west bengal', 3, 1, 0, '2020-12-14', '0000-00-00', 0),
(4, '700022', 'howrah', 'baba bazar', 'kolkata', 1, 1, 0, '2020-12-14', '0000-00-00', 0),
(5, '700007', 'KOLKATA', 'KOLKATA', 'WEST BENGAL', 1, 1, 0, '2020-12-15', '0000-00-00', 0),
(6, '700007', 'KOLKATA', 'KOLKATA', 'WEST BENGAL', 1, 1, 0, '2020-12-15', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_master_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` text NOT NULL,
  `password` varchar(200) NOT NULL,
  `password_md5` varchar(250) NOT NULL,
  `inserted_id` int(11) NOT NULL,
  `edited_by_id` int(11) NOT NULL DEFAULT 0,
  `inserted_date` date DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_master_id`, `user_name`, `first_name`, `last_name`, `email`, `contact_no`, `password`, `password_md5`, `inserted_id`, `edited_by_id`, `inserted_date`, `edited_date`, `status`) VALUES
(1, 'subham007', 'SUBHAM', 'CHOUDHURY', 'naresh_ca@yahoo.com', '8697222487', 'goldy100', '0dcba2020d38572ed201a3d2cf622a18', 1, 1, '2020-12-08', '2020-12-15', 0),
(2, 'GOLDY1000', 'GOLDY', 'JHA', '', '8697222487', '123456', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2020-12-09', NULL, 0),
(3, 'UU', 'A', 'JHA', 'naresh_ca@yahoo.com', '8697222487', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '2020-12-09', '2020-12-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_add`
--

CREATE TABLE `vendor_add` (
  `vendor_id` int(11) NOT NULL,
  `sample_vendor_id` int(11) NOT NULL,
  `GST_IN` int(200) NOT NULL,
  `Owner_Name` varchar(50) NOT NULL,
  `Pancard_no` int(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `contact` int(12) NOT NULL,
  `whatsapp_contact` int(12) NOT NULL,
  `alternate_number` int(12) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `alternate_email` varchar(50) NOT NULL,
  `inserted_id` int(11) NOT NULL,
  `edited_by_id` int(11) NOT NULL,
  `inserted_date` date NOT NULL,
  `edited_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_add`
--

INSERT INTO `vendor_add` (`vendor_id`, `sample_vendor_id`, `GST_IN`, `Owner_Name`, `Pancard_no`, `pincode`, `address_1`, `address_2`, `contact`, `whatsapp_contact`, `alternate_number`, `email_id`, `alternate_email`, `inserted_id`, `edited_by_id`, `inserted_date`, `edited_date`, `status`) VALUES
(1, 0, 1265452, 'fdzgbvaergv', 12552, 15454541, 'cvnbfxgnfgnrfgn', 'gcnbsfdbfdb', 12145541, 14548556, 154548, 'fdxbsadfgbdfvb', 'dfzbdfbsetf', 1, 0, '2020-12-14', '0000-00-00', 0),
(2, 0, 1265452, 'fdzgbvaergv', 12552, 15454541, 'cvnbfxgnfgnrfgn', 'gcnbsfdbfdb', 12145541, 14548556, 154548, 'fdxbsadfgbdfvb', 'dfzbdfbsetf', 1, 0, '2020-12-14', '0000-00-00', 0),
(3, 54321, 56789, 'binay', 0, 70032, 'subham', 'partha', 2147483647, 123456789, 2147483647, 'binay@gmail', 'subham@gmaiul', 1, 0, '2020-12-14', '0000-00-00', 0),
(4, 0, 54564, 'NM,N.,M', 0, 5465453, 'JHFGSDJJ', 'BJSBDFNSDB', 5345454, 25453453, 23424234, 'BNFGHFH', 'HHVBHJBVMJ', 1, 0, '2020-12-14', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL,
  `zone` varchar(200) NOT NULL,
  `zone_detail` varchar(200) NOT NULL,
  `inserted_id` int(11) NOT NULL,
  `edited_by_id` int(11) NOT NULL,
  `inserted_date` date NOT NULL,
  `edited_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone`, `zone_detail`, `inserted_id`, `edited_by_id`, `inserted_date`, `edited_date`, `status`) VALUES
(1, 'EAST', '', 1, 1, '2020-12-12', '2020-12-15', 0),
(2, 'WEST', '', 1, 1, '2020-12-12', '2020-12-15', 0),
(3, 'NORTH', '', 1, 1, '2020-12-12', '2020-12-15', 0),
(4, 'BOLDY', '', 1, 1, '2020-12-15', '2020-12-15', 1),
(5, 'SOUTH', '', 1, 1, '2020-12-15', '2020-12-15', 0),
(6, 'GOLDY12', '', 1, 1, '2020-12-15', '2020-12-15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`pincode_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_master_id`);

--
-- Indexes for table `vendor_add`
--
ALTER TABLE `vendor_add`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `pincode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_add`
--
ALTER TABLE `vendor_add`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
