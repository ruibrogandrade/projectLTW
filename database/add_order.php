<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id_restaurant']) and isset($_POST['state']) and isset($_POST['date']) and isset($_POST['id_user']) and isset($_POST['dishes'])  ){
        $stmt = $db->prepare('Select count(last_insert_rowid()) +1
                            From Orders');
        $stmt->execute();
        $id = $stmt->fetch()[0];

        $stmt = $db->prepare('Insert Into Orders
        Values (?, ?, ?, ?, ?)');

        $stmt->execute(array($id, $_POST['state'], $_POST['date'],$_POST['id_restaurant'], $_POST['id_user']));
        
        $dishes_arr = explode (",", $_POST['dishes']); 


        foreach($dishes_arr as $dish){
            $stmt = $db->prepare('Insert Into OrderDish
            Values (?, ?)');
    
            $stmt->execute(array($id,$dish));
        }

        echo 1;
      return 1;

    }else{
        echo 0;
        return 0;
    }



?>