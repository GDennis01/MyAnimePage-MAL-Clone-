<!-- TODO: not-logged-in guard in php -->
<?php
include 'utils.php';
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
              <!-- <th scope="col">Image</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // TODO: get user id from session
            // TODO: using ajax to print the table
            $sql = "SELECT * FROM anime_list";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["Episodes"] . "</td>";
                echo "<td>" . $row["Score"] . "</td>";
                echo "<td>" . $row["Studios"] . "</td>";
                // echo "<td>" . $row["image"] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
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