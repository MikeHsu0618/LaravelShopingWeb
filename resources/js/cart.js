function getCart() {
    var cart =Cookies.get('cart');
    return (!cart) ? {} : JSON.parse(cart)
}

function addProductToCart(productId,quantity) {
    var cart = getCart();
    var currentQuantity = parseInt(cart[productId]) || 0;
    var addQuantity = parseInt(quantity) || 0;
    var newQuantity = currentQuantity + addQuantity;
    updateProductToCart(productId, newQuantity)
}

function updateProductToCart(productId, newQuantity) {
    var cart = getCart();
    cart[productId] = newQuantity;
    saveCart(cart);
}

function alertProductQuantity(productId){
    var cart = getCart();
    var quantity = parseInt(cart[productId]) || 0;
    alert(quantity);
}

function saveCart(cart) {
    Cookies.set("cart",JSON.stringify(cart))
}

function initAddToCart(productId) {
    var addToCartBtn = document.querySelector("#addToCart");

    if (addToCartBtn) {
        addToCartBtn.addEventListener("click", function() {
            var quantityInput = document.querySelector(
                'input[name="quantity"]'
            );
            if (quantityInput) {
                console.log(quantityInput, quantityInput.value)
                addProductToCart(productId, quantityInput.value)
                alertProductQuantity(productId);
            }
        });
    }
}

function initCartDeleteButton(actionUrl) {
    var cartDeleteButtons =document.querySelectorAll('.cartDeleteBtn');
    for (let index = 0; index < cartDeleteButtons.length; index++) {
        const cartDeleteButton = cartDeleteButtons[index];
        cartDeleteButton.addEventListener('click', function(e) {
            let btn = e.target;
            let dataId = btn.getAttribute('data-id');
            let formData = new FormData();
            formData.append("_method", "DELETE");
            let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            let csrfToken = csrfTokenMeta.content;
            formData.append("_token", csrfToken);
            formData.append('id', dataId);
            let request = new XMLHttpRequest();
            request.open('POST', actionUrl);
            request.onreadystatechange = () => {
                if (request.readyState === XMLHttpRequest.DONE 
                    && 
                    request.status === 200
                    &&
                    request.responseText === "success"
                    ) {
                    window.location.reload();
                }
            }
            request.send(formData);
        });
    }
}
export { initAddToCart,initCartDeleteButton };