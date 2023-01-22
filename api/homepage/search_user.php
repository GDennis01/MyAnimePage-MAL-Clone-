<?php

include "../utils.php";
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_GET))
  return;
$db = dbConn() or die("Connection failed");
$search = $_GET['search'];
$query = "SELECT  id_user as id, name FROM user WHERE LOWER(name) LIKE ?";
try {
  $stmt = $db->prepare($query);
  $stmt->execute(["%$search%"]);
  $json = array();
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $json[] = $row;
    }
  } else {
    $json = "";
  }
} catch (PDOException $e) {
  $json = "";
}
echo json_encode($json);
