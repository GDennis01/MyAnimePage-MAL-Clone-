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
  <!-- grid -->
    <div class="row info&stat">
      <div class="col-3">
        <div id="animeInfo">
          <img src="https://cdn.myanimelist.net/images/anime/5/73199.jpg" alt="Anime image" id="animeImg">
          <div class="animeStats">
            <ul>
              <li>Anime name: Steins;Gate</li>
              <li>Japanese name:Steins;Gate</li>
              <li>Episodes:24</li>
              <li>Studio:Aniplex</li>
              <li>First aired:2011</li>
              <li>Type: TV</li>
              <li>Source: Visual Novel</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-2">
        <!-- Anime controls: adding anime to own animelist, rate it(?) etc -->
        <div id="animeCtrl">
          <!-- bootstrap button -->
          <button type="button" class="btn btn-primary">Add to my list</button>
          <button type="button" class="btn btn-primary">Rate</button>

        </div>
        <!-- Anime description -->
        <div id="animeSynopsis">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nisl nisl
            condimentum nisl, nec lacinia nunc nisl eget nisl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas quasi rem sit beatae delectus optio aliquid ab dignissimos eius corrupti, accusantium molestiae quia qui debitis amet ea, minima repudiandae voluptatum?
          </p>
        </div>
      </div>

    </div>

    <div class="row charaReview">
      <div class="col-3">
        <!-- Anime characters -->
        <div id="animeCharacters">
          <h3>Characters</h3>
          <ul>
            <li>Okabe Rintarou</li>
            <li>Mayuri Shiina</li>
            <li>Hashida Itaru</li>
            <li>Moeka Kiryuu</li>
            <li>Amadeus</li>
          </ul>
        </div>
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