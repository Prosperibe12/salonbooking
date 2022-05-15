-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 03:27 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salonappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_reserve`
--

CREATE TABLE `booking_reserve` (
  `booking_rev_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_reserve`
--

INSERT INTO `booking_reserve` (`booking_rev_id`, `cart_id`, `cliente_id`, `salon_id`, `product_id`, `product_price`, `created_at`, `updated_at`) VALUES
(135, 1118642747, 16, 3, 4, 2, '2022-04-23', '2022-04-23 13:18:58'),
(136, 1118642747, 16, 3, 9, 9, '2022-04-23', '2022-04-23 13:18:58'),
(137, 1639271006, 16, 4, 11, 9, '2022-04-23', '2022-04-23 13:35:52'),
(138, 1639271006, 16, 4, 5, 3, '2022-04-23', '2022-04-23 13:35:52'),
(139, 659709179, 16, 3, 3, 5, '2022-04-25', '2022-04-25 09:48:53'),
(140, 659709179, 16, 3, 9, 9, '2022-04-25', '2022-04-25 09:48:53'),
(141, 849707166, 16, 5, 8, 12, '2022-04-25', '2022-04-25 21:12:12'),
(142, 513260685, 16, 4, 11, 9, '2022-04-25', '2022-04-25 20:24:47'),
(143, 1326667537, 16, 3, 9, 9, '2022-04-25', '2022-04-25 20:30:58'),
(144, 1257734299, 16, 5, 8, 12, '2022-04-25', '2022-04-25 20:40:14'),
(145, 128545330, 16, 3, 3, 5, '2022-04-26', '2022-04-26 13:41:29'),
(146, 128545330, 16, 3, 9, 9, '2022-04-26', '2022-04-26 13:41:29'),
(147, 1722642627, 16, 3, 3, 6, '2022-04-28', '2022-04-28 17:27:25'),
(148, 1722642627, 16, 3, 13, 10, '2022-04-28', '2022-04-28 17:27:25'),
(149, 1321377775, 16, 3, 4, 3, '2022-04-30', '2022-04-30 17:39:04'),
(150, 1203065533, 16, 3, 3, 6, '2022-05-01', '2022-05-01 18:31:04'),
(151, 1203065533, 16, 3, 4, 3, '2022-05-01', '2022-05-01 18:31:04'),
(152, 1787287654, 16, 3, 9, 9, '2022-05-08', '2022-05-08 13:48:37'),
(153, 1065343978, 16, 3, 3, 6, '2022-05-11', '2022-05-11 09:45:23'),
(154, 1065343978, 16, 3, 13, 10, '2022-05-11', '2022-05-11 09:45:23'),
(155, 333857748, 16, 3, 3, 6, '2022-05-12', '2022-05-12 10:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `book_rev_payment`
--

CREATE TABLE `book_rev_payment` (
  `rev_pay_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `booking_status` enum('pending','confirmed','','') NOT NULL DEFAULT 'pending',
  `salon_id` int(11) NOT NULL,
  `service_status` enum('pending','completed','','') NOT NULL DEFAULT 'pending',
  `total_amt` int(11) NOT NULL,
  `trans_ref` varchar(122) NOT NULL,
  `trans_stat` enum('pending','completed','','') NOT NULL DEFAULT 'pending',
  `book_date` date NOT NULL,
  `book_time` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_rev_payment`
--

INSERT INTO `book_rev_payment` (`rev_pay_id`, `cart_id`, `cliente_id`, `booking_status`, `salon_id`, `service_status`, `total_amt`, `trans_ref`, `trans_stat`, `book_date`, `book_time`, `created_at`, `updated_at`) VALUES
(12, 1118642747, 16, 'confirmed', 3, 'pending', 11, 'SLN16507199481794292803', 'completed', '2022-04-24', '09:00am', '2022-04-23', '2022-04-23 13:19:08'),
(13, 1639271006, 16, 'pending', 4, 'pending', 12, 'SLN16507209591648936179', 'completed', '2022-04-23', '12:00pm', '2022-04-23', '2022-04-23 13:36:00'),
(14, 659709179, 16, 'confirmed', 3, 'pending', 14, 'SLN16508801481589444158', 'completed', '2022-04-26', '10:30am', '2022-04-25', '2022-04-25 09:49:08'),
(15, 849707166, 16, 'pending', 5, 'pending', 12, 'SLN16509211482067232113', 'completed', '2022-04-26', '09:00am', '2022-04-25', '2022-04-25 21:12:28'),
(16, 513260685, 16, 'pending', 4, 'pending', 9, 'SLN16509183121963047514', 'completed', '2022-04-26', '09:00am', '2022-04-25', '2022-04-25 20:25:13'),
(18, 1257734299, 16, 'pending', 5, 'pending', 12, 'SLN1650919222709339921', 'completed', '2022-04-26', '10:30am', '2022-04-25', '2022-04-25 20:40:23'),
(19, 128545330, 16, 'confirmed', 3, 'pending', 14, 'SLN1650980505451686444', 'completed', '2022-04-27', '02:00pm', '2022-04-26', '2022-04-26 13:41:47'),
(20, 1722642627, 16, 'pending', 3, 'pending', 16, 'SLN1651166854105116256', 'completed', '2022-04-29', '11:30am', '2022-04-28', '2022-04-28 17:27:35'),
(21, 1321377775, 16, 'confirmed', 3, 'completed', 3, 'SLN1651340358538091524', 'completed', '2022-04-30', '11:00am', '2022-04-30', '2022-04-30 17:39:18'),
(22, 1203065533, 16, 'confirmed', 3, 'completed', 9, 'SLN16514298731849781162', 'completed', '2022-05-02', '08:30am', '2022-05-01', '2022-05-01 18:31:13'),
(23, 1787287654, 16, 'pending', 3, 'pending', 9, 'SLN1652017733802846212', 'completed', '2022-05-09', '09:00am', '2022-05-08', '2022-05-08 13:48:55'),
(24, 1065343978, 16, 'confirmed', 3, 'pending', 16, 'SLN16522623321099340812', 'completed', '2022-05-12', '09:30am', '2022-05-11', '2022-05-11 09:45:33'),
(25, 333857748, 16, 'confirmed', 3, 'completed', 6, 'SLN1652351183438078074', 'completed', '2022-05-13', '08:30am', '2022-05-12', '2022-05-12 10:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_table`
--

