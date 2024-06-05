document.addEventListener('DOMContentLoaded', () => {
    const addToCartButton = document.getElementById('add-to-cart-btn');
    addToCartButton.addEventListener('click', () => {
        const productId = addToCartButton.getAttribute('data-product-id');
        fetch('api/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Prodotto aggiunto al carrello');
            } else {
                alert('Errore: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
