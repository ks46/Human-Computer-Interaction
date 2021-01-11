-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 11 Ιαν 2021 στις 23:02:19
-- Έκδοση διακομιστή: 10.4.17-MariaDB
-- Έκδοση PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `sdi1700060`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `appointment`
--

CREATE TABLE `appointment` (
  `AFM` int(9) NOT NULL,
  `branchName` varchar(255) NOT NULL,
  `regUnit` varchar(255) NOT NULL,
  `apptTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `branch`
--

CREATE TABLE `branch` (
  `Name` varchar(255) NOT NULL,
  `RegUnit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `company`
--

CREATE TABLE `company` (
  `Company_Name` varchar(255) NOT NULL,
  `Doy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `company`
--

INSERT INTO `company` (`Company_Name`, `Doy`) VALUES
('Μεταφορική Κουτίβα', 'Καλαμάτα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `doy`
--

CREATE TABLE `doy` (
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `doy`
--

INSERT INTO `doy` (`Name`) VALUES
('Αμαλιάδα'),
('Άργος'),
('Καλαμάτα'),
('Κόρινθος'),
('Ναύπλιο'),
('Πύργος'),
('Σπάρτη'),
('Τρίπολη');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employee`
--

CREATE TABLE `employee` (
  `AFM` int(9) NOT NULL,
  `workStatus` enum('suspended','remote','normal') CHARACTER SET utf8 NOT NULL DEFAULT 'normal',
  `companyName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `hasChildYoungerThan12` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `employee`
--

INSERT INTO `employee` (`AFM`, `workStatus`, `companyName`, `hasChildYoungerThan12`) VALUES
(123456788, 'normal', 'Μεταφορική Κουτίβα', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employer`
--

CREATE TABLE `employer` (
  `AFM` int(9) NOT NULL,
  `Company_Name` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `employer`
--

INSERT INTO `employer` (`AFM`, `Company_Name`) VALUES
(123456789, 'Μεταφορική Κουτίβα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `parentalleavecertificate`
--

CREATE TABLE `parentalleavecertificate` (
  `employerAFM` int(9) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `employeeAFM` int(9) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `category` enum('YE','DE','TE','PE') NOT NULL,
  `property` enum('perm','IDAX','IDOX') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `regionalunit`
--

CREATE TABLE `regionalunit` (
  `Name` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `suspensioncertificate`
--

CREATE TABLE `suspensioncertificate` (
  `employerAFM` int(9) NOT NULL,
  `employeeAFM` int(9) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `employer_EMail` varchar(255) NOT NULL,
  `employee_EMail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `AFM` int(9) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(35) CHARACTER SET utf8mb4 NOT NULL,
  `type` enum('employer','employee') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`AFM`, `username`, `password`, `first_name`, `last_name`, `type`) VALUES
(123456788, 'ks', '$2y$10$8w.9pAoG8hU9B1vBZJkpueWk5w43fMqY1JBQqTDbbV8JTQw65Fyq.', 'Κωνσταντίνα', 'Σταφυλά', 'employee'),
(123456789, 'geokouv89', '$2y$10$utDFa1WAvZ5AX0blTlyV3O7jtqacRMxnt5TRRqu.4ci9vr2linkeW', 'Γεωργία', 'Κουτίβα', 'employer');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AFM`,`branchName`,`apptTime`),
  ADD UNIQUE KEY `regUnit` (`regUnit`),
  ADD KEY `branchName` (`branchName`);

--
-- Ευρετήρια για πίνακα `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Name`),
  ADD UNIQUE KEY `RegUnit` (`RegUnit`);

--
-- Ευρετήρια για πίνακα `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_Name`),
  ADD UNIQUE KEY `DOY` (`Doy`);

--
-- Ευρετήρια για πίνακα `doy`
--
ALTER TABLE `doy`
  ADD PRIMARY KEY (`Name`);

--
-- Ευρετήρια για πίνακα `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `companyname` (`companyName`);

--
-- Ευρετήρια για πίνακα `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `company_name` (`Company_Name`);

--
-- Ευρετήρια για πίνακα `parentalleavecertificate`
--
ALTER TABLE `parentalleavecertificate`
  ADD PRIMARY KEY (`employerAFM`,`startDate`,`endDate`,`employeeAFM`),
  ADD KEY `employeeAFM` (`employeeAFM`);

--
-- Ευρετήρια για πίνακα `regionalunit`
--
ALTER TABLE `regionalunit`
  ADD PRIMARY KEY (`Name`);

--
-- Ευρετήρια για πίνακα `suspensioncertificate`
--
ALTER TABLE `suspensioncertificate`
  ADD PRIMARY KEY (`employerAFM`,`employeeAFM`,`startDate`,`endDate`),
  ADD KEY `suspensioncertificate_ibfk_2` (`employeeAFM`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `usernames` (`username`);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`AFM`) REFERENCES `user` (`AFM`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`branchName`) REFERENCES `branch` (`Name`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`regUnit`) REFERENCES `branch` (`RegUnit`);

--
-- Περιορισμοί για πίνακα `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`RegUnit`) REFERENCES `regionalunit` (`Name`);

--
-- Περιορισμοί για πίνακα `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`Doy`) REFERENCES `doy` (`Name`);

--
-- Περιορισμοί για πίνακα `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`AFM`) REFERENCES `user` (`AFM`);

--
-- Περιορισμοί για πίνακα `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `employer_ibfk_1` FOREIGN KEY (`AFM`) REFERENCES `user` (`AFM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employer_ibfk_2` FOREIGN KEY (`Company_Name`) REFERENCES `company` (`Company_Name`);

--
-- Περιορισμοί για πίνακα `parentalleavecertificate`
--
ALTER TABLE `parentalleavecertificate`
  ADD CONSTRAINT `parentalleavecertificate_ibfk_1` FOREIGN KEY (`employeeAFM`) REFERENCES `employee` (`AFM`),
  ADD CONSTRAINT `parentalleavecertificate_ibfk_2` FOREIGN KEY (`employerAFM`) REFERENCES `employer` (`AFM`);

--
-- Περιορισμοί για πίνακα `suspensioncertificate`
--
ALTER TABLE `suspensioncertificate`
  ADD CONSTRAINT `suspensioncertificate_ibfk_1` FOREIGN KEY (`employerAFM`) REFERENCES `employer` (`AFM`),
  ADD CONSTRAINT `suspensioncertificate_ibfk_2` FOREIGN KEY (`employeeAFM`) REFERENCES `employee` (`AFM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
