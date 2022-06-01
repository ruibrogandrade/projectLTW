<?php
  declare(strict_types = 1);

  session_start();

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
        header('Location: login.php');
      }

  }
  else {
    header('Location: login.php');
  }
?>