-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 07:15 PM
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
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(4) NOT NULL,
  `FULLNAME` text NOT NULL,
  `EMAIL` text NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `FULLNAME`, `EMAIL`, `PASSWORD`) VALUES
(1, 'RAKIBUL HASSAN', 'rakibulhassan@gmail.com', 'rakib1234'),
(2, 'Ahsanul Ekram', 'sahil@gmail.com', 'sahil1234');

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `ID` int(4) NOT NULL,
  `FULLNAME` text NOT NULL,
  `EMAIL` text NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`ID`, `FULLNAME`, `EMAIL`, `PASSWORD`) VALUES
(1, 'Sami Hassan', 'sami@gmail.com', 'sami1234'),
(2, 'Ferdous Ahmed Oli', 'oli@gmail.com', 'oli1234'),
(3, 'Abir Hassan', 'abir@gmail.com', 'abirjsr1234'),
(4, 'Fahad Hossain', 'fahad@gmail.com', 'fahad1234');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(4) NOT NULL,
  `FULLNAME` text NOT NULL,
  `DATEOFPOST` date NOT NULL,
  `TITLE` text NOT NULL,
  `POSTBODY` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `FULLNAME`, `DATEOFPOST`, `TITLE`, `POSTBODY`) VALUES
(1, 'Nafees Hassan', '2025-06-11', 'My First Post', 'This is my first post. Hello World!'),
(2, 'Ali Ahmed', '2025-04-21', 'Hello World', 'Hello World!'),
(3, 'Ali Ahmed', '2025-06-25', 'I love coding', 'I love to code and solve problems'),
(4, 'Ali Ahmed', '2025-06-26', 'I love php', 'Php is great'),
(5, 'Ali Ahmed', '2025-06-26', 'my post', 'this is my post'),
(6, 'Rakibul Hassan Himel', '2025-06-26', 'HI', 'Hello\r\n'),
(7, 'Rakibul Hassan Himel', '2025-06-26', 'NEW POST', 'This is my test post for online blogging platform'),
(8, 'ABIR HASSAN', '2025-06-26', 'EDITOR\'S POST', 'EDITOR IS TESTING'),
(11, 'ABIR HASSAN', '2025-06-26', 'EDITOR\'S POST', 'EDITOR IS TESTING');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(4) NOT NULL,
  `FULLNAME` text NOT NULL,
  `EMAIL` text NOT NULL,
  `DATEOFBIRTH` date NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FULLNAME`, `EMAIL`, `DATEOFBIRTH`, `PASSWORD`) VALUES
(1, 'Nafees Hassan', 'nafees@gmail.com', '2000-01-01', 'nafees1234'),
(2, 'rf', 'fr@gmail.com', '2000-06-10', '12345678'),
(3, 'Ali Ahmed', 'ali@gmail.com', '2001-01-01', 'ali12345'),
(4, 'Rakibul Hassan Himel', 'himel@gmail.com', '2000-05-02', 'himel12345'),
(5, 'REZWAN KHAN', 'rezwan@gmail.com', '1995-01-02', 'Rezwan@1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
