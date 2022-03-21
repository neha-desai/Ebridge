-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 03:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebdrige`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

CREATE TABLE `admintable` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Username` varchar(256) NOT NULL,
  `Admin_Name` varchar(256) NOT NULL,
  `Admin_Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`Admin_ID`, `Admin_Username`, `Admin_Name`, `Admin_Password`) VALUES
(1, 'Jeet', 'Jeet Doshi', 'Jeet@Doshi');

-- --------------------------------------------------------

--
-- Table structure for table `allotment`
--

CREATE TABLE `allotment` (
  `Student_ID` int(11) NOT NULL,
  `Exam_ID` int(11) NOT NULL,
  `Room_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allotment`
--

INSERT INTO `allotment` (`Student_ID`, `Exam_ID`, `Room_ID`) VALUES
(12, 21, 1),
(13, 21, 1),
(14, 21, 1),
(15, 21, 1),
(16, 21, 1),
(17, 21, 1),
(18, 21, 1),
(19, 21, 1),
(20, 21, 1),
(21, 21, 1),
(12, 20, 2),
(13, 20, 2),
(14, 20, 2),
(15, 20, 2),
(16, 20, 2),
(17, 20, 2),
(18, 20, 2),
(19, 20, 2),
(20, 20, 2),
(21, 20, 2),
(22, 20, 2),
(23, 20, 2),
(24, 20, 2),
(25, 20, 2),
(26, 20, 2),
(12, 22, 3),
(13, 22, 3),
(14, 22, 3),
(15, 22, 3),
(16, 22, 3),
(17, 22, 3),
(18, 22, 3),
(19, 22, 3),
(20, 22, 3),
(21, 22, 3),
(22, 22, 3),
(23, 22, 3),
(24, 22, 3),
(25, 22, 3),
(26, 22, 3),
(12, 23, 2),
(13, 23, 2),
(14, 23, 2),
(15, 23, 2),
(16, 23, 2),
(17, 23, 2),
(18, 23, 2),
(19, 23, 2),
(20, 23, 2),
(21, 23, 2),
(22, 23, 2),
(23, 23, 2),
(24, 23, 2),
(25, 23, 2),
(26, 23, 2),
(28, 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Department_ID` int(11) NOT NULL,
  `Department_Name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Department_ID`, `Department_Name`) VALUES
(1, 'Computer Engineering'),
(2, 'Information Technology'),
(3, 'Mechanical Engineering'),
(4, 'Electronics and Telecommunication'),
(8, 'Civil Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `Exam_ID` int(11) NOT NULL,
  `Exam_Name` varchar(256) NOT NULL,
  `Exam_Date` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Subject_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Exam_ID`, `Exam_Name`, `Exam_Date`, `Start_Time`, `End_Time`, `Subject_ID`) VALUES
(20, '', '2021-11-22', '12:00:00', '14:00:00', 14),
(21, '', '2021-11-23', '12:00:00', '14:00:00', 15),
(22, '', '2021-11-23', '12:00:00', '14:00:00', 16),
(23, '', '2021-11-20', '15:32:00', '17:36:00', 18);

-- --------------------------------------------------------

--
-- Table structure for table `leavedetails`
--

CREATE TABLE `leavedetails` (
  `Leave_ID` int(11) NOT NULL,
  `Teacher_ID` int(11) NOT NULL,
  `SDescription` varchar(256) NOT NULL,
  `StartDate` varchar(256) NOT NULL,
  `Till_Date` varchar(100) NOT NULL,
  `Applied_Date` date NOT NULL DEFAULT current_timestamp(),
  `Applied_Time` time NOT NULL DEFAULT current_timestamp(),
  `LeaveType` int(11) NOT NULL,
  `SStatus` int(11) NOT NULL,
  `Rejected_Reason` varchar(526) NOT NULL,
  `RejectedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leavedetails`
--

INSERT INTO `leavedetails` (`Leave_ID`, `Teacher_ID`, `SDescription`, `StartDate`, `Till_Date`, `Applied_Date`, `Applied_Time`, `LeaveType`, `SStatus`, `Rejected_Reason`, `RejectedBy`) VALUES
(44, 28, '', '2021-11-18', '2021-11-18', '2021-11-11', '00:32:06', 0, 1, 'Exams are near. Too much work load.', 32),
(45, 28, 'I have lec in IT Dept today. Give it to Akshay Sir.', '2021-11-12', '2021-11-13', '2021-11-11', '13:37:36', 3, 2, 'TOO MUCH WORK LOAD', 33),
(46, 34, '', '2022-02-18', '2022-02-19', '2022-02-17', '19:58:17', 3, 0, '', NULL),
(47, 34, 'Please give my lectures to Akshay sir', '2022-02-21', '2022-02-26', '2022-02-17', '19:58:51', 3, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `Lec_ID` int(11) NOT NULL,
  `Lec_Date` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Subject_ID` int(11) NOT NULL,
  `Teacher_ID` int(11) NOT NULL,
  `attendance` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`Lec_ID`, `Lec_Date`, `Start_Time`, `End_Time`, `Subject_ID`, `Teacher_ID`, `attendance`) VALUES
