<?php

include "../utils.php";
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn() or die("Connection failed");
$search = $_GET['search'];
// $query = "SELECT  id_user as id, name FROM user WHERE LOWER(name) LIKE '%$search%'";
$query = "SELECT  id_user as id, name FROM user WHERE LOWER(name) LIKE ?";
$stmt = $db->prepare($query);
$stmt->execute(["%$search%"]);
// mysqli
// $result = mysqli_query($db, $query);
$json = array();
// if (mysqli_num_rows($result) > 0) {
if ($stmt->rowCount() > 0) {
  // while ($row = mysqli_fetch_assoc($result)) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $json[] = $row;
  }
} else {
  $json = "";
}
// mysqli_close($db)
echo json_encode($json);
