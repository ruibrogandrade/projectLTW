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
          '<img src="https://picsum.photos/200?1">' .
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

    </section>
  </main>
  <footer>
    Restaurants &copy; 2022
  </footer>
</body>

</html>