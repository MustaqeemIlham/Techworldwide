-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 19, 2023 at 08:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techworldwide`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('ilham', '123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `first_address` varchar(100) NOT NULL,
  `state` varchar(40) NOT NULL,
  `city` varchar(80) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `email`, `phone`, `first_address`, `state`, `city`, `postcode`, `first_name`, `last_name`) VALUES
(1, 'haziq', '12345', 'haziqakram99@gmail.com', '01110775946', 'TAMAN PADANG MIDIN', 'TERENGGANU', 'KUALA TERENGGANU', '21400', 'Haziq', 'akram'),
(2, 'danish', 'gay', 'haziqakram11@gmail.com', '01186476391', 'taman jaya menjaya', 'melaka', 'air lutsinar', '29430', '', ''),
(6, 'cami', 'cami123', 'cami@gmail.com', '111', 'kampung seri permai', 'kemaman', 'cukai', '24000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Delivery_ID` int(11) NOT NULL,
  `Ship_Date` date NOT NULL,
  `Worker_LName` varchar(50) NOT NULL,
  `Worker_Contact` varchar(12) NOT NULL,
  `Worker_Email` varchar(20) NOT NULL,
  `Purchase_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `Purchase_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Delivery_Charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`Purchase_ID`, `Product_ID`, `Quantity`, `Status`, `Delivery_Charge`) VALUES
