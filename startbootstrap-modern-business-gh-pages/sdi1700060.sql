-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 18 Ιαν 2021 στις 20:44:32
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
  `branch` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `appointment`
--

INSERT INTO `appointment` (`branch`, `firstName`, `lastName`, `Date`, `Time`) VALUES
('Βύρωνας', 'Ευστράτιος', 'Κουτίβας', '2021-01-20', 11.5),
('Γαλάτσι', 'Νικόλαος', 'Κουτίβας', '2021-01-20', 9.5),
('Καλαμάτα', 'Βασιλική', 'Κουτουμά', '2021-01-19', 11),
('Καλαμάτα', 'Γιώργος', 'Θεοδωρόπουλος', '2021-01-19', 9),
('Καλαμάτα', 'Ελεάννα', 'Μαλέσκου', '2021-01-20', 9.5),
('Καλαμάτα', 'Ιωάννα', 'Μαδούρη', '2021-01-19', 10),
('Καλαμάτα', 'Κωνσταντίνα', 'Θεοδωροπούλου', '2021-01-19', 11.5),
('Καλαμάτα', 'Μαρία', 'Παπαδοπούλου', '2021-01-19', 9.5),
('Καλαμάτα', 'Μαρία', 'Σπάλα', '2021-01-20', 10),
('Καλαμάτα', 'Ουρανία', 'Χατζηπέτρου', '2021-01-19', 10.5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `branch`
--

CREATE TABLE `branch` (
  `Name` varchar(255) NOT NULL,
  `RegUnit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `branch`
--

INSERT INTO `branch` (`Name`, `RegUnit`) VALUES
('Ερέτρια', 'Εύβοιας'),
('Ιστιαία', 'Εύβοιας'),
('Χαλκίδα', 'Εύβοιας'),
('Βύρωνας', 'Κεντρικού Τομέα Αθηνών'),
('Γαλάτσι ', 'Κεντρικού Τομέα Αθηνών'),
('Καισαριανή', 'Κεντρικού Τομέα Αθηνών'),
('Καλαμάτα', 'Μεσσηνίας'),
('Μεσσήνη', 'Μεσσηνίας'),
('Φιλιατρά', 'Μεσσηνίας');

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
('Μεταφορική Κουτίβα', 'Καλαμάτα'),
('χαχα', 'Πύργος'),
('Μαναβική Αργολίδας', 'Τρίπολη');

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
  `workStatus` enum('suspended','remote','normal','parentalleave') CHARACTER SET utf8 NOT NULL DEFAULT 'normal',
  `companyName` varchar(255) NOT NULL,
  `hasChildYoungerThan12` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `employee`
--

INSERT INTO `employee` (`AFM`, `workStatus`, `companyName`, `hasChildYoungerThan12`) VALUES
(123456788, 'parentalleave', 'Μεταφορική Κουτίβα', 1),
(234567890, 'normal', 'Μεταφορική Κουτίβα', 0),
(345678901, 'normal', 'Μεταφορική Κουτίβα', 0),
(876543210, 'normal', 'χαχα', 1);

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
(456789012, 'Μαναβική Αργολίδας'),
(123456789, 'Μεταφορική Κουτίβα'),
(987654321, 'χαχα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employerforms`
--

CREATE TABLE `employerforms` (
  `employerAFM` int(9) NOT NULL,
  `employeeAFM` int(9) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `typeOfForm` enum('suspended','remote') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `parentalleavecertificate`
--

CREATE TABLE `parentalleavecertificate` (
  `employerAFM` int(9) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `employeeAFM` int(9) NOT NULL,
  `phoneNumber` int(10) DEFAULT NULL,
  `category` enum('YE','DE','TE','PE') CHARACTER SET utf8mb4 DEFAULT NULL,
  `property` enum('perm','IDAX','IDOX') CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `parentalleavecertificate`
--

INSERT INTO `parentalleavecertificate` (`employerAFM`, `startDate`, `endDate`, `employeeAFM`, `phoneNumber`, `category`, `property`) VALUES
(123456789, '2021-01-03', '2021-01-07', 123456788, NULL, NULL, NULL),
(123456789, '2021-01-17', '2021-01-22', 123456788, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `regionalunit`
--

CREATE TABLE `regionalunit` (
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `regionalunit`
--

INSERT INTO `regionalunit` (`Name`) VALUES
('Εύβοιας'),
('Κεντρικού Τομέα Αθηνών'),
('Μεσσηνίας');

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
(123456789, 'geokouv89', '$2y$10$utDFa1WAvZ5AX0blTlyV3O7jtqacRMxnt5TRRqu.4ci9vr2linkeW', 'Γεωργία', 'Κουτίβα', 'employer'),
(234567890, 'alexneof', '$2y$10$N69a0.wOAAgS5ugwD8LjuOkYzbTNUlraGhbEMqbj03m2YiVCS.Cey\r\n', 'Αλέξανδρος', 'Νεοφώτιστος', 'employee'),
(345678901, 'stavTheod', '$2y$10$SvlJUAWvMkzvVNL1kO4EZOCxVN20RgqHThVFAlcjTjN6sFDegpm1C', 'Σταυρούλα', 'Θεοδωρακοπούλου', 'employee'),
(456789012, 'panKout', '$2y$10$UtdF82XeJh98.MmF.bDcM.kXVSdxlG2CF8d5VV3R53YiP5MAUhZ8y', 'Παναγιώτης', 'Κουτίβας', 'employer'),
(876543210, 'MargKont', '$2y$10$9nS3bxTFR45uEC2cFNoqzeg4XDh9DQfMmpzqS3H0JMgV7KRbEMoyO', 'Μαργαρίτα', 'Κοντόλαιμου', 'employee'),
(987654321, 'MarPap', '$2y$10$9CE617Vn7hR.050RRdSwV.RpqG6I0MQICdq54Rn4yu3Tso/4gJce6', 'Μαρία', 'Παπαδοπούλου', 'employer');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`branch`,`firstName`,`lastName`,`Date`,`Time`);

--
-- Ευρετήρια για πίνακα `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Name`),
  ADD KEY `RegUnit` (`RegUnit`);

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
  ADD KEY `companyName` (`companyName`);

--
-- Ευρετήρια για πίνακα `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `company_name` (`Company_Name`);

--
-- Ευρετήρια για πίνακα `employerforms`
--
ALTER TABLE `employerforms`
  ADD PRIMARY KEY (`employerAFM`,`employeeAFM`,`startDate`,`endDate`),
  ADD KEY `suspensioncertificate_ibfk_2` (`employeeAFM`);

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
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`branch`) REFERENCES `branch` (`Name`);

--
-- Περιορισμοί για πίνακα `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`RegUnit`) REFERENCES `regionalunit` (`Name`);

--
-- Περιορισμοί για πίνακα `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`Doy`) REFERENCES `doy` (`Name`),
  ADD CONSTRAINT `company_ibfk_2` FOREIGN KEY (`Company_Name`) REFERENCES `employer` (`Company_Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`AFM`) REFERENCES `user` (`AFM`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`companyName`) REFERENCES `employer` (`Company_Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `employer_ibfk_1` FOREIGN KEY (`AFM`) REFERENCES `user` (`AFM`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `employerforms`
--
ALTER TABLE `employerforms`
  ADD CONSTRAINT `employerforms_ibfk_1` FOREIGN KEY (`employerAFM`) REFERENCES `employer` (`AFM`),
  ADD CONSTRAINT `employerforms_ibfk_2` FOREIGN KEY (`employeeAFM`) REFERENCES `employee` (`AFM`);

--
-- Περιορισμοί για πίνακα `parentalleavecertificate`
--
ALTER TABLE `parentalleavecertificate`
  ADD CONSTRAINT `parentalleavecertificate_ibfk_1` FOREIGN KEY (`employeeAFM`) REFERENCES `employee` (`AFM`),
  ADD CONSTRAINT `parentalleavecertificate_ibfk_2` FOREIGN KEY (`employerAFM`) REFERENCES `employer` (`AFM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
