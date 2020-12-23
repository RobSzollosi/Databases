<?php

$query = "SELECT * FROM universities ORDER BY province";
$result = mysqli_query($connection,$query);
if (!$result) {
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($result)) {
        // echo "<li>";
        echo '<input type="radio" name="unis" value="';
        echo $row["id_num"];
        echo '" required>' .$row["province"].": ".$row["official_name"] . "<br>";

}
mysqli_free_result($result);
?>