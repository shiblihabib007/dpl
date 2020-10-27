-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 11:54 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(6) UNSIGNED NOT NULL,
  `acc_sale_bill_no` varchar(10) NOT NULL,
  `acc_company_full_name` varchar(200) NOT NULL,
  `acc_item_price_in_total` float NOT NULL,
  `acc_vat_on_total` float NOT NULL,
  `acc_bill_credit_method` varchar(6) NOT NULL,
  `acc_bill_credit_cheque_no` varchar(13) NOT NULL,
  `acc_bill_credit` float NOT NULL,
  `acc_bill_credit_vat` float NOT NULL,
  `acc_bill_due` float NOT NULL,
  `acc_bill_grace` float NOT NULL,
  `acc_bill_due_vat` float NOT NULL,
  `acc_bill_due_vat_adjusted` float NOT NULL,
  `acc_bill_reducable_by_client_vat` float NOT NULL,
  `acc_perchase_bill_no` varchar(10) NOT NULL,
  `acc_bill_debit_method` varchar(6) NOT NULL,
  `acc_bill_debit_cheque_no` varchar(6) NOT NULL,
  `acc_supplier_full_name` varchar(200) NOT NULL,
  `acc_perchase_debit` float NOT NULL,
  `acc_perchase_due` float NOT NULL,
  `acc_perchase_grace` float NOT NULL,
  `acc_transection_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_sale_bill_no`, `acc_company_full_name`, `acc_item_price_in_total`, `acc_vat_on_total`, `acc_bill_credit_method`, `acc_bill_credit_cheque_no`, `acc_bill_credit`, `acc_bill_credit_vat`, `acc_bill_due`, `acc_bill_grace`, `acc_bill_due_vat`, `acc_bill_due_vat_adjusted`, `acc_bill_reducable_by_client_vat`, `acc_perchase_bill_no`, `acc_bill_debit_method`, `acc_bill_debit_cheque_no`, `acc_supplier_full_name`, `acc_perchase_debit`, `acc_perchase_due`, `acc_perchase_grace`, `acc_transection_date`) VALUES
(1, '1', 'Nabil Mahmud Madical Hospital 2', 3780, 0, 'cash', '', 3780, 372, 0, 0, 567, 0, 195, '', '', '', '', 0, 0, 0, '2018-11-28 18:52:57.386814'),
(2, '2', 'Nabil Mahmud Madical Hospital 2', 3780, 0, 'cash', '', 3780, 372, 0, 0, 567, 0, 195, '', '', '', '', 0, 0, 0, '2018-11-28 18:52:57.636808'),
(3, '3', 'Nabil Mahmud Madical Hospital 2', 3180, 0, 'cash', '', 3180, 313, 0, 0, 477, 0, 164, '', '', '', '', 0, 0, 0, '2018-11-28 18:58:34.547008'),
(4, '4', 'Nabil Mahmud Madical Hospital 2', 1380, 0, 'cash', '', 1380, 136, 0, 0, 207, 0, 71, '', '', '', '', 0, 0, 0, '2018-11-28 19:08:58.650391'),
(5, '5', 'Nabil Mahmud Madical Hospital 2', 3180, 0, 'cash', '', 3180, 313, 0, 0, 477, 0, 164, '', '', '', '', 0, 0, 0, '2018-11-28 19:12:29.143100'),
(6, '6', 'Nabil Mahmud Madical Hospital 2', 2400, 0, 'cash', '', 1755, 236, 645, 0, 360, 0, 124, '', '', '', '', 0, 0, 0, '2018-11-28 19:12:29.314967'),
(7, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '1', 'cheque', '546576', 'Nabil Paper Mill Ltd', 275, 0, 0, '2018-11-28 19:23:53.385021'),
(8, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '2', 'cash', '546576', 'Nabil Paper Mill Ltd', 1025, 2605, 0, '2018-11-28 19:24:59.585853'),
(9, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '3', '', '', 'Nabil Paper Mill Ltd', 0, 12500, 0, '2018-11-29 10:23:19.457121');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(6) UNSIGNED NOT NULL,
  `bank_cash_account` varchar(15) NOT NULL,
  `bank_cash_balance` float NOT NULL,
  `bank_bank_name` varchar(100) NOT NULL,
  `bank_bank_branch_name` varchar(30) NOT NULL,
  `bank_bank_account_number` varchar(15) NOT NULL,
  `bank_bank_routing_number` varchar(15) NOT NULL,
  `bank_bank_acc_balance` float NOT NULL,
  `bank_transection_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_cash_account`, `bank_cash_balance`, `bank_bank_name`, `bank_bank_branch_name`, `bank_bank_account_number`, `bank_bank_routing_number`, `bank_bank_acc_balance`, `bank_transection_date`) VALUES
