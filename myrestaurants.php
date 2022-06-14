<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="CSS/style_all.css">
  <link rel="stylesheet" href="CSS/style_restaurants.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
</head>

<body class="mainpage">
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

            ?>
        </ul>

    </header>

    <section id="restaurants">
      <div class="my-restaurants-heading">
              <h2>My Restaurants</h2>
      </div>

      <div id="restaurants-container">
      <?php
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');

      $db = getDatabaseConnection();
      $restaurants = Restaurant::getRestaurantWithOwner($db, $_SESSION['id']);

      foreach ($restaurants as $restaurant) {
          echo '<div class="rest"><div class = "crop" ><a href="restaurant_page.php?id='. $restaurant['id'] .'"> <img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"></a> </div>'.
          '<a class="restaurant" href="restaurant_page.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
          <p class="info-address">'.$restaurant['address'].'</p>
          <p class="info-categorie">'. $restaurant['category_name'] .'</p>';
          echo '</div>';

      }
      ?>
      </div>
    </section>
    
</body>
</html>

<script>
  var ID_USER = <?php echo $_SESSION['id']?>;
</script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>