-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 10:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `Fname` varchar(30) NOT NULL COMMENT 'ชื่อคนไข้',
  `Gender` varchar(10) NOT NULL COMMENT 'เพศ',
  `CID` int(5) NOT NULL COMMENT 'IDคลินิก',
  `DID` int(5) NOT NULL COMMENT 'IDหมอ',
  `DOV` date NOT NULL COMMENT 'วันที่',
  `Timestamp` datetime NOT NULL COMMENT 'วันที่และเวลานัด',
  `Status` varchar(100) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Username`, `Fname`, `Gender`, `CID`, `DID`, `DOV`, `Timestamp`, `Status`) VALUES
('user', 'ชาญชล', 'ชาย', 1, 1, '2022-04-11', '2022-04-04 21:56:32', 'นัดหมอเสร็จแล้วรอการอัพเดท...');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `cid` int(11) NOT NULL COMMENT 'idคลินิก',
  `name` varchar(30) NOT NULL COMMENT 'ชื่อคลินิก',
  `address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `town` varchar(30) NOT NULL COMMENT 'จังหวัด',
  `city` varchar(30) NOT NULL COMMENT 'เมือง',
  `contact` bigint(20) NOT NULL COMMENT 'การติดต่อ',
  `mid` int(5) NOT NULL COMMENT 'idผู้จัดการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`cid`, `name`, `address`, `town`, `city`, `contact`, `mid`) VALUES
(1, 'รัฐสภา คลินิก', '89/22', 'กรุงเทพ', 'กรุงเทพ', 55555999, 2),
(2, 'ดีโอ้ คลินิก', '60/7', '556/888', 'กรุงเทพ', 545666666, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `did` int(11) NOT NULL COMMENT 'idหมอ',
  `name` varchar(30) NOT NULL COMMENT 'ชื่อหมอ',
  `gender` varchar(30) NOT NULL COMMENT 'เพศ',
  `dob` date NOT NULL COMMENT 'วันเกิด',
  `experience` int(11) NOT NULL COMMENT 'ประสบการณ์',
  `specialization` varchar(30) NOT NULL COMMENT 'ความเชี่ยวชาญ',
  `contact` bigint(20) NOT NULL COMMENT 'การติดต่อ',
  `address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(30) NOT NULL COMMENT 'รหัสผ่าน',
  `region` varchar(30) NOT NULL COMMENT 'เมือง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `name`, `gender`, `dob`, `experience`, `specialization`, `contact`, `address`, `username`, `password`, `region`) VALUES
(1, 'ประวิตร', 'ชาย', '1922-12-08', 20, 'ทันตกรรม', 6565623, '77/852', 'pawit', 'pawit', 'กรุงเทพ');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `mid` int(11) NOT NULL COMMENT 'idผู้จัดการ',
  `name` varchar(30) NOT NULL COMMENT 'ชื่อผู้จัดการ',
  `gender` varchar(30) NOT NULL COMMENT 'เพศ',
  `dob` date NOT NULL COMMENT 'วันเกิด',
  `contact` bigint(20) NOT NULL COMMENT 'การติดต่อ',
  `address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(30) NOT NULL COMMENT 'รหัสผ่าน',
  `region` varchar(30) NOT NULL COMMENT 'เมือง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`mid`, `name`, `gender`, `dob`, `contact`, `address`, `username`, `password`, `region`) VALUES
(1, 'ประยุทธ์', 'ชาย', '1800-12-18', 621319253, '56/9', 'payut', 'payut', 'กรุงเทพ'),
(2, 'xxxx', 'ชาย', '2022-04-04', 265323, '55/888', 'xxx', 'xxx', 'กรุงเทพ');

-- --------------------------------------------------------

--
-- Table structure for table `manager_clinic`
--

CREATE TABLE `manager_clinic` (
  `cid` int(11) NOT NULL COMMENT 'idคลินิก',
  `mid` int(11) NOT NULL COMMENT 'idผู้จัดการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager_clinic`
--

INSERT INTO `manager_clinic` (`cid`, `mid`) VALUES
(1, 1),
(2, 1),
(1, 2),
(1, 1),
(1, 1),
(1, 1),
(2, 2),
(2, 2),
(1, 1),
(1, 1),
(2, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `name` varchar(30) NOT NULL COMMENT 'ชื่อผู้ป่วย',
  `gender` varchar(30) NOT NULL COMMENT 'เพศ',
  `dob` date NOT NULL COMMENT 'วันเกิด',
  `contact` bigint(20) NOT NULL COMMENT 'การติดต่อ',
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(20) NOT NULL COMMENT 'รหัสผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`name`, `gender`, `dob`, `contact`, `email`, `username`, `password`) VALUES
('ชาญชล', 'ชาย', '2000-12-08', 465622, 'chon@chon.com', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`did`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
