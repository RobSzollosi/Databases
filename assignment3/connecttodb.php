<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "cs3319";
$dbname = "rszollosassign2db";
// $dbname = "rszollosassign2db";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()){

    die("Database connection failed :" .
    mysqli_connect_errno() . " (" . mysqli_connect_errno() . ")" );
    } // enf of if statement
?>