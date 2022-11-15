<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.php");
  return;
}
$user = $_SESSION['id'];
include 'api/utils.php';
$conn = dbConn();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.html' ?>

<body>
  <?php include 'templates/navbar.html' ?>
  <!-- Printing a table with all anime -->
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>My anime page</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Episodes</th>
              <th scope="col">Score</th>
              <th scope="col">Studio</th>
              <th scope="col"></th>
              <th scope="col"></th>
              <!-- <th scope="col">Image</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // error_reporting(0);
            // TODO: using ajax to print the table
            // TODO: remove the anime from the list: make a button that sends a post request to the server
            $sql = "SELECT MAL_ID,Name,Episodes,Score,Studios FROM anime_list JOIN anime_user ON anime_list.mal_id = anime_user.id_anime WHERE anime_user.id_user = '$user'";
            $result = mysqli_query($conn, $sql);
            $id_user = $_SESSION['id'];
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $mal_id = $row['MAL_ID'];
                // echo "<tr>";
                // echo "<td>" . $row["Name"] . "</td>";
                // echo "<td>" . $row["Episodes"] . "</td>";
                // echo "<td>" . $row["Score"] . "</td>";
                // echo "<td>" . $row["Studios"] . "</td>";
                // //print a button to delete anime
                // echo "<td><button type='button' class='btn btn-danger'>Delete</button></td>";
                // // echo "<td>" . $row["image"] . "</td>";
                // echo "</tr>";
            ?>
                <tr id="<?= $mal_id ?>">
                  <td> <?= $row['Name'] ?> </td>
                  <td> <?= $row['Episodes'] ?> </td>
                  <td> <?= $row['Score'] ?> </td>
                  <td> <?= $row['Studios'] ?> </td>
                  <td><button type='button' class='btn btn-danger' onclick="deleteEntry(<?= $id_user ?>,<?= $mal_id ?>)">Delete</button></td>
                  <td><button type='button' class='btn btn-info' onclick="goesToAnimePage(<?= $mal_id ?>)">Visit Anime Page</button></td>
                  <td> <?= $row['image'] ?? "" ?> </td>
                </tr>
            <?php
              }
            } else {
            }
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php include 'templates/footer.html' ?>
</body>

</html>