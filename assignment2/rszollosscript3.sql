-- Checking that correct database is connected
USE rszollosassign2db;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 1) Show the course names of all the Western Courses
SELECT course_name FROM uwo_courses;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 2) Show the course numbers of all courses from other universities with no repeats
SELECT DISTINCT course_code FROM other_courses;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 3) Show all the data in the Western Course table, but show them in order of their course names from A to Z;
SELECT * FROM uwo_courses ORDER BY course_name;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 4) List the course number and title of all half (0.5) Western courses.
SELECT course_number, course_name FROM uwo_courses WHERE weight = 0.5;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 5) List all the course numbers and course names from courses offered at the University of Toronto 
-- (you must use the University's Name as the lookup in the query not the unique university number)
SELECT other_courses.course_code, other_courses.course_name
FROM other_courses
    INNER JOIN universities
        ON universities.id_num = other_courses.university
        WHERE official_name = "University of Toronto";

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 6) List the outside university course name and the university nickname of any course whose name has the word "Introduction" somewhere in the name.
SELECT other_courses.course_name, universities.nickname 
FROM other_courses
    INNER JOIN universities 
        ON universities.id_num = other_courses.university
        WHERE other_courses.course_name LIKE '%Introduction%';

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 7) List all courses names, their universities names, the Western course name, the evaluated date of equivalent courses 
-- but only those courses that have not been reevaluated in the last 5 years. (Google the MySQL command's CURDATE() and
-- DATE_SUB() with INTERVAL YEAR to help you make this work no matter what date it is fun).
SELECT other_courses.course_name, universities.official_name, uwo_courses.course_name, equiv_to.decided_on
FROM equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        INNER JOIN other_courses
            ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
            INNER JOIN universities
                ON equiv_to.university = universities.id_num
                WHERE DATE_ADD(CURDATE(),INTERVAL -5 YEAR) > equiv_to.decided_on; 

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 8) List the all courses names and the university nicknames of course that are equivalent to Western's cs1026.
SELECT other_courses.course_name, universities.nickname
FROM equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        INNER JOIN other_courses
            ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
            INNER JOIN universities
                ON equiv_to.university = universities.id_num
                WHERE equiv_to.course_number = "cs1026";

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 9) Count the number of courses that are equivalent to Western's cs1026
SELECT COUNT(*) 
FROM equiv_to
WHERE equiv_to.course_number = "cs1026";

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 10) List all Western course names and the outside course name and the university nickname  of Western courses that are equivalent to a course offered by ANY university in Waterloo, Ontario.
SELECT uwo_courses.course_name, other_courses.course_name, universities.nickname
FROM equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        INNER JOIN other_courses
            ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
            INNER JOIN universities
                ON equiv_to.university = universities.id_num
                WHERE city = "Waterloo" AND province = "ON";

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 11) List all University Names where they do not have any courses equivalent to a Western Course.
SELECT  official_name
FROM    universities
WHERE   id_num    
NOT IN  (SELECT university FROM equiv_to);

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 12) Find the course name of any Western course and Western course number that is equivalent to a third or fourth year class at another university. 
SELECT  uwo_courses.course_name, uwo_courses.course_number
FROM    equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        INNER JOIN other_courses
        ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
        WHERE other_courses.year > 2;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 13) Find the names of any Western courses that are equivalent to more than one outside course. (Hint: you will have to use the key words Group By and Having)
SELECT  uwo_courses.course_name
FROM    equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        GROUP BY uwo_courses.course_number
        Having COUNT(equiv_to.course_number) > 1;

-- -----------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query 14) We want to make sure that students dont get credit for a half course from another university that was supposed to be a full course at Western or
-- vise versa. Write a query that finds all outside courses that are equivalent to one or more of the Western courses but dont have the same weight as
-- that course.  Output the Western course num and name and weight and output the outside course name and university name and weight.  Write the query
-- so that the columns have the following neat titles "Western Course Number", "Western Course Name", "Course Weight", "Other University Course Name", 
-- "University Name" and "Other Course Weight".
SELECT  uwo_courses.course_number AS "Western Course Number",
        uwo_courses.course_name AS "Western Course Name",
        uwo_courses.weight AS "Course Weight",
        other_courses.course_name AS "Other University Course Name",
        universities.official_name AS "University Name",
        other_courses.weight AS "Other Course Weight"
FROM equiv_to
    INNER JOIN uwo_courses
        ON equiv_to.course_number = uwo_courses.course_number
        INNER JOIN other_courses
            ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
            INNER JOIN universities
                ON equiv_to.university = universities.id_num
                WHERE uwo_courses.weight <> other_courses.weight;