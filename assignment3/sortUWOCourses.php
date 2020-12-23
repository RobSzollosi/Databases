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

    $whichField = $_POST["field"];
    $whichOrder = $_POST["order"];

    $query = 'SELECT * FROM uwo_courses ORDER BY '. $whichField . ' ' . $whichOrder;  
    $result = mysqli_query($connection,$query);

    if (!$result) {
        die("databases query failed.");
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo $row["course_number"].": ".$row["course_name"]." ".$row["suffix"]." ".$row["weight"]."<br>";

    }
    mysqli_free_result($result);
?>
<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>