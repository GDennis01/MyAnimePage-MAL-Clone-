<?php
//TODO:check if the user is logged in 
include "../utils.php";
$db = dbConn();
$search=$_GET['search'];
$query = "SELECT MAL_ID as id, Name as name FROM anime_list WHERE LOWER(Name) LIKE '%$search%'";
// mysqli
$result = mysqli_query($db, $query);
$json = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = $row;
    }
} else {
    $json = "";
}
mysqli_close($db);
echo json_encode($json);

?>