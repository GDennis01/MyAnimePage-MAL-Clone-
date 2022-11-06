<?php

function dbConn(){
    $conn = mysqli_connect("localhost", "root", "", "anime_db");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>