-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 07:30 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pourashava_main_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowance_given_database`
--

CREATE TABLE `allowance_given_database` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `allowanceID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `givenDate` varchar(20) NOT NULL,
  `allowanceType` varchar(200) NOT NULL,
  `allowanceAmount` varchar(20) NOT NULL,
  `allowanceDetails` text NOT NULL,
  `entryBy` varchar(20) NOT NULL,
  `entryDate` varchar(20) NOT NULL,
  `ipAddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `burial_certificate_apply`
--

CREATE TABLE `burial_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `nidNo` varchar(30) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `upozilla` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `deathDate` varchar(20) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `character_certificate_apply`
--

CREATE TABLE `character_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `nidNo` varchar(30) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `upozilla` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` int(11) NOT NULL,
  `ref_page` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `death_certificate_apply`
--

CREATE TABLE `death_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `nidNo` varchar(30) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `upozilla` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `deathDate` varchar(20) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `house_holding_database`
--

CREATE TABLE `house_holding_database` (
  `id` int(11) NOT NULL,
  `formID` varchar(20) NOT NULL,
  `lastUpdate` varchar(20) NOT NULL,
  `lastIP` varchar(20) NOT NULL,
  `idNumber` varchar(20) NOT NULL,
  `pinNumber` varchar(20) NOT NULL,
  `cardStatus` varchar(20) NOT NULL,
  `holdingType` varchar(200) NOT NULL,
  `personName` varchar(200) NOT NULL,
  `guardianType` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `maritalStatus` varchar(50) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `idType` varchar(200) NOT NULL,
  `idNo` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `familyCondition` varchar(100) NOT NULL,
  `maleNumber` varchar(20) NOT NULL,
  `femaleNumber` varchar(20) NOT NULL,
  `applicationFee` varchar(20) NOT NULL,
  `paymentType` varchar(100) NOT NULL,
  `allowanceType` varchar(200) NOT NULL,
  `allowanceAmount` varchar(50) NOT NULL,
  `disability` varchar(20) NOT NULL,
  `freedomFighter` varchar(20) NOT NULL,
  `waterConnection` varchar(20) NOT NULL,
  `nidHolder` varchar(20) NOT NULL,
  `isVoter` varchar(20) NOT NULL,
  `holdingNo` varchar(20) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `village` varchar(200) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `post` varchar(200) NOT NULL,
  `electricity` varchar(20) NOT NULL,
  `sanitation` varchar(20) NOT NULL,
  `houseType` varchar(200) NOT NULL,
  `totalHouse` varchar(100) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `lastTaxDate` varchar(20) NOT NULL,
  `dataEntryBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `house_holding_database_family`
--

CREATE TABLE `house_holding_database_family` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `personName` varchar(200) NOT NULL,
  `relationType` varchar(20) NOT NULL,
  `idNumber` varchar(30) NOT NULL,
  `mobileNumber` varchar(50) NOT NULL,
  `isFreedom` varchar(20) NOT NULL,
  `gazetteNo` varchar(50) NOT NULL,
  `disability` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `isAllowance` varchar(20) NOT NULL,
  `allowanceCardNo` varchar(20) NOT NULL,
  `isVarsity` varchar(20) NOT NULL,
  `varsityName` varchar(200) NOT NULL,
  `isVoter` varchar(20) NOT NULL,
  `nidNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `legacy_certificate_apply`
--

CREATE TABLE `legacy_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `pouroshova` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `legacy_certificate_apply_heredity`
--

CREATE TABLE `legacy_certificate_apply_heredity` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `linkedCertificate` varchar(20) NOT NULL,
  `personName` varchar(200) NOT NULL,
  `relationType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `remarriage_certificate_apply`
--

CREATE TABLE `remarriage_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `nidNo` varchar(30) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `upozilla` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `renew_house_holding_database`
--

CREATE TABLE `renew_house_holding_database` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `renewHoldingID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `renewStartDate` varchar(20) NOT NULL,
  `renewEndDate` varchar(20) NOT NULL,
  `holdingFee` varchar(20) NOT NULL,
  `feeDiscount` varchar(20) NOT NULL,
  `payableAmount` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `entryBy` varchar(20) NOT NULL,
  `entryDate` varchar(20) NOT NULL,
  `ipAddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `renew_trade_licence_database`
--

