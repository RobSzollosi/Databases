-- Checking that correct database is connected
USE rszollosassign2db;

-- Create a view that shows any course title from another university, the university name, nickname and city that it is from and the Western course name that it equivalent to, but only for courses for year 1 students. Then show all the records in this view.
CREATE VIEW year_one_equiv 
AS SELECT   other_courses.course_name   AS "other_uni_course",
            universities.official_name  AS "other_uni_name",
            universities.nickname       AS "other_uni_nickname",
            universities.city           AS "other_uni_city",
            uwo_courses.course_name     AS "equiv_uwo_course"
    FROM    equiv_to
        INNER JOIN  uwo_courses
            ON      equiv_to.course_number = uwo_courses.course_number
            INNER JOIN  other_courses
                ON      equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
                INNER JOIN  universities
                    ON      equiv_to.university = universities.id_num
                    WHERE   other_courses.year = 1;

-- Prove that your view works by selecting all the rows from it.
SELECT * FROM year_one_equiv;

-- Run your view again but this time just select all the columns from the view for universities with the nickname "UofT" .
-- Order the rows in ascending order by the Western Course name. 
SELECT * 
FROM year_one_equiv
WHERE other_uni_nickname = "UofT"
ORDER BY equiv_uwo_course; 

-- Show all the university table information
SELECT * FROM universities;

-- Delete any university that has a nickname with the letters "cord" in it.
DELETE FROM universities
WHERE       nickname LIKE "%cord%";

-- Show all the university table information again to make sure it was remove
SELECT * FROM universities;

-- Delete any university from Ontario
DELETE FROM universities
WHERE       id_num = 2;

-- Put a comment (-- the reason why ...) in your script file to explain why the Ontario universities could not be delete
-- ANSWER: the ontario university (UofT in this case) could not be deleted because the university still has courses offered
-- by it in the other_courses table where its id_num is a foreign key.

-- Show everything in the university table again
SELECT * FROM universities;

-- Show all the information about the outside course and all the information the university they are associated with
SELECT * 
FROM other_courses
INNER JOIN  universities
    ON      other_courses.university = universities.id_num;      
SELECT * FROM year_one_equiv;

-- Delete all the courses that are offered from a university in the city of Waterloo. Make sure you use city = "Waterloo" in your delete statement. 
DELETE o 
FROM other_courses o 
INNER JOIN  universities u
    ON      university = id_num
    WHERE   city = "Waterloo";

-- Show all the information about the outside course and all the information the university they are associated with to make sure those courses were deleted.
SELECT * 
FROM other_courses
INNER JOIN  universities
    ON      other_courses.university = universities.id_num; 

-- Run your view again and make sure that the equivalencies were also deleted from the view (Just double check that the rows returned from the steps above where you create your view are less now).
SELECT * FROM year_one_equiv;