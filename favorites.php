<!DOCTYPE html>

<html lang="en-US">
  <head>
    <title>Porto Eats</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_restaurants.css">
  </head>
  <body  class="mainpage">
  <header>

        <h1><a href="/">Porto Eats</a></h1>
        
        <div class="sidebar"></div>
    
        <div class="toggle" onclick="toggleMenu();">
        </div>

        <ul class="menu">
            <?php
            session_start();

            if(isset($_SESSION['username']))
            echo '<li><a href="profile.php" class="menu_element" onmouseover="changeColor(0)" onmouseout="defaultColor()"> Profile</a> </li>';
            else {
            echo  '<li><a href="login.php" class="menu_element" onmouseover="changeColor(0)" onmouseout="defaultColor()">Login / Register</a> </li>';
            }
            ?>


            <li><a href="restaurants.php" class="menu_element" onmouseover="changeColor(1)" onmouseout="defaultColor()">Restaurants</a> </li>
            <li><a href="favorites.php" class="menu_element" onmouseover="changeColor(2)" onmouseout="defaultColor()">Favorites</a> </li>
            <?php


            if(isset($_SESSION['username']) and $_SESSION['isOwner']) {
                echo '<li><a href="myrestaurants.php" class="menu_element" onmouseover="changeColor(3)" onmouseout="defaultColor()">My Restaurants</a> </li>';
            }
            else {
                echo '<li><a href="#" class="menu_element" onmouseover="changeColor(4)" onmouseout="defaultColor()">My Orders</a> </li>';
            }
            ?>
        </ul>

    </header>

    <main>

    <?php

    require_once('database/connection.db.php');
    require_once('database/dish_class.php');
    require_once('database/restaurant_class.php');

    $db = getDatabaseConnection();
    
    if(!isset($_SESSION['id'])){
      header('Location: login.php');
    }
    ?>
    

    <section id="favourite-dishes" >
        <h1 class="favourite-dishes-heading">
            Favourite Dishes
        </h2>
        <div id="dishes-container">
          <?php
          $dishes = Dish::getFavouriteDishes($db, $_SESSION['id']);

          foreach($dishes as $dish){
              echo '<div class="dish-box" id="'.$dish['id'].'">
                        <div class = "crop-dish" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>

                        <p class="info-dish-name">'.$dish['name'] .'</p>
                        <p class="info-dish-price">'.$dish['price'] .'€</p> 
                         
                    </div>';
          }
          ?>

        </div>
    </section>

    <section id="restaurants">
        <h1 class="favourite-dishes-heading">
            Favourite Restaurants
        </h2>

      <div id="restaurants-container">
      <?php
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');

      $db = getDatabaseConnection();
      $restaurants = Restaurant::getFavouriteRestaurants($db, $_SESSION['id']);

      foreach ($restaurants as $restaurant) {
          echo '<div class="rest"><div class = "crop" ><a href="dishes.php?id='. $restaurant['id'] .'"> <img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"></a> </div>'.
          '<a class="restaurant" href="dishes.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
          <p class="info-address">'.$restaurant['address'].'</p>
          </div>';
      }
      ?>
      </div>
    </section>

    </main>

    <footer> Favorites &copy; 2022 </footer>
  </body>
</html>

<script src="javascript/search.js"></script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

<script>
  var ID_RESTAURANT = <?php echo $_GET['id']?>;
  var ID_USER = <?php echo $_SESSION['id']?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


