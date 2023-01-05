<?php
session_start();
require_once 'include/class/User-pdo.php';
$user = new Userpdo();

if (isset($_SESSION['login'])):
$login = $_SESSION['login'];
endif;
if (isset($_POST['submit'])):
    // securiser les données.
    $login = htmlspecialchars(strip_tags(trim($_POST['login'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

    $err = [];

        //  Verifier que l'utilisateur a rempli tous les cases.
        $err = [];
        if (empty($login)):
            $err[] = '<li> Veiller remplir le Login </li>';
        endif;
    
        if (empty($password)):
            $err[] = '<li>Veiller remplir le Password</li>';
        endif;

    if (empty($err)):

               // methode pour verifier le password.
               if ($user->connect($login,$password) === true):
                   // Création des variables global de session
                   $_SESSION['login'] = $login;
                   
                   echo 'Bienvenue' . $login;
                   // redirection vers la page 
                   // header('location: .php');
               else:
                   $err[] = 'Password ou Login incorect !';
                endif;
        endif;

endif;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <?php require_once 'include/header.php' ?>
    <main>
        <?php
        // l'affichage des erreurs.
        if (!empty($err)){
            $i = 0;
            while(isset($err[$i])):
                echo $err[$i];
                $i++;
            endwhile;
        }
        ?>
    <form action="#" method="POST">
            <label for="login">Login</label>
            <input type="text" name="login" <?php if(isset($login)): echo 'value="'. $login . '"'; else: echo 'placeholder="Votre Login"'; endif ?> >

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Votre Password" required>

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>
    </main>
</body>
</html>
