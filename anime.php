<!-- W3C Validated -->
<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.html");
  return;
}
include 'api/utils.php';
$conn = dbConn() or die("Connection failed");

$value = $_GET['id'] ?? -1;
$id_user = $_SESSION['id'];
$privilege = $_SESSION['privilege'];


$sql = "SELECT * FROM anime_list WHERE mal_id = ?";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute([$value]);
} catch (PDOException $e) {
  header("Location: index.php");
}

// If the anime is not in the database, redirect to the index page
if ($stmt->rowCount() == 0) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="css/animepage.css" rel="stylesheet">
  <?php include 'templates/header.html' ?>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="js/anime.js"></script>
</head>

<body>
  <?php include 'templates/navbar.html' ?>
  <!-- grid -->
  <div class="row info&stat">
    <!-- Anime info column -->
    <div class="col-1">

    </div>
    <?php


    // Check if the anime has been already added to the user's list
    $checkIfAdded = "SELECT * FROM anime_user WHERE id_user = ? AND id_anime = ?";

    try {
      $stmt2 = $conn->prepare($checkIfAdded);
      $stmt2->execute([$id_user, $value]);
    } catch (PDOException $e) {
      header("Location: index.php");
    }

    if ($stmt2->rowCount() > 0) {
      $added = true;
      $text = "Already added to your anime page";
    } else {
      $added = false;
      $text = "Add to list";
    }
    //fetch anime with value with the first prepared query
    $anime = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_user = $_SESSION['id'];

    $name = $anime['Name'];
    $jap_name = $anime['Japanese name'];
    $episode = $anime['Episodes'];
    $studio = $anime['Studios'];
    $premiered = $anime['Premiered'];
    $type = $anime['Type'];
    $source = $anime['Source'];
    $genre = $anime['Genres'];
    $syn = $anime['synopsis'];
    $image = $anime['image'];
    ?>
    <!-- Anime info -->
    <div id="animeInfo" class="col-3 card" style="width: 24rem;">
      <!-- <img src="https://cdn.myanimelist.net/images/anime/5/73199.jpg" alt="Anime image" id="animeImg"> -->
      <img src='<?= $image ?>' alt="Anime image" id="animeImg">
      <div class="card-body">
        <h4 class="card-title"><b><?= $name ?></b></h4>
        <h5 class="card-text"><b><?= $jap_name ?></b></h5>
      </div>
      <div class="animeStats ">
        <ul>

          <li><b>Episodes:</b> <?= $episode ?></li>
          <li><b>Studio:</b> <?= $studio ?></li>
          <li><b>First aired:</b> <?= $premiered ?></li>
          <li><b>Type:</b> <?= $type ?></li>
          <li><b>Source:</b> <?= $source ?></li>
          <li><b>Genre:</b> <?= $genre ?></li>
        </ul>
      </div>
    </div>

    <!-- Anime controls: adding anime to own animelist etc -->
    <div id="ctrlSyn" class="col-5">
      <div id="animeCtrl">
        <!-- bootstrap button -->
        <button id="btnAddList" type="button" class="btn btn-primary" <?php if ($added) {
                                                                        echo "disabled='disabled'";
                                                                      } ?>>
          <?= $text ?>
        </button>
        <button id="btnRemove" type="button" class="btn btn-primary" <?php if (!$added) {
                                                                        echo "style='display:none;'  ";
                                                                      } else {
                                                                        echo "style='display:block;'";
                                                                      }     ?>>
          Remove from list
        </button>
      </div>
      <!-- Anime description -->
      <div id="animeSynopsis" class="card">
        <div class="card-header">
          <h5>Synopsis</h5>
        </div>
        <div class="card-body">
          <?= $syn ?>
        </div>
      </div>
    </div>

  </div>

  <!-- Reviews -->
  <div class="charaReview">
    <div class="col-1">

    </div>
    <div class="col-3">
      <textarea id="review" name="review" rows=3 cols=50>Write a review!</textarea>
      <input id="btnReview" type="button" value="Submit">
    </div>
    <div class="col-4">
      <!-- Anime reviews -->
      <div id="animeReviews">
        <h3>Reviews</h3>
        <ul>
          <!-- print all reviews -->
          <?php
          unset($stmt);
          $error = false;
          $sql = "SELECT * FROM review JOIN user ON review.id_user = user.id_user WHERE id_anime = ?";
          try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$value]);
          } catch (PDOException $e) {
            $error = true;
          }
          if ($error === false) :
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) :   ?>
              <li><b><?= $rows['name'] ?></b>: <?= $rows['text'] ?>

                <?php if ($privilege == 1) { ?>
                  <button id="delReview<?= $rows['id_review'] ?>" class="review-entry">
                    <i class="fa-solid fa-trash"></i>
                  </button>
              </li> <?php } ?>
        <?php
            endwhile;
            unset($db);
          endif;
        ?>
        </ul>
      </div>
      <div id="review-error">

      </div>
    </div>
  </div>


  <?php include 'templates/footer.html' ?>
</body>

</html>