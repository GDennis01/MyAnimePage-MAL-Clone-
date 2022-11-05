<!-- TODO: not-logged-in guard in php -->
<?php
include 'utils.php';
$conn = dbConn();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.html' ?>
<link href="css/animepage.css" rel="stylesheet">
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
    //fetch anime with value
    $sql = "SELECT * FROM anime_list WHERE mal_id = $value";
    $result = mysqli_query($conn, $sql);
    $anime = mysqli_fetch_assoc($result);

    $name=$anime['Name'];
    $jap_name = $anime['Japanese name'];
    $episode = $anime['Episodes'];
    $studio = $anime['Studios'];
    $premiered = $anime['Premiered'];
    $type = $anime['Type'];
    $source = $anime['Source'];
    $genre = $anime['Genres'];
    $syn = $anime['synopsis'];
    ?>
    <div id="animeInfo" class="col-3">
      <img src="https://cdn.myanimelist.net/images/anime/5/73199.jpg" alt="Anime image" id="animeImg">
      <div class="animeStats">
        <ul>
          <li>Anime name: <?=$name ?></li>
          <li>Japanese name:<?=$jap_name ?></li>
          <li>Episodes:<?=$episode?></li>
          <li>Studio:Aniplex<?=$studio?></li>
          <li>First aired:2011<?=$premiered?></li>
          <li>Type: <?=$type?></li>
          <li>Source: <?=$source?></li>
          <li>Genre: <?=$genre?></li>
        </ul>
      </div>
    </div>

    <!-- Anime controls: adding anime to own animelist, rate it(?) etc -->
    <div id="ctrlSyn" class="col-5">
      <div id="animeCtrl">
        <!-- bootstrap button -->
        <button type="button" class="btn btn-primary">Add to my list</button>
        <button type="button" class="btn btn-primary">Rate</button>

      </div>
      <!-- Anime description -->
      <div id="animeSynopsis">
        <p>
          <?=$syn?>
      </div>
    </div>

  </div>


  <div class="row charaReview">
    <div class="col-1">

    </div>
    <div class="col-3">
  
    </div>
    <div class="col-4">
      <!-- Anime reviews -->
      <div id="animeReviews">
        <h3>Reviews</h3>
        <ul>
          <li>Review 1</li>
          <li>Review 2</li>
          <li>Review 3</li>
          <li>Review 4</li>
          <li>Review 5</li>
        </ul>
      </div>
    </div>
  </div>


  <?php include 'templates/footer.html' ?>
</body>

</html>