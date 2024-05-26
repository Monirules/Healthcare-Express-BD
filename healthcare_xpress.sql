-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 11:30 AM
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
-- Database: `healthcare_xpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@northsouth.edu', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `book_consult`
--

CREATE TABLE `book_consult` (
  `name` varchar(50) NOT NULL,
  `address` varchar(70) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(15) NOT NULL,
  `consult_id` int(10) NOT NULL,
  `doctor_name` varchar(20) NOT NULL,
  `category` varchar(10) NOT NULL,
  `meet_link` varchar(20) NOT NULL,
  `time` varchar(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(70) NOT NULL,
  `room_no` int(11) NOT NULL,
  `schedule` varchar(70) NOT NULL,
  `schedule2` varchar(70) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `image`, `name`, `description`, `category`, `room_no`, `schedule`, `schedule2`, `email`, `password`) VALUES
(1, '', 'Md Farid Uddin', 'MBBS (DMC), MRCP (London, UK)', '', 0, '', '', 'farid@email.com', 'Andalib@gmail.com'),
(2, '', 'Dr. Ferdous Shahriar', 'MBBS, MD (Radiotherapy)', 'General Physician', 102, 'Monday 7:00-9:00 pm', 'Wednesday 7:00-9:00 pm', 'Shahriar@gmail.com', 'Shahriar@gmail.com'),
(3, '', 'Dr. Md. Abdul Karim', 'BCS (Health), DLO, FCPS (ENT)', 'Gastroenterologist', 103, 'Thursday 7:00-9:00 pm', 'Saturday 7:00-9:00 pm', 'Karim@gmail.com', 'Karim@gmail.com'),
(4, '', 'Ms. Alya Fardous Azad', 'MBBS, DA, FCPS', 'Gastroenterologist', 104, 'Sunday 7:00-9:00 pm', 'Tuesday 7:00-9:00 pm', 'Azad@gmail.com', 'Azad@gmail.com'),
(5, '', 'Dr. Abdullah Al Mamun', 'MBBS, FCPS (Medicine)', 'Cardiologist', 105, 'Thursday 7:00-9:00 pm', 'Saturday 7:00-9:00 pm', 'Mamum@gmail.com', 'Mamum@gmail.com'),
(6, '', 'Dr. Sabina Sultana', 'MCPS (Paed.), MD (General Paed.)', 'Cardiologist', 106, 'Sunday 7:00-9:00 pm', 'Tuesday 7:00-9:00 pm', 'Sultana@gmail.com', 'Sultana@gmail.com'),
(7, '', 'Dr. Arman Reza', 'FCPS, UICC Fellow', 'Dermatologist', 107, 'Monday 7:00-9:00 pm', 'Wednesday 7:00-9:00 pm', 'Reza@gmail.com', 'Reza@gmail.com'),
(8, '', 'Dr. Ahsanul Haq Amin', 'MD (Endocrinology & Metabolism)', 'Dermatologist', 108, 'Thursday 7:00-9:00 pm', 'Saturday 7:00-9:00 pm', 'Amin@gmail.com', 'Amin@gmail.com'),
(9, '', 'Dr. Farzana Islam', 'MBBS, MCPS (BCPS)', 'Dermatologist', 109, 'Monday 7:00-9:00 pm', 'Wednesday 7:00-9:00 pm', 'Islam@gmail.com', 'Islam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointment`
--

