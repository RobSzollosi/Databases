<!DOCTYPE html>
<html>
<head>
	<title>Western Course Data</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<!-- <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet"> -->
</head>
<body>

<?php
    include "connecttodb.php";
?>

<h1>Western Courses and Equivalencies</h1>

<?php
    $selectedCourseCode = $_POST["courseCode"];
    $selectedCourseQuery = 'SELECT * FROM uwo_courses WHERE course_number = "' . $selectedCourseCode . '"';
    
    $selectedCourseResult = mysqli_query($connection, $selectedCourseQuery);

    if (!$selectedCourseResult) {
        die("database connection failed");
    }

    while ($row = mysqli_fetch_assoc($selectedCourseResult)){

        echo "<h2>Courses Equivalent to " . $row["course_number"] . ": " . $row["course_name"] . " worth " . $row["weight"] . " credits </h2>";
    }
    mysqli_free_result($selectedCourseResult);

?>

<?php
    $selectedCourseCode = $_POST["courseCode"];

    // $equivCourseQuery = 'SELECT other_courses.course_code , other_courses.course_name, other_courses.weight, equiv_to.decided_on
    $equivCourseQuery = 'SELECT * FROM equiv_to INNER JOIN uwo_courses ON equiv_to.course_number = uwo_courses.course_number INNER JOIN other_courses ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university INNER JOIN universities ON equiv_to.university = universities.id_num WHERE equiv_to.course_number = "' . $selectedCourseCode . '"';
    $equivCoursesResult = mysqli_query($connection, $equivCourseQuery);

    if (!$equivCoursesResult) {
        die("database connection failed");
    }

    while ($row = mysqli_fetch_assoc($equivCoursesResult)){
        // var_dump($row);
        echo $row["outside_code"] . " - " . $row["course_name"] . '<br>';
        echo '<li>' . 'Weight: ' . $row["weight"] . '<br>';
        echo '<li>' . 'Equivilancy decided on: ' . $row["decided_on"] . '<br><br>';
    }
    mysqli_free_result($equivCoursesResult);

?>
<br>
<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>
<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>