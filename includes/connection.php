<?php

$mysqli = new mysqli("localhost", "root", "", "bms");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// You can use $mysqli for your database operations

?>
