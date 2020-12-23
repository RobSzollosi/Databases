-- Checking that correct database is connected
USE rszollosassign2db;

-- Show that the uwo_courses table is empty
SELECT * FROM uwo_courses;

-- Inserting more data into the tables
-- Western Courses
INSERT INTO uwo_courses VALUES("cs1026","Computer Science Fundamentals I",0.5, "A/B");
INSERT INTO uwo_courses VALUES("cs1027","Computer Science Fundamentals II",0.5, "A/B");
INSERT INTO uwo_courses VALUES("cs2210","Algorithms and Data Structures",1.0, "A/B");
INSERT INTO uwo_courses VALUES("cs3319", "Databases I", 0.5,"A/B");
INSERT INTO uwo_courses VALUES("cs2120", "Modern Survival Skills I: Coding Essentials", 0.5,"A/B");
INSERT INTO uwo_courses VALUES("cs4490", "Thesis", 0.5, "Z");
INSERT INTO uwo_courses VALUES("cs0020", "Intro to Coding using Pascal and Fortran", 1.0,""); 

-- Show that the uwo_courses table now has data
SELECT * FROM uwo_courses;

-- Show that the universities table is empty
SELECT * FROM universities;

-- Load data into the university table using LOAD DATA LOCAL INFILE
LOAD DATA LOCAL INFILE 'data.txt'
    INTO TABLE universities
    FIELDS TERMINATED BY ','
    (id_num,official_name,city,province,nickname);

-- Universities
INSERT INTO universities VALUES(37,"University of Etobicoke","UofE","Toronto","ON");
INSERT INTO universities VALUES(24,"Concordia University","Concord","Montreal","QC");
-- SHow that the universities table now has data
SELECT * FROM universities;

-- Show that the other_courses table is empty
SELECT * FROM other_courses;

-- Courses at U of T
INSERT INTO other_courses VALUES(2,"CompSci022", "Introduction to Programming", "1", 0.5);
INSERT INTO other_courses VALUES(2,"CompSci033", "Intro to Programming for Med students", "3", 0.5);
INSERT INTO other_courses VALUES(2,"CompSci021", "Packages", "1", 0.5);
INSERT INTO other_courses VALUES(2,"CompSci222", "Introduction to Databases", "2", 1.0);
INSERT INTO other_courses VALUES(2,"CompSci023", "Advanced Programming", "1", 0.5);
-- Courses at Waterloo:
INSERT INTO other_courses VALUES(4,"CompSci011", "Intro to Computer Science", "2", 0.5);
INSERT INTO other_courses VALUES(4,"CompSci123", "Using UNIX", "2", 0.5);
-- Courses at UBC:
INSERT INTO other_courses VALUES(66,"CompSci021","Intro Programming","1", 1.0);
INSERT INTO other_courses VALUES(66,"CompSci022", "Advanced Programming", "1", 0.5);
INSERT INTO other_courses VALUES(66,"CompSci319", "Using Databases","3", 0.5);
-- Courses at Mac:
INSERT INTO other_courses VALUES(55,"CompSci333"," Graphics"," 3", 0.5);
INSERT INTO other_courses VALUES(55,"CompSci444", "Networks", "4", 0.5);
-- Courses at Laurier:
INSERT INTO other_courses VALUES(77,"CompSci022"," Using Packages","1", 0.5);
INSERT INTO other_courses VALUES(77,"CompSci101", "Introduction to Using Data Structures", "2", 0.5);
-- Courses at UofE
INSERT INTO other_courses VALUES(37,"CompSci112","Basic CS","1",0.5);
INSERT INTO other_courses VALUES(37,"CompSci412","Practical Applications of Skynet","4",1.0);

-- Show that the other_courses table now has data
SELECT * FROM other_courses;

-- Show that the equiv_to table now has data
SELECT * FROM equiv_to;

INSERT INTO equiv_to VALUE("cs1026","CompSci022",2,"2015-5-12");
INSERT INTO equiv_to VALUE("cs1026","CompSci033",2,"2013-1-2");
INSERT INTO equiv_to VALUE("cs1026","CompSci011",4,"1997-2-9");
INSERT INTO equiv_to VALUE("cs1026","CompSci021",66,"2010-1-12");
INSERT INTO equiv_to VALUE("cs1027","CompSci023",2,"2017-6-22");
INSERT INTO equiv_to VALUE("cs1027","CompSci022",66,"2019-9-1");
INSERT INTO equiv_to VALUE("cs2210","CompSci101",77,"1998-7-12");
INSERT INTO equiv_to VALUE("cs3319","CompSci222",2,"1990-9-13");
INSERT INTO equiv_to VALUE("cs3319","CompSci319",66,"1987-9-21");
INSERT INTO equiv_to VALUE("cs2120","CompSci022",2,"2018-12-10");
INSERT INTO equiv_to VALUE("cs0020","CompSci022",2,"1999-9-17");

-- Show that the equiv_to table now has data
SELECT * FROM equiv_to;

-- Change the date that cs0020 was evaluated to be the same as CompSci022 at UofT to be September 19, 2018
UPDATE equiv_to 
SET decided_on = '2018-9-19' 
WHERE course_number = 'cs0020'AND outside_code = 'CompSci022' AND university = 2;
SELECT * FROM equiv_to;

-- Change the year to be 1 for every course from other universities that has a course name that starts with the 5 characters "Intro".
SELECT * FROM other_courses;
UPDATE other_courses
SET year = 1
WHERE course_name LIKE "Intro%";
SELECT * FROM other_courses;