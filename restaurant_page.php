
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


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
            '<div class = "crop" ><img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"> </div>' .
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
        $(".restaurant_info").submit(function(event){
        event.preventDefault();
        if($("#btn").html()=="Edit"){
            $("#btn").html("Save");
            $("#profile").hide();
            $(".restaurant_info input").show();
            $(".restaurant_info select").show();
            var name = $("#info-name").text();
            var address = $("#info-address").text();
            var category = $("#info-category").text();

            $("#name").val(name);
            $("#address").val(address);
            $("#category").val(category);

        }else{ //Button = save
            $("#btn").html("Edit");
            $("#profile").show();
            $(".restaurant_info input").hide();
            $(".restaurant_info select").hide();

            var id = "<?php echo $_GET['id'] ?>";
            var name = $("#name").val();
            var address = $("#address").val();
            var category = $("#category").val();

            $.ajax({
                url: "database/update_restaurant.php",
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
                echo '<div id="'.$dish['id'].'"> 
                <div class = "crop" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>'
                . '<p class="info name">'.$dish['name'] .'</p>'
                . '<p class="info price">'.$dish['price'] .'€</p>'
                .'
                <form id="'.$dish['id'].'" class="form_dish" method="post">
                <p><input type="text" id="dish_name" placeholder="Dish name"></p>
                <p><input type="number" step="0.01" min=0 id="dish_price" placeholder="Dish price"></p>
                
                <button id="'.$dish['id'].'">Edit</button>
                <p id="message"> </p> 
                </form>
                </div>';
            }
        ?>
        </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
        $(".form_dish").submit(function(event){
            event.preventDefault();

        if($(this).find("button").html()=="Edit"){
                $(this).find("button").html("Save");
                $(this).parent().find(".info").hide();
                $(this).find("input").show();

                var name = $(this).parent().find(".info.name").text();
                var price = $(this).parent().find(".info.price").text();
                price = price.slice(0, -1);

                $(this).find("#dish_name").val(name);
                $(this).find("#dish_price").val(price);

        }else{ //Button = save
            $(this).find("button").html("Edit");
            $(this).parent().find(".info").show();
            $(this).find("input").hide();

            var id = $(this).attr('id');
            var name = $(this).find("#dish_name").val();
            var price = $(this).find("#dish_price").val();


            $.ajax({
                url: "database/update_dish.php",
                method: "post",
                data: {id: id, name: name, price: price},
                success: function(response){
                    $("#" +id+" .info.name").text(name);
                    $("#" +id+" .info.price").text(price+"€");

                    console.log(response);
                }
            });
            
        }
        
    });
   });
    </script>




    <button> Add dish </button>



    </body>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>

</html>