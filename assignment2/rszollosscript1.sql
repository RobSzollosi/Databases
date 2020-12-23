-- List all current databases owned by you
SHOW DATABASES;

-- Delete the database called yourwesternuseridassign2db if it exists
DROP DATABASE IF EXISTS rszollosassign2db;

-- Create a database called yourwesternuseridassign2db
CREATE DATABASE rszollosassign2db;

-- Connect to (use) that database
USE rszollosassign2db;

-- these lines make sure that a t.a. has access to the database in order to mark this assignment:
GRANT USAGE ON *.* TO 'ta'@'localhost';
DROP USER 'ta'@'localhost';
CREATE USER 'ta'@'localhost' IDENTIFIED BY 'cs3319';
GRANT ALL PRIVILEGES ON yourwesternuseridassign2db.* TO 'ta'@'localhost';
FLUSH PRIVILEGES;

-- List all the tables (should be none initially)
SHOW TABLES;

-- Create the tables you need to solve the problem above with the appropriate types and keys, foreign keys.  Make sure that:
CREATE TABLE uwo_courses(
    
    course_number   CHAR(6)         NOT NULL,
    course_name     VARCHAR(50)     NOT NULL,
    weight          DECIMAL(2,1)    NOT NULL,
    suffix          VARCHAR(3),
    PRIMARY KEY (course_number)
);

CREATE TABLE universities(

    id_num          INT             NOT NULL,
    official_name   VARCHAR(50)     NOT NULL,   
    nickname        VARCHAR(20)     NOT NULL,
    city            VARCHAR(20)     NOT NULL,
    province        VARCHAR(25)     NOT NULL,
    PRIMARY KEY (id_num)
);

CREATE TABLE other_courses(

    university      INT             NOT NULL,
    course_code     CHAR(10)        NOT NULL,
    course_name     VARCHAR(50)     NOT NULL,
    year            CHAR(1)         NOT NULL,
    weight          DECIMAL(2,1)    NOT NULL,
    PRIMARY KEY (university, course_code),
    FOREIGN KEY (university) REFERENCES universities(id_num) 
);

CREATE TABLE equiv_to(

    course_number   CHAR(6)         NOT NULL,
    outside_code    CHAR(10)        NOT NULL,
    university      INT     	    NOT NULL,
    decided_on      TIMESTAMP       NOT NULL,
    PRIMARY KEY (course_number, university, outside_code),
    FOREIGN KEY (university, outside_code) REFERENCES other_courses(university, course_code) ON DELETE CASCADE,
    FOREIGN KEY (course_number) REFERENCES uwo_courses(course_number) ON DELETE CASCADE;
);
--FOREIGN KEY (course_number) REFERENCES uwo_courses(course_number)
-- List the tables again
SHOW TABLES;