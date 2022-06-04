<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <header>
    <h1><a href="/">Porto Eats</a></h1>
    <h1>Restaurants</h1>

    <div class="searchbar">
      <input id="searchbar" type="text" onkeyup="search_restaurant()" placeholder="Search...">
    </div>

  </header>

  <body>
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
          '<div class = "crop" ><img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"> </div>'.
          '<a class="restaurant" href="dishes.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
          <p class="info">'.$restaurant['address'].'</p>
          <p class="info">'. $restaurant['category_name'] .'</p>' . '</div>';
          $i+=1;
          if ($i == 4) {
            echo '</div>';
            $i = 0;
          }
      }
      ?>
    </section>
    <script src="javascript/search.js"></script>
    </body>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>
</body>
</html>