(7, '2022-01-14', '17:07:00', '20:03:00', 14, 28, '1,2,3'),
(8, '2022-01-20', '17:08:00', '18:08:00', 18, 28, '4,1,5,6'),
(9, '2022-01-13', '18:23:00', '18:23:00', 14, 28, '7,8,9'),
(12, '2022-01-21', '12:44:00', '13:44:00', 14, 28, '6,7,8'),
(13, '2022-01-17', '09:00:00', '10:00:00', 16, 29, '1,6,9'),
(14, '2022-01-18', '09:00:00', '10:00:00', 16, 29, '1,2,3'),
(15, '2022-02-17', '09:00:00', '10:00:00', 18, 28, '3,4,7'),
(16, '2022-02-18', '10:48:00', '11:48:00', 14, 28, '1,12,4,5,8'),
(17, '2022-02-18', '10:42:00', '11:42:00', 18, 28, '3,4,7'),
(18, '2022-02-18', '10:54:00', '11:55:00', 14, 28, '1,12,4,5,8');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `Notice_ID` int(11) NOT NULL,
  `NoticeTitle` varchar(256) NOT NULL,
  `NoticeDescription` varchar(2000) NOT NULL,
  `Teacher_ID` int(11) NOT NULL,
  `Dept_ID` int(11) NOT NULL,
  `Date_Uploaded` date NOT NULL DEFAULT current_timestamp(),
  `Time_Uploaded` timestamp NOT NULL DEFAULT current_timestamp(),
  `NoticeImage` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`Notice_ID`, `NoticeTitle`, `NoticeDescription`, `Teacher_ID`, `Dept_ID`, `Date_Uploaded`, `Time_Uploaded`, `NoticeImage`) VALUES
