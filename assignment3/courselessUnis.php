<?php

$courselessQuery = "SELECT  official_name, nickname FROM universities WHERE id_num NOT IN (SELECT university FROM equiv_to);";
$courselessResult = mysqli_query($connection,$courselessQuery);
if (!$courselessResult) {
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($courselessResult)) {
        echo "<li>";
        echo $row["nickname"] . "- " . $row["official_name"] . "<br>";

}
mysqli_free_result($courselessResult);
?>