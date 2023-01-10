<!-- W3C validated! -->
<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.php");
  return;
}
include 'api/utils.php';
$user = $_SESSION['id'];
$search = $_GET['id'] ?? $user; //if I access the page without a search parameter, I want to see my own page
$editable = $user == $search; //if I'm looking at my own page, I want to be able to edit it
$conn = dbConn() or die("Connection failed");
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.html' ?>
<script src="js/animepage.js"></script>
</head>

<body>
  <?php include 'templates/navbar.html' ?>
  <?php
  if ($search != $user) {
    $sql = "SELECT name from user where id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$search]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $result['name'] ?? "Utente non trovato";

    if ($name == "Utente non trovato")
      header("Location: myanimepage.php");

    unset($stmt);
  }
  ?>
  <!-- Printing a table with all anime -->
  <div class="container">
    <div class="row">
      <div class="col">
        <?php if ($editable) { ?>
          <h1>My anime page</h1>
        <?php } else { ?>
          <h1><?= $name ?>'s anime page</h1>
        <?php } ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col"><b>Title</b></th>
              <th scope="col"><b>Episodes</b></th>
              <th scope="col"><b>Score</b></th>
              <th scope="col"><b>Studio</b></th>
              <?php if ($editable) : ?>
                <th scope="col"></th>
              <?php endif; ?>
              <!-- <th scope="col">Image</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // error_reporting(0);
            // $sql = "SELECT MAL_ID,Name,Episodes,Score,Studios FROM anime_list JOIN anime_user ON anime_list.mal_id = anime_user.id_anime ";
            $sql = "SELECT * FROM anime_list JOIN anime_user ON anime_list.mal_id = anime_user.id_anime ";
            // if ($editable) {
            //   // $sql .= "WHERE anime_user.id_user = $user";
            //   $sql .= "WHERE anime_user.id_user = ?";
            // } else {
            //   $sql .= "WHERE anime_user.id_user = ?";
            // }
            $sql .= "WHERE anime_user.id_user = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$search]);


            $id_user = $_SESSION['id'];
            // if (mysqli_num_rows($result) > 0) {
            // while ($row = mysqli_fetch_assoc($result)) :
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                $mal_id = $row['MAL_ID'];
            ?>
                <tr id="<?= $mal_id ?>">
                  <td><b><a href="anime.php?id=<?= $mal_id ?>"> <?= $row['Name'] ?></a></b> </td>
                  <td> <?= $row['Episodes'] ?> </td>
                  <td> <?= $row['Score'] ?> </td>
                  <td> <?= $row['Studios'] ?> </td>
                  <td> <img src='<?= ($row['thumbnail']) ?> ' height="50px" width="50px"> </td>
                  <!-- Buttons to edit(only if you are visiting your own page) -->
                  <?php if ($editable) : ?>
                    <td><button type='button' class='btn btn-danger' onclick="deleteEntry(<?= $id_user ?>,<?= $mal_id ?>)">Delete</button></td>
                    <!-- <td><button type='button' class='btn btn-info' onclick="goesToAnimePage(<?php //$mal_id;
                                                                                                  ?>)">Visit Anime Page</button></td> -->
                  <?php endif; ?>

                </tr>
            <?php
              endwhile;
            }
            // mysqli_close($conn);
            unset($db);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include 'templates/footer.html' ?>
</body>

</html>