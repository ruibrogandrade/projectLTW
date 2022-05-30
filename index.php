<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Porto Eats</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="mainpage">
    <div class="sidebar"></div>
    <header>
        <a href="index.php" class="logo"><img src="IMAGES/logo.png"> </a>

        <div class="toggle" onclick="toggleMenu();">
        </div>

        <script>
            function toggleMenu(){
                const menuToggle = document.querySelector(".toggle");
                const sidebar = document.querySelector(".sidebar");
                const menu = document.querySelector(".menu");
                menuToggle.classList.toggle('active');
                sidebar.classList.toggle('active');
                menu.classList.toggle('active');

            }
        </script>

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

            session_start();
            if($_SESSION['isOwner']) {
                echo '<li><a href="#" class="menu_element" onmouseover="changeColor(4)" onmouseout="defaultColor()">My Restaurants</a> </li>';
            }
            else {
                echo '<li><a href="#" class="menu_element" onmouseover="changeColor(3)" onmouseout="defaultColor()">My Orders</a> </li>';
            }
            ?>
        </ul>
    
        <script>
            function changeColor(index){
                var list_elements = document.getElementsByClassName("menu_element");
                for(var i= 0; i<list_elements.length; i++){
                    if(i!=index){
                        list_elements.item(i).classList.add('grey');
                    }
                }
            }
            function defaultColor(){
                var list_elements = document.getElementsByClassName("menu_element");
                for(var i= 0; i<list_elements.length; i++){
                    list_elements.item(i).classList.remove('grey');
                }
            }
        </script>

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
        <img class="foodimage" src="IMAGES/img1.png">

        <ul>
            <li class = "facebook"><a href="https://www.facebook.com" ><img src="IMAGES/facebook.png"></a> </li>
            <li><a href="https://www.twitter.com"><img src="IMAGES/twitter.png"></a> </li>
            <li><a href="https://www.instagram.com"><img src="IMAGES/instagram.png"></a> </li>
        </ul>

        <div class="circle"></div>
    </div>

    <script>
        const txts = document.querySelector(".slider").children;
        let index = 0;
        const restaurants = ["#starbucks", "#mc", "#pizza", "#sushi", "#kfc"];
        
      
    
        function animateText(){
            if(index==0){
                txts[txts.length-1].classList.remove("text-in");
            }else{
                txts[index-1].classList.remove("text-in");
            }

            txts[index].classList.add("text-in");
            var link = document.querySelector(".restaurant-link");
            link.href = restaurants[index];


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

</body>
</html>