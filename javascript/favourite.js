function favourite(element){
    var icon = element.children[0];
    var id_dish = element.id;
    var fd = new FormData();
    fd.append('id_dish', id_dish);
    fd.append('id_user', ID_USER);


    if(icon.getAttribute("data-prefix")=="far"){
        //Favorite
        icon.setAttribute("data-prefix", "fas")

        $.ajax({
            url: "database/add_favourite_dish.php",
            method: "post",
            data: fd,
            processData: false, 
            contentType: false,
            success: function(response){
                console.log(response);
            }
        });

    }else{
        //UnFavorite
        icon.setAttribute("data-prefix", "far")

        $.ajax({
            url: "database/remove_favourite_dish.php",
            method: "post",
            data: fd,
            processData: false, 
            contentType: false,
            success: function(response){
                console.log(response);
            }
        });
    }


    
}