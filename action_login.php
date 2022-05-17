<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');
  require_once('database/user_class.php');

  $db = getDatabaseConnection();

  $customer = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($customer) {
    $_SESSION['id'] = $customer->id;
    $_SESSION['username'] = $customer->username;
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>