<?php
include '../utils.php';

session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn();

$anime = $_POST['mal_id'];
$user = $_POST['id_user'];
$review = $_POST['review'];

//query that inserts data into db
// $sql = "INSERT INTO review (id_user,id_anime,text) VALUES ($user,$anime,'$review')";
$sql = "INSERT INTO review (id_user,id_anime,text) VALUES (?,?,?)";
$stmt = $db->prepare($sql);
$success = $stmt->execute([$user, $anime, $review]);
// $success = mysqli_query($db, $sql);

if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
