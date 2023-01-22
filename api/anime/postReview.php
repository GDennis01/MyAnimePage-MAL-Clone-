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
$user = $_SESSION['id'];
$review = $_POST['review'];

$sql = "INSERT INTO review (id_user,id_anime,text) VALUES (?,?,?)";
try {
  $stmt = $db->prepare($sql);
  $success = $stmt->execute([$user, $anime, $review]);
  //lastInsertId() returns the id of the last inserted row
  $id = $db->lastInsertId();
} catch (PDOException $e) {
  $success = false;
}
if ($success)
  echo json_encode(["esito" => "success", "id" => $id, "name" => $_SESSION['name']]);
else
  echo json_encode(["esito" => "error"]);
