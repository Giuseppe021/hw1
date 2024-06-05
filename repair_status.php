<?php 
require_once 'auth.php';
require_once 'dbconfig.php';

// Controlla se l'utente è autenticato
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="repair_status.css"> <!-- File CSS specifico per questa pagina -->
   
    <script src="repair_status.js" defer></script> <!-- File JavaScript specifico per questa pagina -->
    <title>Stato Riparazione - Click Atenea</title>
    <?php require_once 'header.php';?>
</head>
<body>
    <div class="content">
        <section class="repairStatus">
            <div class="container">
                <h1>Stato Riparazione</h1>
                <div id="repair-status">
                    <!-- Qui verranno inserite le informazioni sullo stato di riparazione -->
                </div>
            </div>
        </section>
    </div>
    <?php require_once 'footer.php';?>
</body>
</html>
