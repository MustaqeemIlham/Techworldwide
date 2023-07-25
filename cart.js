let cart = [];
let totalPrice = 0;

function addItem() {
    const itemNameInput = document.getElementById("item-name");
    const itemPriceInput = document.getElementById("item-price");

    const itemName = itemNameInput.value;
    const itemPrice = parseFloat(itemPriceInput.value);

    if (!itemName || isNaN(itemPrice) || itemPrice <= 0) {
        alert("Please enter a valid item name and price.");
        return;
    }

    const item = {
        name: itemName,
        price: itemPrice
    };

    cart.push(item);
    totalPrice += itemPrice;
    updateCartDisplay();
    clearInputFields();
}

function removeItem(index) {
    totalPrice -= cart[index].price;
    cart.splice(index, 1);
    updateCartDisplay();
}

function clearCart() {
    cart = [];
    totalPrice = 0;
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartItemsList = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");

    cartItemsList.innerHTML = "";
    cart.forEach((item, index) => {
        const listItem = document.createElement("li");
        listItem.textContent = `${item.name} - $${item.price.toFixed(2)}`;
        
        const removeButton = document.createElement("button");
        removeButton.textContent = "Remove";
        removeButton.onclick = () => removeItem(index);
        listItem.appendChild(removeButton);

        cartItemsList.appendChild(listItem);
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);
}

function clearInputFields() {
    document.getElementById("item-name").value = "";
    document.getElementById("item-price").value = "";
}

// Call the function to set up the initial cart display
updateCartDisplay();
