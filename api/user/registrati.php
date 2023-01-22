<?php
include '../utils.php';
if (!isset($_POST) || !isset($_POST['username']) || !isset($_POST['password'])) {
  echo json_encode("Inserire username e password");
  return;
}
$user = $_POST['username'];
$pass = $_POST['password'];
$conn = dbConn() or die("Connection failed");

$sql = "SELECT name 
        FROM user 
        WHERE name = ?";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute([$user]);

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo json_encode("Errore nel server");
  return;
}

$num_rows = $stmt->rowCount();
if ($num_rows == 1) { //Se la query restituisce una table con UNA sola riga,vuol dire che ha trovato la corrispondenza
  echo json_encode("Username already taken");
} else if ($num_rows == 0) { //Se la query restituisce una table con nessuna riga,vuol dire che non ha trovato la corrispondenza
  $date = date("Y-m-d");

  $sql = "INSERT INTO user(name,password,data_creazione) 
                      values (?,?,?);";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user, $pass, $date]);
  } catch (PDOException $e) {
    echo json_encode("Errore nel server");
    return;
  }

  session_start();
  $id = $conn->lastInsertId();
  $_SESSION['logged'] = true;
  $_SESSION['name'] = $user;
  $_SESSION['id'] = $id;
  $_SESSION['date'] = $date;
  $_SESSION['watched'] = 0;
  $_SESSION['privilege'] = 0;

  echo json_encode("success");
} else {
  echo json_encode("Errore nel server");
}
