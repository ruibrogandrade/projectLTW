<?php
  declare(strict_types = 1);
  require_once('random_token.php');
   session_start();

  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    echo "<script>";
    echo "alert('Request does not appear to be legitimate');";
    echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
    echo "</script>";
  }

  require_once('database/connection.db.php');
  require_once('database/user_class.php');

  $db = getDatabaseConnection();

  $user = User::editUser($db,$_SESSION['id'], filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

  session_destroy();
  header('Location: login.php');
?>