<?php
    declare(strict_types = 1);

    $db = new PDO('sqlite:database.db');

    if(isset($_POST['id']) and isset($_POST['name']) and isset($_POST['address']) and isset($_POST['category'])){
        echo $_POST['id'];

        $stmt = $db->prepare('
        Select id
        From Category
        Where name=?
      ');
      $stmt->execute(array($_POST['category']));
      

      if ($category = $stmt->fetch()) {
        $category_id = $category['id'];

        echo $category_id;

        $stmt = $db->prepare('
        Update Restaurant
        Set name =  ?, address = ?, id_Category = ?
        Where id = ?
      ');

      $stmt->execute(array($_POST['name'], $_POST['address'], $category_id,$_POST['id']));
      } 

        
    }

?>