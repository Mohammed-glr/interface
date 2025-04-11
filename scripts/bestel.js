document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function renderCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        const totalPriceElement = document.getElementById('total-price');

        if (!cartItemsContainer || !totalPriceElement) {
            console.error('Cart items container or total price element not found.');
            return;
        }

        cartItemsContainer.innerHTML = '';
        let totalPrice = 0;

        cart.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <div>
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <p>${item.name}</p>
                    <p>€${item.price.toFixed(2)}</p>
                </div>
                <button class="remove-item" data-index="${index}">Verwijder</button>
            `;
            cartItemsContainer.appendChild(cartItem);
            totalPrice += item.price;
        });

        totalPriceElement.textContent = totalPrice.toFixed(2);

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.dataset.index;
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                renderCart();
            });
        });
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (e) => {
            const item = {
                name: e.target.dataset.name,
                price: parseFloat(e.target.dataset.price),
                image: e.target.dataset.image
            };
            cart.push(item);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            alert(`${item.name} is toegevoegd aan de winkelmand.`);
        });
    });

    const orderForm = document.getElementById('order-form');
    orderForm.addEventListener('submit', (e) => {
        return true;
    });

    renderCart();
});
