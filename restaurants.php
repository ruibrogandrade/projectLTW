<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1><a href="/">Porto Eats</a></h1>
    <h1>Restaurants</h1>

    <div class="searchbar">
      <input type="text" placeholder="Search...">
    </div>

  </header>

  <main>
    <h2>Restaurants</h2>
    <section id="restaurants">
      <?php

      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');
      $i = 4;
      $db = getDatabaseConnection();
      $restaurants = Restaurant::getRestaurants($db);

      foreach ($restaurants as $restaurant) {
        if ($i == 4) {
          echo '<div class="row">';
        }
          echo '<div class="column">' .
          '<img src="https://picsum.photos/200?id='. $restaurant['id'] .'">' .
          '<a href="dishes.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
          <p class="info">'.$restaurant['address'].'</p>
          <p class="info">'. $restaurant['id_category'] .'</p>' . '</div>';
          $i+=1;
          if ($i == 4) {
            echo '</div>';
            $i = 0;
          }
      }
      ?>
<!--       
      <!
      <div class="row">
        <div class="column">
          <img src="https://picsum.photos/200?1">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?2">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?3">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?4">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <img src="https://picsum.photos/200?5">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?6">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?7">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
        <div class="column">
          <img src="https://picsum.photos/200?8">
          <a href="dishes.php?id=1">Restaurant Name</a>
          <p class="info">Address</p>
          <p class="info">Category</p>
        </div>
      </div>
    -->

    </section>
  </main>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>
</body>
</html>