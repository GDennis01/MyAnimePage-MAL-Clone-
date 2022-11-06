<?php
include 'utils.php';
if(!isset($_POST))
  return;

$user = $_POST['username'];
$pass = $_POST['pw'];
$conn = dbConn();

$sql = "SELECT name FROM user WHERE name = '$user'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) == 1){//Se la query restituisce una table con UNA sola riga,vuol dire che ha trovato la corrispondenza
  echo json_encode("Username already taken");
}else if(mysqli_num_rows($result)== 0){//Se la query restituisce una table con nessuna riga,vuol dire che non ha trovato la corrispondenza
  $sql = "INSERT INTO user(name,password) values (\"$user\",\"$pass\");";
  $conn->query($sql);
  session_start();         
  $_SESSION['id']=$user;
  $_SESSION['logged']=true;
  echo json_encode("success");
}


  ?>