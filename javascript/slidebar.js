var i = 0;

function toggleMenu(){
    i += 1;
    const menuToggle = document.querySelector(".toggle");
    const sidebar = document.querySelector(".sidebar");
    const menu = document.querySelector(".menu");
    menuToggle.classList.toggle('active');
    sidebar.classList.toggle('active');
    menu.classList.toggle('active');
    if(i>=2){
        menu.classList.toggle('animation');
    }
}

function changeColor(index){
    var list_elements = document.getElementsByClassName("menu_element");
    for(var i= 0; i<list_elements.length; i++){
        if(i!=index){
            list_elements.item(i).classList.add('grey');
        }
    }
}

function defaultColor(){
    var list_elements = document.getElementsByClassName("menu_element");
    for(var i= 0; i<list_elements.length; i++){
        list_elements.item(i).classList.remove('grey');
    }
}