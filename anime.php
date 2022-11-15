<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.php");
  return;
}
include 'api/utils.php';
$conn = dbConn();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.html' ?>
<link href="css/animepage.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include 'templates/navbar.html' ?>
  <!-- grid -->
  <div class="row info&stat">
    <!-- Anime info column -->
    <div class="col-1">

    </div>
    <?php
    $value = $_GET['id'];
    $id_user = $_SESSION['id'];

    // Check if the anime has been already added to the user's list
    $checkIfAdded = "SELECT * FROM anime_user WHERE id_user = $id_user AND id_anime = $value";
    $result = mysqli_query($conn, $checkIfAdded);
    if (mysqli_num_rows($result) > 0) {
      $added = true;
      $text = "Already added to your anime page";
    } else {
      $added = false;
      $text = "Add to list";
    }
    //fetch anime with value
    $sql = "SELECT * FROM anime_list WHERE mal_id = $value";
    $result = mysqli_query($conn, $sql);
    $anime = mysqli_fetch_assoc($result);
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
    ?>
    <!-- Anime info -->
    <div id="animeInfo" class="col-3">
      <img src="https://cdn.myanimelist.net/images/anime/5/73199.jpg" alt="Anime image" id="animeImg">
      <div class="animeStats">
        <ul>
          <li><b>Anime name:</b> <?= $name ?></li>
          <li><b>Japanese name:</b> <?= $jap_name ?></li>
          <li><b>Episodes:</b> <?= $episode ?></li>
          <li><b>Studio:</b> <?= $studio ?></li>
          <li><b>First aired:</b> <?= $premiered ?></li>
          <li><b>Type:</b> <?= $type ?></li>
          <li><b>Source:</b> <?= $source ?></li>
          <li><b>Genre:</b> <?= $genre ?></li>
        </ul>
      </div>
    </div>

    <!-- Anime controls: adding anime to own animelist, rate it(?) etc -->
    <div id="ctrlSyn" class="col-5">
      <div id="animeCtrl">
        <!-- bootstrap button -->
        <button id="btnAddList" type="button" class="btn btn-primary" <?php if ($added) {
                                                                        echo "disabled='disabled'";
                                                                      } else {
                                                                        echo "onclick=\"addToList($value,$id_user)\"";
                                                                      }     ?>>

          <?= $text ?>
        </button>
        <button type="button" class="btn btn-primary">Rate</button>

      </div>
      <!-- Anime description -->
      <div id="animeSynopsis">
        <p>
          <?= $syn ?>
      </div>
    </div>

  </div>

  <!-- Reviews -->
  <div class="row charaReview">
    <div class="col-1">

    </div>
    <div class="col-3">
      <textarea id="review" name="review" rows=3 cols=50>Write a review!</textarea>
      <input type="button" value="Submit" onclick="postReview(<?= $value ?>,<?= $id_user ?>)">
    </div>
    <div class="col-4">
      <!-- Anime reviews -->
      <div id="animeReviews">
        <h3>Reviews</h3>
        <ul>
          <!-- print all reviews -->
          <?php
          $sql = "SELECT * FROM review JOIN user ON review.id_user = user.id_user WHERE id_anime = $value";
          $result = mysqli_query($conn, $sql);
          while ($rows = mysqli_fetch_assoc($result)) : ?>
            <li><b><?= $rows['name'] ?></b>: <?= $rows['text'] ?> <button class="delReview" onclick="deleteReview(<?= $rows['id_review'] ?>)"><i class="fa-solid fa-trash"></i></button></li>
          <?php
          endwhile;
          ?>
        </ul>
      </div>
    </div>
  </div>


  <?php include 'templates/footer.html' ?>
</body>

</html>