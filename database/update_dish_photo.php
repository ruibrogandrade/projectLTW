<?php
    declare(strict_types = 1);
    
    print_r($_FILES);
    print_r($_POST);

    if(isset($_FILES['file']['name'])){
        $filename = $_FILES['file']['name']; 

        $location = "../IMAGES/Dishes/".$_POST['id'].".jpeg";

        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);

        if(($imageFileType=="jpeg" or  $imageFileType=="jpg" or $imageFileType=="png") and move_uploaded_file($_FILES['file']['tmp_name'], $location)){
            echo $location;
        }else{
            echo 0;
        }
    }
    
?>