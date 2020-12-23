<!DOCTYPE html>
<html>
<head>
	<title>Western Course Data</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h1>Western Courses and Equivalencies</h1>
<?php
    include "connecttodb.php";
?>

<?php
    $uni = $_POST["unis"];
    $query = 'SELECT * FROM universities WHERE id_num = ' . $uni ;
    $school = mysqli_query($connection,$query);

    if (!$school) {
        die("databases query failed.");
    }

    while ($row = mysqli_fetch_assoc($school)) {
        // echo "<li>";
        echo $row["official_name"] . " - " . $row["nickname"] . "<br>";
        echo $row["city"] . ", " . $row["province"] . "<br><br>";
    }
    mysqli_free_result($school);

    $query = 'SELECT * FROM other_courses WHERE university = ' . $uni;
    $outsideCourse = mysqli_query($connection, $query);

    if (!$outsideCourse) {
        die("database query failed");
    }

    while ($row = mysqli_fetch_assoc($outsideCourse)){

        echo "<li>" . $row["course_code"] . ': ' . $row["course_name"] . "<br>";
    }
    
    mysqli_close($connection);
?>
<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>


</body>
</html>