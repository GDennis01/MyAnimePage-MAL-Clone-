<?php
include "../utils.php";
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn();
$query = "SELECT MAL_ID FROM anime_list ORDER BY RAND() LIMIT 1";
$stmt = $db->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// $result = mysqli_query($db, $query);
// $row = mysqli_fetch_assoc($result);
echo $row['MAL_ID'];
