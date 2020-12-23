<?php

$codeQuery = "SELECT course_number FROM uwo_courses";
$codeResult = mysqli_query($connection,$codeQuery);
if (!$codeResult) {
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($codeResult)) {
        // echo "<li>";
        echo '<input type="radio" name="courseCode" value="';
        echo $row["course_number"];
        echo '" required>' . $row["course_number"] . "<br>";

}
mysqli_free_result($codeResult);
?>