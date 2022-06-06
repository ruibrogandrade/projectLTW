<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id_dish']) and isset($_POST['id_user'])){
        $stmt = $db->prepare('Delete From FavouriteDish
        Where id_user=? and id_dish=?');

        $stmt->execute(array($_POST['id_user'], $_POST['id_dish']));
        
        echo 1;
      return 1;

    }else{
        echo 0;
        return 0;
    }



?>