-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2018 at 07:16 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `nursestrainingapp`
--
DROP DATABASE IF EXISTS NursesTrainingApp;
CREATE DATABASE IF NOT EXISTS NursesTrainingApp;

use `NursesTrainingApp`;
-- --------------------------------------------------------

--
-- Table structure for table `course_section`
--

DROP TABLE IF EXISTS `Module`;
CREATE TABLE IF NOT EXISTS `Module` (
  `ModuleID` int(11) NOT NULL,
  `ModuleName` varchar(255) DEFAULT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ModuleID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `documentID` int(11) NOT NULL AUTO_INCREMENT,
  `documentFile` varchar(255) DEFAULT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`documentID`),
  KEY `fk_document-course` (`ModuleID`)
); 

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

DROP TABLE IF EXISTS `lookup`;
CREATE TABLE IF NOT EXISTS `lookup` (
  `lookupID` int(11) NOT NULL AUTO_INCREMENT,
  `lookupName` varchar(255) NOT NULL,
  `lookupValue` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lookupID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permissionID` int(11) NOT NULL AUTO_INCREMENT,
  `permissionName` varchar(255) NOT NULL,
  `permissionDescription` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`permissionID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `schoolID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(255) NOT NULL,
  `schoolState` varchar(255) DEFAULT 'CT',
  `schoolCountry` varchar(255) DEFAULT 'USA',
  PRIMARY KEY (`schoolID`)
) ;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolName`) VALUES
('Albertus Magnus College'),
('Asnuntuck Community College'),
('Capital Community College'),
('Central Connecticut State University'),
('Connecticut College'),
('Eastern Connecticut State University'),
('Fairfield University'),
('Gateway Community College'),
('Goodwin College'),
('Holy Apostles College and Seminary'),
('Housatonic Community College'),
('Lincoln College of New England Hartford'),
('Lincoln College of New England Southington'),
('Lincoln College of New England Suffield'),
('Lyme Academy College of Fine Arts'),
('Manchester Community College'),
('Middlesex Community College'),
('Mitchell College'),
('Naugatuck Valley Community College'),
('Northwestern Connecticut Community College'),
('Norwalk Community College'),
('Paier College of Art Inc'),
('Post University'),
('Quinebaug Valley Community College'),
('Quinnipiac University'),
('Sacred Heart University'),
('Saint Joseph College'),
('Sanford Brown College Farmington'),
('Southern Connecticut State University'),
('St Vincents College'),
('Three Rivers Community College'),
('Trinity College'),
('Tunxis Community College'),
('United States Coast Guard Academy'),
('University of Bridgeport'),
('University of Connecticut'),
('University of Connecticut Avery Point'),
('University of Connecticut Stamford'),
('University of Connecticut Tri Campus'),
('University of Hartford'),
('University of New Haven'),
('University of Phoenix Fairfield County Campus'),
('Wesleyan University'),
('Western Connecticut State University'),
('Yale University'),
('other');

-- --------------------------------------------------------

--
-- Table structure for table `test_answer`
--

DROP TABLE IF EXISTS `test_answer`;
CREATE TABLE IF NOT EXISTS `test_answer` (
  `questionID` int(11), 
  `ModuleID` int(11),
  `answerID` int (11) not null auto_increment,
  `answertext` varchar(255) DEFAULT NULL,
  `isAnswer`  int(1) DEFAULT 0,
  `isActive` varchar(1),
  `testID` varchar(11), 
  `createdBy` varchar(255) ,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answerID`),
  KEY   fk_test_testID   (testID),
  KEY   fk_test_question   (ModuleID,questionID)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

DROP TABLE IF EXISTS `test_question`;
CREATE TABLE IF NOT EXISTS `test_question` (
  `ModuleID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `questiontext` varchar(255) DEFAULT NULL,
  `complexity` varchar(255) DEFAULT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   KEY `fk_ques_moduleid` (`ModuleID`) ,
   constraint pk_questionid primary key (ModuleID,questionID)
  
) ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `securityQuestion` varchar(255) NOT NULL,
  `securityAnswer` varchar(255) NOT NULL,
  `graduationYear` int(4) NOT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `universityFlag` char(1) NOT NULL,
  `otherUniversity` varchar(255) DEFAULT NULL,
  `schoolID` int(11) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user-school` (`schoolID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
CREATE TABLE IF NOT EXISTS `user_permission` (
  `userPermissionID` int(11) NOT NULL AUTO_INCREMENT,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `permissionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`userPermissionID`),
  KEY `fk_permissions-userpermissions` (`permissionID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `user_test`
--

DROP TABLE IF EXISTS `user_test`;
CREATE TABLE IF NOT EXISTS `user_test` (
  `ModuleID` int(11) NOT NULL,
  `testID` int(11) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isCorrect` int(1) DEFAULT 0,
  `answerID` int(11) DEFAULT NULL,
  `questionID` int(11) DEFAULT NULL,
  KEY fk_usertest_question (ModuleID,questionID ) ,
  KEY fk_usertest_answer (answerID)
  
) ;

-- --------------------------------------------------------

--
-- Table structure for table `user_test_result`
--

DROP TABLE IF EXISTS `user_test_result`;
CREATE TABLE IF NOT EXISTS `user_test_result` (
  `resultID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `testID` int(11) DEFAULT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` int(3) DEFAULT NULL,
  PRIMARY KEY (`resultID`),
  KEY `fk_result-user` (`userID`),
  KEY `fk_result-test` (`testID`)
) ;
COMMIT;

