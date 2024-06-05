<?php
    require_once 'auth.php';
    require_once 'dbconfig.php';   


    // Controlla se l'utente è autenticato
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    // Connetti al database
    $conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    // Controlla la connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Recupera l'ID del prodotto dall'URL, ad esempio: product_details.php?id=1
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($product_id > 0) {
        // Prepara la query
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        // Controlla se il prodotto esiste
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            die('Prodotto non trovato.');
        }
    } else {
        die('ID prodotto non valido.');
    }

    // Chiudi la connessione
    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Prodotto</title>
    <?php require_once 'header.php'; ?>
    <link rel="stylesheet" href="productdetails.css">
</head>
<body>
    <div class="content">
        <section class="secproduct">            
            <div class="product-details">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-description">
                    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                    <div class="price"> 
                        <strong><span><?php echo number_format($product['price'], 2); ?> €</span></strong>
                    </div>
                    <div class="description">
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    </div>
                    <div class="add-to-cart">
                        <button id="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>" >Aggiungi al carrello</button>
                    </div>
                </div>
            </div>   
        </section>
    </div>
    <?php require_once 'footer.php';?>
    <script src="productdetails.js"></script>
</body>
</html>
