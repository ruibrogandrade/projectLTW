
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <header>
    <h1><a href="/">Porto Eats</a></h1>
    <h1>My Restaurants</h1>
  </header>

  <body>
      <h1> Restaurant Information </h1>
      <?php
      session_start();
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');
      require_once('database/dish_class.php');
      
      $db = getDatabaseConnection();
      $restaurant = Restaurant::getRestaurantWithId($db, $_GET['id']);


      if($restaurant!=null){
            echo 
            '<img src="https://picsum.photos/200?id='. $restaurant['id'] .'">' .
            '<div id="profile"> <p id="info-name" >' . $restaurant['name'] . ' </p>
            <p id="info-address">'.$restaurant['address'].'</p>
            <p id="info-category">'. $restaurant['category_name'] .'</p> </div>';
        
        }
      ?>
      
      <form class="restaurant_info" method="post">
        <p><input type="text" id="name" placeholder="name"></p>
        <p><input type="text" id="address" placeholder="address"></p>
        <p><select id="category">
            <?php 
                $stmt = $db->prepare('
                SELECT name, id
                FROM Category 
                ');

                $stmt->execute();
  
                $categories = $stmt->fetchAll();
                foreach($categories as $category) {
                    echo "<option value='".$category["name"]."'>".$category["name"]."</option>";
                }
            ?>
        </select></p>

        <button id="btn">Edit</button>
        <p id="message"> </p>
      </form>
    <script>
        $(document).ready(function(){
        $("form").submit(function(event){
        event.preventDefault();
        if($("#btn").html()=="Edit"){
            $("#btn").html("Save");
            $("#profile").hide();
            $("input").show();
            $("select").show();
            var name = $("#info-name").text();
            var address = $("#info-address").text();
            var category = $("#info-category").text();

            $("#name").val(name);
            $("#address").val(address);
            $("#category").val(category);

        }else{ //Button = save
            $("#btn").html("Edit");
            $("#profile").show();
            $("input").hide();
            $("select").hide();

            var id = "<?php echo $_GET['id'] ?>";
            var name = $("#name").val();
            var address = $("#address").val();
            var category = $("#category").val();

            $.ajax({
                url: "database/connection_ajax.php",
                method: "post",
                data: {id: id, name: name, address: address, category: category},
                success: function(response){
                    $("#info-name").text(name);
                    $("#info-address").text(address);
                    $("#info-category").text(category);
                    console.log(response);
                }
            });
        }
            });
        });


    </script>

    <h1> Dishes </h1>
    <div id="dishes-div">
    <?php
    $dishes = Dish::getDishesRestaurant($db, $_GET['id']);

    foreach($dishes as $dish){
        echo '<div id="'.$dish['id'].'"> <img src="https://picsum.photos/200?id=' . $dish['id'] .'">'
        . '<p class="info">'.$dish['name'] .'</p>'
        . '<p class="info">'.$dish['price'] .'€</p> <button id="'.$dish['id'].'"> Edit </button> </div>';
    }
    ?>
    </div>
    <button> Add dish </button>



    </body>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>
</body>
</html>