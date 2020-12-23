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

<?php  
    $newCode = "cs" . $_POST["newCourseCode"];
    $newName = $_POST["newCourseName"];
    $newSuffix = $_POST["suffix"];
    $newWeight = $_POST["courseWeight"];

    $checkExistQuery = 'SELECT COUNT(*) FROM uwo_courses WHERE course_number ="' . $newCode . '"';
    $checkExistResult = mysqli_query($connection, $checkExistQuery);

    if (!$checkExistResult) {
        die("databases query failed.");
    }

    while ($row = mysqli_fetch_assoc($checkExistResult)) {

        if ($row["COUNT(*)"] == 0){
        
            echo "No course with this code exists, adding the course<br>";

            $addQuery = 'INSERT INTO uwo_courses VALUES("' . $newCode . '", "' . $newName . '", "' . $newWeight . '", "' . $newSuffix . '")';

            $addResult = mysqli_query($connection, $addQuery);

            if (!$addResult){
                die("Database query failed");
            }
            else{
                echo $newCode . " " . $newSuffix . ": " . $newName . " worth " . $newWeight . " credits has been added to the database<br>"; 
            }

        }
        else{

            echo "A course with the code: " . $newCode . " already exists so it cannot be added<br> please try again from the homepage<br>";

        }
    }

?>
<a href="uwoCourseData.php"><button type="button">Return to homepage</button></a>

<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>