<?php
    declare(strict_types = 1);

    session_start();

    require_once('database/connection.db.php');
    require_once('database/user_class.php');

    $db = getDatabaseConnection();

    $user = User::insertUser($db, filter_var($_POST['isOwner'],FILTER_VALIDATE_BOOLEAN), $_POST['username'], $_POST['password'], $_POST['address'], (int)$_POST['phoneNumber']);

 
    $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

    //if($_POST['username']) { header('Location: register.php'); echo "user already exists";} 

    //if($query->num_rows !=0 ) {header('Location: register.php'); } //não está a funcionar mas era para corrigir se um user ja registado tentasse registar novamente

    if ($user) {
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