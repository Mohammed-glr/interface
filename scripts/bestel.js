orderForm.addEventListener('submit', (e) => {
    e.preventDefault();

    if (cart.length === 0) {
        alert('Je winkelmand is leeg. Voeg items toe voordat je een bestelling plaatst.');
        return;
    }

    const formData = new FormData(orderForm);

    const orderDetails = {
        name: formData.get('name'),
        email: formData.get('email'),
        street: formData.get('street'),
        city: formData.get('city'),
        zipcode: formData.get('zipcode'),
        cart: cart,
        total: parseFloat(totalPriceElement.textContent),
    };

    console.log('Order submitted:', orderDetails);

    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();

    alert('Bedankt voor je bestelling!');
});
