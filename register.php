<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="mainpage">
<div class="wrapper">
<header>
        <h1><a href="/">Porto Eats</a></h1>
        
        <div class="sidebar"></div>
    
        <div class="toggle" onclick="toggleMenu();">
        </div>

        <ul class="menu">
            <?php
            session_start();

            if (!isset($_SESSION['csrf'])) {
              $_SESSION['csrf'] = generate_random_token();
            }

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
    <div class=ProfilePage>
      <h1>Register</h1>

        <form class="register" action="action_register.php" method="post">
          
          <div class = "radio">
            <input type = "radio" name="isOwner" id="Owner" value="true">
            <label for="Owner">Owner</label>
            <input type = "radio" name="isOwner" id="Client" value="false" checked>
            <label for="Client">Client</label>
          </div>
          <input type="text" name="username" placeholder="username">
          <input type="password" name="password" placeholder="password">
          <input type="text" name="address" placeholder="address">
          <input type="tel" name="phoneNumber" placeholder="phone number">

          <input type="submit" value="Register"></input> 
          <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        </form> 
    </div>
  </div>
  </body>

  </html>

<script src="javascript/slidebar.js"></script>