<?php
include "../utils.php";
$db = dbConn();
$query = "SELECT MAL_ID FROM anime_list ORDER BY RAND() LIMIT 1";  
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
echo $row['MAL_ID'];
