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
    $whichCourse = $_POST["uwo_courses"];
    
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

    if (isset($_POST['modify'])) {

        $whichMod = $_POST["mod_field"];

        if ((strcmp($whichMod,"course_name")) == 0){

            $newValue = $_POST["new_value"];
        }
        if ((strcmp($whichMod,"suffix")) == 0){

            $newValue = $_POST["new_value2"];
        }
        if ((strcmp($whichMod,"weight")) == 0){

            $newValue = $_POST["new_value3"];
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
        echo '<a href="uwoCourseData.php"><button type="button">Return to home!</button></a>';
    }

    if (isset($_POST['delete'])) {

        echo '<form action = "deleteUWOCourse.php" method = "post"';

        // Check if the course is equivalent to an outside course
        $deletionCheck = 'SELECT COUNT(*) FROM equiv_to WHERE course_number = "' . $whichCourse . '"';
        $deletionCheckResult = mysqli_query($connection, $deletionCheck);

        if (!$deletionCheckResult) {
            die("databases query failed.");
        }
        while ($row = mysqli_fetch_assoc($deletionCheckResult)) {

            // no outside equivs
            if ($row["COUNT(*)"] == 0){
            
                echo "<br>The couse being deleted is not equivalent to anything <br>";
                
            }

            // has outside equivs 
            else{
                
                echo "<br>The couse being deleted is equivalent to the following: <br>";
                
                $warningQuery = 'SELECT * FROM equiv_to WHERE course_number = "' . $whichCourse . '"';
                $warningResult = mysqli_query($connection, $warningQuery);

                if (!$warningResult){
                    die("database query failed");
                }

                while ($row = mysqli_fetch_assoc($warningResult)) {

                    echo "<li>" . $row["outside_code"];
                }
            }
    
        }
        echo '<br>Confirm that you want to delete the following course: <input type="submit" name = "submit" value= "' . $whichCourse . '">';
        echo '<br><a href="uwoCourseData.php"><button type="button">Return to home instead!</button></a>';
    }
?>
<!-- <input type="submit" name = "confimDelet" value="Confirm Deletion" > -->
</form>

<?php
mysqli_close($connection);
?>
<hr>
</body>
</html>