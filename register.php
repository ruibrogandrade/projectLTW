<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
      <h1><a href="/">Porto Eats</a></h1>
      </header>
      <div class=wrapper>
      <form class="register" action="action_register.php" method="post">
        <div class = "radio">
        <input type = "radio" name="Owner/Client" id="Owner" value="Owner" checked>
        <label for="Owner">Owner</label>
        <input type = "radio" name="Owner/Client" id="Client" value="">
        <label for="Client">Client</label>
        </div>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="text" name="address" placeholder="address">
        <input type="tel" name="phoneNumber" placeholder="phone number">
        <a href="register.php">Register</a>
      </form> 
      <div class="circle"></div>
      </div>
</body>
</html>