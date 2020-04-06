-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: mysql502.discountasp.net    Database: accounts
-- ------------------------------------------------------
-- Server version	5.6.34

DROP DATABASE IF EXISTS `accounts`;
CREATE DATABASE IF NOT EXISTS `accounts`;
USE `accounts`;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `FirstName` varchar(2) NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `City` varchar(11) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserNumber` int (3) DEFAULT NULL,
  PRIMARY KEY (`usernumber`),
  KEY `lastname` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
UNLOCK TABLES;




