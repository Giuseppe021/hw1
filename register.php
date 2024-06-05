<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) )
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT NomeUtente FROM users WHERE NomeUtente = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT Email FROM users WHERE Email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }



        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(Nome,Cognome,NomeUtente,email,password) VALUES('$name', '$surname' ,'$username' , '$email','$password' )";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_agora_username"] = $_POST["username"];
                $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrati</title>

    <?php require_once 'header.php';?>
    <link rel="stylesheet" href="register.css">
    <script src="register.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
</head>
<body>
    <div class="content">
        <section class="secPrincipale">
            <div class="container">            
                    <h1>Crea un account</h1>
                    <div class="register-box">
                        <main>                            
                            <form name='fregister' method='post' enctype="multipart/form-data" autocomplete="off">
                                <div class="names">
                                    <div class="name">
                                        <label for='name'>Nome</label>
                                        <!-- Se il submit non va a buon fine, il server reindirizza su questa stessa pagina, quindi va ricaricata con 
                                            i valori precedentemente inseriti -->
                                        <input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> >
                                        <div><img src="./assets/close.svg"/><span>Devi inserire il tuo nome</span></div>
                                    </div>
                                    <div class="surname">
                                        <label for='surname'>Cognome</label>
                                        <input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> >
                                        <div><img src="./assets/close.svg"/><span>Devi inserire il tuo cognome</span></div>
                                    </div>
                                </div>
                                <div class="username">
                                    <label for='username'>Nome utente</label>
                                    <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                                    <div><img src="./assets/close.svg"/><span>Nome utente non disponibile</span></div>
                                </div>
                                <div class="email">
                                    <label for='email'>Email</label>
                                    <input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                                    <div><img src="./assets/close.svg"/><span>Indirizzo email non valido</span></div>
                                </div>
                                <div class="password">
                                    <label for='password'>Password</label>
                                    <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                                    <div><img src="./assets/close.svg"/><span>Inserisci almeno 8 caratteri</span></div>
                                </div>
                                <div class="confirm_password">
                                    <label for='confirm_password'>Conferma Password</label>
                                    <input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                                    <div><img src="./assets/close.svg"/><span>Le password non coincidono</span></div>
                                </div>
                               
                                <?php if(isset($error)) {
                                    foreach($error as $err) {
                                        echo "<div class='errorj'><img src='./assets/close.svg'/><span>".$err."</span></div>";
                                    }
                                } ?>
                                <div class="submit">
                                    <input type='submit' value="Registrati" id="submit">
                                </div>
                            </form>
                            
                        </main>  
                    </div>
            </div>
        </section>
    </div>

         <?php require_once 'footer.php';?>
  
</html>