(1, 'CASH', 217797, '', '', '', '', 0, '2018-11-28 19:24:59.632740'),
(2, '', 0, 'Southeast Bank Ltd', 'Motijheel', '12345676433355', '43346678', 506000, '2018-11-28 19:23:53.681891'),
(3, '', 0, 'City Bank Ltd', 'Dilkusha', '56456443222455', '123445', 0, '2018-11-27 20:07:41.360597'),
(4, '', 0, 'One Bank Ltd', 'Uttara Branch', '547668798098978', '65787866', 300000, '2018-11-28 17:52:49.288741'),
(5, '', 0, 'Janata Bank Ltd', 'Jatrabari', '6576577688755', '564546555', 0, '2018-11-22 17:47:04.267084');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(6) UNSIGNED NOT NULL,
  `bills_name` varchar(50) NOT NULL,
  `item_creating_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(6) UNSIGNED NOT NULL,
  `client_company` varchar(200) NOT NULL,
  `client_full_name` varchar(100) NOT NULL,
  `client_possition` varchar(100) NOT NULL,
  `client_depertment` varchar(100) NOT NULL,
  `client_phone_no` int(15) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_recievable_vat` float NOT NULL,
  `client_payable_vat` float NOT NULL,
  `client_address_line_1` varchar(100) NOT NULL,
  `client_address_line_2` varchar(100) NOT NULL,
  `client_address_line_3` varchar(100) NOT NULL,
  `client_adding_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_company`, `client_full_name`, `client_possition`, `client_depertment`, `client_phone_no`, `client_email`, `client_recievable_vat`, `client_payable_vat`, `client_address_line_1`, `client_address_line_2`, `client_address_line_3`, `client_adding_date`) VALUES
(1, 'Nabil Mahmud Madical Hospital 2', 'Nabil Mahmud Khan 2', 'Director 2', 'Managment2', 6546372, 'nabil@gmail.com2', 15, 4.5, 'Add-132', 'Road-nabil2', 'Nabil-12042', '2018-11-20 13:18:05.592566'),
(2, 'Shibli Sadek University', 'Shibli Sadek', 'It Executive', 'It', 173, 'shibli@yahoo.com', 15, 0, 'Jatrabari', 'Dolphin', '12-a', '2018-11-22 14:15:34.345233'),
(3, 'Nabil Mahmud Madical Hospital', 'Nabil Mahmud', 'Director', 'Managment', 654637, 'nabil@gmail.com', 15, 0, 'Add-13', 'Road-nabil', 'Nabil-1204', '2018-11-18 18:21:10.813706');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(6) UNSIGNED NOT NULL,
  `company_full_name` varchar(100) NOT NULL,
  `company_title` varchar(100) NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) NOT NULL,
  `address_line_3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_full_name`, `company_title`, `address_line_1`, `address_line_2`, `address_line_3`) VALUES
