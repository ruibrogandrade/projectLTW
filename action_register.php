<?php
    declare(strict_types = 1);
    require_once('random_token.php');
    session_set_cookie_params(0, '/', '.app.localhost', true, true);
    session_start();

    require_once('database/connection.db.php');
    require_once('database/user_class.php');

    $db = getDatabaseConnection();

    $password = $_POST['password'];
    $username = $_POST['username'];
    $number = $_POST['phoneNumber'];

    if(strlen($password) < 8) {  //check if password is valid
    echo "<script>";
    echo "alert('Passsword not long enough!');";
    echo "window.location = '../register.php';"; // redirect with javascript, after page loads
    echo "</script>";
    exit(0);
    }

    if(strlen($number) != 9) {  //check if phone number is valid
        echo "<script>";
        echo "alert('Invalid phone number!');";
        echo "window.location = '../register.php';"; // redirect with javascript, after page loads
        echo "</script>";
        exit(0);
        }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        echo "<script>";
        echo "alert('Request does not appear to be legitimate');";
        echo "window.location = '../register.php';"; // redirect with javascript, after page loads
        echo "</script>";
        exit(0);
      }
 
    if (!preg_match ("/^[a-zA-Z0-9\s]+$/", $username)) {
        echo "<script>";
        echo "alert('Name can only contain letters,numbers and spaces');";
        echo "window.location = '../register.php';"; // redirect with javascript, after page loads
        echo "</script>";
        exit(0);
      }

    $stmt = $db->prepare("SELECT * FROM User WHERE username=?");
    $stmt->execute([$username]); 
    $user = $stmt->fetch();

    if($user) {
        echo "<script>";
        echo "alert('User already registered!');";
        echo "window.location = '../register.php';"; // redirect with javascript, after page loads
        echo "</script>";
        exit(0);
    }

    $useradd = User::insertUser($db, filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

    $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

    if (isset($useradd)) {
        $_SESSION['id'] = $user->id;
        $_SESSION['isOwner'] = $user->isOwner;
        $_SESSION['username'] = $user->username;
        $_SESSION['address'] = $user->address;
        $_SESSION['phoneNumber'] = $user->phoneNumber;
        header('Location: profile.php');  
        }
    else {
        header('Location: register.php');
    } 

?>