<?php

$db = mysqli_connect("localhost", "root", "", "php-project");

if ($db) {
    // echo "Database conneced";
}
else {
    die("MySQL connection failed." . mysqli_error($db));
}
?>