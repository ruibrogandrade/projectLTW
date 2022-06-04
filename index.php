<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porto Eats</title>
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_index.css">
</head>

<body class="mainpage">
    <div class="sidebar"></div>
    <header>

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
    
    <div class="content">
        <div class="text">
            <h1>We deliver every type of food. <br> Like 
                <div class="slider">
                    <span> Starbucks</span>
                    <span> Mc</span>
                    <span> Pizza</span>
                    <span> Sushi</span>
                    <span> KFC</span>
                </div>

                
            </h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis 
                bibendum dolor in semper. Integer quis porta libero. Donec vehicula 
                non augue sit amet cursus. In tortor enim, auctor dictum felis consectetur. </p>
            <a href="restaurants.php" class="restaurant-link">Visit Restaurant </a>
        </div>
        <img class="foodimage fadein" src="IMAGES/img0.png">

        <ul>
            <li class = "facebook"><a href="https://www.facebook.com" ><img src="IMAGES/facebook.png"></a> </li>
            <li><a href="https://www.twitter.com"><img src="IMAGES/twitter.png"></a> </li>
            <li><a href="https://www.instagram.com"><img src="IMAGES/instagram.png"></a> </li>
        </ul>

        <div class="circle"></div>
    </div>

   

</body>
</html>

<script>
    const txts = document.querySelector(".slider").children;
    let index = 0;
    const restaurants = ["dishes.php?id=2", "dishes.php?id=3", "dishes.php?id=4", "dishes.php?id=6", "dishes.php?id=1"];

    function animateText(){
        if(index==0){
            txts[txts.length-1].classList.remove("text-in");
        }else{
            txts[index-1].classList.remove("text-in");
        }


        txts[index].classList.add("text-in");
        var link = document.querySelector(".restaurant-link");
        link.href = restaurants[index];
        
        var image = document.querySelector(".foodimage");
        image.classList.remove("fadeout");
        image.src = "IMAGES/img"+index+".png";
        image.classList.add("fadein");

        setTimeout(function(){
            image.classList.remove("fadein");
            image.classList.add("fadeout");
        }, 2550);

        setTimeout(animateText,3000);
        if(index==txts.length-1){
            index = 0;
        }
        else{
            index++;
        }
    }

    window.onload=animateText;

</script>

<script src="javascript/slidebar.js"></script>
