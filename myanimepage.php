<!-- W3C validated! -->
<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.html");
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

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <?php include 'templates/header.html' ?>
  <link rel="stylesheet" href="css/myanimepage.css">
  <script src="js/animepage.js"></script>
</head>

<body>
  <?php include 'templates/navbar.html' ?>
  <?php
  if ($search != $user) {
    $sql = "SELECT name from user where id_user = ?";
    try {
      $stmt = $conn->prepare($sql);
      $stmt->execute([$search]);
    } catch (PDOException $e) {
      header("Location: myanimepage.php"); //going to my own myanimepage
      return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $result['name'] ?? "Utente non trovato";
    if ($name == "Utente non trovato") {
      header("Location: myanimepage.php"); //going to my own myanimepage
      return;
    }

    unset($stmt);
  }
  ?>
  <div id="error"></div>
  <!-- Printing a table with all anime -->
  <div class="container ">
    <div class="row ">
      <h1>My anime page</h1>
      <div class="col mal">
        <?php if ($editable) { ?>
        <?php } else { ?>
          <h1><?= $name ?>'s anime page</h1>
        <?php } ?>
        <table class="table table-striped mal ">
          <thead>
            <tr>
              <th scope="col"><b>Title</b></th>
              <th scope="col"><b>Episodes</b></th>
              <th scope="col"><b>Score</b></th>
              <th scope="col"><b>Studio</b></th>
              <th scope="col"></th>
              <?php if ($editable) : ?>
                <th scope="col"></th>
              <?php endif; ?>
              <!-- <th scope="col">Image</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM anime_list JOIN anime_user ON anime_list.mal_id = anime_user.id_anime ";
            $sql .= "WHERE anime_user.id_user = ?";
            $error = false;
            try {
              $stmt = $conn->prepare($sql);
              $stmt->execute([$search]);
            } catch (PDOException $e) {
              $error = true;
            }


            $id_user = $_SESSION['id'];
            // if (mysqli_num_rows($result) > 0) {
            // while ($row = mysqli_fetch_assoc($result)) :
            if ($error === false) {
              if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                  $mal_id = $row['MAL_ID'];
            ?>
                  <tr id="<?= $mal_id ?>">
                    <td><b><a href="anime.php?id=<?= $mal_id ?>"> <?= $row['Name'] ?></a></b> </td>
                    <td> <?= $row['Episodes'] ?> </td>
                    <td> <?= $row['Score'] ?> </td>
                    <td> <?= $row['Studios'] ?> </td>
                    <td> <img src='<?= ($row['thumbnail']) ?> ' height="50" width="50" alt="thumbnail"> </td>
                    <!-- Buttons to edit(only if you are visiting your own page) -->
                    <?php if ($editable) : ?>
                      <td><button id="delete<?= $mal_id ?>" type='button' class='btn btn-danger anime-entry'>Delete</button></td>

                    <?php endif; ?>

                  </tr>
              <?php
                endwhile;
              }
              unset($db);
            } else { ?>
              <tr>
                <td colspan='5'>No anime found</td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include 'templates/footer.html' ?>
</body>

</html>