CREATE TABLE `doctor_appointment` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `contact_no` int(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `doctor_name` varchar(80) NOT NULL,
  `category` varchar(20) NOT NULL,
  `doctor_description` text NOT NULL,
  `schedule` varchar(50) NOT NULL,
  `total_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_appointment`
--

INSERT INTO `doctor_appointment` (`appointment_id`, `doctor_id`, `name`, `contact_no`, `address`, `doctor_name`, `category`, `doctor_description`, `schedule`, `total_price`) VALUES
(1, 4, 'Dianne Stoltz', 2147483647, '17410 52nd Ave W, Apt 14', 'Ms. Alya Fardous Azad', 'Gastroenterologist', 'MBBS, DA, FCPS', 'Tuesday 7:00-9:00 pm', 700),
(2, 9, 'Karim Benzema', 1863572211, 'Lynnwood, WA, 98037', 'Dr. Farzana Islam', 'Dermatologist', 'MBBS, MCPS (BCPS)', 'Wednesday 7:00-9:00 pm', 700);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `emergency_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`emergency_id`, `name`, `email`, `password`, `address`, `phone`, `price`) VALUES
(1, 'Md Farid Uddin', 'farid@email.com', 'farid123', 'Bashundhara R/A, Dhaka', 1734566642, 650),
(2, 'Monsur Uddin', 'monsur@gmail.com', 'monsur123', 'Mirpur 10, Dhaka', 1734566541, 700),
(3, 'Tofaul Ahmed', 'tofaul@gmail.com', 'tofaul123', 'Gulshan 2, Dhaka', 1734566827, 600),
(4, 'Md Noman', 'noman@gmail.com', 'noman123', 'Banani, Dhaka', 1923273333, 700),
(5, 'Subhan Ali', 'subhan@gmail.com', 'subhan123', 'Savar, Dhaka', 1795676827, 900),
(6, 'Abdul Wahab', 'abdul@gmail.com', 'abdul123', 'Paltan, Dhaka', 1734566890, 1000),
(7, 'Azgar Sheikh', 'azgar@gmail.com', 'azgar123', 'Dhanmondi Lake, Dhaka', 1934566827, 900),
(8, 'Shihab Reza', 'shihab@gmail.com', 'shihab123', 'Uttara 10 no Sector, Dhaka', 1863272723, 700),
(9, 'Farhan Ahmed', 'farhan@gmail.com', 'farhan123', 'Malibag Rail Station, Dhaka', 1795676821, 600);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_submission`
--

CREATE TABLE `emergency_submission` (
  `submission_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_address` varchar(80) NOT NULL,
  `user_phone` int(20) NOT NULL,
  `emergency_id` int(10) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_email` varchar(70) DEFAULT NULL,
  `driver_address` varchar(70) DEFAULT NULL,
  `driver_phone` int(20) DEFAULT NULL,
  `driver_price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_submission`
--

INSERT INTO `emergency_submission` (`submission_id`, `user_name`, `user_address`, `user_phone`, `emergency_id`, `driver_name`, `driver_email`, `driver_address`, `driver_phone`, `driver_price`) VALUES
(2, 'Sanaullah', 'New A Block ', 2147483647, 3, 'Tofaul Ahmed', 'tofaul@gmail.com', 'Gulshan 2', 1734566827, 700),
(3, 'Karim', 'Bashundhara R/A', 2147483647, 7, 'Azgar Sheikh', 'azgar@gmail.com', 'Dhanmondi Lake, Dhaka', 1934566827, 900),
(4, 'Rahim', 'Uttara 8 no', 2147483647, 4, 'Md Noman', 'noman@gmail.com', 'Banani, Dhaka', 1923273333, 700),
(11, 'Saidul Islam ', 'Mirpur 2', 2147483647, 2, 'Monsur Uddin', 'monsur@gmail.com', 'Mirpur 10, Dhaka', 1734566541, 700);

-- --------------------------------------------------------

--
-- Table structure for table `live_consultant`
--

CREATE TABLE `live_consultant` (
  `consult_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(60) NOT NULL,
  `category` varchar(20) NOT NULL,
  `meet_link` varchar(50) NOT NULL,
  `time` varchar(40) NOT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_consultant`
--

INSERT INTO `live_consultant` (`consult_id`, `name`, `description`, `category`, `meet_link`, `time`, `price`) VALUES
(1, 'Dr. Shafwanur Rahman', 'MBBS, M.D, FCPS', 'General', 'https://meet.google.com/vvq-toqb-teb', '7 pm - 8 pm', 800),
(2, 'Dr. Mehedi Hasan', 'MBBS, F.C.P.S', 'Gynae', 'https://meet.google.com/vvq-toqb-teb', '8pm - 9pm', 700),
(3, 'Dr. Khadiza Tasnim', 'MCPS', 'Dermatology', 'https://meet.google.com/vvq-toqb-teb', '6pm - 7pm', 900),
(4, 'Dr. Arafat Hossain', 'MBBS, BCS (Health)', 'Pediatrics', 'https://meet.google.com/vvq-toqb-teb', '7pm - 8pm', 1000),
(5, 'Dr. Sabrina Ahmed', 'MPH, MBBS', 'Psychology', 'https://meet.google.com/vvq-toqb-teb', '6pm - 7pm', 900),
(6, 'Dr. Sharif Hasan', 'M.Phil, MBBS', 'Cardiology', 'https://meet.google.com/vvq-toqb-teb', '8pm - 9pm', 1000),
(7, 'Dr. Aniya Islam', 'BCS, MBBS', 'General', 'https://meet.google.com/vvq-toqb-teb', '6pm - 7pm', 900);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `medicine_category` varchar(70) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `medicine_category`, `description`, `price`) VALUES
(1, 'Flexi Capsule', 'antacids', 'Relieves pain and inflammation effectively with its potent analgesic and anti-inflammatory propertie', 10),
(2, 'Ambrox Tablet', 'antacids', 'Relieves cough and respiratory congestion with its expectorant properties, promoting easier breathin', 20),
(3, 'Entacyd Plus', 'antacids', 'Provides rapid relief from acidity and heartburn, offering effective gastrointestinal comfort and ba', 30),
(4, 'Napa Extend', 'antibiotics', 'Alleviates pain effectively with extended relief, providing long-lasting comfort for various conditi', 20),
(5, 'Napa Extra', 'antibiotics', 'Offers powerful and swift relief from pain, ensuring quick comfort for various ailments and discomfo', 10),
(6, 'Alatrol Tablet', 'antibiotics', 'Combats allergies effectively with its antihistamine properties, providing relief from symptoms such', 40),
(7, 'Omidon Tablet', 'antacids', 'Provides rapid relief from acidity and heartburn, promoting gastrointestinal comfort and balance wit', 20),
(8, 'Monas tablet', 'antibiotics', 'Combats bacterial infections effectively with its potent antibiotic properties, ensuring swift relie', 10),
(9, 'Kalcoral D', 'antidiabetic', 'Maintains calcium balance and promotes bone health with vitamin D supplementation, supporting overal', 60),
(10, 'Azithromycin', 'antibiotics', 'Its used to treat infections including: chest infections suchas pneumonia. ear, nose and throat infections', 50),
(11, 'Ciprofloxacin', 'antacids', 'Used to treat or prevent certain infections caused by bacteria such as pneumonia; gonorrhea ; typhoid fever', 70),
(12, 'Amoxicillin', 'antacids', 'used to treat bacterial infections, such as chest infections (including pneumonia) and dental abscesses.', 30),
(13, 'Citalopram', 'antidepressant', 'Citalopram, sold under the brand name Celexa among others, is an antidepressant of the selective serotonin reuptake inhibitor class.', 80),
(14, 'Fluoxetine', 'antidepressant', 'Fluoxetine, sold under the brand name Prozac, among others, is an antidepressant of the selective serotonin reuptake inhibitor class.', 120),
(15, 'Escitalopram', 'antidepressant', 'Escitalopram is mainly used to treat major depressive disorder and generalized anxiety disorder.', 58),
(16, 'Paroxetine', 'antidepressant', 'Paroxetine, A selective serotonin reuptake inhibitor used to treat major depressive disorder, panic disorder, OCD.', 80),
(17, 'sertraline', 'antidepressant', 'Highly effective, although some people find that it is more likely than other SSRIs to cause diarrhea.', 100),
(18, 'ketoprofen', 'antipyretic', 'Ketoprofen is used to relieve minor aches and pain from headaches, menstrual periods, toothaches.', 58),
(19, 'Naproxen', 'antipyretic', 'Naproxen is a non-steroidal anti-inflammatory drug (NSAID). It reduces swelling (inflammation) and pain ', 68),
(20, 'Buprofen', 'antipyretic', 'Buprofen is used to reduce fever and to relieve minor aches and pain from headaches, muscle aches', 102),
(21, 'Metformin', 'antidiabetic', 'Metformin is used to treat high blood sugar levels that are caused by a type of diabetes mellitus or sugar diabetes called type 2 diabetes.', 210),
(22, 'Glipizide', 'antidiabetic', 'Glipizide belongs to a class of drugs called sulfonylureas. It stimulates the release of insulin from the pancreas, directing your body to store blood sugar.', 160);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purchase`
--

CREATE TABLE `medicine_purchase` (
  `order_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(300) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `medicine_description` text NOT NULL,
  `medicine_price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `bkash_txn_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_purchase`
--

INSERT INTO `medicine_purchase` (`order_id`, `name`, `email`, `contact_no`, `address`, `medicine_name`, `medicine_description`, `medicine_price`, `quantity`, `total_price`, `payment_method`, `bkash_txn_number`) VALUES
(1, 'User1', 'user2025@gmail.com', '01973736711', 'Dhaka, Bangladesh', 'Ciprofloxacin', 'Used to treat or prevent certain infections caused by bacteria such as pneumonia; gonorrhea ; typhoid fever', 70, 2, '140.00', 'Bkash Payment', 'wfwwtwe32333'),
(2, 'user3', 'sds@gmail.com', '2424443534636', 'gdffdfdsvdsv', 'Monas tablet', 'Combats bacterial infections effectively with its potent antibiotic properties, ensuring swift relie', 10, 2, '20.00', 'Bkash Payment', 'gfgdvdvdggd'),
(3, 'Karim Benzema', 'karim@gmail.com', '2424443', 'Gulshan 2, Dhaka, Bangladesh', 'ketoprofen', 'Ketoprofen is used to relieve minor aches and pain from headaches, menstrual periods, toothaches.', 58, 2, '116.00', 'Cash on Delivery', ''),
(4, 'ff', 'sdfsdf@rgrg.com', '2323', 'Gulshan 2, Dhaka, Bangladesh', 'Buprofen', 'Buprofen is used to reduce fever and to relieve minor aches and pain from headaches, muscle aches', 102, 2, '204', '0', ''),
(5, 'ff', 'sdfsdf@rgrg.com', '2323', 'Gulshan 2, Dhaka, Bangladesh', 'Naproxen', 'Naproxen is a non-steroidal anti-inflammatory drug (NSAID). It reduces swelling (inflammation) and pain ', 68, 1, '68', '0', ''),
(6, 'user1', 'user9@gmail.com', '123434333', '1251 36th Street Apt #1R Brooklyn', 'Naproxen', 'Naproxen is a non-steroidal anti-inflammatory drug (NSAID). It reduces swelling (inflammation) and pain ', 68, 1, '68', '0', 'wfwwtwe32'),
(7, 'user1', 'user9@gmail.com', '123434333', '1251 36th Street Apt #1R Brooklyn', 'ketoprofen', 'Ketoprofen is used to relieve minor aches and pain from headaches, menstrual periods, toothaches.', 58, 2, '116', '0', 'wfwwtwe32'),
(8, 'user1', 'user9@gmail.com', '123434333', '1251 36th Street Apt #1R Brooklyn', 'Buprofen', 'Buprofen is used to reduce fever and to relieve minor aches and pain from headaches, muscle aches', 102, 1, '102', '0', 'wfwwtwe32'),
(9, 'check1', 'check1@gmail.com', 'check1@gmail.com', '1251 36th Street Apt #1R Brooklyn', 'ketoprofen', 'Ketoprofen is used to relieve minor aches and pain from headaches, menstrual periods, toothaches.', 58, 3, '174', '1', ''),
(10, 'Hossain', 'hossain@gmail.com', '1234566555', 'Bashindhara R/A, Dhaka', 'Naproxen', 'Naproxen is a non-steroidal anti-inflammatory drug (NSAID). It reduces swelling (inflammation) and pain ', 68, 1, '68', '2', 'gfgdvdvdggd'),
(11, 'Hossain', 'hossain@gmail.com', '1234566555', 'Bashindhara R/A, Dhaka', 'Buprofen', 'Buprofen is used to reduce fever and to relieve minor aches and pain from headaches, muscle aches', 102, 1, '102', '2', 'gfgdvdvdggd'),
(12, 'Hossain', 'admin@northsouth.edu', '1233213', 'Gulshan 2, Dhaka, Bangladesh', 'Naproxen', 'Naproxen is a non-steroidal anti-inflammatory drug (NSAID). It reduces swelling (inflammation) and pain ', 68, 1, '68', '2', 'gfgdvdvdggd');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`) VALUES
(1, 'Nabila Rahaman	', 1923272723, 'nabila.rahaman123@northsouth.edu', 'nabila123'),
(2, 'User 1', 1828228282, 'user1@gmail.com', 'user123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`emergency_id`);

--
-- Indexes for table `emergency_submission`
--
ALTER TABLE `emergency_submission`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `live_consultant`
--
ALTER TABLE `live_consultant`
  ADD PRIMARY KEY (`consult_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_purchase`
--
ALTER TABLE `medicine_purchase`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `emergency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emergency_submission`
--
ALTER TABLE `emergency_submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `live_consultant`
--
ALTER TABLE `live_consultant`
  MODIFY `consult_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `medicine_purchase`
--
ALTER TABLE `medicine_purchase`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
