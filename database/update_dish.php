<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');


    if(isset($_POST['id']) and isset($_POST['name']) and isset($_POST['price']) ){
        $stmt = $db->prepare('
        Update Dish
        Set name =  ?, price = ?
        Where id = ?
        ');

      $stmt->execute(array($_POST['name'], $_POST['price'],$_POST['id']));
    }

    

?>