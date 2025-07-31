-- Create Database
CREATE DATABASE SunnySpot;
USE SunnySpot;

-- Create Tables
CREATE TABLE Cabin (
    cabinID BIGINT AUTO_INCREMENT PRIMARY KEY,
    cabinType VARCHAR(150) NOT NULL,
    cabinDescription VARCHAR(255),
    pricePerNight BIGINT(10) NOT NULL,
    pricePerWeek DECIMAL(10,2) NOT NULL,
    photo VARCHAR(50)
);

CREATE TABLE CabinInclusion (
    cabinIncID BIGINT AUTO_INCREMENT PRIMARY KEY,
    cabinID BIGINT NOT NULL,
    incID BIGINT NOT NULL,
    FOREIGN KEY (cabinID) REFERENCES Cabin(cabinID),
    FOREIGN KEY (incID) REFERENCES Inclusion(incID)
);

CREATE TABLE Inclusion (
    incID BIGINT AUTO_INCREMENT PRIMARY KEY,
    incName VARCHAR(50) NOT NULL,
    incDetails VARCHAR(255)
);

CREATE TABLE Admin (
    staffID BIGINT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(200) NOT NULL,
    address VARCHAR(200) NOT NULL,
    mobile VARCHAR(8) NOT NULL
);

CREATE TABLE Log (
    logID BIGINT AUTO_INCREMENT PRIMARY KEY,
    staffID BIGINT NOT NULL,
    loginDateTime TIMESTAMP NOT NULL,
    logoutDateTime TIMESTAMP NOT NULL,
    FOREIGN KEY (staffID) REFERENCES Admin(staffID)
);

