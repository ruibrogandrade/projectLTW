<?php
  declare(strict_types = 1);
  require_once('random_token.php');
  session_set_cookie_params(0, '/', '.app.localhost', true, true);
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }
  else if ($_SESSION['csrf'] !== $_POST['csrf']) {
    echo "<script>";
    echo "alert('Request does not appear to be legitimate');";
    echo "window.location = '../login.php';"; // redirect with javascript, after page loads
    echo "</script>";
  }
 
  
  require_once('database/connection.db.php');
  require_once('database/user_class.php');

  $db = getDatabaseConnection();

  if($_POST['password']) { 
      $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
      if ($user) {
        $_SESSION['id'] = $user->id;
        $_SESSION['isOwner'] = $user->isOwner;
        $_SESSION['username'] = $user->username;
        $_SESSION['address'] = $user->address;
        $_SESSION['phoneNumber'] = $user->phoneNumber;
        header('Location: profile.php');
      }
      else {
          echo "<script>";
          echo "alert('User or password incorrect!');";
          echo "window.location = '../login.php';"; // redirect with javascript, after page loads
          echo "</script>";
          exit(0);
          }
      }
  else {
    header('Location: login.php');
  }
?>