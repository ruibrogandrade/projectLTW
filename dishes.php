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
      <h1><a href="restaurants.php"></a></h1>
    </header>
  
    <main>
          <h2>
          <?php

            session_start();

            require_once('database/connection.db.php');
            require_once('database/restaurant_class.php');

            $db = getDatabaseConnection();

            $restaurant = Restaurant::getRestaurantWithId($db, $_GET['id']);
            echo $restaurant->name;
            var_dump($restaurant->name);
            exit(0); 
            ?>       
    </h2>

    <?php
    session_start();

    require_once('database/connection.db.php');
    require_once('database/dish_class.php');

    $db = getDatabaseConnection();

    $dishes = Dish::getDishesRestaurant($db, $_GET['id_Owner']);


    $i = 4;

    foreach($dishes as $dish) {
      if($i == 4) {
        echo '<div class = "row">';
      }
      echo '<div class = "collumn">';
      echo '<img src="https://picsum.photos/200?id=' . $dish['id'] .'">'
        . '<p class="info">Price</p>'
        . '<p class="info">Category</p>'
        . '</div>';
    }


   /*   <article>
        <class="row">
        <div class="column">
        <img src="https://picsum.photos/200?1">
        <p class="info">Price</p>
        <p class="info">Category</p>
        </div>
        <div class="column">
        <img src="https://picsum.photos/200?2">
        <p class="info">Price</p>
        <p class="info">Category</p>
        </div>
        <div class="column">
        <img src="https://picsum.photos/200?3">
        <p class="info">Price</p>
        <p class="info">Category</p>
        </div>
        </div>
      </article> */
      ?>

    </main>

    <footer> Dishes &copy; 2022 </footer>
  </body>
</html>