-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 08:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unionparishad_himusharier_database`
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

--
-- Dumping data for table `character_certificate_apply`
--

INSERT INTO `character_certificate_apply` (`id`, `linkedForm`, `certificateID`, `fullName`, `guardianName`, `motherName`, `nidNo`, `birthDate`, `village`, `wardNo`, `upozilla`, `zilla`, `regStatus`, `paymentStatus`, `applyDate`, `applyType`, `ipAddress`, `status`, `statusBy`) VALUES
(1, '94650809202203419', '2063541987', 'শাহরিয়ার কবির', 'কবির হোসেন', 'জাকিয়া সুলতানা', '4160000000', '1997-09-08', 'শেখহাটী খাঁ পাড়া', '4', 'সদর', 'যশোর', 'Done', 'Unpaid', '08-09-2022', 'সাধারণ', '::1', 'Requested', ''),
(2, '94650809202203419', '9852760134', 'শাহরিয়ার কবির', 'কবির হোসেন', 'জাকিয়া সুলতানা', '4160000000', '2022-09-08', 'শেখহাটী খাঁ পাড়া', '4', 'সদর', 'যশোর', 'Done', 'Paid', '08-09-2022', 'সাধারণ', '::1', 'Requested', '');

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
  `landAmount` varchar(20) NOT NULL,
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
  `unemployedMember` varchar(20) NOT NULL,
  `workerMember` varchar(20) NOT NULL,
  `voterNumber` varchar(20) NOT NULL,
  `homeLandAmount` varchar(50) NOT NULL,
  `agriLandAmount` varchar(50) NOT NULL,
  `maleDisabilityNumber` varchar(20) NOT NULL,
  `femaleDisabilityNumber` varchar(20) NOT NULL,
  `maleChildNumber` varchar(20) NOT NULL,
  `femaleChildNumber` varchar(20) NOT NULL,
  `isAllowance` varchar(20) NOT NULL,
  `allowanceMember` varchar(20) NOT NULL,
  `disabilityNumber` varchar(20) NOT NULL,
  `familyIncome` varchar(50) NOT NULL,
  `isChildEducation` varchar(20) NOT NULL,
  `childEducationNumber` varchar(20) NOT NULL,
  `personAge` varchar(20) NOT NULL,
  `totalFamilyMember` varchar(20) NOT NULL,
  `dataEntryBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `house_holding_database`
--

INSERT INTO `house_holding_database` (`id`, `formID`, `lastUpdate`, `lastIP`, `idNumber`, `pinNumber`, `cardStatus`, `holdingType`, `personName`, `guardianType`, `guardianName`, `motherName`, `gender`, `maritalStatus`, `birthDate`, `idType`, `idNo`, `mobile`, `religion`, `familyCondition`, `maleNumber`, `femaleNumber`, `applicationFee`, `paymentType`, `allowanceType`, `allowanceAmount`, `disability`, `freedomFighter`, `waterConnection`, `nidHolder`, `isVoter`, `landAmount`, `holdingNo`, `wardNo`, `village`, `zip`, `post`, `electricity`, `sanitation`, `houseType`, `totalHouse`, `occupation`, `lastTaxDate`, `unemployedMember`, `workerMember`, `voterNumber`, `homeLandAmount`, `agriLandAmount`, `maleDisabilityNumber`, `femaleDisabilityNumber`, `maleChildNumber`, `femaleChildNumber`, `isAllowance`, `allowanceMember`, `disabilityNumber`, `familyIncome`, `isChildEducation`, `childEducationNumber`, `personAge`, `totalFamilyMember`, `dataEntryBy`) VALUES
(1, '94650809202203419', '08-09-2022', '::1', 'id123456', '123456', 'সক্রিয়', 'আবাসিক হোল্ডিং', 'শাহরিয়ার কবির', '', 'কবির হোসেন', 'জাকিয়া সুলতানা', 'পুরুষ', '', '', '', '4160000000', '01800000000', 'ইসলাম', 'মধ্যবিত্ত', '2', '2', '200', 'নগদ টাকা', '', '', 'না', 'না', 'হ্যাঁ', '', 'হ্যাঁ', '20', '824', '4', 'শেখহাটী খাঁ পাড়া', '7400', 'শিক্ষাবোর্ড', 'হ্যাঁ', 'পাকা', 'পাকা ১ তলা', '', 'চাকরি', '2022', '2', '1', '3', '5', '15', '', '', '', '', 'না', '', '', '100000', 'হ্যাঁ', '2', '25', '4', '111');

