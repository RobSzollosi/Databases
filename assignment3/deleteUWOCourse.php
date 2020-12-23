<?php
    include "connecttodb.php";
    $whichCourse = $_POST["submit"];
    $deletionQuery = 'DELETE FROM uwo_courses WHERE course_number = "' . $whichCourse . '"';

    echo $deletionQuery;

    $deletionResult = mysqli_query($connection, $deletionQuery);

    if (!$deletionResult) {
        die("database query failed");
    }

    else{
      header('Location: uwoCourseData.php');
    }
    exit;

?>
