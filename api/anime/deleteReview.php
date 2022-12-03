<?php
include '../utils.php';
session_start();
$privilege = $_SESSION['privilege'] ?? 0;
if (!isset($_SESSION['logged']) || $privilege != 1) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn();

$id_review = $_POST['id_review'];

//query that inserts data into db
$sql = "DELETE FROM review WHERE id_review=?";
$stmt = $db->prepare($sql);
$success = $stmt->execute([$id_review]);
// $success = mysqli_query($db, $sql);
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
