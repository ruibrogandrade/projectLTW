function toggleCart(){
    const cart = document.querySelector(".cart");
    cart.classList.toggle('active');
}

function removeProduct(element){
    var cartIcon = document.getElementsByClassName('cart-icon')[0];
    var span = cartIcon.getElementsByTagName('span')[0];
    span.innerHTML = parseInt(span.innerHTML) - 1;

    element.parentNode.remove();
    updateTotal();
}

function updateTotal(){
    var total = 0;

    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartItems.getElementsByClassName("cart-box");
    for(var j=0; j<cartBoxes.length; j++){
        var cartBox = cartBoxes[j];
        var price = cartBox.getElementsByClassName("product-price")[0].innerHTML;
        price = parseFloat(price);
        var quantity = cartBox.getElementsByClassName("product-quantity")[0].value;
        total += quantity * price;
    }

    var totalPrice = document.getElementsByClassName("total-price")[0];
    total = Math.round(total * 100) / 100;

    totalPrice.innerHTML = total + "€";

}

window.onload = function(){
    updateTotal();
}

function addCart(element){
    var product = element.parentNode;
    var title = product.getElementsByClassName("info-dish-name")[0].innerHTML;
    var price = product.getElementsByClassName("info-dish-price")[0].innerHTML;
    var img_src = product.getElementsByTagName("img")[0].src;
    var id = product.id;


    /*<div class="cart-box">
                    <img src="IMAGES/Dishes/0.jpeg" alt="" class="cart-img">
                    <div class="detail-box">
                        <p class="product-title">Big Mac</p>
                        <p class="product-price">4.5€</p>
                        <input type="number" min="1" value="1" class="product-quantity" onchange="updateTotal()">
                    </div>
                    
                    <i onclick="removeProduct(this)" class="fas fa-trash product-remove"></i>
    </div> */

    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartItems.getElementsByClassName("cart-box");
    var products = cartItems.getElementsByClassName("products")[0];

    
    for(var j=0; j<cartBoxes.length; j++){
        var cartBox = cartBoxes[j];
        var cartBoxtitle = cartBox.getElementsByClassName("product-title")[0].textContent;
        if(title==cartBoxtitle){
            var input = cartBox.getElementsByClassName("product-quantity")[0];
            input.value = parseInt(input.value) +1;
            updateTotal();
            const cart = document.querySelector(".cart");
            cart.classList.add('active');
            return;
        }
    }
    

    var cartboxHTML = `
                        <img src="`+img_src+`" alt="" class="cart-img">
                        <div class="detail-box">
                            <p class="product-title">`+title+`</p>
                            <p class="product-price">`+price+`</p>
                            <input type="number" min="1" value="1" class="product-quantity" onchange="updateTotal()">
                        </div>
                        
                        <i onclick="removeProduct(this)" class="fas fa-trash product-remove"></i>`;
    var cartbox = document.createElement("div");
    cartbox.classList.add("cart-box");
    cartbox.setAttribute("id", id);
    cartbox.innerHTML = cartboxHTML;
    products.append(cartbox);

    var cartIcon = document.getElementsByClassName('cart-icon')[0];
    var span = cartIcon.getElementsByTagName('span')[0];
    span.innerHTML = parseInt(span.innerHTML) + 1;
    
    updateTotal();
    const cart = document.querySelector(".cart");
    cart.classList.add('active');
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}
  
function formatDate(date) {
return (
    [padTo2Digits(date.getDate()),
    padTo2Digits(date.getMonth() + 1),
    date.getFullYear()
    ].join('/') +
    ' ' +
    [
    padTo2Digits(date.getHours()),
    padTo2Digits(date.getMinutes())
    ].join(':')
);
}



function checkOut(){
    var products = document.getElementsByClassName("products")[0];
    if(products.children.length==0){
        alert("Your basket is empty!");
        return;
    }

   
    var state =  "preparing";
    var date = formatDate(new Date());

    var fd = new FormData();
    fd.append('id_restaurant', ID_RESTAURANT);
    fd.append('state', state);
    fd.append('date', date);
    fd.append('id_user', ID_USER);
    var dishes = [];
    
    var items = document.getElementsByClassName("cart-box");
    for(var j=0; j<items.length; j++){
        var id = items[j].id;
        dishes.push(id);
        items[j].parentNode.removeChild(items[j]);
        j--;
    }
    

    fd.append('dishes', dishes);

    
    $.ajax({
        url: "database/add_order.php",
        method: "post",
        data: fd,
        processData: false, 
        contentType: false,
        success: function(response){
            updateTotal();
            /*Update cart-icon span */

            var cartIcon = document.getElementsByClassName('cart-icon')[0];
            var span = cartIcon.getElementsByTagName('span')[0];
            span.innerHTML = 0;

            alert("We are preparing your order" );
            console.log(response);
        }
    });
    
}