CREATE TABLE `categorie_table` (
  `cat_id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie_table`
--

INSERT INTO `categorie_table` (`cat_id`, `service_type`, `created_at`, `updated_at`) VALUES
(1, 'Manicure', '2022-03-22 21:18:23', '2022-03-22 20:20:05'),
(2, 'Hair Design', '2022-03-22 21:20:46', '2022-03-22 20:21:55'),
(3, 'Body Massage', '2022-03-22 21:20:46', '2022-03-22 20:21:55'),
(4, 'Hair Cut', '2022-03-22 21:22:04', '2022-03-22 20:22:41'),
(5, 'Pedicure', '2022-03-22 21:22:04', '2022-03-22 20:22:41'),
(6, 'Waxing', '2022-03-22 21:24:32', '2022-03-22 20:24:54'),
(7, 'Shaving', '2022-03-22 21:24:32', '2022-03-22 20:24:54'),
(8, 'Dreadlocks', '2022-03-22 21:25:09', '2022-03-22 20:25:37'),
(9, 'Hair Dyeing', '2022-03-22 21:25:09', '2022-03-22 20:25:37'),
(10, 'Face Makeup', '2022-03-22 21:32:56', '2022-03-22 20:33:19'),
(11, 'Blade Shaving', '2022-03-22 21:32:56', '2022-03-22 20:33:19'),
(12, 'Hair Conditioning & Treatment', '2022-03-22 23:12:37', '2022-03-22 22:13:43'),
(13, 'Organic Dyeing', '2022-03-22 23:12:37', '2022-03-22 22:13:43'),
(14, 'Eyelash Extension', '2022-03-22 23:16:56', '2022-03-22 22:18:19'),
(15, 'Hair Extension Fixing', '2022-03-22 23:16:56', '2022-03-22 22:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_user`
--

CREATE TABLE `cliente_user` (
  `cliente_id` int(11) NOT NULL,
  `cliente_fn` varchar(100) NOT NULL,
  `cliente_em` varchar(100) NOT NULL,
  `cliente_pwd` varchar(100) NOT NULL,
  `cliente_code` varchar(150) NOT NULL,
  `cliente_ad` text DEFAULT NULL,
  `cliente_tel` varchar(100) DEFAULT NULL,
  `cliente_status` enum('pending','verified','','') DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente_user`
--

INSERT INTO `cliente_user` (`cliente_id`, `cliente_fn`, `cliente_em`, `cliente_pwd`, `cliente_code`, `cliente_ad`, `cliente_tel`, `cliente_status`, `created_at`, `updated_at`) VALUES
(16, 'Prosper Ibe', 'prosperibe12@rediffmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '57978423e345e545768d7ad63843f37e', '21 Okwelle Street, diobu, Port Harcourt', '08067116843', 'verified', '2022-03-19 18:39:07', '2022-03-19 20:33:45'),
(18, 'Prosper Ibe', 'prosperibe12@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '23b65a878d85393a6e35d8db5de14d08', NULL, NULL, 'verified', '2022-04-16 10:26:48', '2022-04-16 13:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Prosper  Ibe', 'prosperibe12@gmail.com', 'JOBS', 'I want to collaborate with you on some projects', '2022-05-02 17:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_table`
--

CREATE TABLE `product_purchase_table` (
  `id` int(11) NOT NULL,
  `purchase_product_id` int(11) NOT NULL,
  `purchase_prdt_name` varchar(100) NOT NULL,
  `purchase_prdt_amt` varchar(150) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `purchase_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salon_payment`
--

CREATE TABLE `salon_payment` (
  `payment_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_year` date NOT NULL,
  `trans_ref` varchar(100) NOT NULL,
  `trans_status` enum('pending','completed','','') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salon_service_tb`
--

CREATE TABLE `salon_service_tb` (
  `salon_serv_no` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `service_desc` text NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_img` text NOT NULL,
  `service_code` varchar(150) NOT NULL,
  `service_status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_service_tb`
--

INSERT INTO `salon_service_tb` (`salon_serv_no`, `salon_id`, `cat_id`, `service_desc`, `service_price`, `service_img`, `service_code`, `service_status`, `created_at`, `updated_at`) VALUES
(3, 3, 'Hair Design', 'Our hair styles creates a custom look for your special day', 6, '1648064302473569700.jpg', '10095978911648064302', 'active', '0000-00-00 00:00:00', '2022-03-23 19:38:22'),
(4, 3, 'Pedicure', 'Making your feet look perfect', 3, '1648064699298038518.jpg', '19492841301648064699', 'active', '0000-00-00 00:00:00', '2022-03-23 19:44:59'),
(5, 4, 'Hair Cut', 'Giving your hair the best treatment', 3, '16482103502077079345.jpg', '11057869071648210350', 'active', '2022-03-25 09:12:30', '2022-03-25 12:12:30'),
(6, 5, 'Face Makeup', 'Giving you a pretty look.', 5, '16482130711652130506.jpg', '7036531771648213071', 'active', '2022-03-25 09:57:51', '2022-03-25 12:57:51'),
(7, 5, 'Waxing', 'Giving your face a lift', 10, '16482132901016125236.jpg', '17403406741648213290', 'active', '2022-03-25 10:01:30', '2022-03-25 13:01:30'),
(8, 5, 'Body Massage', 'Giving your whole body a treat', 12, '164823788765969240.jpg', '18975821921648237887', 'active', '2022-03-25 16:51:27', '2022-03-25 19:51:27'),
(9, 3, 'Body Massage', 'Our massage routine relieves you of all stress', 9, '1648237985608842246.jpg', '548794511648237986', 'active', '2022-03-25 16:53:06', '2022-03-25 19:53:06'),
(10, 4, 'Blade Shaving', 'Giving your face the treatment it deserves', 5, '16482382691621002438.jpg', '5839246421648238269', 'active', '2022-03-25 16:57:49', '2022-03-25 19:57:49'),
(11, 4, 'Dreadlocks', 'We make your dreadlocks look beautiful', 9, '1648238609587308173.jpg', '6264193341648238609', 'active', '2022-03-25 17:03:29', '2022-03-25 20:03:29'),
(12, 3, 'Face Makeup', 'Making you look pretty', 6, '16482389291430928763.jpg', '3751820181648238929', 'active', '2022-03-25 17:08:49', '2022-03-25 20:08:49'),
(13, 3, 'Hair Extension Fixing', 'we give you the best service in hair wigs and extension fixing', 10, '16482396491067703795.jpg', '9368833291648239649', 'active', '2022-03-25 17:20:49', '2022-03-25 20:20:49'),
(14, 5, 'Hair Extension Fixing', 'Giving you the best service in hair extension fixing', 9, '16482397521143982351.jpg', '14394874151648239752', 'active', '2022-03-25 17:22:32', '2022-03-25 20:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE `service_provider` (
  `salon_id` int(11) NOT NULL,
  `salon_name` varchar(100) NOT NULL,
  `salon_email` varchar(100) NOT NULL,
  `salon_pwd` varchar(150) NOT NULL,
  `salon_code` varchar(150) NOT NULL,
  `salon_tel` varchar(123) DEFAULT NULL,
  `salon_adrs` text DEFAULT NULL,
  `salon_cat` enum('men','women','','') DEFAULT NULL,
  `salon_stat` enum('pending','verified','','') NOT NULL DEFAULT 'pending',
  `salon_img` text DEFAULT NULL,
  `created-at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`salon_id`, `salon_name`, `salon_email`, `salon_pwd`, `salon_code`, `salon_tel`, `salon_adrs`, `salon_cat`, `salon_stat`, `salon_img`, `created-at`, `updated_at`) VALUES
(3, 'Mabae Beauty Salon', 'prosperibe12@rediffmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'c355a349226da953504e444e7ca93d3f', '09021465673', 'Uniport Junction, Choba, Port Harcourt.', 'women', 'verified', '1647979474160480007.jpg', '2022-03-20 19:44:16', '2022-03-20 22:44:16'),
(4, 'First Class Cutz', 'Ifeatuibe932@gmail.com', '25f9e794323b453885f5181f1b624d0b', '65e36f291335bfb4aff7b6e30ac88a74', '08121214587', 'Opebi, Ikeja, Lagos', 'men', 'verified', '1648131882579167685.jpg', '2022-03-24 11:18:24', '2022-03-24 14:18:24'),
(5, 'Oma Beauty Palace', 'pibe@relational-technologies.com', '25f9e794323b453885f5181f1b624d0b', '9c3078c0b644b4de3f08d48d0eb76f63', '09021465673', 'Asokoro Drive, Abuja', 'women', 'verified', '1648212856219907184.jpg', '2022-03-25 09:37:32', '2022-03-25 12:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_payment`
--

CREATE TABLE `service_provider_payment` (
  `payment_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_year` varchar(122) NOT NULL,
  `datepaid` datetime NOT NULL,
  `payment_mode` varchar(122) NOT NULL,
  `transref` varchar(122) NOT NULL,
  `status` enum('pending','completed','','') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_provider_payment`
--

INSERT INTO `service_provider_payment` (`payment_id`, `salon_id`, `amount`, `payment_year`, `datepaid`, `payment_mode`, `transref`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 30000, '2022', '2022-04-12 12:52:48', 'paystack', 'SLN16497175681806569001', 'pending', '2022-04-11 19:52:48', '2022-04-11 22:52:48'),
(2, 3, 30000, '2022', '2022-04-12 12:55:47', 'paystack', 'SLN1649717747425197037', 'pending', '2022-04-11 19:55:47', '2022-04-11 22:55:47'),
(3, 3, 30000, '2022', '2022-04-12 01:05:29', 'paystack', 'SLN16497183282037006341', 'pending', '2022-04-11 20:05:29', '2022-04-11 23:05:29'),
(4, 4, 30000, '2022', '2022-04-12 01:18:20', 'paystack', 'SLN16497190992073821429', 'pending', '2022-04-11 20:18:20', '2022-04-11 23:18:20'),
(5, 4, 30000, '2022', '2022-04-12 01:44:15', 'paystack', 'SLN1649720655415864604', 'pending', '2022-04-11 20:44:15', '2022-04-11 23:44:15'),
(6, 3, 30000, '2022', '2022-04-13 11:59:52', 'paystack', 'SLN1649843991566633207', 'pending', '2022-04-13 06:59:52', '2022-04-13 09:59:52'),
(7, 3, 30000, '2022', '2022-04-13 12:17:05', 'paystack', 'SLN164984502480821907', 'pending', '2022-04-13 07:17:05', '2022-04-13 10:17:05'),
(8, 3, 30000, '2022', '2022-04-13 12:17:19', 'paystack', 'SLN16498450381652932237', 'pending', '2022-04-13 07:17:19', '2022-04-13 10:17:19'),
(9, 3, 30000, '2022', '2022-04-13 02:42:10', 'paystack', 'SLN1649853728585857157', 'pending', '2022-04-13 09:42:10', '2022-04-13 12:42:10'),
(10, 3, 30000, '2022', '2022-04-13 09:01:03', 'paystack', 'SLN1649876463938801451', 'pending', '2022-04-13 16:01:03', '2022-04-13 19:01:03'),
(11, 3, 30000, '2022', '2022-04-13 09:09:51', 'paystack', 'SLN16498769901628845336', 'pending', '2022-04-13 16:09:51', '2022-04-13 19:09:51'),
(12, 3, 30000, '2022', '2022-04-13 09:34:46', 'paystack', 'SLN164987848678548410', 'pending', '2022-04-13 16:34:46', '2022-04-13 19:34:46'),
(13, 3, 30000, '2022', '2022-04-13 09:35:46', 'paystack', 'SLN1649878545943187653', 'pending', '2022-04-13 16:35:46', '2022-04-13 19:35:46'),
(14, 3, 30000, '2022', '2022-04-13 09:54:37', 'paystack', 'SLN16498796751352918709', 'pending', '2022-04-13 16:54:37', '2022-04-13 19:54:37'),
(15, 3, 30000, '2022', '2022-04-13 09:57:42', 'paystack', 'SLN16498798621456221720', 'pending', '2022-04-13 16:57:42', '2022-04-13 19:57:42'),
(16, 3, 30000, '2022', '2022-04-13 10:13:39', 'paystack', 'SLN16498808171141877534', 'completed', '2022-04-13 17:13:39', '2022-04-13 20:13:39'),
(17, 3, 30000, '2022', '2022-04-14 12:03:00', 'paystack', 'SLN16499305791524397696', 'pending', '2022-04-14 07:03:00', '2022-04-14 10:03:00'),
(18, 3, 30000, '2022', '2022-04-14 12:21:37', 'paystack', 'SLN16499316951606536541', 'completed', '2022-04-14 07:21:37', '2022-04-14 10:21:37'),
(19, 3, 30000, '2022', '2022-04-14 12:29:16', 'paystack', 'SLN1649932155720513945', 'pending', '2022-04-14 07:29:16', '2022-04-14 10:29:16'),
(20, 3, 30000, '2022', '2022-04-14 12:30:09', 'paystack', 'SLN16499322091737415755', 'completed', '2022-04-14 07:30:09', '2022-04-14 10:30:09'),
(21, 3, 30000, '2022', '2022-04-14 12:45:02', 'paystack', 'SLN16499331001906196162', 'completed', '2022-04-14 07:45:02', '2022-04-14 10:45:02'),
(22, 5, 30000, '2022', '2022-04-14 04:49:37', 'paystack', 'SLN16499477751023640286', 'pending', '2022-04-14 11:49:37', '2022-04-14 14:49:37'),
(23, 5, 30000, '2022', '2022-04-14 04:50:54', 'paystack', 'SLN1649947851903978700', 'completed', '2022-04-14 11:50:54', '2022-04-14 14:50:54'),
(24, 5, 30000, '2022', '2022-04-14 04:52:53', 'paystack', 'SLN1649947973991768870', 'completed', '2022-04-14 11:52:53', '2022-04-14 14:52:53'),
(25, 3, 30000, '2022', '2022-04-16 01:56:27', 'paystack', 'SLN16501101861494810839', 'completed', '2022-04-16 08:56:27', '2022-04-16 11:56:27'),
(26, 3, 30000, '2022', '2022-04-16 01:59:43', 'paystack', 'SLN1650110382811090340', 'completed', '2022-04-16 08:59:43', '2022-04-16 11:59:43'),
(27, 5, 30000, '2022', '2022-04-16 02:03:13', 'paystack', 'SLN1650110592553981942', 'completed', '2022-04-16 09:03:13', '2022-04-16 12:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `store_prdt_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_amt` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_img` varchar(123) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store_pur_payment`
--

CREATE TABLE `store_pur_payment` (
  `store_pay_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `total_amt` varchar(150) NOT NULL,
  `trans_ref` varchar(100) NOT NULL,
  `trans_status` enum('pending','completed','','') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_reserve`
--
ALTER TABLE `booking_reserve`
  ADD PRIMARY KEY (`booking_rev_id`),
  ADD KEY `cliente_id_fk` (`cliente_id`),
  ADD KEY `cate_id_fk` (`product_id`),
  ADD KEY `saloon_id_fk` (`salon_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `book_rev_payment`
--
ALTER TABLE `book_rev_payment`
  ADD PRIMARY KEY (`rev_pay_id`),
  ADD KEY `user_id_fk` (`cliente_id`),
  ADD KEY `service_provider_fk` (`salon_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `categorie_table`
--
ALTER TABLE `categorie_table`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cliente_user`
--
ALTER TABLE `cliente_user`
  ADD PRIMARY KEY (`cliente_id`),
  ADD UNIQUE KEY `cliente_em` (`cliente_em`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchase_table`
--
ALTER TABLE `product_purchase_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id_fk` (`purchase_product_id`),
  ADD KEY `users_fk` (`cliente_id`),
  ADD KEY `salons_fk` (`salon_id`);

--
-- Indexes for table `salon_payment`
--
ALTER TABLE `salon_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `salon_pay_fk` (`salon_id`);

--
-- Indexes for table `salon_service_tb`
--
ALTER TABLE `salon_service_tb`
  ADD PRIMARY KEY (`salon_serv_no`),
  ADD KEY `salon_id_fk` (`salon_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`salon_id`),
  ADD UNIQUE KEY `salon_email` (`salon_email`);

--
-- Indexes for table `service_provider_payment`
--
ALTER TABLE `service_provider_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `serv_provider_pay_fk` (`salon_id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`store_prdt_id`),
  ADD KEY `store_prdts_fk` (`salon_id`);

--
-- Indexes for table `store_pur_payment`
--
ALTER TABLE `store_pur_payment`
  ADD PRIMARY KEY (`store_pay_id`),
  ADD KEY `pur_cliente_id_fk` (`cliente_id`),
  ADD KEY `pur_salon_id_fk` (`salon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_reserve`
--
ALTER TABLE `booking_reserve`
  MODIFY `booking_rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `book_rev_payment`
--
ALTER TABLE `book_rev_payment`
  MODIFY `rev_pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categorie_table`
--
ALTER TABLE `categorie_table`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cliente_user`
--
ALTER TABLE `cliente_user`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_purchase_table`
--
ALTER TABLE `product_purchase_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salon_payment`
--
ALTER TABLE `salon_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salon_service_tb`
--
ALTER TABLE `salon_service_tb`
  MODIFY `salon_serv_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service_provider`
--
ALTER TABLE `service_provider`
  MODIFY `salon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_provider_payment`
--
ALTER TABLE `service_provider_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `store_prdt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_pur_payment`
--
ALTER TABLE `store_pur_payment`
  MODIFY `store_pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_reserve`
--
ALTER TABLE `booking_reserve`
  ADD CONSTRAINT `cate_id_fk` FOREIGN KEY (`product_id`) REFERENCES `categorie_table` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_id_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente_user` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saloon_id_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_rev_payment`
--
ALTER TABLE `book_rev_payment`
  ADD CONSTRAINT `cart_id_fk` FOREIGN KEY (`cart_id`) REFERENCES `booking_reserve` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_provider_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente_user` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_purchase_table`
--
ALTER TABLE `product_purchase_table`
  ADD CONSTRAINT `purchase_id_fk` FOREIGN KEY (`purchase_product_id`) REFERENCES `store_products` (`store_prdt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salons_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente_user` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salon_payment`
--
ALTER TABLE `salon_payment`
  ADD CONSTRAINT `salon_pay_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salon_service_tb`
--
ALTER TABLE `salon_service_tb`
  ADD CONSTRAINT `salon_id_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_provider_payment`
--
ALTER TABLE `service_provider_payment`
  ADD CONSTRAINT `serv_provider_pay_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_products`
--
ALTER TABLE `store_products`
  ADD CONSTRAINT `store_prdts_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_pur_payment`
--
ALTER TABLE `store_pur_payment`
  ADD CONSTRAINT `pur_cliente_id_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente_user` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pur_salon_id_fk` FOREIGN KEY (`salon_id`) REFERENCES `service_provider` (`salon_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
