<?php

$provQuery = "SELECT DISTINCT province FROM universities";
$provResult = mysqli_query($connection,$provQuery);
if (!$provResult) {
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($provResult)) {
        // echo "<li>";
        echo '<input type="radio" name="provs" value="';
        echo $row["province"];
        echo '" required>' . $row["province"] . "<br>";

}
mysqli_free_result($provResult);
?>