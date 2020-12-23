<!DOCTYPE html>
<html>
<head>
      	<title>Western Course Data</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <!-- <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet"> -->
</head>
<body>

<!-- <script src="museum.js"></script>; -->

<?php
    include "connecttodb.php";
?>

<h1>Western Courses and Equivalencies</h1>

<?php

    $whichMod = $_POST["mod_field"];
    $whichCourse = $_POST["uwo_courses"];

    if ((strcmp($whichMod,"course_name")) == 0){

        $newValue = $_POST["new_value"];
    }
    if ((strcmp($whichMod,"suffix")) == 0){

        $newValue = $_POST["new_value2"];
    }
    if ((strcmp($whichMod,"weight")) == 0){

        $newValue = $_POST["new_value3"];
    }

    // $query = 'SELECT * FROM uwo_courses ORDER BY '. $whichField . ' ' . $whichOrder;
    $query = 'SELECT * FROM uwo_courses WHERE course_number = "'. $whichCourse . '"';
    $result = mysqli_query($connection,$query);

    if (!$result) {
        die("databases query failed.");
    }

    echo "The entry was originally: <br>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo $row["course_number"].": ".$row["course_name"]." ".$row["suffix"]." ".$row["weight"]."<br>";
    }

    echo "The entry is now: <br>";
    // echo 'UPDATE uwo_courses SET ' . $whichMod . ' = "' . $newValue . '" WHERE course_number = "' . $whichCourse . '"';
    $update = 'UPDATE uwo_courses SET ' . $whichMod . ' = "' . $newValue . '" WHERE course_number = "' . $whichCourse . '"';
    $updateResult = mysqli_query($connection, $update);

    if (!$updateResult) {
        die("database query has failed.");
    }

    $query = 'SELECT * FROM uwo_courses WHERE course_number = "'. $whichCourse . '"';
    $result = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo $row["course_number"].": ".$row["course_name"]." ".$row["suffix"]." ".$row["weight"]."<br>";
    }
?>
<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>

<?php
mysqli_close($connection);
?>
<hr>
</body>
