<?php
include '../utils.php';
if (!isset($_POST))
  return;
$db = dbConn();

$anime = $_POST['mal_id'];
$user = $_POST['id_user'];
$review = $_POST['review'];

//query that inserts data into db
$sql = "INSERT INTO review (id_user,id_anime,text) VALUES ($user,$anime,'$review')";
$success = mysqli_query($db, $sql);
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
