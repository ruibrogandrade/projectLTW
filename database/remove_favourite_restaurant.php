<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id_restaurant']) and isset($_POST['id_user'])){
        $stmt = $db->prepare('Delete From FavouriteRestaurant
        Where id_user=? and id_restaurant=?');

        $stmt->execute(array($_POST['id_user'], $_POST['id_restaurant']));
        
        echo 1;
      return 1;

    }else{
        echo 0;
        return 0;
    }



?>