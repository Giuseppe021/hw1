<?php
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT * FROM users WHERE NomeUtente = '".$username."'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['Password'])) {

                // Imposto una sessione dell'utente
                $_SESSION["_agora_username"] = $entry['NomeUtente'];
                $_SESSION["_agora_user_id"] = $entry['ID'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Entra</title>

    <?php require_once 'header.php';?>
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>

</head>
<body>
    <div class="content">
        <section class="secPrincipale">
            <div class="container">            
                    <h1>Accedi al tuo account</h1>
                    <div class="login-box">
                        <section class="login-form">
                        <?php
                            if (isset($error)) {
                                echo "<p class='error'>$error</p>";
                            }
                            
                        ?>
                        
                            <form name='flogin' method="post">
                                <div class="textbox">
                                    <input type="text" name="username" placeholder="Username" >
                                    <span class="error" id="usernameError"></span></p>
                                </div>
                                <div class="textbox">
                                    <input type="password" name="password" placeholder="Password" >
                                    <span class="error" id="passwordError"></span>
                                </div>
                                <input type="submit" class="button" value="Login">
                            </form>
                        </section>
                        <hr>
                       
                        <a href="register.php">Non hai ancora un account? Registrati qui.</a>
                    </div>
            </div>
        </section>
    </div>

         <?php require_once 'footer.php';?>
  
</html>