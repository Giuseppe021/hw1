<?php 
require_once 'auth.php';
require_once 'dbconfig.php';

// Controlla se l'utente è autenticato
if ($userid = checkAuth()) {
    header("Location: home.php");
    exit;
}

// Connetti al database
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera i prodotti popolari (esempio: i primi 6 prodotti)
$sql = "SELECT * FROM products LIMIT 6";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    die('Nessun prodotto trovato.');
}

// Chiudi la connessione
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="hw1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
    <script src="hw1.js" defer></script>
	<script src="uploadproduct.js" defer></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbPWqruBWLrugkLvFOVfPgcz6Tp5FxBFQ&callback=console.debug&libraries=maps,marker&v=beta"></script>
    <title>Click Atenea</title>
    <?php require_once 'header.php';?>
</head>
<body>
    <div class="content">
        <section class="secPrincipale">
            <div class="container">
                <div id="carousel" class="standard">
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <a href="https://clickatenea.it/app/">
                                <img class="sizeCarousel" src="https://clickatenea.it/shop/modules/ps_imageslider/images/d7a6e7aeedd0aadd1c3f319747aaf24e3e608591_batteria scherzi con logo.png">
                                <figcaption class="caption"> 
                                    <h2 class="img1-carousel">SOSTITUZIONE BATTERIA</h2> 
                                    <div class="caption-description"></div>
                                </figcaption>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://clickatenea.it/shop/home/52-iphone-11-pro-64-gb.html">
                                <img class="sizeCarousel" src="https://clickatenea.it/shop/modules/ps_imageslider/images/c19b4ce97d60ae756aa761d00724d7c02efffa07_iphone11pro.jpg">
                                <figcaption class="caption"> 
                                    <h2 class="img2-carousel">IPHONE 11 PRO</h2> 
                                    <div class="caption-description"></div>
                                </figcaption>
                            </a>
                        </div>
                    </div>
                    <button class="prev-btn"><a>&lt;</a></button>
                    <button class="next-btn"><a>&gt;</a></button>
                </div>
                <section class="secProduct">
                    <h1>PRODOTTI POPOLARI</h1>
                    <div class="products">
                        <?php foreach ($products as $product): ?>
                        <article>
                            <div class="dataProduct">
                                <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                </a>
                                <div class="productDescription">
                                    <h4 class="nameProduct">
                                        <a href="product_details.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a>
                                    </h4>
                                    <div class="priceProduct"> 
                                        <strong><span><?php echo number_format($product['price'], 2); ?> €</span></strong>
                                    </div>                            
                                </div>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <div class="allproductlink">
                        <a href="https://clickatenea.it/shop/2-home">Tutti i prodotti ></a>
                    </div>            
                </section>
                <div id="imgfinale">
                    <a href="https://clickatenea.it/shop/">
                        <img class="sizeCarousel" src="https://clickatenea.it/shop/modules/ps_banner/img/da199763c3f562404db325ec12dc1ee8.png">    
                    </a>
                </div>
                <div id="custom-text">
                    <h3>CLICK ATENEA</h3>
                    <p>Il tuo negozio di elettronica di fiducia</p>
                </div>
                <div id="map" style="height: 500px; width: 100%; margin-bottom: 2%;">
                    <gmp-map center="37.311920166015625,13.57970905303955" zoom="14" map-id="DEMO_MAP_ID">
                        <gmp-advanced-marker position="37.311920166015625,13.57970905303955" title="My location"></gmp-advanced-marker>
                    </gmp-map>
                </div>
            </div>
        </section>
        <!--
        <section id="notizie">
            
        </section>
        <section id="spotify">
            <h1>Album da ascoltare durante la riparazione...</h1>
            <form id="apiToken">
            Inserisci il nome di un album 
            <input type='text' id='album'>
            <input type='submit' id='submit' value='Cerca'>
            </form>
            <section id="album-view"></section>
        </section>
        -->
    </div>
    <?php require_once 'footer.php';?>
</body>
</html>
