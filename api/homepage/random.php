<?php
include "../utils.php";
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: ../../login.html");
  return;
}
if (!isset($_POST))
  return;
$db = dbConn() or die("Connection failed");
$query = "SELECT MAL_ID FROM anime_list ORDER BY RAND() LIMIT 1";
try {
  $stmt = $db->prepare($query);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "error";
  return;
}
echo $row['MAL_ID'];
