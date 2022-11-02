<!-- TODO: not-logged-in guard in php -->
<?php
include 'utils.php';
$conn = dbConn();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.html' ?>

<body>
  <?php include 'templates/navbar.html'?>

  <!-- Aside left div with anime information  -->
  <div id="animeInfo">
    <img src="https://cdn.myanimelist.net/images/anime/5/73199.jpg" alt="Anime image" id="animeImg">
    <div class="animeStats">
      <ul>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
        <li>Anime</li>
      </ul>
    </div>
  </div>
  <div>
    
  </div>
  <?php include 'templates/footer.html' ?>
</body>

</html>