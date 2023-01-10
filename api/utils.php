<?php

// function dbConn(){
//     $conn = mysqli_connect("localhost", "root", "", "anime_db");
//     if (!$conn) {
//       die("Connection failed: " . mysqli_connect_error());
//     }
//     return $conn;
// }
function dbConn()
{
  //PDO
  try {
    $dsn = "mysql:dbname=anime_db;host=localhost";
    $user = "root";
    $password = "";
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return null;
  }
  return $conn;
}
