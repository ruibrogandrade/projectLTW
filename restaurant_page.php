
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Porto Eats</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="CSS/style_all.css">
  <link rel="stylesheet" href="CSS/style_restaurants.css">
  <link rel="stylesheet" href="CSS/style_my_restaurants_dishes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    
    <div class="heading">
              <h2>Restaurant Information</h2>
    </div>
    <div id="my_restaurant_container">
        
      <?php
      require_once('database/connection.db.php');
      require_once('database/restaurant_class.php');
      require_once('database/dish_class.php');
      
      $db = getDatabaseConnection();

      $restaurant = Restaurant::getRestaurantWithId($db, $_GET['id']);

      if(!isset($_SESSION['id']) or $_SESSION['id']!= $restaurant['id_Owner']){
          echo "Bloquear acesso";
        header("location:register.php");
        }
      

      if($restaurant!=null){
            echo 
            '<div class = "crop" ><img src="IMAGES/Restaurants/'. $restaurant['id'] .'.jpeg"> </div>' .
            '<div id="profile-form"><div id="profile"> <p id="info-name" >' . $restaurant['name'] . ' </p>
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

        <button class="btn" id="btn">Edit</button>
        <p id="message"> </p>
      </form>
      </div>


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

    </div>

    <div class="heading">
              <h2>Dishes</h2>
    </div>
    <div id="dishes">
    <div id="dishes-container">
        <?php
            $dishes = Dish::getDishesRestaurant($db, $_GET['id']);
            foreach($dishes as $dish){
                echo '<div class="dish-box" id="'.$dish['id'].'"> 
                <div class = "crop" ><img src="IMAGES/Dishes/'. $dish['id'] .'.jpeg"> </div>'
                . '<p class="info name">'.$dish['name'] .'</p>'
                . '<p class="info price">'.$dish['price'] .'€</p>'
                .'
                <form id="'.$dish['id'].'" class="form_dish" method="post">
                <p><input type="file" id ="dish_image" > </p>
                <p><input type="text" id="dish_name" placeholder="Dish name"></p>
                <p><input type="number" step="0.01" min=0 id="dish_price" placeholder="Dish price"></p>
                
                <button class="btn" id="'.$dish['id'].'">Edit</button>
                <p id="message"> </p> 
                </form>
                </div>';
            }

    
    $dish_count = Dish::getDishNextId($db);
    
    echo '<div class="dish-box"';
    echo '<div id="'.$dish_count.'"> 
    <form id="'.$dish_count.'" class="form_dish_add" method="post">
    <p class="dish_add_p">Photo: <input type="file" id ="dish_image" > </p>
    <p class="dish_add_p">Name: <input type="text" id="dish_name" placeholder="Dish name"></p>
    <p class="dish_add_p">Price: <input type="number" step="0.01" min=0 id="dish_price" placeholder="Dish price"></p>
    <button class="btn" id="'.$dish_count.'">Add Dish</button>
    </form>
    </div>'; 
    echo "<div>";         
    
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>


    <div id="reviews">
        <div class="heading">
                <h2>Reviews</h2>
        </div>
        <div id="reviews-container">
        <?php
            $reviews = Restaurant::getReviewsWithRestaurant($db, $_GET['id']);

            foreach($reviews as $review){
                echo '<div class="review"> <div id="'.$review['id'].'">
                    <div class="profile">
                    <img src="Images/Users/'.$review['id_writer'].'.png" >
                    <div class="profile-text">
                    <p class="info username">@'.$review['username'] .'</p>
                    </div>
                    </div>
                    <div class="rating">';
                    for($j=0; $j<$review['classification'];$j++){
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '</div>
                    <p class="info comment">'.$review['comment'] .'</p>';

                if($review['answer']==""){
                    echo '<form id="'.$review['id'].'" class="form_answer_comment" method="post">
                    <p><input type="text" id="answer" placeholder="Answer"></p>
                    <button id="'.$review['id'].'">Publish answer</button>
                    </form>';
                }
                echo '<p class="info answer">'.$review['answer'] .'</p>
                </div>
                </div>';
                
                
            }
        
        ?>
        </div>
    </div>
    
    <div id="orders">
        <div class="heading">
                <h2>Orders</h2>
        </div>
        <div id="orders-container">
    <?php
            $orders = Restaurant::getOrdersWithRestaurant($db, $_GET['id']);

            foreach($orders as $order){
                echo '<div class="order"> <div id="'.$order['id'].'">
                <div class="profile">
                    <img src="Images/Users/'.$order['id_user'].'.png" >
                    <div class="profile-text">
                    <p class="info username">@'.$order['username'] .'</p>
                    </div>
                </div>';

                echo '<p class="info date">'.$order['date'] .'</p>';
                
                echo '<p><select class="info state" id="'.$order['id'].'" onchange="changeState(this)">';
                    echo '<option '; if($order['state']=="received") {echo 'selected="selected"';} echo 'value="received">Received</option>';
                    echo '<option '; if($order['state']=="preparing") {echo 'selected="selected"';} echo 'value="preparing">Preparing</option>';
                    echo '<option '; if($order['state']=="ready") {echo 'selected="selected"';} echo 'value="ready">Ready</option>';
                    echo '<option '; if($order['state']=="delivered") {echo 'selected="selected"';} echo 'value="delivered">Delivered</option>';
                echo '</select></p>
                </div>
                </div>';
                
                
            }
        
        ?>
        </div>
    </div>



<script>
    function changeState(select){
        var val = select.value;
        var id = select.id;

        var fd = new FormData();
        fd.append('val', val);
        fd.append('id', id);

        $.ajax({
            url: "database/edit_order_state.php",
            method: "post",
            data: fd,
            processData: false, 
            contentType: false,
            success: function(response){
                console.log(response);
            }
        });
    }
</script>


<script>
        // ADD Review Answer Script
        $(document).ready(function(){
        $(document).on("submit", ".form_answer_comment", function (event){
            event.preventDefault();

        if($(this).find("#answer").val()!=""){

            $(this).find("button").hide();
            $(this).find("input").hide();

            var id = $(this).attr('id');
            var answer = $(this).find("#answer").val();

            $.ajax({
                url: "database/add_review_answer.php",
                method: "post",
                data: {id: id, answer: answer},
                success: function(response){
                    console.log(response);
                    console.log($("#reviews").find('#'+id).find(".info").find(".answer"));
                    $("#reviews").find('#'+id).find(".answer").text(answer);
                }
            });

        }
        
    });
   });
         

</script>

<script>
    // Edit DISH SCRIPT
    $(document).ready(function(){
        $(document).on("submit", ".form_dish", function (event){
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
            
            var fd = new FormData();
            
            var files = $(this).find("#dish_image")[0].files;
            console.log($(this).find("#dish_image")[0].files);
            fd.append('file', files[0]);
            fd.append('id', id);
            
            
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
            
            $.ajax({
                url: "database/update_dish_photo.php",
                method: "post",
                data: fd,
                processData: false, 
                contentType: false,
                success: function(response){
                    if(response==0){
                        alert("Photo must be .jpeg");
                    }else if(response!=1){
                        var timestamp = $.now();
                        $("#" +id+" img").attr('src', $("#" +id+" img").attr('src') + "?t=" + timestamp);
                    }

                    console.log(response);
                }
            });
        }
        
    });
   });
        // ADD DISH SCRIPT
        //add cancel button!!
        $(document).ready(function(){
        $(document).on("submit", ".form_dish_add", function (event){
            event.preventDefault();

        if($(this).find("button").html()=="Add Dish"){
                $(this).find("button").html("Save");
                $(this).find("p").show();

        }else{ //Button = save
            $(this).find("button").html("Add Dish");
            $(this).find("p").hide();

            var id = $(this).attr('id');
            var name = $(this).find("#dish_name").val();
            var price = $(this).find("#dish_price").val();
            var id_restaurant = <?php echo $_GET['id']?>;
            
            var fd = new FormData();
            
            var files = $(this).find("#dish_image")[0].files;
            fd.append('file', files[0]);
            fd.append('id', id);
            
            var success = 0;

            $.ajax({
                url: "database/add_dish.php",
                method: "post",
                data: {id: id, name: name, price: price, id_restaurant: id_restaurant},
                success: function(response){
                    console.log(response);
                }
            });
            
            $.ajax({
                url: "database/update_dish_photo.php",
                method: "post",
                data: fd,
                processData: false, 
                contentType: false,
                success: function(response){
                    console.log(response);
                    $("#dishes-div").append(
                        '<div id='+id+'> '
                        + '<div class= "crop" ><img src="IMAGES/Dishes/'+ id +'.jpeg"> </div>'
                        + '<p class="info name">'+name+'</p>'
                        + '<p class="info price">'+price+'€</p>'
                        +'<form id="'+id+'" class="form_dish" method="post">'
                        +'<p><input type="file" id ="dish_image" > </p>'
                        +'<p><input type="text" id="dish_name" placeholder="Dish name"></p>'
                        +'<p><input type="number" step="0.01" min=0 id="dish_price" placeholder="Dish price"></p>'
                        +'<button id="'+id+'">Edit</button>'
                        +'<p id="message"> </p>'
                        +'</form>'
                        +'</div>'
    
                    );
                    $(".form_dish_add").find("#dish_name").val("");
                    $(".form_dish_add").find("#dish_price").val("");
                    $(".form_dish_add").attr('id', parseInt(id)+1);

                }
            });
        }
        
    });
   });
         
    </script>

    
    


    
    




    </body>
  <footer>
   <span>Restaurants &copy; 2022</span> 
  </footer>


  </html>

<script>
  var ID_USER = <?php echo $_SESSION['id']?>;
</script>
<script src="javascript/slidebar.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>