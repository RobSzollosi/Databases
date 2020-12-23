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
    session_start();
    // $whichCourse = $_SESSION['modify'];
    $whichField = $_POST["mod_field"];
    
    echo $_SESSION['modify'];
    echo"<br>";
    echo $whichField;

?>

<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>