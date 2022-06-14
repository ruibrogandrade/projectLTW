<?php
  declare(strict_types = 1);
  require_once('random_token.php');
   session_start();

  require_once('database/connection.db.php');
  require_once('database/user_class.php');

  $db = getDatabaseConnection();

  $password = $_POST['password'];
  $username = $_POST['username'];
  $number = $_POST['phoneNumber'];

  if(strlen($password) < 8) {  //check if password is valid
  echo "<script>";
  echo "alert('Password not long enough!');";
  echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
  echo "</script>";
  exit(0);
  }

  if(strlen($number) != 9) {  //check if phone number is valid
      echo "<script>";
      echo "alert('Invalid phone number!');";
      echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
      echo "</script>";
      exit(0);
      }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
      echo "<script>";
      echo "alert('Request does not appear to be legitimate');";
      echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
      echo "</script>";
    }

  if (!preg_match ("/^[a-zA-Z\s]+$/", $username)) {
      echo "<script>";
      echo "alert('Name can only contain letters and spaces');";
      echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
      echo "</script>";
      exit(0);
    }

if($username != $_SESSION['username']) {

  $stmt = $db->prepare("SELECT * FROM User WHERE username=?");
  $stmt->execute([$username]); 
  $user = $stmt->fetch();
  if($user) {
    echo "<script>";
    echo "alert('This username already exists!');";
    echo "window.location = '../edit_profile.php';"; // redirect with javascript, after page loads
    echo "</script>";
    exit(0);
}
}

  
  $user = User::editUser($db,$_SESSION['id'], filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

  session_destroy();
  header('Location: login.php');
?>