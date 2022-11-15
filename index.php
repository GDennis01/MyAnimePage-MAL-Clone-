<?php
session_start();
if (!isset($_SESSION['logged'])){
    header("Location: login.html");
  return;
}
$user = $_SESSION['name'];
$date = $_SESSION['date'];
$watched = $_SESSION['watched'];
?>
<!doctype html>
<html lang="en">

<?php include('templates/header.html') ?>
</head>
      <body>
        <!-- HEADER -->
        <header>

        </header>
        <!-- NAVBAR -->
        <?php include('templates/navbar.html') ?>

        <!-- Carousel -->
        <div id="carouselContainer">
          <div id="sugg_anime">
            <h3>Top suggested anime!</h3>
          </div>
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <!-- Actual carousel -->
            <!-- ids and img should be replaced when body loads by an ajax function that generates 3 random number from 
          the pool of mal ids in the database -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/notavailable.png" class="w-100" alt="..." width="240px">
              </div>
              <div class="carousel-item">
                <img src="img/notavailable2.png" class="w-100" alt="..." width="240px">
              </div>
              <div class="carousel-item">
                <img src="img/notavailable3.png" class="w-100" alt="..." width="240px">
              </div>
            </div>
            <!-- Current active carousel anime synopsis-->
            <!--  Search through the dom for carousel-item active, then get its mal id, ajax it to the db to find its
            Synopsis and innerHTML'd it here -->
            <div id="carouselSynopsis">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum officiis, accusamus optio quos assumenda magnam ut est nemo dignissimos, temporibus numquam libero veritatis rerum odio inventore ipsam beatae, eligendi eveniet. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet ab voluptates et in nulla consectetur amet at error voluptas veniam illum delectus repellendus similique tenetur libero repellat sed, illo minus.</p>
            </div>
            <!-- Carousel control buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>

          </div>
        </div>
        <!-- Aside -->
        <aside>
          <!-- Stats of the user -->
          <ul>
            <li>Nome account: <?=$user?></li>
            <li>Data creazione account: <?=$date?></li>
            <li>Anime visti: <?=$watched?></li>
          </ul>

        </aside>
        <!-- Footer -->
        <?php include('templates/footer.html') ?>
      </body>

</html >