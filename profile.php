<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="mainpage">
    <div class="wrapper">

    <div class="sidebar"></div>
    <header>
        <h1><a href="/">Porto Eats</a></h1>
    
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
    
    <div class="ProfilePage">
        
        <?php
        echo '
        <img src="IMAGES/do-utilizador.png">
        <ul>
        <li><span>Utilizador: </span>' . $_SESSION["username"] . '</li>' . 
        '<li><span>Palavra-passe </span>: ************</li>' .
        '<li><span>Morada: </span>' . $_SESSION["address"] . '</li>' .
        '<li><span>Telemóvel: </span>' . $_SESSION["phoneNumber"] . '</li>' 
        ?>
        </ul>

        <form action="edit_profile.php">
            <input type="submit" value="Edit information?"/></input>
        </form>

        <form class="register" action="action_logout.php">
            <input type="submit" value="Log out"></input> 
        </form> 
        
    </div>

    </div>

    
</body>
</html>

<script src="javascript/slidebar.js"></script>