(1, 'divine packaging industries', 'All kinds of carton manufacturer', '26/08/A, North Perarbagh, Mirpur, Dhaka-1211', 'Phone : 8090179, Fax : 8090181', 'Mobile : 01916-791810, 01616-791811');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(6) UNSIGNED NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_status` varchar(50) NOT NULL,
  `employee_basic_salary` float NOT NULL,
  `employee_loan` float NOT NULL,
  `employee_current_salary` float NOT NULL,
  `employee_transection_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_name`, `employee_status`, `employee_basic_salary`, `employee_loan`, `employee_current_salary`, `employee_transection_date`) VALUES
(1, 'imran mama', 'employee', 50000, 30000, 20000, '2018-10-31 19:03:28.648997'),
(2, 'abdul hamid ', 'worker', 10000, 8000, 2000, '2018-10-31 19:02:55.378990'),
(3, 'Fahim', 'employee', 50000, 10000, 40000, '2018-10-31 18:56:02.253090'),
(4, 'Shahin Ahamed', 'worker', 5000, 5000, 0, '2018-10-31 19:03:13.869079'),
(5, 'Rashid Vai', 'employee', 20000, 0, 0, '2018-11-03 10:23:06.530979'),
(6, 'Alauddin', 'worker', 10000, 2000, 8000, '2018-11-03 10:51:00.114775');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(6) UNSIGNED NOT NULL,
  `expense_catagory_name` varchar(100) NOT NULL,
  `expense_amount` float NOT NULL,
  `expense_approve_status` varchar(10) NOT NULL,
  `expense_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_catagory`
--

CREATE TABLE `expense_catagory` (
  `id` int(6) UNSIGNED NOT NULL,
  `expense_catagory_name` varchar(100) NOT NULL,
  `item_creating_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_catagory`
--

INSERT INTO `expense_catagory` (`id`, `expense_catagory_name`, `item_creating_date`) VALUES
(1, 'Proprietor Convence', '2018-11-26 17:57:49.814618'),
(2, 'Proprietor Other Expense', '2018-11-26 18:01:16.031989');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(6) UNSIGNED NOT NULL,
  `item_catagory_name` varchar(50) NOT NULL,
  `item_model_name` varchar(50) NOT NULL,
  `item_size` varchar(50) NOT NULL,
  `item_price` double NOT NULL,
  `item_full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_catagory_name`, `item_model_name`, `item_size`, `item_price`, `item_full_name`) VALUES
(1, 'item 1 ', 'item1 model', '12x12x12', 10, ''),
(2, 'item2', 'item2 model', '13x13x13', 13, ''),
(3, 'item3', 'item3 model', '14x14x14', 40, ''),
(4, 'item4', 'item4 model', '14x141x14', 40, ''),
(5, 'ply-5', 'chokopy', '20x20x21', 20, ''),
(6, 'Item2, ', 'Model2', '22x22x33', 40, ''),
(7, '3ply', 'Model', '22x44x55', 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(6) UNSIGNED NOT NULL,
  `item_id` int(6) DEFAULT NULL,
  `item_full_name` varchar(200) NOT NULL,
  `item_qty` int(6) NOT NULL,
  `item_price` float NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `quotation_no` varchar(10) NOT NULL,
  `work_oder_status` varchar(20) NOT NULL,
  `delivery_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `item_id`, `item_full_name`, `item_qty`, `item_price`, `client_name`, `quotation_no`, `work_oder_status`, `delivery_date`) VALUES
(1, 1, 'item 1, item1 model, Size: 12x12x12', 60, 10, 'Nabil Mahmud Madical Hospital 2', '1', 'delivered', '2018-11-28 18:50:28.720089'),
(2, 2, 'item2, item2 model, Size: 13x13x13', 60, 13, 'Nabil Mahmud Madical Hospital 2', '1', 'delivered', '2018-11-28 18:50:28.766990'),
(3, 3, 'item3, item3 model, Size: 14x14x14', 60, 40, 'Nabil Mahmud Madical Hospital 2', '1', 'delivered', '2018-11-28 18:50:28.813860'),
(4, 1, 'item 1, item1 model, Size: 12x12x12', 60, 10, 'Nabil Mahmud Madical Hospital 2', '2', 'delivered', '2018-11-28 18:50:35.266735'),
(5, 2, 'item2, item2 model, Size: 13x13x13', 60, 13, 'Nabil Mahmud Madical Hospital 2', '2', 'delivered', '2018-11-28 18:50:35.313614'),
(6, 3, 'item3, item3 model, Size: 14x14x14', 60, 40, 'Nabil Mahmud Madical Hospital 2', '2', 'delivered', '2018-11-28 18:50:35.407385'),
(7, 2, 'item2, item2 model, Size: 13x13x13', 60, 13, 'Nabil Mahmud Madical Hospital 2', '3', 'delivered', '2018-11-28 18:50:40.485306'),
(8, 3, 'item3, item3 model, Size: 14x14x14', 60, 40, 'Nabil Mahmud Madical Hospital 2', '3', 'delivered', '2018-11-28 18:50:40.516559'),
(9, 1, 'item 1, item1 model, Size: 12x12x12', 60, 10, 'Nabil Mahmud Madical Hospital 2', '4', 'delivered', '2018-11-28 19:07:22.825611'),
(10, 2, 'item2, item2 model, Size: 13x13x13', 60, 13, 'Nabil Mahmud Madical Hospital 2', '4', 'delivered', '2018-11-28 19:07:22.872487'),
(11, 2, 'item2, item2 model, Size: 13x13x13', 60, 13, 'Nabil Mahmud Madical Hospital 2', '5', 'delivered', '2018-11-28 19:07:28.387894'),
(12, 3, 'item3, item3 model, Size: 14x14x14', 60, 40, 'Nabil Mahmud Madical Hospital 2', '5', 'delivered', '2018-11-28 19:07:28.434795'),
(13, 3, 'item3, item3 model, Size: 14x14x14', 60, 40, 'Nabil Mahmud Madical Hospital 2', '6', 'delivered', '2018-11-28 19:07:32.122137');

