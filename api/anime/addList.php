<?php
include '../utils.php';
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn() or die("Connection failed");

$anime = $_POST['mal_id'];
$user = $_POST['id_user'];

//query that inserts data into db
// $sql = "INSERT INTO anime_user (id_user,id_anime) VALUES ($user,$anime)";
// $success = mysqli_query($db, $sql);
$sql = "INSERT INTO anime_user (id_user,id_anime) VALUES (?,?)";
try {
  $stmt = $db->prepare($sql);
  $success = $stmt->execute([$user, $anime]);
} catch (PDOException $e) {
  $success = false;
}
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
