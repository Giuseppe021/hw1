<?php
require_once 'auth.php';
require_once 'dbconfig.php';

// Controlla se l'utente è autenticato
if (!$userid = checkAuth()) {
    header("Location: index.php");
    exit;
}

// Connetti al database
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera gli articoli nel carrello per l'utente autenticato
$sql = "SELECT p.id as idproduct, p.image_url, p.name, p.price, c.quantity, c.id as idcart
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = $userid";
$result = $conn->query($sql);

$cartItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
}

// Chiudi la connessione
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
    <link rel="stylesheet" href="carrello.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="content">
        <h1>Il tuo carrello</h1>
        <div class="cart-items">
            <?php if (empty($cartItems)): ?>
                <p>Il tuo carrello è vuoto.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th>Prezzo</th>
                            <th>Quantità</th>
                            <th>Totale</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                <p><?php echo htmlspecialchars($item['name']); ?></p>
                            </td>
                            <td><?php echo number_format($item['price'], 2); ?> €</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> €</td>
                            <td>
                                <button class="remove-item-btn" data-product-id="<?php echo $item['idcart']; ?>">Rimuovi</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <?php require_once 'footer.php'; ?>
    <script src="remove_from_cart.js" defer></script>
</body>
</html>