-- --------------------------------------------------------

--
-- Table structure for table `perchases`
--

CREATE TABLE `perchases` (
  `id` int(6) UNSIGNED NOT NULL,
  `parchase_bill_number` int(5) NOT NULL,
  `parchase_supplier_full_name` varchar(100) NOT NULL,
  `parchase_item_name` varchar(100) NOT NULL,
  `parchase_item_qty` varchar(5) NOT NULL,
  `parchase_item_unit` varchar(5) NOT NULL,
  `parchase_item_price` varchar(5) NOT NULL,
  `parchase_item_total_price` varchar(5) NOT NULL,
  `parchase_approve_status` varchar(10) NOT NULL,
  `parchase_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perchases`
--

INSERT INTO `perchases` (`id`, `parchase_bill_number`, `parchase_supplier_full_name`, `parchase_item_name`, `parchase_item_qty`, `parchase_item_unit`, `parchase_item_price`, `parchase_item_total_price`, `parchase_approve_status`, `parchase_date`) VALUES
(1, 1, 'Nabil Paper Mill Ltd', 'Flour', '5', 'Kg', '55', '275', 'approved', '2018-11-28 19:19:49.690341'),
(2, 2, 'Nabil Paper Mill Ltd', 'Flour', '55', 'Kg', '66', '3630', 'approved', '2018-11-28 19:20:07.533473'),
(3, 3, 'Nabil Paper Mill Ltd', 'Flour', '100', 'Kg', '20', '2000', 'approved', '2018-11-29 10:23:19.097770'),
(4, 3, 'Nabil Paper Mill Ltd', 'Liner-24', '200', 'Kg', '10', '2000', 'approved', '2018-11-29 10:23:19.097770'),
(5, 3, 'Nabil Paper Mill Ltd', 'Khata', '300', 'Pices', '20', '6000', 'approved', '2018-11-29 10:23:19.097770'),
(6, 3, 'Nabil Paper Mill Ltd', 'Pen', '50', 'Pices', '50', '2500', 'approved', '2018-11-29 10:23:19.097770');

-- --------------------------------------------------------

--
-- Table structure for table `perchase_items`
--

CREATE TABLE `perchase_items` (
  `id` int(6) UNSIGNED NOT NULL,
  `perchase_item_full_name` varchar(50) NOT NULL,
  `perchase_item_unit` varchar(50) NOT NULL,
  `perchase_item_qty` double NOT NULL,
  `perchase_item_price` double NOT NULL,
  `perchase_item_creating_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perchase_items`
--

INSERT INTO `perchase_items` (`id`, `perchase_item_full_name`, `perchase_item_unit`, `perchase_item_qty`, `perchase_item_price`, `perchase_item_creating_date`) VALUES
(1, 'Flour', 'Kg', 0, 0, '2018-11-24 18:36:48.735033'),
(2, 'Liner-24', 'Kg', 0, 0, '2018-11-25 17:31:55.165063'),
(3, 'Khata', 'Pices', 0, 0, '2018-11-25 18:04:09.417423'),
(4, 'Pen', 'Pices', 0, 0, '2018-11-25 18:04:18.901469');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(6) UNSIGNED NOT NULL,
  `report_purchase_bill_no` varchar(8) NOT NULL,
  `report_purchase_suplier_name` varchar(100) NOT NULL,
  `report_expense_category_name` varchar(100) NOT NULL,
  `report_purchase_debit` float NOT NULL,
  `report_expense_debit` float NOT NULL,
  `report_sale_bill_no` varchar(8) NOT NULL,
  `report_sale_company_name` varchar(100) NOT NULL,
  `report_transection_status` varchar(50) NOT NULL,
  `report_sale_cheque_no` varchar(15) NOT NULL,
  `report_sale_purchase_payment_cheque_no` varchar(15) NOT NULL,
  `report_bank_name` varchar(100) NOT NULL,
  `report_bank_acc_no` varchar(15) NOT NULL,
  `report_bank_old_balance` float NOT NULL,
  `report_bank_new_balance` float NOT NULL,
  `report_cash_old_balance` float NOT NULL,
  `report_cash_new_balance` float NOT NULL,
  `report_bill_credit` float NOT NULL,
  `report_bill_credit_vat` float NOT NULL,
  `report_bill_debit_vat` float NOT NULL,
  `report_transection_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_purchase_bill_no`, `report_purchase_suplier_name`, `report_expense_category_name`, `report_purchase_debit`, `report_expense_debit`, `report_sale_bill_no`, `report_sale_company_name`, `report_transection_status`, `report_sale_cheque_no`, `report_sale_purchase_payment_cheque_no`, `report_bank_name`, `report_bank_acc_no`, `report_bank_old_balance`, `report_bank_new_balance`, `report_cash_old_balance`, `report_cash_new_balance`, `report_bill_credit`, `report_bill_credit_vat`, `report_bill_debit_vat`, `report_transection_date`) VALUES
(1, '', '', '', 0, 0, '1', '', 'cash', '', '', '', '', 0, 0, 0, 0, 2628, 372, 0, '2018-11-28 18:51:32.155419'),
(2, '', '', '', 0, 0, '1', '', 'cash', '', '', '', '', 0, 0, 0, 0, 1152, 0, 0, '2018-11-28 18:52:57.464964'),
(3, '', '', '', 0, 0, '2', '', 'cash', '', '', '', '', 0, 0, 0, 0, 3780, 372, 0, '2018-11-28 18:52:57.777447'),
(4, '', '', '', 0, 0, '3', '', 'cash', '', '', '', '', 0, 0, 0, 0, 1383, 313, 0, '2018-11-28 18:52:58.136790'),
(5, '', '', '', 0, 0, '3', '', 'cash', '', '', '', '', 0, 0, 0, 0, 1797, 0, 0, '2018-11-28 18:58:34.593912'),
(6, '', '', '', 0, 0, '4', '', 'cash', '', '', '', '', 0, 0, 211797, 213313, 1380, 136, 0, '2018-11-28 19:08:58.759767'),
(7, '', '', '', 0, 0, '5', '', 'cash', '', '', '', '', 0, 0, 211797, 215797, 2171, 313, 0, '2018-11-28 19:08:58.994156'),
(8, '', '', '', 0, 0, '5', '', 'cash', '', '', '', '', 0, 0, 215797, 216806, 1009, 0, 0, '2018-11-28 19:12:29.268099'),
(9, '', '', '', 0, 0, '6', '', 'cash', '', '', '', '', 0, 0, 216806, 218797, 1755, 236, 0, '2018-11-28 19:12:29.502478'),
(10, '1', 'Nabil Paper Mill Ltd', '', 100, 0, '', '', 'cheque payment', '', '345466', 'Southeast Bank Ltd', '', 0, 0, 506300, 506200, 0, 0, 0, '2018-11-28 19:22:17.325878'),
(11, '1', 'Nabil Paper Mill Ltd', '', 175, 0, '', '', 'cheque payment', '', '5465768', 'Southeast Bank Ltd', '', 0, 0, 506200, 506025, 0, 0, 0, '2018-11-28 19:23:53.494402'),
(12, '2', 'Nabil Paper Mill Ltd', '', 25, 0, '', '', 'cheque payment', '', '5465768', 'Southeast Bank Ltd', '', 0, 0, 506025, 506000, 0, 0, 0, '2018-11-28 19:23:53.775661'),
(13, '2', 'Nabil Paper Mill Ltd', '', 1000, 0, '', '', 'cash payment', '', '', '', '', 0, 0, 218797, 217797, 0, 0, 0, '2018-11-28 19:24:59.679628');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(6) UNSIGNED NOT NULL,
  `stock_supplier_company` varchar(100) NOT NULL,
  `stock_item_full_name` varchar(100) NOT NULL,
  `stock_item_amount` varchar(5) NOT NULL,
  `stock_item_unit` varchar(10) NOT NULL,
  `stock_incoming_outgoing` varchar(10) NOT NULL,
  `parchase_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stock_supplier_company`, `stock_item_full_name`, `stock_item_amount`, `stock_item_unit`, `stock_incoming_outgoing`, `parchase_date`) VALUES
