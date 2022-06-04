<!DOCTYPE html>

<html lang="en-US">
  <head>
    <title>Porto Eats</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style_dishes.css">
  </head>
  <body>
    <header>

      <div id="header-fixed">
        <h1><a href="/">Porto Eats</a></h1>
        
        <div class="toggle" onclick="toggleMenu();">
        </div>
      </div>


      <div class="cart">
      </div>

    </header>

    <main>


    <?php
    session_start();

    require_once('database/connection.db.php');
    require_once('database/dish_class.php');

    $db = getDatabaseConnection();

    ?>

    <h1> Dishes </h1>
    <div id="dishes-div">
    
    

    <?php
    $dishes = Dish::getDishesRestaurant($db, $_GET['id']);

    foreach($dishes as $dish){
        echo '<div class="dish-box"><div class = "crop" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>
          <div class="dish-info-cart">'
        . '<div class="dish-info"> <p class="info">'.$dish['name'] .'</p>'
        . '<p class="info">'.$dish['price'] .'€</p> </div>
        <button id='.$dish['id'].'>  </button> </div></div>'
        ;
    }
    ?>
    </div>
    </div>
    </div>

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