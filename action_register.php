<?php
    declare(strict_types = 1);

    session_start();

    require_once('database/connection.db.php');
    require_once('database/user_class.php');

    $db = getDatabaseConnection();

    //$user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

    $password = $_POST['password'];
    $username = $_POST['username'];

    if(strlen($password) < 8) {  //check if password is valid
    echo "<script>";
    echo "alert('Passsword not long enough!');";
    echo "window.location = '../register.php';"; // redirect with javascript, after page loads
    echo "</script>";
    }

    $stmt = $db->prepare("SELECT * FROM User WHERE username=?");
    $stmt->execute([$username]); 
    $user = $stmt->fetch();

    if($user) {
        echo "<script>";
        echo "alert('User already registered!');";
        echo "window.location = '../register.php';"; // redirect with javascript, after page loads
        echo "</script>";
    }

    $useradd = User::insertUser($db, filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

    if (isset($user)) {
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