CREATE TABLE `renew_trade_licence_database` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `renewTradeID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `renewStartDate` varchar(20) NOT NULL,
  `renewEndDate` varchar(20) NOT NULL,
  `tradeLicNo` varchar(50) NOT NULL,
  `businessName` varchar(300) NOT NULL,
  `businessType` varchar(300) NOT NULL,
  `tradeLicFee` varchar(20) NOT NULL,
  `signboardTax` varchar(20) NOT NULL,
  `totalTax` varchar(20) NOT NULL,
  `totalAmount` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `entryBy` varchar(20) NOT NULL,
  `entryDate` varchar(20) NOT NULL,
  `ipAddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trade_license_database`
--

CREATE TABLE `trade_license_database` (
  `id` int(11) NOT NULL,
  `formID` varchar(20) NOT NULL,
  `lastUpdate` varchar(20) NOT NULL,
  `lastIP` varchar(20) NOT NULL,
  `idNumber` varchar(20) NOT NULL,
  `pinNumber` varchar(20) NOT NULL,
  `cardStatus` varchar(20) NOT NULL,
  `haveLicense` varchar(20) NOT NULL,
  `tradeLicense` varchar(100) NOT NULL,
  `serialNo` varchar(100) NOT NULL,
  `lastRenew` varchar(50) NOT NULL,
  `tradeLicIntroNo` varchar(200) NOT NULL,
  `businessName` varchar(200) NOT NULL,
  `proprietorName` varchar(200) NOT NULL,
  `fatherName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `nidNo` varchar(50) NOT NULL,
  `businessType` varchar(200) NOT NULL,
  `tradeLicFee` varchar(50) NOT NULL,
  `signboardTax` varchar(50) NOT NULL,
  `totalTax` varchar(50) NOT NULL,
  `totalAmount` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `village` varchar(200) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `post` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unmarried_certificate_apply`
--

CREATE TABLE `unmarried_certificate_apply` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `certificateID` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `motherName` varchar(200) NOT NULL,
  `nidNo` varchar(30) NOT NULL,
  `birthDate` varchar(20) NOT NULL,
  `village` varchar(50) NOT NULL,
  `wardNo` varchar(20) NOT NULL,
  `upozilla` varchar(50) NOT NULL,
  `zilla` varchar(50) NOT NULL,
  `regStatus` varchar(20) NOT NULL,
  `paymentStatus` varchar(20) NOT NULL,
  `applyDate` varchar(20) NOT NULL,
  `applyType` varchar(50) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `statusBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `activation_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `user_id`, `role`, `username`, `password`, `full_name`, `activation_status`) VALUES
(1, '111', 'admin', 'admin', 'admin', 'Admin', 'active'),
(2, '0001', 'operator', 'operator-1', '123456', 'Operator 01', 'active'),
(3, '0002', 'operator', 'operator-2', '123456', 'Operator 02', 'active'),
(4, '0003', 'operator', 'operator-3', '123456', 'Operator 03', 'active'),
(5, '0004', 'operator', 'operator-4', '123456', 'Operator 04', 'active'),
(6, '0005', 'operator', 'operator-5', '123456', 'Operator 05', 'active'),
(7, '0006', 'operator', 'operator-6', '123456', 'Operator 06', 'active'),
(8, '0007', 'operator', 'operator-7', '123456', 'Operator 07', 'active'),
(9, '0008', 'operator', 'operator-8', '123456', 'Operator 08', 'active'),
(10, '0009', 'operator', 'operator-9', '123456', 'Operator 09', 'active'),
(11, '0010', 'operator', 'operator-10', '123456', 'Operator 10', 'active'),
(12, '0011', 'operator', 'operator-11', '123456', 'Operator 11', 'active'),
(13, '0012', 'operator', 'operator-12', '123456', 'Operator 12', 'active'),
(14, '0013', 'operator', 'operator-13', '123456', 'Operator 13', 'active'),
(15, '0014', 'operator', 'operator-14', '123456', 'Operator 14', 'active'),
(16, '0015', 'operator', 'operator-15', '123456', 'Operator 15', 'active'),
(17, '0016', 'operator', 'operator-16', '123456', 'Operator 16', 'active'),
(18, '0017', 'operator', 'operator-17', '123456', 'Operator 17', 'active'),
(19, '0018', 'operator', 'operator-18', '123456', 'Operator 18', 'active'),
(20, '0019', 'operator', 'operator-19', '123456', 'Operator 19', 'active'),
(21, '0020', 'operator', 'operator-20', '123456', 'Operator 20', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowance_given_database`
--
ALTER TABLE `allowance_given_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `burial_certificate_apply`
--
ALTER TABLE `burial_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `character_certificate_apply`
--
ALTER TABLE `character_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_certificate_apply`
--
ALTER TABLE `death_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_holding_database`
--
ALTER TABLE `house_holding_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_holding_database_family`
--
ALTER TABLE `house_holding_database_family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legacy_certificate_apply`
--
ALTER TABLE `legacy_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legacy_certificate_apply_heredity`
--
ALTER TABLE `legacy_certificate_apply_heredity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remarriage_certificate_apply`
--
ALTER TABLE `remarriage_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_house_holding_database`
--
ALTER TABLE `renew_house_holding_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_trade_licence_database`
--
ALTER TABLE `renew_trade_licence_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_license_database`
--
ALTER TABLE `trade_license_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unmarried_certificate_apply`
--
ALTER TABLE `unmarried_certificate_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowance_given_database`
--
ALTER TABLE `allowance_given_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `burial_certificate_apply`
--
ALTER TABLE `burial_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `character_certificate_apply`
--
ALTER TABLE `character_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `death_certificate_apply`
--
ALTER TABLE `death_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_holding_database`
--
ALTER TABLE `house_holding_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_holding_database_family`
--
ALTER TABLE `house_holding_database_family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legacy_certificate_apply`
--
ALTER TABLE `legacy_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legacy_certificate_apply_heredity`
--
ALTER TABLE `legacy_certificate_apply_heredity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remarriage_certificate_apply`
--
ALTER TABLE `remarriage_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renew_house_holding_database`
--
ALTER TABLE `renew_house_holding_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renew_trade_licence_database`
--
ALTER TABLE `renew_trade_licence_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trade_license_database`
--
ALTER TABLE `trade_license_database`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unmarried_certificate_apply`
--
ALTER TABLE `unmarried_certificate_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
