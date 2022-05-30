<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
      <h1><a href="/">Porto Eats</a></h1>
      </header>
<ul>
<div class="ProfilePage">
    
<?php

session_start();

echo '<li>' . $_SESSION["username"] . '</li>' 
. '<li>Password</li>' .
'<li>' . $_SESSION["address"] . '</li>' .
'<li>' . $_SESSION["phoneNumber"] . '</li>' 

?>

<form class="register" action="action_logout.php">
    <input type="submit">Log out</input> 
</form> 


</div>
</ul>
</body>
</html>