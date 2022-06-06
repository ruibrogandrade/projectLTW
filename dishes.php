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

        <a onclick="toggleCart()" class="cart-icon"> <i class="fas fa-shopping-cart" "></i>
        <span>0</span>
        </a>
        <div class="cart">
            <h2>Your Cart</h2>
            <div class="cart-content">
                <div class="products">
                </div>    
                

                <div class="cart-total">
                  <h3>Total: </h3>
                  <p class="total-price">0€</p>
                </div>

                <button onclick="checkOut()" class="cart-btn cart-check-out"> Check out</button>

                <img src="IMAGES/close.png" class ="cart-close-btn" onclick="toggleCart()" alt="">
            </div>

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
    
    <div class="searchbar">
        <div class="image"><img  src="Images/Restaurants/<?php echo $_GET['id'] ?>.jpeg"> </div>
        <div class="search-bar-text search-dish">
          <h1>Search your favourite dishes</h1>
          <p> You can search by:
              <div class="search-dish-radio">
                <input type = "radio" name="dish-radio" id="name" value="true">
                <label for="name">Name</label>

                <input type = "radio" name="dish-radio" id="price" value="false">
                <label for="price">Max price</label>

              </div>
          </p>
          <input id="searchbar" type="text" onkeyup="search_dishes()" placeholder="Search...">
          
        </div>
    </div>




    <?php

    require_once('database/connection.db.php');
    require_once('database/dish_class.php');
    require_once('database/restaurant_class.php');


    $db = getDatabaseConnection();

    ?>

    <section id="dishes">

        <div id="dishes-container">
          <?php
          $dishes = Dish::getDishesRestaurant($db, $_GET['id']);
          $favourites  = Dish::getFavouriteDishesIds($db, $_SESSION['id']);

          foreach($dishes as $dish){
              echo '<div class="dish-box" id="'.$dish['id'].'">
                        <div class = "crop-dish" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>

                        <p class="info-dish-name">'.$dish['name'] .'</p>
                        <p class="info-dish-price">'.$dish['price'] .'€</p> 
                        <a id='.$dish['id'].'  class="cart-btn" onclick="addCart(this)">
                            <i class="fas fa-cart-plus"></i></i> <p>Add Cart</p>
                        </a>
                        <a id='.$dish['id'].' class="like-btn" onclick="favourite(this)">
                        <i class="'; 
                        if(in_array($dish['id'], $favourites)){
                          echo 'fas';
                        } else{
                          echo 'far';
                        }

                        echo ' fa-heart"></i></i>
                        </a>
                         
                    </div>';
          }
          ?>

        </div>
    </section>

    <section id="reviews">
        <div class="heading">
                <h2>What are people talking about us?</h2>
        </div>
        <div id="reviews-container">
            <?php
                $reviews = Restaurant::getReviewsWithRestaurant($db, $_GET['id']);

                foreach($reviews as $review){
                    echo '<div class="review">'
                        .'<div class="profile">'
                        .'<img src="Images/Users/'.$review['id_writer'].'.png" >'
                        .'<div class="profile-text">'
                              . '<p class="info username">@'.$review['username'] .'</p>'
                        .'</div>
                        </div>
                        <div class="rating">';

                        for($j=0; $j<$review['classification'];$j++){
                          echo '<i class="fas fa-star"></i>';
                        }
                          
                       echo '</div>'
                        . '<p class="info comment">'.$review['comment'] .'</p>'
                        .'</div>';
                }
            
            ?>
            <!--Write Review-->
            <div class="review">
              <form id="feedback" action="">
                    <p>Leave your comment...</p>
                    <div class="star-rating">
                        <input type="radio" onchange="star(1)" name="rate" id="star1">
                        <label for="star1"> <i class="fas fa-star"></i></i></label>
                        <input type="radio" onchange="star(2)" name="rate" id="star2">
                        <label for="star2"> <i class="fas fa-star"></i></label>
                        <input type="radio" onchange="star(3)" name="rate" id="star3">
                        <label for="star3"> <i class="fas fa-star"></i></label>
                        <input type="radio" onchange="star(4)"  name="rate" id="star4">
                        <label for="star4"><i class="fas fa-star"></i> </label>
                        <input type="radio" onchange="star(5)"  name="rate" id="star5">
                        <label for="star5"><i class="fas fa-star"></i> </label>
                        
                    </div>
                    </input>
                    <p><textarea class="text-box" rows="5"></textarea></p>
                    <p><button type="submit" class="btn">Submit</button></p>
              </form>
            </div>

        </div>
    </section>


    
  
      </article>
    </main>

    <footer> Dishes &copy; 2022 </footer>
  </body>
</html>

<script src="javascript/search.js"></script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<script>
  function star(id){
    var inputs = document.getElementsByClassName('star-rating')[0].getElementsByTagName('input');
    console.log(inputs);
    console.log(inputs.length);

    for(let a = 0; a<inputs.length; a++){
      console.log(a);

      if(a<id){
        document.getElementsByClassName('star-rating')[0].getElementsByTagName('label')[a].classList.add('colored');
      }else{
        document.getElementsByClassName('star-rating')[0].getElementsByTagName('label')[a].classList.remove('colored');
      }
    }

  }
</script>
<script>
  var ID_RESTAURANT = <?php echo $_GET['id']?>;
  var ID_USER = <?php echo $_SESSION['id']?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="javascript/cart.js"></script>
<script src="javascript/favourite.js"></script>

