<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile Page</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<header>
      <h1><a href="/">Porto Eats</a></h1>
      </header>
      <div class=wrapper>
      <form class="register" action="action_edit.php" method="post">
          <?php
          
          session_start();

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
      <div class="circle"></div>
      </div>
</body>
</html>