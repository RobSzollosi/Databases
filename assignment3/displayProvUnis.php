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
    $selectedProv = $_POST["provs"];
    echo "<h2>Schools in " . $selectedProv . ":</h2>";

    $provUniQuery = 'SELECT * FROM universities WHERE province = "' . $selectedProv . '"';
    $provUniversities = mysqli_query($connection, $provUniQuery);

    if (!$provUniversities) {
        die("database connection failed");
    }

    while ($row = mysqli_fetch_assoc($provUniversities)){

        echo '<li>' . $row["official_name"] . " - " . $row["nickname"];
    }
    mysqli_free_result($provUniversities);

?>
<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>
<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>