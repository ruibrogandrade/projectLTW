<?php
    declare(strict_types = 1);
    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id']) and isset($_POST['answer'])){
        $stmt = $db->prepare('
        Update Review
        Set answer =  ?
        Where id = ?
        ');

      $stmt->execute(array($_POST['answer'], $_POST['id']));
      echo 1;
    }else{
       echo 0;
    }
    
    
    

?>