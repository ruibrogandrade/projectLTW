<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');
  require_once('database/user_class.php');

  $db = getDatabaseConnection();

  User::deleteUser($db, $_SESSION('id'));

  $user = User::insertUser($db, filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

?>