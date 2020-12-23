<!DOCTYPE html>
<html>
<head>
	<title>Western Course Data</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="updateReq.js"></script>
	<!-- <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet"> -->
</head>
<body>

<?php
    include "connecttodb.php";
?>

<h1>Western Courses and Equivalencies</h1>

<form action="modifyUWOCourses.php" method="post">

<h2>Which course would you like to modify?</h2>

<?php

    $whichField = $_POST["field"];
    $whichOrder = $_POST["order"];

    $uwoQuery = 'SELECT * FROM uwo_courses ORDER BY '. $whichField . ' ' . $whichOrder;  
    $provUni = mysqli_query($connection,$uwoQuery);

    if (!$provUni) {
        die("databases query failed.");
    }

    while ($row = mysqli_fetch_assoc($provUni)) {
        // echo "<li>";
        echo '<input type="radio" name="uwo_courses" value="';
        echo $row["course_number"];
        echo '" required>' .$row["course_number"].": ".$row["course_name"]." ".$row["suffix"]." ".$row["weight"]."<br>";
    }

    mysqli_free_result($provUni);
?>

<h2>Option 1: Select the field to modify and input the new entry</h2>

<input type="radio" name="mod_field" value="course_name" id = "courseName" required> Change Course Name to: <input type="text" name="new_value" maxlength = 50/><br>
<input type="radio" name="mod_field" value="suffix" id = "courseSuffix" required> Change Course Suffix to: <input type="text" name="new_value2" maxlength = 3 pattern = "A/B|F/G|E|Y|Z|\s"/><br>
<input type="radio" name="mod_field" value="weight" id = "courseWeight" required> Change Course Weight to: <input type="text" name="new_value3" maxlength = 3 pattern = "1.0|0.5"/><br>

<input type="submit" name = "modify" value="Modify" >

<h2>Option 2: Delete the selected course</h2>
<input type="submit" name = "delete" value="Delete" onclick = "updateReq()" >


</form>


<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>