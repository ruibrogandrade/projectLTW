<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile Page</title>
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_profile.css">
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
      <div class=ProfilePage>
      <h1>Edit profile</h1>
        <form class="register" action="action_edit.php" method="post">
            <?php
                echo '<div class = "radio">
                <input type = "radio" name="isOwner" id="Owner" value="true"'; 
                if($_SESSION['isOwner']) {
                    echo 'checked>';
                }
                echo '<label for="Owner">Owner</label>
                <input type = "radio" name="isOwner" id="Client" value="false"';
                if(!$_SESSION['isOwner']) {
                    echo 'checked>';
                }
                echo '<label for="Client">Client</label>
                </div>
                <input type="text" name="username" value="' . $_SESSION['username'] . '">
                <input type="password" name="password" placeholder="password">
                <input type="text" name="address" value="' . $_SESSION['address'] . '">
                <input type="tel" name="phoneNumber" value="' . $_SESSION['phoneNumber'] . '">
                <input type="submit" value="Edit Info"></input>' 
            ?>
        </form> 
    
    </div>
</body>
</html>

<script src="javascript/slidebar.js"></script>