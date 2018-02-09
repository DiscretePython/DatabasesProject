-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2018 at 03:41 PM
-- Server version: 5.7.20-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Company_Payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `BRANCH`
--

CREATE TABLE `BRANCH` (
  `Branch_id` varchar(2) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Manager_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `BRANCH`
--

INSERT INTO `BRANCH` (`Branch_id`, `Address`, `Manager_id`) VALUES
('01', '110 Lawrencetown Lane, Lawrencetown, NS CA, B0S 1M0', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `W/o_number` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`W/o_number`, `Name`) VALUES
(30, 'County Of Annapolis'),
(33, 'Farmer Joe');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `Id_number` varchar(15) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Fname` varchar(15) NOT NULL,
  `Lname` varchar(15) NOT NULL,
  `Phone_number` varchar(15) DEFAULT NULL,
  `Birth_date` date DEFAULT NULL,
  `Job_title` varchar(15) NOT NULL,
  `Admin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`Id_number`, `Password`, `Fname`, `Lname`, `Phone_number`, `Birth_date`, `Job_title`, `Admin_status`) VALUES
('03', '1234', 'Jeff', 'Simmonds', '19031321234', '1979-10-17', 'Parts', 1),
('06', 'FastCar', 'Zac', 'Hiltz', '9028442777', NULL, 'Head Mechanic', 0),
('07', 'BMX', 'Fred', 'Hoffman', '9018263321', '1990-10-17', 'Janitor', 0),
('101', 'Mypassword', 'Charlie', 'Simpson', '19025551234', '1986-05-13', 'Inspector', 0),
('123456789', 'Secret', 'Justin', 'Hiltz', '9028242333', '2017-05-21', 'Database Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `HOURLY_EMPL`
--

CREATE TABLE `HOURLY_EMPL` (
  `E_id` varchar(15) NOT NULL,
  `Wage` decimal(5,2) NOT NULL DEFAULT '12.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `HOURLY_EMPL`
--

INSERT INTO `HOURLY_EMPL` (`E_id`, `Wage`) VALUES
('06', '20.00'),
('07', '12.00');

-- --------------------------------------------------------

--
-- Table structure for table `INTERNAL`
--

CREATE TABLE `INTERNAL` (
  `W/o_number` int(11) NOT NULL,
  `Bran_id` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `INTERNAL`
--

INSERT INTO `INTERNAL` (`W/o_number`, `Bran_id`) VALUES
(26, '01'),
(28, '01'),
(29, '01');

-- --------------------------------------------------------

--
-- Table structure for table `MECHANIC`
--

CREATE TABLE `MECHANIC` (
  `E_id` varchar(15) NOT NULL,
  `Certification` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MECHANIC`
--

INSERT INTO `MECHANIC` (`E_id`, `Certification`) VALUES
('06', 'Automotive');

-- --------------------------------------------------------

--
-- Table structure for table `PAYCHECK`
--

CREATE TABLE `PAYCHECK` (
  `Productivity` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Start_date` date NOT NULL,
  `E_id` varchar(9) NOT NULL,
  `End_date` date NOT NULL,
  `Base_pay` decimal(7,2) NOT NULL,
  `Taxes` decimal(7,2) NOT NULL DEFAULT '0.00',
  `Medical` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Commission` decimal(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PAYCHECK`
--

INSERT INTO `PAYCHECK` (`Productivity`, `Start_date`, `E_id`, `End_date`, `Base_pay`, `Taxes`, `Medical`, `Commission`) VALUES
('123.00', '2017-11-06', '123456789', '2017-12-12', '10136.00', '123.00', '123.00', '123.00'),
('123.00', '2017-11-26', '123456789', '2017-12-22', '7397.00', '123.00', '123.00', '123.00'),
('100.00', '2017-12-02', '06', '2017-12-03', '122.33', '23.00', '32.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `PAY_TIME`
--

CREATE TABLE `PAY_TIME` (
  `Start_date` date NOT NULL,
  `Time_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Emp_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `SALARY_EMPL`
--

CREATE TABLE `SALARY_EMPL` (
  `E_id` varchar(15) NOT NULL,
  `Salary` decimal(10,2) NOT NULL DEFAULT '20000.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SALARY_EMPL`
--

INSERT INTO `SALARY_EMPL` (`E_id`, `Salary`) VALUES
('03', '40000.00'),
('101', '25000.00'),
('123456789', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `TIME_ENTRY`
--

CREATE TABLE `TIME_ENTRY` (
  `Task` varchar(20) NOT NULL,
  `Time_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Time_out` timestamp NULL DEFAULT NULL,
  `E_id` varchar(9) NOT NULL,
  `Work_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TIME_ENTRY`
--

INSERT INTO `TIME_ENTRY` (`Task`, `Time_in`, `Time_out`, `E_id`, `Work_order`) VALUES
('Testing everything', '2017-12-03 13:03:00', '2017-12-03 16:17:34', '06', 28),
('Add values', '2017-12-03 14:24:59', '2017-12-03 19:48:51', '06', 26),
('Css Styling', '2017-12-03 14:54:11', '2017-12-03 19:47:20', '123456789', 26),
('Warranty Repairs', '2017-12-03 19:50:21', '2017-12-03 19:53:10', '06', 32),
('Clean Up', '2017-12-03 19:53:10', '2017-12-03 20:34:48', '06', 32),
('Change Valve', '2017-12-03 20:39:35', '2017-12-03 20:40:58', '06', 33),
('Class Example', '2017-12-04 18:36:07', '2017-12-04 18:37:08', '123456789', 28);

-- --------------------------------------------------------

--
-- Table structure for table `WARRANTY`
--

CREATE TABLE `WARRANTY` (
  `W/o_number` int(11) NOT NULL,
  `Account` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `WARRANTY`
--

INSERT INTO `WARRANTY` (`W/o_number`, `Account`) VALUES
(31, 'CUBCADET'),
(32, 'CUBCADET');

-- --------------------------------------------------------

--
-- Table structure for table `WORKS_AT`
--

CREATE TABLE `WORKS_AT` (
  `Worker_id` varchar(9) NOT NULL,
  `Bra_id` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `WORKS_ON`
--

CREATE TABLE `WORKS_ON` (
  `W/o_num` int(11) NOT NULL,
  `Worker_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `WORK_ORDER`
--

CREATE TABLE `WORK_ORDER` (
  `W/o_number` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `WORK_ORDER`
--

INSERT INTO `WORK_ORDER` (`W/o_number`, `Status`, `Description`) VALUES
(26, 0, 'Add Values To Database'),
(28, 1, 'Test Work Orders'),
(29, 1, 'Fix Broken Stuff'),
(30, 1, 'Fix Flat Tire'),
(31, 1, 'XT2 - Valve Pan Cover Leak'),
(32, 0, 'Bent Rim'),
(33, 1, 'Change Midmount Valve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BRANCH`
--
ALTER TABLE `BRANCH`
  ADD PRIMARY KEY (`Branch_id`),
  ADD KEY `Manager_id` (`Manager_id`);

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`W/o_number`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`Id_number`);

--
-- Indexes for table `HOURLY_EMPL`
--
ALTER TABLE `HOURLY_EMPL`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `INTERNAL`
--
ALTER TABLE `INTERNAL`
  ADD PRIMARY KEY (`W/o_number`),
  ADD KEY `Bran_id` (`Bran_id`);

--
-- Indexes for table `MECHANIC`
--
ALTER TABLE `MECHANIC`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `PAYCHECK`
--
ALTER TABLE `PAYCHECK`
  ADD PRIMARY KEY (`Start_date`,`E_id`),
  ADD KEY `E_id` (`E_id`);

--
-- Indexes for table `PAY_TIME`
--
ALTER TABLE `PAY_TIME`
  ADD PRIMARY KEY (`Start_date`,`Time_in`,`Emp_id`),
  ADD KEY `Time_in` (`Time_in`),
  ADD KEY `Emp_id` (`Emp_id`);

--
-- Indexes for table `SALARY_EMPL`
--
ALTER TABLE `SALARY_EMPL`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `TIME_ENTRY`
--
ALTER TABLE `TIME_ENTRY`
  ADD PRIMARY KEY (`Time_in`,`E_id`),
  ADD KEY `E_id` (`E_id`),
  ADD KEY `Work_order` (`Work_order`);

--
-- Indexes for table `WARRANTY`
--
ALTER TABLE `WARRANTY`
  ADD PRIMARY KEY (`W/o_number`);

--
-- Indexes for table `WORKS_AT`
--
ALTER TABLE `WORKS_AT`
  ADD PRIMARY KEY (`Worker_id`,`Bra_id`),
  ADD KEY `Bra_id` (`Bra_id`);

--
-- Indexes for table `WORKS_ON`
--
ALTER TABLE `WORKS_ON`
  ADD PRIMARY KEY (`W/o_num`,`Worker_id`),
  ADD KEY `Worker_id` (`Worker_id`);

--
-- Indexes for table `WORK_ORDER`
--
ALTER TABLE `WORK_ORDER`
  ADD PRIMARY KEY (`W/o_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `WORK_ORDER`
--
ALTER TABLE `WORK_ORDER`
  MODIFY `W/o_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `BRANCH`
--
ALTER TABLE `BRANCH`
  ADD CONSTRAINT `BRANCH_ibfk_1` FOREIGN KEY (`Manager_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD CONSTRAINT `CUSTOMER_ibfk_1` FOREIGN KEY (`W/o_number`) REFERENCES `WORK_ORDER` (`W/o_number`);

--
-- Constraints for table `HOURLY_EMPL`
--
ALTER TABLE `HOURLY_EMPL`
  ADD CONSTRAINT `HOURLY_EMPL_ibfk_1` FOREIGN KEY (`E_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `INTERNAL`
--
ALTER TABLE `INTERNAL`
  ADD CONSTRAINT `INTERNAL_ibfk_2` FOREIGN KEY (`Bran_id`) REFERENCES `BRANCH` (`Branch_id`),
  ADD CONSTRAINT `INTERNAL_ibfk_3` FOREIGN KEY (`W/o_number`) REFERENCES `WORK_ORDER` (`W/o_number`);

--
-- Constraints for table `MECHANIC`
--
ALTER TABLE `MECHANIC`
  ADD CONSTRAINT `MECHANIC_ibfk_1` FOREIGN KEY (`E_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `PAYCHECK`
--
ALTER TABLE `PAYCHECK`
  ADD CONSTRAINT `PAYCHECK_ibfk_1` FOREIGN KEY (`E_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `PAY_TIME`
--
ALTER TABLE `PAY_TIME`
  ADD CONSTRAINT `PAY_TIME_ibfk_1` FOREIGN KEY (`Start_date`) REFERENCES `PAYCHECK` (`Start_date`),
  ADD CONSTRAINT `PAY_TIME_ibfk_2` FOREIGN KEY (`Time_in`) REFERENCES `TIME_ENTRY` (`Time_in`),
  ADD CONSTRAINT `PAY_TIME_ibfk_3` FOREIGN KEY (`Emp_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `SALARY_EMPL`
--
ALTER TABLE `SALARY_EMPL`
  ADD CONSTRAINT `SALARY_EMPL_ibfk_1` FOREIGN KEY (`E_id`) REFERENCES `EMPLOYEE` (`Id_number`);

--
-- Constraints for table `TIME_ENTRY`
--
ALTER TABLE `TIME_ENTRY`
  ADD CONSTRAINT `TIME_ENTRY_ibfk_2` FOREIGN KEY (`E_id`) REFERENCES `EMPLOYEE` (`Id_number`),
  ADD CONSTRAINT `TIME_ENTRY_ibfk_3` FOREIGN KEY (`Work_order`) REFERENCES `WORK_ORDER` (`W/o_number`);

--
-- Constraints for table `WARRANTY`
--
ALTER TABLE `WARRANTY`
  ADD CONSTRAINT `WARRANTY_ibfk_1` FOREIGN KEY (`W/o_number`) REFERENCES `WORK_ORDER` (`W/o_number`);

--
-- Constraints for table `WORKS_AT`
--
ALTER TABLE `WORKS_AT`
  ADD CONSTRAINT `WORKS_AT_ibfk_1` FOREIGN KEY (`Worker_id`) REFERENCES `EMPLOYEE` (`Id_number`),
  ADD CONSTRAINT `WORKS_AT_ibfk_2` FOREIGN KEY (`Bra_id`) REFERENCES `BRANCH` (`Branch_id`);

--
-- Constraints for table `WORKS_ON`
--
ALTER TABLE `WORKS_ON`
  ADD CONSTRAINT `WORKS_ON_ibfk_1` FOREIGN KEY (`Worker_id`) REFERENCES `EMPLOYEE` (`Id_number`),
  ADD CONSTRAINT `WORKS_ON_ibfk_2` FOREIGN KEY (`W/o_num`) REFERENCES `WORK_ORDER` (`W/o_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
