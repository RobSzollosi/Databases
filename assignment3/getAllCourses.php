<?php
echo "<h4>Courses offered by Western </h4>";
$westernCoursesQuery = "SELECT course_number, course_name FROM uwo_courses";
$westernCoursesResult = mysqli_query($connection, $westernCoursesQuery);

if (!$westernCoursesResult){
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($westernCoursesResult)) {

    echo '<input type="radio" name="westernCourse" value="';
    echo $row["course_number"];
    echo '" required>' . $row["course_number"] . ": " . $row["course_name"] . "<br>";
}
mysqli_free_result($westernCoursesResult);

echo "<h4>Courses offered by Other Universities </h4>";
$outsideCoursesQuery = "SELECT course_code, course_name, university FROM other_courses";
$outsideCourseResult = mysqli_query($connection, $outsideCoursesQuery);

if (!$outsideCourseResult){
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($outsideCourseResult)) {

    echo '<input type="radio" name="outsideCourse" value="';
    echo $row["course_code"] . " " . $row["university"];
    echo '" required>' . $row["course_code"] . ": " . $row["course_name"] . "<br>";
}

?>