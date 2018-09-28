-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 10:20 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `qr_admin`
--

CREATE TABLE `qr_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `admin_pwd` varchar(255) DEFAULT NULL,
  `admin_fname` varchar(255) DEFAULT NULL,
  `admin_lname` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_admin`
--

INSERT INTO `qr_admin` (`admin_id`, `admin_username`, `admin_pwd`, `admin_fname`, `admin_lname`, `admin_email`, `admin_phone`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Test', 'Testmann', 'Tester@test.net', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `qr_product`
--

CREATE TABLE `qr_product` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_product` varchar(255) NOT NULL,
  `product_content` varchar(255) NOT NULL,
  `product_NFC` varchar(255) NOT NULL,
  `product_geo_tag` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_text` varchar(255) NOT NULL,
  `qr_code_file` varchar(255) DEFAULT NULL,
  `product_status` int(2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qr_product_analytics`
--

CREATE TABLE `qr_product_analytics` (
  `pc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qr_settings`
--

CREATE TABLE `qr_settings` (
  `id` int(11) NOT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedIn_link` varchar(255) DEFAULT NULL,
  `pinterest_link` varchar(255) DEFAULT NULL,
  `google_plus_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `form_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_settings`
--

INSERT INTO `qr_settings` (`id`, `facebook_link`, `twitter_link`, `linkedIn_link`, `pinterest_link`, `google_plus_link`, `instagram_link`, `address`, `state`, `city`, `zipcode`, `site_email`, `form_email`) VALUES
(1, 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://in.pinterest.com/', 'https://plus.google.com/', 'https://www.instagram.com/', 'Level 20, 28 Freshwater Place, Southbank VIC Australia 3006.', 'WB', 'Kolkata', '700008', 'aqua.attend@gmail.com', 'admin.arnab@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `qr_user`
--

CREATE TABLE `qr_user` (
  `user_id` int(11) NOT NULL,
  `user_company_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone_no` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_picture` varchar(255) NOT NULL,
  `user_status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_user`
--

INSERT INTO `qr_user` (`user_id`, `user_company_name`, `user_name`, `user_email`, `user_phone_no`, `user_username`, `user_password`, `user_picture`, `user_status`) VALUES
(1, 'Test Company', 'Martin Max', 'mustermann@test-company.com', '1234567890', 'test', 'e10adc3949ba59abbe56e057f20f883e', '9d945429097209b88fcc0a697bda2ac8.png', 1),
(3, 'Martin Test', 'Martin', 'test@test.de', '12345678', 'Martin', '827ccb0eea8a706c4c34a16891f84e7b', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qr_admin`
--
ALTER TABLE `qr_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `qr_product`
--
ALTER TABLE `qr_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `qr_product_analytics`
--
ALTER TABLE `qr_product_analytics`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `qr_settings`
--
ALTER TABLE `qr_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_user`
--
ALTER TABLE `qr_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qr_admin`
--
ALTER TABLE `qr_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qr_product`
--
ALTER TABLE `qr_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_product_analytics`
--
ALTER TABLE `qr_product_analytics`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_settings`
--
ALTER TABLE `qr_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qr_user`
--
ALTER TABLE `qr_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
