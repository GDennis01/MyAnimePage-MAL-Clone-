<?php
include '../utils.php';
if (!isset($_POST))
  return;
$db = dbConn();

$user = $_POST['id_user'];
$anime = $_POST['mal_id'];

//query that inserts data into db
$sql = "DELETE FROM anime_user WHERE id_user = $user AND id_anime = $anime";
$success = mysqli_query($db, $sql);
if ($success)
  echo json_encode("success");
else
  echo json_encode("error");
