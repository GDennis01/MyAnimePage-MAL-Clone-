<!-- W3C Validated! -->
<?php
session_start();
if (!isset($_SESSION['logged'])) {
  header("Location: login.html");
  return;
}
include 'api/utils.php';
$user = $_SESSION['name'];
$date = $_SESSION['date'];
$id_user = $_SESSION['id'];
$watched = $_SESSION['watched'];
?>
<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <?php include('templates/header.html') ?>
</head>

<body>
  <!-- HEADER -->
  <header>

  </header>
  <!-- NAVBAR -->
  <?php include('templates/navbar.html') ?>


  <?php
  $error = false;
  $conn = dbConn() or die("Connection failed");
  $sql = "SELECT MAL_ID,image,synopsis FROM anime_list ORDER BY RAND() LIMIT 3";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $anime_1 = $stmt->fetch(PDO::FETCH_ASSOC);
    $anime_2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $anime_3 = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $error = true;
  }

  ?>
  <!-- Carousel -->
  <div id="carouselContainer">
    <div id="sugg_anime">
      <h3>Anime of the day!</h3>
    </div>
    <?php if ($error === false) : ?>
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <!-- Actual carousel -->
        <!-- ids and img should be replaced when body loads by an ajax function that generates 3 random number from 
          the pool of mal ids in the database -->

        <div class="carousel-inner">
          <div class="carousel-item active">
            <a id="slider_a_0" href='anime.php?id=<?= $anime_1['MAL_ID'] ?>'><img id="slider_0" src='<?= $anime_1['image'] ?>' class="w-100" alt="..." width="320" height="240"></a>
          </div>
          <div class="carousel-item">
            <a id="slider_a_1" href='anime.php?id=<?= $anime_2['MAL_ID'] ?>'><img id="slider_1" src='<?= $anime_2['image'] ?>' class="w-100" alt="..." width="320" height="240"></a>
          </div>
          <div class="carousel-item">
            <a id="slider_a_2" href='anime.php?id=<?= $anime_3['MAL_ID'] ?>'><img id="slider_2" src='<?= $anime_3['image'] ?>' class="w-100" alt="..." width="320" height="240"></a>
          </div>
        </div>

        <!-- Carousel control buttons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>

      </div>
      <!-- Current active carousel anime synopsis-->
      <div id="carouselSynopsis">
        <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum officiis, accusamus optio quos assumenda magnam ut est nemo dignissimos, temporibus numquam libero veritatis rerum odio inventore ipsam beatae, eligendi eveniet. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet ab voluptates et in nulla consectetur amet at error voluptas veniam illum delectus repellendus similique tenetur libero repellat sed, illo minus.</p> -->
        <p id="syn0" class="synopsis"><?= $anime_1['synopsis'] ?></p>
        <p id="syn1" class="synopsis"><?= $anime_2['synopsis'] ?></p>
        <p id="syn2" class="synopsis"><?= $anime_3['synopsis'] ?></p>
      </div>
  </div>
<?php endif; ?>
<!-- Aside -->
<aside>
  <?php
  $conn = dbConn() or die("Connection failed");
  $sql = "SELECT count(*) FROM anime_user where id_user = ?";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);
    $count = $stmt->fetchColumn();
  } catch (PDOException $e) {
    $count = "Not available";
  }
  unset($stmt);
  unset($conn);
  ?>
  <!-- Stats of the user -->
  <ul>
    <li>Nome account: <?= $user ?></li>
    <li>Data creazione account: <?= $date ?></li>
    <li>Anime visti: <?= $count ?></li>
  </ul>

</aside>
<!-- Footer -->
<?php include('templates/footer.html') ?>
</body>

</html>