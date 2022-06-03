<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id']) and isset($_POST['val'])){
        $stmt = $db->prepare('
        Update Orders
        Set state =  ?
        Where id = ?
        ');
      $stmt->execute(array($_POST['val'], $_POST['id']));
    }

?>