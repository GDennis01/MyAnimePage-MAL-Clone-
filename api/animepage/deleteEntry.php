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

$user = $_POST['id_user'];
$anime = $_POST['mal_id'];

//query that inserts data into db
// $sql = "DELETE FROM anime_user WHERE id_user = $user AND id_anime = $anime";
// $success = mysqli_query($db, $sql);
$sql = "DELETE FROM anime_user WHERE id_user = ? AND id_anime = ?";
$stmt = $db->prepare($sql);
$success = $stmt->execute([$user, $anime]);


// $success = mysqli_query($db, $sql);
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
