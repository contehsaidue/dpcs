-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2022 at 12:39 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dpcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `username`, `firstname`, `lastname`, `password`) VALUES
(1, 'admin', 'Saidu', 'Conteh', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoursematerial`
--

DROP TABLE IF EXISTS `tblcoursematerial`;
CREATE TABLE IF NOT EXISTS `tblcoursematerial` (
  `mat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `matname` varchar(50) DEFAULT NULL,
  `matcontent` varchar(255) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  `prog_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `sem_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`mat_ID`),
  KEY `tut_ID` (`tut_ID`),
  KEY `prog_ID` (`prog_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `sem_ID` (`sem_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcoursematerial`
--

INSERT INTO `tblcoursematerial` (`mat_ID`, `matname`, `matcontent`, `tut_ID`, `prog_ID`, `level_ID`, `sem_ID`) VALUES
(4, 'Introduction to C ++', 'studentmaterialuploads/comps218.pdf', 3, 1, 2, 1),
(7, 'HCI - Artificial Intelligence', 'studentmaterialuploads/Human computer .pdf', 1, 1, 2, 2),
(9, 'HCI PDF  NOTES', 'studentmaterialuploads/Human computer  (1).pdf', 1, 1, 2, 2),
(10, 'Java', 'studentmaterialuploads/Programing Group Assignments.pdf', 1, 1, 2, 1),
(11, 'Structered Query Language', 'assets/studentmaterialuploads/Departmental First Semester Exams Timetable.pdf', 5, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcourses`
--

DROP TABLE IF EXISTS `tblcourses`;
CREATE TABLE IF NOT EXISTS `tblcourses` (
  `Course_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(10) DEFAULT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `credit_hour` int(11) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  `sem_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `prog_ID` int(11) DEFAULT NULL,
  `courseimage` varchar(255) NOT NULL,
  PRIMARY KEY (`Course_ID`),
  KEY `tut_ID` (`tut_ID`),
  KEY `sem_ID` (`sem_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `prog_ID` (`prog_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcourses`
--

INSERT INTO `tblcourses` (`Course_ID`, `course_code`, `course_name`, `credit_hour`, `tut_ID`, `sem_ID`, `level_ID`, `prog_ID`, `courseimage`) VALUES
(10, 'Comps 211', 'Artificial Intelligence', 3, 1, 1, 3, 1, 'assets/courseimagesuploads/1582544349phpZN228O.png'),
(11, 'Comps 214', 'Human Computer Interaction', 3, 1, 2, 2, 1, 'assets/courseimagesuploads/phs.jpg'),
(12, 'Comps 221', 'Structured Query Language', 3, 5, 1, 2, 1, 'assets/courseimagesuploads/code-820275_1280.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbldays`
--

DROP TABLE IF EXISTS `tbldays`;
CREATE TABLE IF NOT EXISTS `tbldays` (
  `days_ID` int(11) NOT NULL AUTO_INCREMENT,
  `days` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`days_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldays`
--

INSERT INTO `tbldays` (`days_ID`, `days`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `tblgrades`
--

DROP TABLE IF EXISTS `tblgrades`;
CREATE TABLE IF NOT EXISTS `tblgrades` (
  `grade_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course_ID` int(11) DEFAULT NULL,
  `prog_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  `sem_ID` int(11) DEFAULT NULL,
  `student_ID` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`grade_ID`),
  KEY `course_ID` (`course_ID`),
  KEY `prog_ID` (`prog_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `tut_ID` (`tut_ID`),
  KEY `sem_ID` (`sem_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblgrades`
--

INSERT INTO `tblgrades` (`grade_ID`, `course_ID`, `prog_ID`, `level_ID`, `tut_ID`, `sem_ID`, `student_ID`, `score`) VALUES
(3, 10, 1, 2, 1, 1, 55892, 89),
(4, 10, 1, 2, 1, 2, 55892, 90),
(5, 11, 1, 2, 1, 1, 55892, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbllevel`
--

DROP TABLE IF EXISTS `tbllevel`;
CREATE TABLE IF NOT EXISTS `tbllevel` (
  `level_ID` int(11) NOT NULL AUTO_INCREMENT,
  `level_Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`level_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllevel`
--

INSERT INTO `tbllevel` (`level_ID`, `level_Name`) VALUES
(1, 'First Year'),
(2, 'Second Year'),
(3, 'Third Year'),
(4, 'Fourth Year');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

DROP TABLE IF EXISTS `tblnews`;
CREATE TABLE IF NOT EXISTS `tblnews` (
  `news_ID` int(11) NOT NULL AUTO_INCREMENT,
  `posttitle` varchar(50) DEFAULT NULL,
  `postauthor` int(11) DEFAULT NULL,
  `postcontent` text,
  `date_published` date DEFAULT NULL,
  PRIMARY KEY (`news_ID`),
  KEY `postauthor` (`postauthor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`news_ID`, `posttitle`, `postauthor`, `postcontent`, `date_published`) VALUES
(4, 'test', 1, 'vgjvvygvyuv', '2021-12-01'),
(5, 'New session academic year', 1, 'jvdbbvjndfjbhfdhbnf', '2021-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblprograms`
--

DROP TABLE IF EXISTS `tblprograms`;
CREATE TABLE IF NOT EXISTS `tblprograms` (
  `prog_ID` int(11) NOT NULL AUTO_INCREMENT,
  `program_Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`prog_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprograms`
--

INSERT INTO `tblprograms` (`prog_ID`, `program_Name`) VALUES
(1, 'BSC Computer Science'),
(2, 'BSC Business & Information Technology'),
(3, 'BSC Electronics & Telecommunication'),
(4, 'BSC Energy Studies'),
(5, 'BSC Physics with Computer Science'),
(6, 'HD Computer Science'),
(7, 'OD Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

DROP TABLE IF EXISTS `tblsemester`;
CREATE TABLE IF NOT EXISTS `tblsemester` (
  `sem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `semester_Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sem_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`sem_ID`, `semester_Name`) VALUES
(1, 'First Semester'),
(2, 'Second Semester');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentattendace`
--

DROP TABLE IF EXISTS `tblstudentattendace`;
CREATE TABLE IF NOT EXISTS `tblstudentattendace` (
  `attendanceid` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) DEFAULT NULL,
  `tutid` int(11) DEFAULT NULL,
  `courseid` int(11) DEFAULT NULL,
  `programid` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`attendanceid`),
  KEY `studentid` (`studentid`),
  KEY `tutid` (`tutid`),
  KEY `courseid` (`courseid`),
  KEY `programid` (`programid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentattendace`
--

INSERT INTO `tblstudentattendace` (`attendanceid`, `studentid`, `tutid`, `courseid`, `programid`, `status`) VALUES
(1, 1, 1, 1, 1, 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentcourses`
--

DROP TABLE IF EXISTS `tblstudentcourses`;
CREATE TABLE IF NOT EXISTS `tblstudentcourses` (
  `student_courseID` int(11) NOT NULL AUTO_INCREMENT,
  `student_ID` int(11) DEFAULT NULL,
  `prog_ID` int(11) NOT NULL,
  `level_ID` int(11) NOT NULL,
  `course_ID` int(11) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_courseID`),
  KEY `student_ID` (`student_ID`),
  KEY `course_ID` (`course_ID`),
  KEY `tut_ID` (`tut_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentcourses`
--

INSERT INTO `tblstudentcourses` (`student_courseID`, `student_ID`, `prog_ID`, `level_ID`, `course_ID`, `tut_ID`) VALUES
(1, 1, 1, 2, 11, 1),
(2, 1, 1, 2, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentmessage`
--

DROP TABLE IF EXISTS `tblstudentmessage`;
CREATE TABLE IF NOT EXISTS `tblstudentmessage` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `hodimage` varchar(225) NOT NULL,
  `hodname` varchar(50) NOT NULL,
  `hodmessage` text,
  PRIMARY KEY (`messageID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentmessage`
--

INSERT INTO `tblstudentmessage` (`messageID`, `hodimage`, `hodname`, `hodmessage`) VALUES
(6, 'assets/images/IMG-20210325-WA0002.jpg', 'Alhaji DR. Foday M. Kallon', '      \r\n  <p class=\"lead fst-italic container\">Figurative expressions are words used in non-literal ways to create a memorable effect. Figurative language is very important in descriptive essay as it is this language that gives your writing its creative edge and makes your descriptions very unique.\r\nExample: â€œThere are specks of crumped pieces of paper in the parkâ€\r\nThe description above is somehow literal and cannot likely be memorable even though the description tells something about a place. On the other hand, we can make the description more likely to stick in the readersâ€™ mind by using some figurative language.\r\nA writer of the descriptive essay must note that not every sentence should be filled with figurative language, but using the figurative expressions in an original way at various points throughout the essay will engage the readers and that will convey your perspective on your subject.');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) DEFAULT NULL,
  `username` int(11) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `middlename` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `program` int(11) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `program` (`program`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `studentid`, `username`, `firstname`, `middlename`, `lastname`, `gender`, `level`, `program`, `password`, `photo`, `phone`) VALUES
(1, 55892, 55892, 'Saidu', 'Emmanuel', 'Conteh', '1', 2, 1, '1234', 'studentregisteruploads/IMG-20210528-WA0071.jpg', '+23277028023'),
(2, 55891, 55891, 'Samuel', 'Joseph Tamba', 'Lehbie', '1', 2, 1, '1234', 'studentregisteruploads/IMG-20210528-WA0103.jpg', '+23288001023'),
(3, 56901, 56901, 'John', 'Tamba', 'Koroma', '1', 1, 1, '1234', 'studentregisteruploads/IMG-20210410-WA0006.jpg', '+23277097843'),
(4, 55982, 55982, 'Emmanuel', '', 'Koroma', 'Male', 4, 1, '1234', 'studentregisteruploads/IMG-20210422-WA0044.jpg', '+23278456523'),
(5, 55982, 55982, 'Christiana', 'Boima', 'Kpange', 'Female', 3, 3, '1234', 'studentregisteruploads/bg-masthead.jpg', '+23278456523'),
(6, 55925, 55925, 'Amid', 'Khalil', 'Tunkara', '1', 2, 1, '1234', 'studentregisteruploads/IMG-20210528-WA0013.jpg', '+23299787872'),
(8, 55891, 55891, 'Samuel ', 'Joseph Tamba', 'Lehbie', 'Male', 3, 1, 'Lehbie1999', 'studentregisteruploads/IMG-20210528-WA0145.jpg', '079065227'),
(12, 55925, 55925, 'Mustapha', 'Kolifa', 'Kargbo', '1', 3, 1, '1234', 'studentregisteruploads/FB_IMG_16242998385374449.jpg', '+23277987623');

-- --------------------------------------------------------

--
-- Table structure for table `tbltime`
--

DROP TABLE IF EXISTS `tbltime`;
CREATE TABLE IF NOT EXISTS `tbltime` (
  `time_ID` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`time_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltime`
--

INSERT INTO `tbltime` (`time_ID`, `time`) VALUES
(1, '8:00 AM - 10:00 AM'),
(2, '10:00 AM - 12:00 PM'),
(3, '2:00 PM - 4:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbltutor`
--

DROP TABLE IF EXISTS `tbltutor`;
CREATE TABLE IF NOT EXISTS `tbltutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `designation` varchar(10) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltutor`
--

INSERT INTO `tbltutor` (`id`, `username`, `firstname`, `lastname`, `designation`, `password`, `gender`, `email`, `photo`, `phone`) VALUES
(1, 'Mrtommy', 'Michael', 'Tommy', 'Mr', '1234', 'male', 'mtommy@njala.edu.sl', 'facultyregisteruploads/FB_IMG_16310167956571564.jpg', '+23277028023'),
(2, 'Mrlabbay', 'Yayah', 'Labbay', 'Mr', '1234', 'male', 'ylabbay@njala.edu.sl', 'facultyregisteruploads/IMG_5101.JPG', '+23277028023'),
(3, 'MrAJ', 'Joseph', 'Odubenu', 'Mr', '1234', 'male', 'jodubenu@njala.edu.s', 'facultyregisteruploads/IMG-20210319-WA0041.jpg', '+23278234512'),
(4, 'Mrokafor', 'Winston', 'Okafor', 'Mr', '1234', 'male', 'wokafor@njala.edu.sl', 'facultyregisteruploads/IMG-20210907-WA0022.jpg', '+23278456523'),
(5, 'Sconteh', 'Sulaiman ', 'Conteh', 'Mr', '1234', 'male', 'sconteh@njala.edu.sl', 'facultyregisteruploads/bg-masthead.jpg', '077235436'),
(6, 'Mrchase', 'Saidu', 'Conteh', 'Mr', '1234', 'male', 'mrchase@njala.edu.sl', 'assets/facultyregisteruploads/course-3.jpg', '076235367');

-- --------------------------------------------------------

--
-- Table structure for table `tbltutorcourses`
--

DROP TABLE IF EXISTS `tbltutorcourses`;
CREATE TABLE IF NOT EXISTS `tbltutorcourses` (
  `tut_courseID` int(11) NOT NULL AUTO_INCREMENT,
  `tut_ID` int(11) DEFAULT NULL,
  `prog_ID` int(11) DEFAULT NULL,
  `course_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `sem_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`tut_courseID`),
  KEY `tut_ID` (`tut_ID`),
  KEY `prog_ID` (`prog_ID`),
  KEY `course_ID` (`course_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `sem_ID` (`sem_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltutorcourses`
--

INSERT INTO `tbltutorcourses` (`tut_courseID`, `tut_ID`, `prog_ID`, `course_ID`, `level_ID`, `sem_ID`) VALUES
(1, 1, 1, 11, 2, 1),
(2, 1, 1, 10, 3, 1),
(4, 5, 1, 12, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbltutorprogram`
--

DROP TABLE IF EXISTS `tbltutorprogram`;
CREATE TABLE IF NOT EXISTS `tbltutorprogram` (
  `tut_programID` int(11) NOT NULL AUTO_INCREMENT,
  `prog_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`tut_programID`),
  KEY `prog_ID` (`prog_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `tut_ID` (`tut_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltutorprogram`
--

INSERT INTO `tbltutorprogram` (`tut_programID`, `prog_ID`, `level_ID`, `tut_ID`) VALUES
(2, 1, 2, 3),
(3, 1, 3, 1),
(4, 1, 2, 5),
(6, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltutortimetable`
--

DROP TABLE IF EXISTS `tbltutortimetable`;
CREATE TABLE IF NOT EXISTS `tbltutortimetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_ID` int(11) DEFAULT NULL,
  `level_ID` int(11) DEFAULT NULL,
  `Course_ID` int(11) DEFAULT NULL,
  `tut_ID` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prog_ID` (`prog_ID`),
  KEY `level_ID` (`level_ID`),
  KEY `Course_ID` (`Course_ID`),
  KEY `tut_ID` (`tut_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltutortimetable`
--

INSERT INTO `tbltutortimetable` (`id`, `prog_ID`, `level_ID`, `Course_ID`, `tut_ID`, `days`, `time`) VALUES
(12, 1, 2, 8, 1, 4, 2),
(6, 1, 3, 8, 1, 2, 2),
(3, 1, 2, 9, 5, 3, 3),
(7, 1, 2, 1, 1, 1, 1),
(8, 1, 2, 8, 1, 2, 2),
(17, 1, 2, 8, 1, 5, 3),
(13, 1, 2, 8, 1, 6, 1),
(14, 1, 2, 8, 1, 2, 2),
(16, 1, 2, 9, 5, 4, 1),
(18, 1, 2, 9, 5, 5, 2),
(19, 1, 2, 11, 1, 1, 2),
(20, 1, 2, 12, 5, 2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcoursematerial`
--
ALTER TABLE `tblcoursematerial`
  ADD CONSTRAINT `tblcoursematerial_ibfk_1` FOREIGN KEY (`tut_ID`) REFERENCES `tbltutor` (`id`),
  ADD CONSTRAINT `tblcoursematerial_ibfk_2` FOREIGN KEY (`prog_ID`) REFERENCES `tblprograms` (`prog_ID`),
  ADD CONSTRAINT `tblcoursematerial_ibfk_3` FOREIGN KEY (`level_ID`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tblcoursematerial_ibfk_4` FOREIGN KEY (`sem_ID`) REFERENCES `tblsemester` (`sem_ID`);

--
-- Constraints for table `tblcourses`
--
ALTER TABLE `tblcourses`
  ADD CONSTRAINT `tblcourses_ibfk_1` FOREIGN KEY (`tut_ID`) REFERENCES `tbltutor` (`id`),
  ADD CONSTRAINT `tblcourses_ibfk_2` FOREIGN KEY (`sem_ID`) REFERENCES `tblsemester` (`sem_ID`),
  ADD CONSTRAINT `tblcourses_ibfk_3` FOREIGN KEY (`level_ID`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tblcourses_ibfk_4` FOREIGN KEY (`prog_ID`) REFERENCES `tblprograms` (`prog_ID`);

--
-- Constraints for table `tblgrades`
--
ALTER TABLE `tblgrades`
  ADD CONSTRAINT `tblgrades_ibfk_1` FOREIGN KEY (`course_ID`) REFERENCES `tblcourses` (`Course_ID`),
  ADD CONSTRAINT `tblgrades_ibfk_2` FOREIGN KEY (`prog_ID`) REFERENCES `tblprograms` (`prog_ID`),
  ADD CONSTRAINT `tblgrades_ibfk_3` FOREIGN KEY (`level_ID`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tblgrades_ibfk_4` FOREIGN KEY (`tut_ID`) REFERENCES `tbltutor` (`id`),
  ADD CONSTRAINT `tblgrades_ibfk_5` FOREIGN KEY (`sem_ID`) REFERENCES `tblsemester` (`sem_ID`);

--
-- Constraints for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD CONSTRAINT `tblnews_ibfk_1` FOREIGN KEY (`postauthor`) REFERENCES `tbladmin` (`id`);

--
-- Constraints for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD CONSTRAINT `tblstudents_ibfk_1` FOREIGN KEY (`level`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tblstudents_ibfk_2` FOREIGN KEY (`program`) REFERENCES `tblprograms` (`prog_ID`);

--
-- Constraints for table `tbltutorcourses`
--
ALTER TABLE `tbltutorcourses`
  ADD CONSTRAINT `tbltutorcourses_ibfk_1` FOREIGN KEY (`tut_ID`) REFERENCES `tbltutor` (`id`),
  ADD CONSTRAINT `tbltutorcourses_ibfk_2` FOREIGN KEY (`prog_ID`) REFERENCES `tblprograms` (`prog_ID`),
  ADD CONSTRAINT `tbltutorcourses_ibfk_3` FOREIGN KEY (`course_ID`) REFERENCES `tblcourses` (`Course_ID`),
  ADD CONSTRAINT `tbltutorcourses_ibfk_4` FOREIGN KEY (`level_ID`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tbltutorcourses_ibfk_5` FOREIGN KEY (`sem_ID`) REFERENCES `tblsemester` (`sem_ID`);

--
-- Constraints for table `tbltutorprogram`
--
ALTER TABLE `tbltutorprogram`
  ADD CONSTRAINT `tbltutorprogram_ibfk_1` FOREIGN KEY (`prog_ID`) REFERENCES `tblprograms` (`prog_ID`),
  ADD CONSTRAINT `tbltutorprogram_ibfk_2` FOREIGN KEY (`level_ID`) REFERENCES `tbllevel` (`level_ID`),
  ADD CONSTRAINT `tbltutorprogram_ibfk_3` FOREIGN KEY (`tut_ID`) REFERENCES `tbltutor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
