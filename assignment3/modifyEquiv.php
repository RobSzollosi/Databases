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

    $uwoCourse = $_POST["westernCourse"];
    $outsideData = $_POST["outsideCourse"];
    $split = explode(" ", $outsideData);
    $outsideCourse = $split[0];
    $outsideUni = $split[1];

    $equivalenceQuery = 'SELECT COUNT(*) FROM equiv_to WHERE course_number = "' . $uwoCourse . '" AND outside_code = "' . $outsideCourse . '" AND university = "' . $outsideUni . '"';

    $equivalenceResult = mysqli_query($connection, $equivalenceQuery);

    if (!$equivalenceResult) {
        die("databases query failed.");
    }

    while ($row = mysqli_fetch_assoc($equivalenceResult)) {

        echo $row["COUNT(*)"] . "<br>";

        if ($row["COUNT(*)"] == 0){

            echo "no equivalence exists adding new entry <br>";
            $updateQuery = 'INSERT INTO equiv_to VALUE("'. $uwoCourse .'","' . $outsideCourse . '",' . $outsideUni . ',CURDATE())';
            // $addEquivalency =
        }
	    else{

            echo "an equivalence exists updating the entry <br>";
            $updateQuery = 'UPDATE equiv_to SET decided_on = CURDATE() WHERE course_number = "' . $uwoCourse . '" AND outside_code = "' . $outsideCourse . '" AND university = "' . $outsideUni . '"';

        }

	$modifyResult = mysqli_query($connection,$updateQuery);
        header('Location: uwoCourseData.php');
    }



?>
