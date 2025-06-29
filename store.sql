-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 12:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `category`, `brand`, `color`, `material`, `description`, `tags`) VALUES
(1, 'Cannon EOS 500D', 36000, 'Camera', 'Canon', 'Black', 'Plastic/Metal', 'Professional DSLR camera for photography', 'camera,DSLR,Canon,photography'),
(2, 'Sony DSLR', 40000, 'Camera', 'Sony', 'Black', 'Plastic/Metal', 'High-quality DSLR for photography enthusiasts', 'camera,DSLR,Sony,photography'),
(3, 'Nikon DSLR', 50000, 'Camera', 'Sony', 'Black', 'Plastic/Metal', 'Advanced DSLR with zoom lens', 'camera,DSLR,zoom'),
(4, 'Olympus DSLR', 80000, 'Camera', 'Olympus', 'Black', 'Plastic/Metal', 'Premium Olympus DSLR camera', 'camera,DSLR,Olympus,photography'),
(5, 'Apple Watch', 13000, 'Watch', 'Apple', 'Black', 'Stainless Steel', 'Elegant Apple wristwatch.', 'watch,Apple,Smart'),
(6, 'Lacie Hard Drive', 30000, 'Storage', 'Lacie', 'Orange', 'Rubber', '1TB Hard Drive from Lacie', 'Lacie,Hard Drive,Storage'),
(7, 'Keyboard', 800, 'Keyboard', 'EASE', 'Black', 'Plastic', 'Office Keyboard.', 'office,keyboard'),
(8, 'SONY WH-1000XM4 Headphone', 18000, 'Headphone', 'Sony', 'Blue', 'Plastic', 'SONY WH-1000XM4 Wireless Bluetooth Noise-Cancelling Headphones-Blue', 'Headphone,Sony,Bluetooth\r\n\r\n'),
(9, 'Samsung Galaxy S24', 150000, 'Phone', 'Samsung', 'Purple', 'Titanium', '- Display: 6.2 inch FHD+ ;Dynamic AMOLED 2X, 120Hz, HDR10+, 2600 nits (peak)\r\n- Display Protection: Protection Corning Gorilla Glass Victus 2.\r\n- Sim: Nano-SIM and eSIM or Dual SIM (2 Nano-SIMs and eSIM, dual stand-by)\r\n- Memory: 256GB + 8GB RAM.\r\n- Rear Camera: 50 MP(wide) Dual Pixel PDAF, OIS', 'S24,Phone,Samsung'),
(10, 'Samsung SSD', 10000, 'Storage', 'Samsung ', 'Black', 'Plastic', 'Very Fast SSD from Samsung Brand.', 'Fast,Samsung,Storage'),
(11, 'Earphone', 1100, 'Earphone', 'Razer', 'Green', 'Plastic', 'Awesome Earphone for almost every kind of work.', 'razer,sound,earphone'),
(12, 'Gaming Headphone', 2300, 'Headphone', 'Version', 'Black', 'Plastic', 'Gaming Headphone', 'headphone,sound,gaming'),
(13, 'SanDisk SSD', 10000, 'Storage', 'SanDisk', 'Black', 'Plastic', 'Very good industry level SSD from SanDisk.', 'Fast,Storage,SanDisk'),
(14, 'Hasselblad Dslr', 1000000, 'Camera', 'Hasselblad', 'Black', 'Aluminium', 'Cinema grade Camera.', 'Camera, dslr'),
(15, 'Western Digital SN850X', 32000, 'Storage', 'Western Digital', 'Black', 'Plastic', 'Data Storage Capacity: 2 Tb\r\n\r\nGet the ultimate gaming edge over your competition with insane speeds up to 7,300 MB/s for top-tier performance and ridiculously short load times\r\n\r\nA range of capacities from 1TB to 4TB means you get to keep more of today?s games that can take up 200GB2 or more of storage', 'storage,ssd,western digital'),
(16, 'Samsung Galaxy S23', 90000, 'Phone', 'Samsung ', 'Black', 'Titanium', '- Display: 6.2 inch FHD+ ;Dynamic AMOLED 2X, 120Hz, HDR10+, 2600 nits (peak) - Display Protection: Protection Corning Gorilla Glass Victus 2. - Sim: Nano-SIM and eSIM or Dual SIM (2 Nano-SIMs and eSIM, dual stand-by) - Memory: 256GB + 8GB RAM. - Rear Camera: 50 MP(wide) Dual Pixel PDAF, OIS', 'samsung phone,s23,samsung,phone\r\n'),
(18, 'Nothing Phone 3a', 60000, 'Phone', 'Nothing', 'Gray', 'Aluminium', 'The Phone (3a) Series is characterised by clean, geometric shapes, flat surfaces and straight sides, all giving a sense of sophistication in comparison to its predecessor. An eclectic mix of influences drawn from Japanese iconography, playful elements alongside industrial designs from the 60s and 70s.', 'phone,nothing,3a'),
(19, 'Ugreen Keyboard', 1035, 'Keyboard', 'Ugreen', 'Black', 'Plastic', 'Cable Length : 1.5 m\r\n\r\nDimension : 445x165x25 (mm)\r\n\r\nLifespan : 10 million keystrokes\r\n\r\nOperating Voltage : 5V\r\n\r\nOperating Current : 20-50mA\r\n\r\nOther : Spill resistant\r\n\r\nCompatible Systems : Windows 2000/2003/XP, Vista/7/8/8.1/10/11, macOS', 'keyboard,ugreen,office'),
(20, 'Fantech Wireless Keyboard', 2789, 'Keyboard', 'Fantech', 'White', 'Aluminium', 'Adjustable FeetThis keyboard has adjustable feet that allow you to adjust the height and tilt of the keyboard. That way you can get the perfect ergonomic setup.', 'keyboard,wireless,fantech'),
(21, 'Transcend Hard Drive', 15336, 'Storage', 'Transcend', 'Blue', 'Rubber', 'The StoreJet portable external hard drives combine the superior performance of USB 3.0, vast storage space. Slender and lightweight in design, these drives offer robust durability, with thorough defence against data loss resulting from accidental shock or collision\r\nAdvanced three-stage shock protection system', 'storage,transcend,harddrive'),
(22, 'Asus Zenphone 10', 125499, 'Phone', 'Asus', 'Red', 'Polycarbonate', 'Body: Eco-friendly polycarbonate back, aluminum frame, 146.5 x 68.1 x 9.4mm, 172 gm\r\nIP Rating: IP68 dust and water resistant\r\nDisplay: 5.9-inch Samsung AMOLED panel, Gorilla Glass Victus, 144Hz refresh rate, Up to 1,100 nits, ?E< 1, HDR10+, 112% DCI-P3 color gamut.', 'asus,phone,zenphone'),
(23, 'Motorola Moto G05', 12999, 'Phone', 'Motorola', 'Blue', 'Plastic', 'Display Size: 6.67\" display or 16.94cmResolution: HD+ (1612 × 720p) 263ppiOperating System: Android™ 15Security: Side fingerprint reader Face unlockSensors: Proximity sensor Ambient light sensor AccelerometerProcessor: MediaTek Helio G81 Extreme processor with 2xA75 2.0GHz + 6xA55 1.7GHz octa-core CPU, 820MHz Arm Mali-G52 MC2 GPUBattery Size: 5200mAh (Typical)Charging: 18W device charging capable | 6V3AScreen to Body Ratio: Active Area-Touch Panel (AA-TP): 91% Active Area-Body (AA-Body): 87%Rear Main Camera: 50MP* f/1.8 apeture 0.64µm pixel size | Quad Pixel Technology with 1.28µm PDAFRear Camera Video Software: Shooting modes: Video Timelapse Slow MotionFront Camera Video Capture: FHD (30fps) HD (30fps)Front Camera Hardware: 8MP f/2.05 aperture 1.12µm pixel sizeRear Camera Video Capture: FHD (30fps) HD (30fps)Speakers: Stereo speakers Dolby Atmos®Headphone Jack: 3.5mm headset jackMicrophones: 1 microphone', 'mobile,motorola,phone'),
(24, 'Panasonic Lumix DC GH5', 230000, 'Camera', 'Panasonic', 'Black', 'Metal', 'Panasonic LUMIX GH5 4K Digital Camera, 20.3 Megapixel Mirrorless Camera, DC-GH5 (Black), Bundle with Vanguard Alta Pro 264AB 100 Aluminum Tripod with SBH-100 Ball Head + 32GB SD Card + Cleaning Kit', 'dslr,camera,panasonic'),
(26, 'Hoco Earphone', 1200, 'earphone', 'Hoco', 'White', 'Plastic', 'High quality earphone', 'earphone');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `is_admin`) VALUES
(2, 'Ram', 'ram1234@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889989', 'Dang', 'Dang, Nepal', 0),
(3, 'Shyam', 'shyam@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889990', 'Manang', 'Manang, Nepal\r\n', 0),
(4, 'Salin', 'salinmhzn@gmail.com', '897c8fde25c5cc5270cda61425eed3c8', '9866666666', 'Kathmandu', 'Nepal', 0),
(5, 'Salin Maharjan', 'uchiademon.123@gmail.com', '897c8fde25c5cc5270cda61425eed3c8', '98777777', 'Kathmandu', 'Nepal', 0),
(7, 'Salin', 'salinxparadygm@gmail.com', '897c8fde25c5cc5270cda61425eed3c8', 'asda', 'asdas', 'asd', 0),
(8, 'admin', 'admin@gmail.com', '1140625ad15023acf463ed481c16400a', '98765443210', 'asdf', 'asdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `status`) VALUES
(7, 3, 3, 'Added to cart'),
(8, 3, 4, 'Added to cart'),
(9, 3, 5, 'Added to cart'),
(10, 3, 11, 'Added to cart'),
(16, 5, 10, 'Added to cart'),
(21, 7, 22, 'Confirmed'),
(22, 7, 1, 'Added to cart'),
(23, 7, 7, 'Confirmed'),
(24, 7, 12, 'Confirmed'),
(25, 4, 1, 'Confirmed'),
(26, 4, 22, 'Confirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_items`
--
ALTER TABLE `users_items`
  ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
