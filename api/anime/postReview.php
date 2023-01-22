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
// $user = $_POST['id_user'];
$user = $_SESSION['id'];
$review = $_POST['review'];

//query that inserts data into db
// $sql = "INSERT INTO review (id_user,id_anime,text) VALUES ($user,$anime,'$review')";
$sql = "INSERT INTO review (id_user,id_anime,text) VALUES (?,?,?)";
try {
  $stmt = $db->prepare($sql);
  $success = $stmt->execute([$user, $anime, $review]);
} catch (PDOException $e) {
  $success = false;
}
// $success = mysqli_query($db, $sql);

if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
