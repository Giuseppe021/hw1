document.addEventListener('DOMContentLoaded', function () {
    // Fai una richiesta AJAX per ottenere i dati dei prodotti popolari
    fetch('api/products.php')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            data.forEach(product => {
                const productItem = document.createElement('div');
                productItem.innerHTML = `
                    <article>
                        <div class="dataProduct">
                            <a href="product_details.php?id=${product.id}">
                                <img src="${product.image_url}" alt="${product.name}">
                            </a>
                            <div class="productDescription">
                                <h4 class="nameProduct">
                                    <a href="product_details.php?id=${product.id}">${product.name}</a>
                                </h4>
                                <div class="priceProduct"> 
                                    <strong><span>${product.price} €</span></strong>
                                </div>                            
                            </div>
                        </div>
                    </article>
                `;
                productList.appendChild(productItem);
            });
        })
        .catch(error => console.error('Errore durante il recupero dei dati:', error));
});