-- --------------------------------------------------------

--
-- Table structure for table `house_holding_database_children`
--

CREATE TABLE `house_holding_database_children` (
  `id` int(11) NOT NULL,
  `linkedForm` varchar(20) NOT NULL,
  `personName` varchar(300) NOT NULL,
  `personAge` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `house_holding_database_children`
--

INSERT INTO `house_holding_database_children` (`id`, `linkedForm`, `personName`, `personAge`) VALUES
(1, '94650809202203419', 'আদ্রিতা', '12'),
(2, '94650809202203419', 'রাজন', '18');

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

--
-- Dumping data for table `renew_house_holding_database`
--

INSERT INTO `renew_house_holding_database` (`id`, `linkedForm`, `renewHoldingID`, `fullName`, `mobile`, `renewStartDate`, `renewEndDate`, `holdingFee`, `feeDiscount`, `payableAmount`, `paymentStatus`, `entryBy`, `entryDate`, `ipAddress`) VALUES
(1, '94650809202203419', '0291437658', 'শাহরিয়ার কবির', '01800000000', '2022-09-08', '2023-09-08', '200', '50', '150', 'Unpaid', '111', '08-09-2022', '::1');

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
(1, '111', 'admin', 'admin@demo123', 'demoacc123', 'Admin', 'active'),
(2, '0001', 'operator', 'operator-1', '854571', 'Operator 01', 'active'),
(3, '0002', 'operator', 'operator-2', '979062', 'Operator 02', 'active'),
(4, '0003', 'operator', 'operator-3', '785566', 'Operator 03', 'active'),
(5, '0004', 'operator', 'operator-4', '383084', 'Operator 04', 'active'),
(6, '0005', 'operator', 'operator-5', '851061', 'Operator 05', 'active'),
(7, '0006', 'operator', 'operator-6', '552677', 'Operator 06', 'active'),
(8, '0007', 'operator', 'operator-7', '671011', 'Operator 07', 'active'),
(9, '0008', 'operator', 'operator-8', '481819', 'Operator 08', 'active'),
(10, '0009', 'operator', 'operator-9', '855135', 'Operator 09', 'active'),
(11, '0010', 'operator', 'operator-10', '679002', 'Operator 10', 'active'),
(12, '0011', 'operator', 'operator-11', '764042', 'Operator 11', 'active'),
(13, '0012', 'operator', 'operator-12', '938453', 'Operator 12', 'active'),
(14, '0013', 'operator', 'operator-13', '207710', 'Operator 13', 'active'),
(15, '0014', 'operator', 'operator-14', '622330', 'Operator 14', 'active'),
(16, '0015', 'operator', 'operator-15', '084287', 'Operator 15', 'active'),
(17, '0016', 'operator', 'operator-16', '242933', 'Operator 16', 'active'),
(18, '0017', 'operator', 'operator-17', '190591', 'Operator 17', 'active'),
(19, '0018', 'operator', 'operator-18', '697382', 'Operator 18', 'active'),
(20, '0019', 'operator', 'operator-19', '442853', 'Operator 19', 'active'),
(21, '0020', 'operator', 'operator-20', '628265', 'Operator 20', 'active'),
(22, '0021', 'operator', 'operator-21', '577087', 'Operator 21', 'active'),
(23, '0022', 'operator', 'operator-22', '340302', 'Operator 22', 'active'),
(24, '0023', 'operator', 'operator-23', '835660', 'Operator 23', 'active'),
(25, '0024', 'operator', 'operator-24', '364043', 'Operator 24', 'active'),
(26, '0025', 'operator', 'operator-25', '260133', 'Operator 25', 'active'),
(27, '0026', 'operator', 'operator-26', '027293', 'Operator 26', 'active'),
(28, '0027', 'operator', 'operator-27', '099009', 'Operator 27', 'active'),
(29, '0028', 'operator', 'operator-28', '658336', 'Operator 28', 'active'),
(30, '0029', 'operator', 'operator-29', '899037', 'Operator 29', 'active'),
(31, '0030', 'operator', 'operator-30', '347005', 'Operator 30', 'active');

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
-- Indexes for table `house_holding_database_children`
--
ALTER TABLE `house_holding_database_children`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `house_holding_database_children`
--
ALTER TABLE `house_holding_database_children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
