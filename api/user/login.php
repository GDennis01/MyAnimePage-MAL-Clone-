<?php
include '../utils.php';
if(!isset($_POST))
  return;
$user = $_POST['username'];
$pass = $_POST['password'];
$conn = dbConn();
$sql = "SELECT id_user,name,data_creazione as date,anime_visti as watched FROM user WHERE name = '$user' AND password = '$pass'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) == 1){//Se la query restituisce una table con UNA sola riga,vuol dire che ha trovato la corrispondenza
  session_start();         
  $_SESSION['logged']=true;
  $_SESSION['name']=$row['name'];
  $_SESSION['id']=$row['id_user'];
  $_SESSION['date']=$row['date'];
  $_SESSION['watched']=$row['watched'];
  echo json_encode("success");
}else if(mysqli_num_rows($result)== 0){//Se la query restituisce una table con nessuna riga,vuol dire che non ha trovato la corrispondenza
  echo json_encode("Credenziali errate");
}
