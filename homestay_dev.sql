-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 03:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestay.dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `acID` tinyint(3) UNSIGNED NOT NULL COMMENT 'ไอดีกิจกรรม',
  `acName` varchar(50) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `acDetail` text COMMENT 'รายละเอียดกิจกรรม',
  `acDateOpen` varchar(126) NOT NULL COMMENT 'วันที่ให้บริการ',
  `acTime` enum('1','2','3') NOT NULL,
  `acImg` varchar(7) NOT NULL COMMENT 'รูปกิจกรรม',
  `acPrice` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'ราคากิจกรรม',
  `acNote` text COMMENT 'หมายเหตุ',
  `mbID` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`acID`, `acName`, `acDetail`, `acDateOpen`, `acTime`, `acImg`, `acPrice`, `acNote`, `mbID`) VALUES
(1, 'ดำน้ำดูปะการัง', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'เสาร์ อาทิตย์', '2', '300.jpg', 790, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', '1341286957402'),
(2, 'ฝ่าวิกฤติ พิชิตยอดเขา', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสฯ ศุกร์', '2', '190.jpg', 700, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', '1341286957402'),
(3, 'ผจญภัยสายน้ำลึกลับ', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'อาทิตย์', '3', '982.jpg', 120, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', '1341286957402'),
(4, 'สืบสานวัฒนธรรมดำนา', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'เสาร์ อาทิตย์', '1', '802.jpg', 20, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', '1341286957402'),
(5, 'เรียนรู้กับโลกของสิ่งทอ', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสฯ ศุกร์ เสาร์ อาทิตย์', '1', '409.jpg', 35, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', '1341286957402');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addID` int(11) NOT NULL,
  `cmID` varchar(13) NOT NULL COMMENT 'รหัสลูกค้า',
  `houseNo` varchar(3) NOT NULL COMMENT 'บ้านเลขที่',
  `moo` varchar(2) NOT NULL COMMENT 'หมู่ที่',
  `road` varchar(30) DEFAULT NULL COMMENT 'ถนน',
  `alley` varchar(30) DEFAULT NULL COMMENT 'ซอย',
  `villageName` varchar(30) DEFAULT NULL COMMENT 'ชื่อหมู่บ้าน',
  `subdistrict` varchar(30) NOT NULL COMMENT 'ตำบล',
  `district` varchar(30) NOT NULL COMMENT 'อำเภอ',
  `province` varchar(30) NOT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(5) NOT NULL COMMENT 'รหัสไปรษณีย์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addID`, `cmID`, `houseNo`, `moo`, `road`, `alley`, `villageName`, `subdistrict`, `district`, `province`, `zipcode`) VALUES
(2, '1100501376787', '2', '3', '', '', 'บ้านกลางใหญ่', 'กลางใหญ่', 'เอขื่องใน', 'อุบลราชธานี', '34320');

-- --------------------------------------------------------

--
-- Table structure for table `attractions`
--

CREATE TABLE `attractions` (
  `atID` tinyint(3) UNSIGNED NOT NULL,
  `atName` varchar(50) NOT NULL,
  `atDetail` text,
  `atDateOpen` varchar(126) NOT NULL,
  `atImg` varchar(7) NOT NULL,
  `atPrice` smallint(5) UNSIGNED DEFAULT '0',
  `atNote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attractions`
--

INSERT INTO `attractions` (`atID`, `atName`, `atDetail`, `atDateOpen`, `atImg`, `atPrice`, `atNote`) VALUES
(1, 'ตำนานไม้เลื้อยแห่งวัดหินผา', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสบดี ศุกร์ เสาร์ อาทิตย์', '393.jpg', 0, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?'),
(2, 'สำนักฤาษีลิ้นดำ', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสบดี เสาร์ อาทิตย์', '599.jpg', 70, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?'),
(3, 'วัดบ้านคำบก', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสบดี ศุกร์ เสาร์ อาทิตย์', '228.jpg', 0, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?'),
(4, 'ตลาดนัดบ้านคำบก', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'จันทร์ อังคาร พุธ พฤหัสบดี ศุกร์ เสาร์ อาทิตย์', '515.jpg', 0, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?'),
(5, 'ป่าลึกลับแห่งบ้านคำบก', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'เสาร์ อาทิตย์', '179.jpg', 30, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?'),
(6, 'สวนนกนานาพันธุ์', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?', 'ศุกร์ เสาร์ อาทิตย์', '408.jpg', 50, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus est consectetur cum perspiciatis officiis expedita nobis, laboriosam eos, aspernatur earum saepe at repudiandae, corrupti debitis commodi aut architecto sint optio?');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cmID` varchar(13) NOT NULL COMMENT 'รหัสประชาชน',
  `fname` varchar(20) NOT NULL COMMENT 'ชื่อ',
  `lname` varchar(20) NOT NULL COMMENT 'นามสกุล',
  `tel` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `email` varchar(35) NOT NULL COMMENT 'อีเมล์',
  `pwd` varchar(40) NOT NULL COMMENT 'รหัสผ่าน',
  `salt` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cmID`, `fname`, `lname`, `tel`, `email`, `pwd`, `salt`) VALUES
('0', 'Admin', 'istrator', '0000000000', 'master@homestay.dev', '408ee6ce0aba7347955847cb3d454eb91096fd54', '@1q0;#$R1tm%h*)'),
('1100501376787', 'จิรวัฒน์', 'จรูญเนตร', '0987654321', 'email@email.com', '408ee6ce0aba7347955847cb3d454eb91096fd54', '@1q0;#$R1tm%h*)');

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `hmID` varchar(11) NOT NULL,
  `hmName` varchar(50) NOT NULL,
  `hmDetail` text,
  `hmImg` varchar(7) NOT NULL,
  `mbID` varchar(13) NOT NULL,
  `CAR` enum('0','1') DEFAULT NULL,
  `WIFI` enum('0','1') DEFAULT NULL,
  `PRI` enum('0','1') DEFAULT NULL,
  `hmNote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`hmID`, `hmName`, `hmDetail`, `hmImg`, `mbID`, `CAR`, `WIFI`, `PRI`, `hmNote`) VALUES
('10294827465', 'บ้านจรูญเนตร', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '973.jpg', '1341286957402', '1', '1', '0', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!'),
('23417586902', 'ครัวจรูญเนตร', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '708.jpg', '1341286957402', '0', '1', '0', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!'),
('69581028472', 'บ้านดีงาม', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '523.jpg', '1100548295762', '0', '1', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!'),
('86756403921', 'เฮือนอุ้ยปัน', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '242.jpg', '1100548295762', '1', '1', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!');

-- --------------------------------------------------------

--
-- Table structure for table `imgs_acts`
--

CREATE TABLE `imgs_acts` (
  `imgID` int(11) UNSIGNED NOT NULL COMMENT 'ไอรูปภาพ',
  `imgName` varchar(7) NOT NULL COMMENT 'ชื่อรูปภาพ',
  `acID` tinyint(3) UNSIGNED NOT NULL COMMENT 'ไอดีกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgs_acts`
--

INSERT INTO `imgs_acts` (`imgID`, `imgName`, `acID`) VALUES
(1, '223.jpg', 1),
(2, '522.jpg', 1),
(3, '568.jpg', 1),
(4, '542.jpg', 1),
(5, '773.jpg', 1),
(6, '623.jpg', 1),
(11, '715.jpg', 2),
(12, '695.jpg', 2),
(13, '523.jpg', 2),
(14, '821.jpg', 2),
(15, '237.jpg', 3),
(16, '638.jpg', 3),
(17, '643.jpg', 3),
(18, '587.jpg', 3),
(19, '819.jpg', 3),
(20, '446.jpg', 3),
(21, '130.jpg', 4),
(22, '632.jpg', 4),
(23, '935.jpg', 4),
(24, '531.jpg', 4),
(25, '748.jpg', 5),
(26, '432.jpg', 5),
(27, '785.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `imgs_atts`
--

CREATE TABLE `imgs_atts` (
  `imgID` int(11) UNSIGNED NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `atID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgs_atts`
--

INSERT INTO `imgs_atts` (`imgID`, `imgName`, `atID`) VALUES
(1, '562.jpg', 1),
(2, '630.jpg', 1),
(3, '637.jpg', 1),
(4, '845.jpg', 1),
(5, '120.jpg', 1),
(6, '899.jpg', 1),
(7, '538.jpg', 2),
(8, '378.jpg', 2),
(9, '921.jpg', 2),
(10, '896.jpg', 2),
(11, '672.jpg', 2),
(12, '345.jpg', 2),
(13, '669.jpg', 3),
(15, '359.jpg', 3),
(16, '457.jpg', 3),
(17, '802.jpg', 3),
(18, '225.jpg', 3),
(19, '130.jpg', 3),
(20, '592.jpg', 3),
(21, '356.jpg', 3),
(22, '107.jpg', 3),
(23, '911.jpg', 4),
(24, '954.jpg', 4),
(26, '351.jpg', 4),
(27, '458.jpg', 4),
(28, '211.jpg', 4),
(29, '423.jpg', 4),
(31, '838.jpg', 5),
(32, '291.jpg', 5),
(33, '296.jpg', 5),
(34, '242.jpg', 5),
(36, '186.jpg', 5),
(37, '192.jpg', 5),
(38, '159.jpg', 5),
(43, '705.jpg', 6),
(44, '176.jpg', 6),
(45, '403.jpg', 6),
(46, '283.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `imgs_hms`
--

CREATE TABLE `imgs_hms` (
  `imgID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `hmID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgs_hms`
--

INSERT INTO `imgs_hms` (`imgID`, `imgName`, `hmID`) VALUES
(1, '120.jpg', '10294827465'),
(2, '637.jpg', '10294827465'),
(3, '164.jpg', '10294827465'),
(4, '342.jpg', '10294827465'),
(5, '988.jpg', '23417586902'),
(6, '620.jpg', '23417586902'),
(7, '670.jpg', '23417586902'),
(8, '604.jpg', '23417586902'),
(9, '285.jpg', '69581028472'),
(10, '526.jpg', '69581028472'),
(11, '342.jpg', '69581028472'),
(12, '181.jpg', '69581028472'),
(13, '336.jpg', '86756403921'),
(14, '547.jpg', '86756403921'),
(15, '671.jpg', '86756403921'),
(16, '223.jpg', '86756403921'),
(17, '120.jpg', '10294827465'),
(18, '637.jpg', '10294827465'),
(19, '164.jpg', '10294827465'),
(20, '342.jpg', '10294827465'),
(21, '342.jpg', '69581028472'),
(22, '181.jpg', '69581028472'),
(23, '620.jpg', '23417586902'),
(24, '670.jpg', '23417586902'),
(25, '671.jpg', '86756403921'),
(26, '223.jpg', '86756403921');

-- --------------------------------------------------------

--
-- Table structure for table `imgs_prod`
--

CREATE TABLE `imgs_prod` (
  `imgID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `pdID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgs_prod`
--

INSERT INTO `imgs_prod` (`imgID`, `imgName`, `pdID`) VALUES
(25, '169.jpg', 4),
(26, '903.jpg', 4),
(27, '449.jpg', 4),
(28, '497.jpg', 4),
(29, '999.jpg', 4),
(30, '330.jpg', 4),
(31, '601.jpg', 4),
(32, '649.jpg', 4),
(33, '169.jpg', 5),
(34, '903.jpg', 5),
(35, '449.jpg', 5),
(36, '497.jpg', 5),
(37, '999.jpg', 5),
(38, '330.jpg', 5),
(39, '601.jpg', 5),
(40, '649.jpg', 5),
(41, '169.jpg', 6),
(42, '903.jpg', 6),
(43, '449.jpg', 6),
(44, '497.jpg', 6),
(45, '999.jpg', 6),
(46, '330.jpg', 6),
(47, '601.jpg', 6),
(48, '649.jpg', 6),
(49, '169.jpg', 7),
(50, '903.jpg', 7),
(51, '449.jpg', 7),
(52, '497.jpg', 7),
(53, '999.jpg', 7),
(54, '330.jpg', 7),
(55, '601.jpg', 7),
(56, '649.jpg', 7),
(57, '169.jpg', 8),
(58, '903.jpg', 8),
(59, '449.jpg', 8),
(60, '497.jpg', 8),
(61, '999.jpg', 8),
(62, '330.jpg', 8),
(63, '601.jpg', 8),
(64, '649.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `img_slide_acts`
--

CREATE TABLE `img_slide_acts` (
  `ID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `header` varchar(100) NOT NULL,
  `subHeader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_slide_acts`
--

INSERT INTO `img_slide_acts` (`ID`, `imgName`, `header`, `subHeader`) VALUES
(8, '670.jpg', 'Header', 'Sub Header');

-- --------------------------------------------------------

--
-- Table structure for table `img_slide_atts`
--

CREATE TABLE `img_slide_atts` (
  `ID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `header` varchar(100) NOT NULL,
  `subHeader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_slide_atts`
--

INSERT INTO `img_slide_atts` (`ID`, `imgName`, `header`, `subHeader`) VALUES
(2, '682.jpg', 'Header', 'Sub Header');

-- --------------------------------------------------------

--
-- Table structure for table `img_slide_homes`
--

CREATE TABLE `img_slide_homes` (
  `ID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `header` varchar(100) NOT NULL,
  `subHeader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_slide_homes`
--

INSERT INTO `img_slide_homes` (`ID`, `imgName`, `header`, `subHeader`) VALUES
(1, '100.jpg', 'ยินดีต้อนรับเข้าสู่เว็บไซต์บ้านคำบกโฮมสเตย์', 'ท่องเที่ยวงายๆ สไตบ์บ้านคำบก');

-- --------------------------------------------------------

--
-- Table structure for table `img_slide_prod`
--

CREATE TABLE `img_slide_prod` (
  `ID` int(11) NOT NULL,
  `imgName` varchar(7) NOT NULL,
  `header` varchar(100) NOT NULL,
  `subHeader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_slide_prod`
--

INSERT INTO `img_slide_prod` (`ID`, `imgName`, `header`, `subHeader`) VALUES
(1, '583.jpg', 'Header', 'Sub Header');

-- --------------------------------------------------------

--
-- Table structure for table `likes_acts`
--

CREATE TABLE `likes_acts` (
  `ID` int(11) UNSIGNED NOT NULL COMMENT 'ไอดีไลค์',
  `cmID` varchar(13) NOT NULL COMMENT 'รหัสผู้ใช้',
  `acID` tinyint(3) UNSIGNED NOT NULL COMMENT 'ไอดีกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes_atts`
--

CREATE TABLE `likes_atts` (
  `ID` int(11) UNSIGNED NOT NULL,
  `cmID` varchar(13) NOT NULL,
  `atID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes_prod`
--

CREATE TABLE `likes_prod` (
  `ID` int(11) NOT NULL,
  `cmID` varchar(13) NOT NULL,
  `pdID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes_rooms`
--

CREATE TABLE `likes_rooms` (
  `ID` int(11) NOT NULL,
  `cmID` varchar(13) NOT NULL,
  `rmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes_rooms`
--

INSERT INTO `likes_rooms` (`ID`, `cmID`, `rmID`) VALUES
(1, '1100501376787', 1),
(2, '1100501376787', 2),
(3, '1100501376787', 9);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mbID` varchar(13) NOT NULL,
  `mbPx` enum('นาย','นาง','นางสาว','') NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `img` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mbID`, `mbPx`, `fname`, `lname`, `tel`, `img`) VALUES
('1100548295762', 'นาง', 'สายไหม', 'จิตใจดีงาม', '0987654322', '138.jpg'),
('1341286957402', 'นาย', 'จิรวัฒน์', 'จรูญเนตร', '0987654321', '130.jpg'),
('3405617289583', 'นางสาว', 'จัญญาพร', 'นิติโรชภานิณช์', '0987654320', '229.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ord_acts`
--

CREATE TABLE `ord_acts` (
  `ID` int(11) NOT NULL,
  `cmID` varchar(13) DEFAULT NULL,
  `actsID` tinyint(3) UNSIGNED NOT NULL,
  `checkIn` date NOT NULL,
  `date_save` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ord_acts`
--

INSERT INTO `ord_acts` (`ID`, `cmID`, `actsID`, `checkIn`, `date_save`, `status`) VALUES
(1, '1100501376787', 1, '2019-08-30', '2019-08-30 09:19:07', '1'),
(2, '1100501376787', 4, '2019-08-31', '2019-08-30 09:19:07', '0'),
(3, '1100501376787', 3, '2019-08-31', '2019-08-30 09:19:07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ord_prod`
--

CREATE TABLE `ord_prod` (
  `ID` int(11) NOT NULL,
  `ord_ID` int(11) NOT NULL,
  `cmID` varchar(13) NOT NULL,
  `pdID` tinyint(3) UNSIGNED NOT NULL,
  `ord_QTY` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `addID` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ord_prod`
--

INSERT INTO `ord_prod` (`ID`, `ord_ID`, `cmID`, `pdID`, `ord_QTY`, `date`, `addID`, `status`) VALUES
(2, 0, '1100501376787', 4, 1, '2019-08-30 09:22:00', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ord_rooms`
--

CREATE TABLE `ord_rooms` (
  `ID` int(11) NOT NULL,
  `cmID` varchar(13) DEFAULT NULL,
  `rmID` int(11) NOT NULL,
  `date` date NOT NULL,
  `checkOut` date NOT NULL,
  `date_save` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ord_rooms`
--

INSERT INTO `ord_rooms` (`ID`, `cmID`, `rmID`, `date`, `checkOut`, `date_save`, `status`) VALUES
(92, '1100501376787', 2, '2019-08-30', '2019-08-31', '2019-08-30 09:19:07', '0'),
(93, '1100501376787', 2, '2019-08-31', '2019-08-31', '2019-08-30 09:19:07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pdID` tinyint(3) UNSIGNED NOT NULL,
  `pdName` varchar(50) NOT NULL,
  `pdDetail` text NOT NULL,
  `pdImg` varchar(7) NOT NULL,
  `pdPrice` smallint(5) UNSIGNED NOT NULL,
  `pdNote` text NOT NULL,
  `qty` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pdID`, `pdName`, `pdDetail`, `pdImg`, `pdPrice`, `pdNote`, `qty`) VALUES
(4, 'สินค้า 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', '686.jpg', 69, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', 9),
(5, 'สินค้า 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', '280.jpg', 145, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', 1),
(6, 'สินค้า 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', '764.jpg', 99, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', 7),
(7, 'สินค้า 4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', '930.jpg', 250, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', 5),
(8, 'สินค้า 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', '704.jpg', 150, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet optio pariatur expedita vitae ratione similique, molestias at quasi necessitatibus quod voluptatum ipsa in libero dolor ex, numquam quae nostrum sapiente?', 81);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `rmID` int(11) NOT NULL,
  `rmName` varchar(50) NOT NULL,
  `rmDetail` text NOT NULL,
  `rmImg` varchar(7) NOT NULL,
  `hmID` varchar(11) NOT NULL,
  `rmNote` text NOT NULL,
  `rmPrice` smallint(5) UNSIGNED NOT NULL,
  `rmGqty` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rmID`, `rmName`, `rmDetail`, `rmImg`, `hmID`, `rmNote`, `rmPrice`, `rmGqty`) VALUES
(1, 'ห้องธรรมดา', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '773.jpg', '10294827465', ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 9999, '4'),
(2, 'ห้องพิเศษ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '492.jpg', '10294827465', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 999, '3'),
(3, 'ห้องธรรมดา', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '317.jpg', '23417586902', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 750, '4'),
(4, 'ห้องพิเศษ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '420.jpg', '23417586902', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 900, '2'),
(5, 'ห้องธรรมดา', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '292.jpg', '69581028472', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 300, '4'),
(6, 'ห้องพิเศษ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '819.jpg', '69581028472', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 560, '3'),
(7, 'ห้องธรรมดา', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '357.jpg', '86756403921', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 100, '2'),
(8, 'ห้องพิเศษ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '668.jpg', '86756403921', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 800, '2'),
(9, 'ห้องชันนะตุ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', '773.jpg', '10294827465', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum hic sint corrupti eligendi, repellendus praesentium nemo id sequi neque omnis animi inventore alias tenetur esse odit sit tempora totam fugiat!', 400, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`acID`),
  ADD UNIQUE KEY `acName` (`acName`),
  ADD KEY `mbID` (`mbID`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addID`),
  ADD KEY `cmID` (`cmID`);

--
-- Indexes for table `attractions`
--
ALTER TABLE `attractions`
  ADD PRIMARY KEY (`atID`),
  ADD UNIQUE KEY `atName` (`atName`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cmID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`hmID`),
  ADD UNIQUE KEY `hmName` (`hmName`),
  ADD KEY `mbID` (`mbID`);

--
-- Indexes for table `imgs_acts`
--
ALTER TABLE `imgs_acts`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `acID` (`acID`);

--
-- Indexes for table `imgs_atts`
--
ALTER TABLE `imgs_atts`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `atID` (`atID`);

--
-- Indexes for table `imgs_hms`
--
ALTER TABLE `imgs_hms`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `hmID` (`hmID`);

--
-- Indexes for table `imgs_prod`
--
ALTER TABLE `imgs_prod`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `pdID` (`pdID`);

--
-- Indexes for table `img_slide_acts`
--
ALTER TABLE `img_slide_acts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `img_slide_atts`
--
ALTER TABLE `img_slide_atts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `img_slide_homes`
--
ALTER TABLE `img_slide_homes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `img_slide_prod`
--
ALTER TABLE `img_slide_prod`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `likes_acts`
--
ALTER TABLE `likes_acts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `acID` (`acID`),
  ADD KEY `cmID` (`cmID`);

--
-- Indexes for table `likes_atts`
--
ALTER TABLE `likes_atts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cmID` (`cmID`),
  ADD KEY `atID` (`atID`);

--
-- Indexes for table `likes_prod`
--
ALTER TABLE `likes_prod`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pdID` (`pdID`),
  ADD KEY `cmID` (`cmID`);

--
-- Indexes for table `likes_rooms`
--
ALTER TABLE `likes_rooms`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cmID` (`cmID`),
  ADD KEY `rmID` (`rmID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mbID`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Indexes for table `ord_acts`
--
ALTER TABLE `ord_acts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ord_acts_ibfk_1` (`actsID`),
  ADD KEY `cmID` (`cmID`);

--
-- Indexes for table `ord_prod`
--
ALTER TABLE `ord_prod`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ord_prod_ibfk_2` (`pdID`),
  ADD KEY `ord_prod_ibfk_1` (`cmID`),
  ADD KEY `ord_prod_ibfk_3` (`addID`);

--
-- Indexes for table `ord_rooms`
--
ALTER TABLE `ord_rooms`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ord_rooms_ibfk_2` (`rmID`),
  ADD KEY `ord_rooms_ibfk_1` (`cmID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pdID`),
  ADD UNIQUE KEY `pdName` (`pdName`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rmID`),
  ADD KEY `hmID` (`hmID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `acID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีกิจกรรม', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attractions`
--
ALTER TABLE `attractions`
  MODIFY `atID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `imgs_acts`
--
ALTER TABLE `imgs_acts`
  MODIFY `imgID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอรูปภาพ', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `imgs_atts`
--
ALTER TABLE `imgs_atts`
  MODIFY `imgID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `imgs_hms`
--
ALTER TABLE `imgs_hms`
  MODIFY `imgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `imgs_prod`
--
ALTER TABLE `imgs_prod`
  MODIFY `imgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `img_slide_acts`
--
ALTER TABLE `img_slide_acts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `img_slide_atts`
--
ALTER TABLE `img_slide_atts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `img_slide_homes`
--
ALTER TABLE `img_slide_homes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `img_slide_prod`
--
ALTER TABLE `img_slide_prod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes_acts`
--
ALTER TABLE `likes_acts`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไลค์';

--
-- AUTO_INCREMENT for table `likes_atts`
--
ALTER TABLE `likes_atts`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_prod`
--
ALTER TABLE `likes_prod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_rooms`
--
ALTER TABLE `likes_rooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ord_acts`
--
ALTER TABLE `ord_acts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ord_prod`
--
ALTER TABLE `ord_prod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ord_rooms`
--
ALTER TABLE `ord_rooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pdID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`mbID`) REFERENCES `members` (`mbID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homes`
--
ALTER TABLE `homes`
  ADD CONSTRAINT `homes_ibfk_1` FOREIGN KEY (`mbID`) REFERENCES `members` (`mbID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imgs_acts`
--
ALTER TABLE `imgs_acts`
  ADD CONSTRAINT `imgs_acts_ibfk_1` FOREIGN KEY (`acID`) REFERENCES `activities` (`acID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imgs_atts`
--
ALTER TABLE `imgs_atts`
  ADD CONSTRAINT `imgs_atts_ibfk_1` FOREIGN KEY (`atID`) REFERENCES `attractions` (`atID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imgs_hms`
--
ALTER TABLE `imgs_hms`
  ADD CONSTRAINT `imgs_hms_ibfk_1` FOREIGN KEY (`hmID`) REFERENCES `homes` (`hmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imgs_prod`
--
ALTER TABLE `imgs_prod`
  ADD CONSTRAINT `imgs_prod_ibfk_1` FOREIGN KEY (`pdID`) REFERENCES `products` (`pdID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes_acts`
--
ALTER TABLE `likes_acts`
  ADD CONSTRAINT `likes_acts_ibfk_1` FOREIGN KEY (`acID`) REFERENCES `activities` (`acID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_acts_ibfk_2` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes_atts`
--
ALTER TABLE `likes_atts`
  ADD CONSTRAINT `likes_atts_ibfk_1` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_atts_ibfk_2` FOREIGN KEY (`atID`) REFERENCES `attractions` (`atID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes_prod`
--
ALTER TABLE `likes_prod`
  ADD CONSTRAINT `likes_prod_ibfk_1` FOREIGN KEY (`pdID`) REFERENCES `products` (`pdID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_prod_ibfk_2` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes_rooms`
--
ALTER TABLE `likes_rooms`
  ADD CONSTRAINT `likes_rooms_ibfk_1` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_rooms_ibfk_2` FOREIGN KEY (`rmID`) REFERENCES `rooms` (`rmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ord_acts`
--
ALTER TABLE `ord_acts`
  ADD CONSTRAINT `ord_acts_ibfk_1` FOREIGN KEY (`actsID`) REFERENCES `activities` (`acID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord_acts_ibfk_2` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `ord_prod`
--
ALTER TABLE `ord_prod`
  ADD CONSTRAINT `ord_prod_ibfk_1` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord_prod_ibfk_2` FOREIGN KEY (`pdID`) REFERENCES `products` (`pdID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord_prod_ibfk_3` FOREIGN KEY (`addID`) REFERENCES `address` (`addID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ord_rooms`
--
ALTER TABLE `ord_rooms`
  ADD CONSTRAINT `ord_rooms_ibfk_1` FOREIGN KEY (`cmID`) REFERENCES `customers` (`cmID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ord_rooms_ibfk_2` FOREIGN KEY (`rmID`) REFERENCES `rooms` (`rmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hmID`) REFERENCES `homes` (`hmID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
