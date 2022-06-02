<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    

    if(isset($_POST['id']) and isset($_POST['name']) and isset($_POST['price']) and isset($_POST['id_restaurant']) ){
        $stmt = $db->prepare('
        Insert Into Dish(id, name, price, id_restaurant)
        Values (?, ?, ?, ?)
        ');

      $stmt->execute(array($_POST['id'], $_POST['name'],$_POST['price'], $_POST['id_restaurant']));
      echo 1;
      return 1;

    }else{
        echo 0;
        return 0;
    }
    
    
    

?>