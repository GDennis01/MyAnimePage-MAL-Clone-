<?php
include 'utils.php';
if(!isset($_POST) || !isset($_POST['username']) || !isset($_POST['password'])){
    echo json_encode("Inserire username e password");
  return;
}
$user = $_POST['username'];
$pass = $_POST['password'];
$conn = dbConn();

$sql = "SELECT name FROM user WHERE name = '$user'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 1){//Se la query restituisce una table con UNA sola riga,vuol dire che ha trovato la corrispondenza
  echo json_encode("Username already taken");
}else if(mysqli_num_rows($result)== 0){//Se la query restituisce una table con nessuna riga,vuol dire che non ha trovato la corrispondenza
  $date = date("Y-m-d");
  $sql = "INSERT INTO user(name,password,data_creazione) values ('$user','$pass','$date');";
  $conn->query($sql);
  session_start();         
  $_SESSION['id']=$user;
  $_SESSION['logged']=true;
  $_SESSION['data']=$date;
  $_SESSION['watched']=0;
  echo json_encode("success");
}
?>