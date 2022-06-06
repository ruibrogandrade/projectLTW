<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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

      <div class=ProfilePage>
          <h1>Log in</h1>
            
          <form class="loginforms" action="action_login.php" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            
            <a href="register.php">Don't have an account? Register</a>
            
            <button type="submit">Login</button>
          </form>
          
      </div>
</body>
</html>

<script src="javascript/slidebar.js"></script>