(1, 'Nabil Paper Mill Ltd', 'Flour', '160', 'Kg', 'incoming', '2018-11-29 10:23:19.207140'),
(2, 'Nabil Paper Mill Ltd', 'Liner-24', '50', 'Kg', 'incoming', '2018-11-29 10:25:22.652002'),
(3, 'Nabil Paper Mill Ltd', 'Khata', '300', 'Pices', 'incoming', '2018-11-29 10:23:19.285259'),
(4, 'Nabil Paper Mill Ltd', 'Pen', '50', 'Pices', 'incoming', '2018-11-29 10:23:19.379007');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(6) UNSIGNED NOT NULL,
  `supplier_company` varchar(200) NOT NULL,
  `supplier_full_name` varchar(100) NOT NULL,
  `supplier_possition` varchar(100) NOT NULL,
  `supplier_depertment` varchar(100) NOT NULL,
  `supplier_phone_no` int(15) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_address_line_1` varchar(100) NOT NULL,
  `supplier_address_line_2` varchar(100) NOT NULL,
  `supplier_address_line_3` varchar(100) NOT NULL,
  `supplier_adding_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_company`, `supplier_full_name`, `supplier_possition`, `supplier_depertment`, `supplier_phone_no`, `supplier_email`, `supplier_address_line_1`, `supplier_address_line_2`, `supplier_address_line_3`, `supplier_adding_date`) VALUES
(1, 'Nabil Paper Mill Ltd', 'Nabil Mahmud', 'Manager', 'Sales', 3456789, 'nabil@gmail.com', 'Line1', '1212', '1202', '2018-11-12 16:26:20.320768'),
(2, 'Mosaddik Paper Industris Ltd', 'Mosadikkur Rahman', 'Accountent Officer', 'Marketing Officer', 34567890, 'mosaddik@gmail.com', 'Narandi', '512', '1205', '2018-11-12 16:28:45.522920'),
(3, 'Ripa Enterprice Ltd', 'Ripa Akter', 'Pruduction Officer', 'Pruduction', 4567890, 'ripa@gmail.com', 'Lakhpur', '66788', '678', '2018-11-12 16:30:12.299098');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_full_name` varchar(30) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_full_name`, `user_username`, `user_password`, `user_status`) VALUES
(1, 'Shibli Sadek', 'shibli', '$2y$10$CtwpMOIGYNrugsP6Gq2IEOg4LzTKs/rs9.sN0Ejqf0YXeZQfvx/Jm', 'admin'),
(2, 'nurul huda', 'admin', '$2y$10$PToiVD1Ent2XcuG6krIlv.8WqLaURRN9hP2vdb3p/Cngw.K9ZBa4C', 'admin'),
(3, 'rashid', 'rashid', '$2y$10$T2JtrOMAnOlGZ8mXccrBR.2qBg1Gd28tH9ZVQfJRcyOi75y31YnVa', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_catagory`
--
ALTER TABLE `expense_catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perchases`
--
ALTER TABLE `perchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perchase_items`
--
ALTER TABLE `perchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_catagory`
--
ALTER TABLE `expense_catagory`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `perchases`
--
ALTER TABLE `perchases`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perchase_items`
--
ALTER TABLE `perchase_items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
