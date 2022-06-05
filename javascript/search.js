function search_restaurant() {
    let input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('restaurant');
      
    for (i = 0; i < x.length; i++) { 
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            x[i].parentNode.style.display="none";
        }
        else {
            x[i].parentNode.style.display="initial";                 
        }
    }
}

function search_category(categorie){
    console.log(categorie);
    let x = document.getElementsByClassName('info-categorie');


    for (i = 0; i < x.length; i++) { 
        if (x[i].innerHTML!=categorie && categorie!="all") {

            x[i].parentNode.style.display="none";
        }
        else {
            x[i].parentNode.style.display="initial";                 
        }
    }


}

function search_dishes(){
    var input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    
    var x;

    var radios = document.getElementsByName('dish-radio');
    if(radios[0].checked){
        x = document.getElementsByClassName('info-dish-name');

        for (i = 0; i < x.length; i++) { 
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].parentNode.style.display="none";
            }
            else {
                x[i].parentNode.style.display="initial";                 
            }
        }
    }else if(radios[1].checked){
        x = document.getElementsByClassName('info-dish-price');

        for (i = 0; i < x.length; i++) { 
            var price = parseFloat(x[i].innerHTML.substring(0,x[i].innerHTML.length-1));
            console.log(price);
            
            if (price>parseFloat(input)) {
                x[i].parentNode.style.display="none";
            }
            else {
                x[i].parentNode.style.display="initial";                 
            }
        }

    }else{

    }

    



    
    
}