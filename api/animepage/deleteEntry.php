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

$user = $_SESSION['id'];
$anime = $_POST['mal_id'];

$sql = "DELETE FROM anime_user WHERE id_user = ? AND id_anime = ?";
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