(10, 'Student Remedial notice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 28, 2, '2022-02-12', '2022-02-12 15:05:22', 'Std 5 Maths Ch.12 NB (1).pdf'),
(11, 'Exam Notice', 'Please check the portal for hall ticket and exam time table', 28, 2, '2022-02-13', '2022-02-12 19:49:28', 'K283C49AdmitCard.pdf'),
(12, 'EXAM FORM NOTICE SEM-VII & VIII', 'All the BE (CIVIL/COMPUTER/IT/EXTC/ETRX) Students are hereby  informed that the last date of filling the KT exam form (Sem – VII & VIII) in  University Site:-', 34, 2, '2022-02-17', '2022-02-17 14:35:49', 'EXAM FORM NOTICE SEM-VII & VIII.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` int(11) NOT NULL,
  `Room_Number` int(11) NOT NULL,
  `Strength` int(11) NOT NULL,
  `Floor_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `Room_Number`, `Strength`, `Floor_No`) VALUES
(1, 101, 15, 1),
(2, 102, 15, 1),
(3, 103, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomstatus`
--

CREATE TABLE `roomstatus` (
  `Room_ID` int(11) NOT NULL,
  `EDate` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomstatus`
--

INSERT INTO `roomstatus` (`Room_ID`, `EDate`, `Start_Time`, `End_Time`) VALUES
(1, '2021-10-19', '12:00:00', '14:00:00'),
(2, '2021-10-19', '11:00:00', '13:00:00'),
(1, '2021-11-19', '11:30:00', '13:30:00'),
(2, '2021-11-19', '11:30:00', '13:30:00'),
(1, '2021-11-23', '12:00:00', '14:00:00'),
(2, '2021-11-22', '12:00:00', '14:00:00'),
(3, '2021-11-23', '12:00:00', '14:00:00'),
(2, '2021-11-20', '15:32:00', '17:36:00'),
(2, '2021-11-23', '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seatno`
--

CREATE TABLE `seatno` (
  `ID` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `Seat_No` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Student_Name` varchar(256) NOT NULL,
  `Department` int(11) NOT NULL,
  `Semester` int(11) NOT NULL,
  `SeatNo` varchar(11) NOT NULL,
  `RollNo` int(11) NOT NULL,
  `EmailID` varchar(256) NOT NULL,
  `SPassword` varchar(256) NOT NULL,
  `CandidatePhoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `Student_Name`, `Department`, `Semester`, `SeatNo`, `RollNo`, `EmailID`, `SPassword`, `CandidatePhoto`) VALUES
(12, 'AOUDICHYA SATISH ASHOK', 2, 7, 'C21156001', 1, 'satish.aoudichya@universal.edu.in', 'SATISH', 'images.jpg'),
(13, 'BAGALKOT SONIA MAHADEV', 2, 7, 'C21156002', 2, 'sonio.bagalkot@universal.edu.in', 'SONIA', 'imageGirl.jpg'),
(14, 'BAROT ISHAN PRAKASH', 2, 7, 'C21156003', 3, 'ishan.prakash@universal.edu.in', 'ISHAN', 'images.jpg'),
(15, 'BHEDA AKSHAT KHUSHAL', 2, 7, 'C21156004', 4, 'akshat.bheda@universal.edu.in', 'AKSHAT', 'images.jpg'),
(16, 'BUTOLA SAMEER PREM', 2, 7, 'C21156005', 5, 'sameer.butola@universal.edu.in', 'SAMEER', 'images.jpg'),
(17, 'CHANDURA DARSH BHADRESH', 2, 7, 'C21156006', 6, 'darsh.chandura@universal.edu.in', 'DARSH', 'images.jpg'),
(18, 'CHAUDHARY PAYAL SHANTIBHAI', 2, 7, 'C21156007', 7, 'payal.chaudhary@universal.edu.in', 'PAYAL', 'imageGirl.jpg'),
(19, 'CHOUDHARY PREM NEMICHAND', 2, 7, 'C21156008', 8, 'prem.choudhary@universal.edu.in', 'PREM ', 'images.jpg'),
(20, 'DEDHIA CHANDRESH KHUSHAL', 2, 7, 'C21156009', 9, 'chnadresh.dedhia@universal.edu.in', 'CHANDRESH', 'images.jpg'),
(21, 'DEDHIA MIHIR KIRTI', 2, 7, 'C21156010', 10, 'mihir.dedhia@universal.edu.in', 'MIHIR', 'images.jpg'),
(22, 'DOSHI AASHKA GOPAL', 2, 7, 'C21156011', 11, 'aashka.doshi@universal.edu.in', 'AASHKA', 'imageGirl.jpg'),
(23, 'DOSHI JEET AJAY', 2, 7, 'C21156012', 12, 'jeet.doshi@universal.edu.in', 'JEET', 'images.jpg'),
(24, 'GHIMIRE RAHUL TULSIRAM', 2, 7, 'C21156013', 13, 'rahul.ghimire@universal.edu.in', 'RAHUL', 'images.jpg'),
(25, 'GOGRI SHUBHAM PRAKASH', 2, 7, 'C21156014', 14, 'shubham.gogri@universal.edu.in', 'SHUBHAM', 'images.jpg'),
(26, 'HEGISHTE ANUJ SHUSHANT', 2, 7, 'C21156015', 15, 'anuj.hegishte@universal.edu.in', 'ANUJ', 'images.jpg'),
(27, 'INTWALA UDIT SANDEEP', 2, 7, 'C21156016', 16, 'udit.intwala@universal.edu.in', 'UDIT', 'images.jpg'),
(28, 'AKSHAY KAUSHIK MANIAR', 2, 7, 'C21156030', 30, 'akshay.maniar@universal.edu.in', 'akshay', 'images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `Subject_ID` int(11) NOT NULL,
  `Subject_Name` varchar(256) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Dept_ID` int(11) NOT NULL,
  `Subject_Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_table`
--

INSERT INTO `subject_table` (`Subject_ID`, `Subject_Name`, `Semester`, `Teacher_ID`, `Dept_ID`, `Subject_Type`) VALUES
(14, 'Artificial Intelligence', 7, 28, 2, 1),
(15, 'Infrastructure Security', 7, 31, 2, 1),
(16, 'Cyber Security and Law', 7, 29, 2, 1),
(17, 'Enterprise Network Development', 7, 30, 2, 1),
(18, 'Mobile Application Development', 7, 28, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(11) NOT NULL,
  `TeacherName` varchar(256) NOT NULL,
  `Username` varchar(256) NOT NULL,
  `SPassword` varchar(256) NOT NULL,
  `TeacherLevel` int(11) NOT NULL,
  `Dept_ID` int(11) NOT NULL,
  `NoofLeaves` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Teacher_ID`, `TeacherName`, `Username`, `SPassword`, `TeacherLevel`, `Dept_ID`, `NoofLeaves`) VALUES
(28, 'JIGAR CHAUHAN', 'jigar.chauhan@universal.edu.in', 'JIGAR', 0, 2, 29),
(29, 'CHINNMAY RAUT', 'chinnmay.raut@universal.edu.in', 'CHINNMAY', 0, 2, 30),
(30, 'ROVINA DIBBRITTO', 'rovina.dibbritto@universal.edu.in', 'ROVINA', 0, 2, 30),
(31, 'SANKETI RAUT', 'sanketi.raut@universal.edu.in', 'SANKETI', 0, 2, 30),
(32, 'YOGITA MANE', 'yogita.mane@universal.edu.in', 'YOGITA', 1, 2, 30),
(33, 'JITENDRA PATIL', 'jitendra.patil@universal.edu.in', 'JITENDRA', 2, 2, 30),
(34, 'MUDRA DOSHI', 'mudra.doshi@universal.edu.in', 'MUDRA', 0, 2, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `allotment`
--
ALTER TABLE `allotment`
  ADD KEY `StudentAllot` (`Student_ID`),
  ADD KEY `ExamAllot` (`Exam_ID`),
  ADD KEY `roomAllot` (`Room_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Department_ID`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`Exam_ID`),
  ADD UNIQUE KEY `Subject_ID` (`Subject_ID`);

--
-- Indexes for table `leavedetails`
--
ALTER TABLE `leavedetails`
  ADD PRIMARY KEY (`Leave_ID`),
  ADD KEY `TeachersData` (`Teacher_ID`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`Lec_ID`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`Notice_ID`),
  ADD KEY `TeacherNotice` (`Teacher_ID`),
  ADD KEY `DepartmentNotice` (`Dept_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`);

--
-- Indexes for table `seatno`
--
ALTER TABLE `seatno`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `StudentDepartment` (`Department`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`Subject_ID`),
  ADD KEY `DepartmentSubject` (`Dept_ID`),
  ADD KEY `Teacher` (`Teacher_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`),
  ADD KEY `DepartnameName` (`Dept_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintable`
--
ALTER TABLE `admintable`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `Exam_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `leavedetails`
--
ALTER TABLE `leavedetails`
  MODIFY `Leave_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `Lec_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `Notice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seatno`
--
ALTER TABLE `seatno`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subject_table`
--
ALTER TABLE `subject_table`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allotment`
--
ALTER TABLE `allotment`
  ADD CONSTRAINT `ExamAllot` FOREIGN KEY (`Exam_ID`) REFERENCES `exam` (`Exam_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentAllot` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomAllot` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `leavedetails`
--
ALTER TABLE `leavedetails`
  ADD CONSTRAINT `TeachersData` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `DepartmentNotice` FOREIGN KEY (`Dept_ID`) REFERENCES `department` (`Department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TeacherNotice` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `StudentDepartment` FOREIGN KEY (`Department`) REFERENCES `department` (`Department_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD CONSTRAINT `DepartmentSubject` FOREIGN KEY (`Dept_ID`) REFERENCES `department` (`Department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Teacher` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `DepartnameName` FOREIGN KEY (`Dept_ID`) REFERENCES `department` (`Department_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
