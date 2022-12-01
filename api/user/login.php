<?php
include '../utils.php';
if (!isset($_POST))
  return;
$user = $_POST['username'];
$pass = $_POST['password'];

$conn = dbConn();

$sql = "SELECT id_user,name,data_creazione as date,anime_visti as watched,privilege  
        FROM user 
        WHERE name = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user, $pass]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$num_rows = $stmt->rowCount();
if ($num_rows == 1) { //Se la query restituisce una table con UNA sola riga,vuol dire che ha trovato la corrispondenza
  session_start();
  $_SESSION['logged'] = true;
  $_SESSION['name'] = $result['name'];
  $_SESSION['id'] = $result['id_user'];
  $_SESSION['date'] = $result['date'];
  $_SESSION['watched'] = $result['watched'];
  $_SESSION['privilege'] = $result['privilege'];
  echo json_encode("success");
} else if ($num_rows == 0) { //Se la query restituisce una table con nessuna riga,vuol dire che non ha trovato la corrispondenza
  echo json_encode("Credenziali errate");
} else {
  echo json_encode("Errore nel server");
}
