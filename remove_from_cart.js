document.addEventListener('DOMContentLoaded', () => {
    const removeItemButtons = document.querySelectorAll('.remove-item-btn');
    removeItemButtons.forEach(button => {
        button.addEventListener('click', () => {
            const idcart = button.getAttribute('data-product-id');
            fetch('api/remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id_cart: idcart                    
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Prodotto rimosso dal carrello');
                    location.reload();
                } else {
                    alert('Errore: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
