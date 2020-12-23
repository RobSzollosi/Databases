--  --------------------------------
-- SCRIPT 2

USE lreid2assign2db;

SELECT * FROM university;
LOAD DATA LOCAL INFILE 'loaddatafall2020.txt' INTO TABLE university FIELDS TERMINATED BY ',';
SELECT * FROM university;

-- insert into the Western Courses Table
SELECT * FROM westerncourse;
INSERT INTO westerncourse VALUES ('cs1026','Computer Science Fundamentals I',0.5,'A/B');
INSERT INTO westerncourse VALUES ('cs1027','Computer Science Fundamentals II',0.5,'A/B'); 
INSERT INTO westerncourse VALUES ('cs2210','Algorithms and Data Structures',1.0,'A/B');
INSERT INTO westerncourse VALUES ('cs3319','Databases I',0.5,'A/B');
INSERT INTO westerncourse VALUES ('cs2120','Modern Survival Skills I: Coding Essentials',0.5,'A/B');
INSERT INTO westerncourse VALUES ('cs4490','Thesis',0.5,'Z');
INSERT INTO westerncourse VALUES ('cs0020','Intro to Coding using Pascal and Fortran',1.0,'');
INSERT INTO westerncourse VALUES ('cs3326','User Interface Design',1.0,''); 
SELECT * FROM westerncourse;

-- insert into the University Table

SELECT * FROM university;
INSERT INTO university VALUES (99,"Wayne Gretzky Hockey School", "Brantford", "ON", "The Great One");
SELECT * FROM university;

-- insert into the Outside Course Table

SELECT * FROM outsidecourse;
INSERT INTO outsidecourse VALUES ('CompSci022', 'Introduction to Programming I', 1,0.5, 2);
INSERT INTO outsidecourse VALUES ('CompSci033', 'Intro to Programming for Med students', 3,0.5, 2);
INSERT INTO outsidecourse VALUES ('CompSci021', 'Packages I', 1,0.5,2);
INSERT INTO outsidecourse VALUES ('CompSci222', 'Introduction to Databases', 2,1.0,2);
INSERT INTO outsidecourse VALUES ('CompSci023', 'Advanced Programming', 1,0.5,2);
INSERT INTO outsidecourse VALUES ('CompSci011', 'Intro to Computer Science', 2,0.5,4);
INSERT INTO outsidecourse VALUES ('CompSci123', 'Using UNIX', 2,0.5,4);
INSERT INTO outsidecourse VALUES ('CompSci021', 'Intro Programming', 1,1.0,66);
INSERT INTO outsidecourse VALUES ('CompSci022', 'Advanced Programming', 1,0.5,66);
INSERT INTO outsidecourse VALUES ('CompSci319', 'Using Databases', 3,0.5,66);
INSERT INTO outsidecourse VALUES ('CompSci333', 'Graphics', 3,0.5,55);
INSERT INTO outsidecourse VALUES ('CompSci444', 'Networks', 4,0.5,55);
INSERT INTO outsidecourse VALUES ('CompSci022', 'Using Packages', 1,0.5,77);
INSERT INTO outsidecourse VALUES ('CompSci101', 'Introduction to Using Data Structures', 2,0.5,77);
INSERT INTO outsidecourse VALUES ('CompSci111', 'My whichyear one course', 1,0.5,88);
INSERT INTO outsidecourse VALUES ('CompSci444', 'My fourth whichyear course', 4,0.5,88);
SELECT * FROM outsidecourse;

-- insert into the Equivalencies table 

SELECT * FROM equivalentto;
INSERT INTO equivalentto VALUES ('cs1026','CompSci022', '2', '2015-05-12');
INSERT INTO equivalentto VALUES ('cs1026','CompSci033', '2', '2013-01-02');
INSERT INTO equivalentto VALUES ('cs1026','CompSci011', '4', '1997-02-09');
INSERT INTO equivalentto VALUES ('cs1026','CompSci021', '66', '2010-01-12');
INSERT INTO equivalentto VALUES ('cs1027','CompSci023', '2', '2017-06-22');
INSERT INTO equivalentto VALUES ('cs1027','CompSci022', '66', '2019-09-01');
INSERT INTO equivalentto VALUES ('cs2210','CompSci101', '77', '1998-07-12');
INSERT INTO equivalentto VALUES ('cs3319','CompSci222', '2', '1990-09-13');
INSERT INTO equivalentto VALUES ('cs3319','CompSci319', '66', '1987-09-21');
INSERT INTO equivalentto VALUES ('cs2120','CompSci022', '2', '2018-12-10');
INSERT INTO equivalentto VALUES ('cs0020','CompSci022', '2', '1999-09-17');
SELECT * FROM equivalentto;

-- updates of the tables

SELECT * FROM equivalentto;
UPDATE equivalentto SET evaluateddate = "2018-09-19" WHERE westernnum="cs0020" AND outsidenum="CompSci022" AND uniid=2;
SELECT * FROM equivalentto;

SELECT * FROM outsidecourse;
UPDATE outsidecourse SET whichyear=1 WHERE outsidename LIKE 'Intro%';
SELECT * FROM outsidecourse;

-- end of script 2