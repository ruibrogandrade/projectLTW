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
    <h1>My Restaurants</h1>


  </header>

  <body>
    <section id="restaurants">
      <?php
    
      session_start();
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');
      $i = 4;
      $db = getDatabaseConnection();
      $restaurants = Restaurant::getRestaurantWithOwner($db, $_SESSION['id']);

      if($restaurants!=null){
        foreach ($restaurants as $restaurant) {
            if ($i == 4) {
            echo '<div class="row">';
            }
            echo '<div class="column">' .
            '<img src="https://picsum.photos/200?id='. $restaurant['id'] .'">' .
            '<a class="restaurant" href="restaurant_page.php?id='. $restaurant['id'] .'">' . $restaurant['name'] . ' </a>
            <p class="info">'.$restaurant['address'].'</p>
            <p class="info">'. $restaurant['category_name'] .'</p>' . '</div>';
            $i+=1;
            if ($i == 4) {
                echo '</div>';
                $i = 0;
            }
        }
        }
      ?>
    </section>
    </body>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>
</body>
</html>