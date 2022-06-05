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

        <a href="#" class="cart"> <i class="fas fa-shopping-cart" onclick=""></i>
        <span>0</span>
        </a>
      
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
            <li><a href="#" class="menu_element" onmouseover="changeColor(2)" onmouseout="defaultColor()">Favorites</a> </li>
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
    
    <div class="searchbar">
        <div class="image"><img  src="Images/Restaurants/<?php echo $_GET['id'] ?>.jpeg"> </div>
        <div class="search-bar-text search-dish">
          <h1>Search your favourite dishes</h1>
          <p> You can search by:
              <div class="radio">
              <input type = "radio" name="name" id="name" value="true">
              <label for="name">Name</label>

              <input type = "radio" name="name" id="price" value="false">
              <label for="price">Price</label>

              <input type = "radio" name="name" id="favorites" value="false">
              <label for="favorites">Favorites</label>
          </div>
          </p>
          <input id="searchbar" type="text" onkeyup="search_restaurant()" placeholder="Search...">
          
        </div>
    </div>




    <?php

    require_once('database/connection.db.php');
    require_once('database/dish_class.php');

    $db = getDatabaseConnection();

    ?>

    <section id="dishes">

        <div id="dishes-container">
          <?php
          $dishes = Dish::getDishesRestaurant($db, $_GET['id']);

          foreach($dishes as $dish){
              echo '<div class="dish-box">
                        <div class = "crop-dish" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>

                        <p class="info">'.$dish['name'] .'</p>
                        <p class="info-dish-price">'.$dish['price'] .'€</p> 
                        <a id='.$dish['id'].'  class="cart-btn">
                            <i class="fas fa-cart-plus"></i></i> <p>Add Cart</p>
                        </a>
                        <a id='.$dish['id'].' class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                         
                    </div>';
          }
          ?>

        </div>
    </section>

<!--Write Review-->
<form id="feedback" action="">

 <div class="pinfo">Restaurant Rating</div>
  

<div class="form-group">
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
   <select class="form-control" id="rate">
      <option value="1star">1</option>
      <option value="2stars">2</option>
      <option value="3stars">3</option>
      <option value="4stars">4</option>
      <option value="5stars">5</option>
    </select>
    </div>
  </div>
</div>

 <div class="pinfo">Write your feedback.</div>
  

<div class="form-group">
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
  <textarea class="form-control" id="review" rows="3"></textarea>
 
    </div>
  </div>
</div>

 <button type="submit" class="btn btn-primary">Submit</button>


</form>
      </article>
    </main>

    <footer> Dishes &copy; 2022 </footer>
  </body>
</html>

<script src="javascript/search.js"></script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>