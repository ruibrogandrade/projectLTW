<?php
    declare(strict_types = 1);

    session_start();

    require_once('database/connection.db.php');
    require_once('database/user.class.php');

    $db = getDatabaseConnection();

    $customer = User::insertUser($db, $_POST['id'], $_POST['isOwner'], $_POST['username'], $_POST['password'], $_POST['address'], $_POST['phoneNumber']);
    debug_to_console('test');
    /*
    if ($customer) {
    $_SESSION['id'] = $customer->id;
    $_SESSION['name'] = $customer->name();
    }
    */
    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>