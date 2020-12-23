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
    $selectedDate = $_POST["equivDay"];
    echo "Equivalencies made before: " . $selectedDate;

    $dateQuery = 'SELECT *
    FROM equiv_to
        INNER JOIN uwo_courses
            ON equiv_to.course_number = uwo_courses.course_number
            INNER JOIN other_courses
                ON equiv_to.outside_code = other_courses.course_code AND equiv_to.university = other_courses.university
                INNER JOIN universities
                    ON equiv_to.university = universities.id_num
                    WHERE' . $selectedDate . '< equiv_to.decided_on'; 
    echo $dateQuery;
    $dateResult = mysqli_query($connection, $dateQuery);

    if (!$dateResult){
        die("database connection failed");
    }

    while ($row = mysqli_fetch_assoc($dateResult)){
        echo $row["outside_code"] . " - " . $row["course_name"] . '<br>';
        echo '<li>' . 'Weight: ' . $row["weight"] . '<br>';
        echo '<li>' . 'Equivilancy decided on: ' . $row["decided_on"] . '<br><br>';
    }
    mysqli_free_result($dateResult);

?>
<br>
<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>
<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>