(37, 507, 1, 'Cancelled', 7),
(47, 505, 1, 'To Receive', 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Payment_Method` varchar(30) NOT NULL,
  `Payment_Date` date NOT NULL,
  `Payment_Time` time NOT NULL,
  `Payment_Charge` decimal(19,2) NOT NULL,
  `Voucher_ID` varchar(50) NOT NULL,
  `Purchase_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Payment_Method`, `Payment_Date`, `Payment_Time`, `Payment_Charge`, `Voucher_ID`, `Purchase_ID`) VALUES
(23, 'Online Banking', '2023-07-18', '20:19:54', '2501.00', '123', 37),
(24, 'Debit/Credit Card', '2023-07-20', '00:36:22', '2896.00', '456', 47);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Product_Price` decimal(19,2) NOT NULL,
  `product_image` varchar(300) NOT NULL,
  `product_type` varchar(30) NOT NULL,
  `Product_Available` int(8) NOT NULL,
  `Product_Brand` varchar(25) NOT NULL,
  `Product_Desc` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Price`, `product_image`, `product_type`, `Product_Available`, `Product_Brand`, `Product_Desc`) VALUES
(501, 'IPHONE 11', '2049.00', 'sources\\iphone11.png', 'PHONE', 9, 'APPLE', '6.1-inch Liquid Retina HD LCD display,  iOS 13 with Dark Mode, 12MP TrueDepth front camera with Portrait mode, 4K video and slow-motion video, Capacity 64GB, Color Black'),
(502, 'GALAXY S23 ULTRA', '5199.00', 'sources\\galaxys23.png', 'PHONE', 8, 'SAMSUNG', ''),
(503, 'IPHONE XS', '1199.00', 'sources\\iphonexs.png', 'PHONE', 13, 'APPLE', ''),
(504, 'GALAXY A54 5G', '1899.00', 'sources\\galaxya54.png', 'PHONE', 32, 'SAMSUNG', ''),
(505, 'IPAD AIR ', '2899.00', 'sources\\ipadair2.png', 'TABLET', 26, 'APPLE', ''),
(506, 'AIRPODS 3RD GEN', '1099.00', 'sources\\airpodpro.png', 'ACCESSORY', 200, 'APPLE', ''),
(507, 'AIRPODS MAX', '2499.00', 'sources\\airpodmax.png', 'ACCESSORY', 156, 'APPLE', ''),
(508, 'GALAXY TAB S8+', '3999.00', 'sources\\tabs8.png', 'TABLET', 145, 'SAMSUNG', ''),
(509, 'IPAD PRO', '3899.00', 'sources\\ipadpro.png', 'TABLET', 75, 'APPLE', ''),
(510, 'IPAD MINI', '2399.00', 'sources\\ipadmini.png', 'TABLET', 58, 'APPLE', ''),
(511, 'GALAXY BUDS2', '499.00', 'sources\\galaxybud2.png', 'ACCESSORY', 47, 'APPLE', ''),
(512, 'GALAXY BUDS PRO', '649.00', 'sources\\galaxybudspro.png', 'ACCESSORY', 94, 'SAMSUNG', ''),
(513, 'GALAXY A14 LTE', '799.00', 'sources\\GALAXY_A14_LTE.png', 'PHONE', 116, 'SAMSUNG', ''),
(514, 'GALAXY A24 LTE', '999.00', 'sources\\GALAXY_A24_LTE.png', 'PHONE', 50, 'SAMSUNG', ''),
(515, 'GALAXY S23+', '4699.00', 'sources\\GALAXY_S23+.png', 'PHONE', 50, 'SAMSUNG', ''),
(516, 'GALAXY S23', '3899.00', 'sources\\GALAXY_S23.png', 'PHONE', 41, 'SAMSUNG', ''),
(517, 'GALAXY S22 ULTRA', '5099.00', 'sources\\GALAXY_S22_ULTRA.png', 'PHONE', 32, 'SAMSUNG', ''),
(518, 'GALAXY S22', '3499.00', 'sources\\GALAXY_S22.png', 'PHONE', 67, 'SAMSUNG', ''),
(519, 'GALAXY A34 5G', '1599.00', 'sources\\GALAXY_A34_5G.png', 'PHONE', 36, 'SAMSUNG', ''),
(520, 'GALAXY Z FLIP4 5G', '4099.00', 'sources\\GALAXY_Z_FLIP4_5G.png', 'PHONE', 80, 'SAMSUNG', ''),
(521, 'GALAXY Z FOLD4 5G', '6799.00', 'sources\\GALAXY_Z_FOLD4_5G.png', 'PHONE', 20, 'SAMSUNG', ''),
(522, 'GALAXY A13', '799.00', 'sources\\GALAXY_A13.png', 'PHONE', 150, 'SAMSUNG', ''),
(523, 'GALAXY S22+ 5G', '4099.00', 'sources\\GALAXY_S22+_5G.png', 'PHONE', 174, 'SAMSUNG', ''),
(524, 'GALAXY A04', '479.00', 'sources\\GALAXY_A04.png', 'PHONE', 200, 'SAMSUNG', ''),
(525, 'GALAXY A14 5G', '949.00', 'sources\\GALAXY_A14_5G.png', 'PHONE', 51, 'SAMSUNG', ''),
(526, 'GALAXY TAB A7 LITE WIFI', '599.00', 'sources\\GALAXY_TAB_A7_LITE_WIFI.png', 'TABLET', 37, 'SAMSUNG', ''),
(527, 'GALAXT TAB S6 LITE WIFI', '1249.00', 'sources\\GALAXT_TAB_S6_LITE_WIFI.png', 'TABLET', 54, 'SAMSUNG', ''),
(528, 'GALAXY TAB A7 LITE LTE', '599.00', 'sources\\GALAXY_TAB_A7_LITE_LTE.png', 'TABLET', 30, 'SAMSUNG', ''),
(529, 'GALAXY TAB S7 FE WIFI + S PEN 4/64', '1799.00', 'sources\\GALAXY_TAB_S7_FE_WIFI_S_PEN_4_64.png', 'TABLET', 60, 'SAMSUNG', ''),
(530, 'GALAXY TAB S7 FE WIFI +S PEN 6/128', '2099.00', 'sources\\GALAXY_TAB_S7_FE_WIFI_S_PEN_6_128.png', 'TABLET', 42, 'SAMSUNG', ''),
(531, 'GALAXT TAB S6 LITE LTE', '1549.00', 'sources\\GALAXT_TAB_S6_LITE_LTE.png', 'TABLET', 49, 'SAMSUNG', ''),
(532, 'GALAXY TAB S8 ULTRA WIFI', '5099.00', 'sources\\GALAXY_TAB_S8_ULTRA_WIFI.png', 'TABLET', 10, 'SAMSUNG', ''),
(533, 'GALAXT TAB S8 WIFI', '2999.00', 'sources\\GALAXT_TAB_S8_WIFI.png', 'TABLET', 20, 'SAMSUNG', ''),
(534, 'GALAXY WATCH5 R900', '899.00', 'sources\\Watch5_R900.png', 'ACCESSORY', 22, 'SAMSUNG', 'Highlights\r\n\r\n- 1.2\"(30.4mm), 330PPI\r\n\r\n- Sapphire Crystal Glass 24GPa\r\n\r\n- Wear OS\r\n\r\n- Powered by Samsung\r\n\r\n- ECG & Blood Pressure\r\n\r\n- Exynos W920 (Dualcore, 5nm)\r\n\r\n- RAM 1.5GB + 16GB\r\n\r\n- 284mAh\r\n\r\n- NFC, Bluetooth, Wi-Fi, GPS\r\n\r\n- 5ATM/ IP68/ MIL-STD-810G\r\n\r\n- Bluetooth v5.2\r\n\r\n- Mic., Speaker, Motor, Touch Bezel\r\n\r\n- Heart Rate Monitor, BIA, Continuous SpO2\r\n\r\n- Accelerometer, Barometer, Gyro Sensor, Geomagnetic Sensor, Light Sensor, Opti'),
(535, 'GALAXY WATCH5 R910', '999.00', 'sources\\Watch5_R910.png', 'ACCESSORY', 20, 'SAMSUNG', 'Highlights\r\n\r\n- 1.4\"(34.6mm), 330PPI\r\n\r\n- Sapphire Crystal Glass 24GPa\r\n\r\n- Wear OS\r\n\r\n- Powered by Samsung\r\n\r\n- Exynos W920 (Dualcore, 5nm)\r\n\r\n- ECG & Blood Pressure\r\n\r\n- RAM 1.5GB + 16GB\r\n\r\n- 410mAh\r\n\r\n- NFC, Bluetooth, Wi-Fi, GPS\r\n\r\n- 5ATM/ IP68/ MIL-STD-810G\r\n\r\n- Bluetooth v5.2\r\n\r\n- Mic., Speaker, Motor, Touch Bezel\r\n\r\n- Heart Rate Monitor, BIA, Continuous SpO2\r\n\r\n- Accelerometer, Barometer, Gyro Sensor, Geomagnetic Sensor, Light Sensor, Opti'),
(536, 'GALAXY WATCH5 PRO R920', '1599.00', 'sources\\Watch5_R920.png', 'ACCESSORY', 13, 'SAMSUNG', 'Highlights\r\n\r\n- 1.4\"(34.6mm), 330PPI\r\n\r\n- Sapphire Crystal Glass 29GPa\r\n\r\n- Wear OS\r\n\r\n- Powered by Samsung\r\n\r\n- ECG & Blood Pressure\r\n\r\n- Exynos W920 (Dualcore, 5nm)\r\n\r\n- RAM 1.5GB + 16GB\r\n\r\n- 590mAh\r\n\r\n- NFC, Bluetooth, Wi-Fi, GPS\r\n\r\n- 5ATM/ IP68/ MIL-STD-810G\r\n\r\n- Bluetooth v5.2\r\n\r\n- Mic., Speaker, Motor, Touch Bezel\r\n\r\n- Heart Rate Monitor, BIA, Continuous SpO2\r\n\r\n- Accelerometer, Barometer, Gyro Sensor, Geomagnetic Sensor, Light Sensor, Opti'),
(537, 'AIRPOD 2ND GEN', '629.00', 'sources\\airpod2ndgen.png', 'ACCESSORY', 9, 'APPLE', ''),
(538, 'AIRPODS PRO 2ND GEN', '1099.00', 'sources\\airpodpro2ndgen.png\r\n', 'ACCESSORY', 11, 'APPLE', ''),
(539, 'MAGSAFE CHARGER', '179.00', 'sources\\magsafecharger.png', 'ACCESSORY', 29, 'APPLE', ''),
(540, 'USB-C TO LIGHTNING CABLE', '99.00', 'sources\\usb-ctolightning.png', 'ACCESSORY', 15, 'APPLE', ''),
(541, 'LIGHTNING TO USB CABLE', '89.00', 'sources\\lightningtousb.png', 'ACCESSORY', 18, 'APPLE', ''),
(542, '20W USB-C POWER ADAPTER', '99.00', 'sources\\20wpoweradapter.png', 'ACCESSORY', 20, 'APPLE', ''),
(543, 'AIRTAG', '139.00', 'sources\\airtag.png', 'ACCESSORY', 7, 'APPLE', ''),
(544, 'EARPOD WITH LIGHTNING CABLE', '99.00', 'sources\\earpodwithlightning.png', 'ACCESSORY', 14, 'APPLE', ''),
(545, '30W POWER ADAPTER', '159.00', 'sources\\30wpoweradapter.png', 'ACCESSORY', 21, 'APPLE', ''),
(546, 'MAGSAFE DUO CHARGER', '589.00', 'sources\\magsafeduocharger.png', 'ACCESSORY', 22, 'APPLE', ''),
(547, 'MAGSAFE BATTERY PACK', '479.00', 'sources\\magsafebatterypack.png', 'ACCESSORY', 3, 'APPLE', ''),
(548, '35W DUAL PORT POWER ADAPTER', '239.00', 'sources\\35wdualportpoweradapter.png', 'ACCESSORY', 17, 'APPLE', ''),
(549, 'APPLE PENCIL (1st GENERATION)', '479.00', 'sources\\applepencil1stgen.png', 'ACCESSORY', 10, 'APPLE', ''),
(550, 'APPLE PENCIL (2nd GENERATION)', '599.00', 'sources\\applepencil2ndgen.png\r\n', 'ACCESSORY', 8, 'APPLE', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_ID` int(11) NOT NULL,
  `Purchase_Date` date NOT NULL,
  `Purchase_Time` time NOT NULL,
  `Cust_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Purchase_ID`, `Purchase_Date`, `Purchase_Time`, `Cust_ID`) VALUES
(37, '2023-07-18', '20:19:54', 1),
(38, '2023-07-19', '22:53:46', 1),
(39, '2023-07-19', '22:54:43', 1),
(40, '2023-07-19', '22:54:44', 1),
(41, '2023-07-19', '22:54:45', 1),
(42, '2023-07-19', '22:54:57', 1),
(43, '2023-07-19', '22:55:18', 1),
(44, '2023-07-19', '23:40:18', 1),
(45, '2023-07-19', '23:40:21', 1),
(46, '2023-07-20', '00:36:15', 1),
(47, '2023-07-20', '00:36:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `Voucher_ID` varchar(50) NOT NULL,
  `Voucher_Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`Voucher_ID`, `Voucher_Price`) VALUES
('123', '5.00'),
('456', '8.00'),
('789', '7.00'),
('TCHWORLD', '4.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Delivery_ID`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`Purchase_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_ID`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`Voucher_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `Delivery_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=554;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
