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
          /*

            session_start();

            require_once('database/connection.db.php');
            require_once('database/restaurant_class.php');

            $db = getDatabaseConnection();

            $restaurant = Restaurant::getRestaurantWithId($db, $_GET['id']);
            echo $restaurant->name;
            var_dump($restaurant->name);
            exit(0); 
            */
            ?>
    </h2>
      <article>
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