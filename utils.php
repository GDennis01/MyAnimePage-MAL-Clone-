<?php

function dbConn(){
    $conn = mysqli_connect("localhost", "root", "", "anime_db");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
function head()
{
?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- js bootstrap library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- css bootstrap library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <!-- custom css library -->
    <link href="css/style.css" rel="stylesheet">
    <title>My Anime Page</title>
  </head>

<?php
}

function footer()
{
?>

  <footer>
    <p>Copyright @ Dennis Gobbi2022</p>
  </footer>
<?php
}

function navbar()
{
?>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg ">

    <div class="container-fluid">
      <a class="navbar-brand" href="myanimepage.php">My anime page</a>
      <!--Button that shows up when windows shrink
            as the "data-bs-target" implies, it targets the indicated element, in this case the div that wraps up the whole navbar-->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Home -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
          </li>
          <!-- Random Anime page -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="anime.php">Random anime</a>
          </li>
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Random anime page</a>
          </li> -->
        </ul>
        <!-- Search bar -->
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

    </div>
  </nav>
<?php
}
?>