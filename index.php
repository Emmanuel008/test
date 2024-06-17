<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width= device-width intial-scale =1" />
    <title></title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>


    <section class="s-services" id="services">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              <?php
                  $host = "localhost";
                  $username = "root";
                  $password = "";
                  $db = "medical";
                  $port = 3306;
  
                  // Create database connection
                  $conn = new mysqli($host, $username, $password, $db, $port);
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }
  
                  $sql = "SELECT * FROM `news` ORDER BY `id` DESC";
                  $result = $conn->query($sql);
                  $activeClass = 'active';
  
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) { ?>
                          <div class="carousel-item <?php echo $activeClass; ?>">
                              <div class="card">
                                  <div class="img-wrapper">
                                      <img src="./images/<?php echo $row['photo']; ?>" class="d-block w-100" alt="">
                                  </div>
                                  <div class="card-body">
                                      <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                      <p class="card-text"><?php echo $row['description']; ?></p>
                                      <a href="<?php echo $row['readmore']; ?>" class="btn btn-primary">Read more</a>
                                  </div>
                              </div>
                          </div>
                      <?php
                          $activeClass = '';
                      }
                  } else {
                      echo "NO ITEMS UPLOADED";
                  }
  
                  $conn->close();
              ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div>

      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>
  </body>
</html>
