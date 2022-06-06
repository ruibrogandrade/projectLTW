<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="CSS/style_all.css">
  <link rel="stylesheet" href="CSS/style_restaurants.css">
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
            else {
                echo '<li><a href="#" class="menu_element" onmouseover="changeColor(4)" onmouseout="defaultColor()">My Orders</a> </li>';
            }
            ?>
        </ul>

    </header>

    <div class="searchbar">
        <img src="IMAGES/food_dark.jpg">
        <div id="search-bar-text">
          <h1>Are you hungry? Order a dish!</h1>
          <p>Search for a restaurant near you. There are plenty of options.</p>
          <input id="searchbar" type="text" onkeyup="search_restaurant()" placeholder="Search...">
          
        </div>
      </div>

      <section id="category">
        <div class="heading">
            <h2>Category</h2>
            <span onclick="search_category('all')">All</span>
        </div>
        <div class="category-container">
            <a onclick="search_category('Fast Food')" class="category-box">
                <img src="IMAGES/fast-food.png">
                <span>Fast Food</span>
            </a>
            <a onclick="search_category('Coffe')" class="category-box">
                <img src="images/coffee-cup.png">
                <span>Coffe</span>
            </a>
            <a onclick="search_category('Japanese Food')" class="category-box">
                <img src="images/japanese.png">
                <span>Japanese Food</span>
            </a>
            <a onclick="search_category('Ice Cream')" class="category-box">
                <img src="images/ice-cream.png">
                <span>Ice Cream</span>
            </a>
            <a onclick="search_category('Brazilian Food')" class="category-box">
                <img src="images/brazil.png">
                <span>Brazilian Food</span>
            </a>
        </div>
        
      </section>

    <section id="restaurants">
      <div class="heading">
              <h2>Restaurants</h2>
      </div>

      <div id="restaurants-container">
      <?php
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');

      $db = getDatabaseConnection();
      $restaurants = Restaurant::getRestaurants($db);
      if(isset($_SESSION['id'])){
        $favourites  = Restaurant::getFavouriteRestaurantsIds($db, $_SESSION['id']);
      }
      

      foreach ($restaurants as $restaurant) {
          echo '<div class="rest"><div class = "crop" ><a href="dishes.php?id='. $restaurant['id'] .'"> <img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"></a> </div>'.
          '<a class="restaurant" href="dishes.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
          <p class="info-address">'.$restaurant['address'].'</p>
          <p class="info-categorie">'. $restaurant['category_name'] .'</p>';
          if(isset($_SESSION['id'])){
          echo '<a id='.$restaurant['id'].' class="like-btn" onclick="favourite_restaurant(this)">
                        <i class="'; 
                        if(in_array($restaurant['id'], $favourites)){
                          echo 'fas';
                        } else{
                          echo 'far';
                        }

                        echo ' fa-heart"></i></i>
            </a>';
         }
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
<script src="javascript/search.js"></script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<script src="javascript/favourite.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>