<?php
include '../utils.php';
if (!isset($_POST))
  return;
$db = dbConn();

$id_review = $_POST['id_review'];

//query that inserts data into db
$sql = "DELETE FROM review WHERE id_review=$id_review";
$success = mysqli_query($db, $sql);
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
