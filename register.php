<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel="stylesheet" href="CSS/style_all.css">
    <link rel="stylesheet" href="CSS/style_profile.css">
</head>
<body>
<header>
      <h1><a href="/">Porto Eats</a></h1>
      </header>
      <div class=wrapper>
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
      </form> 
      </div>
</body>
</html>