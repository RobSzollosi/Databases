-- ---------------------------------
-- SCRIPT 1

-- Set up the database

SHOW DATABASES;
DROP DATABASE IF EXISTS lreid2assign2db;
CREATE DATABASE lreid2assign2db;
USE lreid2assign2db;

-- Set privileges for the t.a.s

GRANT USAGE ON *.* TO 'ta'@'localhost'; DROP USER 'ta'@'localhost';
CREATE USER 'ta'@'localhost' IDENTIFIED BY 'cs3319'; GRANT ALL
PRIVILEGES ON yourwesternuseridassign2db.* TO 'ta'@'localhost';
FLUSH PRIVILEGES;

-- Create the tables for the database

SHOW TABLES;

CREATE TABLE westerncourse (westernnum CHAR(6) NOT NULL, westernname VARCHAR(50) NOT NULL, weight DECIMAL(2,1) NOT NULL, suffix VARCHAR(3), PRIMARY KEY(westernnum));
CREATE TABLE university (uniid TINYINT NOT NULL, uniname VARCHAR(50), city VARCHAR(20) NOT NULL, prov CHAR(2) NOT NULL, nickname VARCHAR(20) NOT NULL, PRIMARY KEY(uniid));
CREATE TABLE outsidecourse (outsidenum CHAR(10) NOT NULL, outsidename VARCHAR(50) NOT NULL, whichyear TINYINT NOT NULL, weight DECIMAL(2,1) NOT NULL, uniid TINYINT NOT NULL, FOREIGN KEY (uniid) REFERENCES university(uniid), PRIMARY KEY (outsidenum, uniid));
CREATE TABLE equivalentto (westernnum CHAR(6) NOT NULL, FOREIGN KEY(westernnum) REFERENCES westerncourse(westernnum) ON DELETE CASCADE, outsidenum CHAR(10) NOT NULL, FOREIGN KEY (outsidenum, uniid) REFERENCES outsidecourse(outsidenum, uniid) ON DELETE CASCADE, uniid TINYINT NOT NULL,  evaluateddate DATE NOT NULL, PRIMARY KEY (westernnum, outsidenum, uniid));

SHOW TABLES;