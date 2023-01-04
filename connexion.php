<?php
session_start();
if (isset($_SESSION['login'])):
$login = $_SESSION['login'];
endif;
if (isset($_POST['submit'])):
    // securiser les données.
    $login = htmlspecialchars(strip_tags(trim($_POST['login'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

    require_once 'include/class/User.php';
    $user = new User();
    $err = [];

    // methode pour verifier le password.

        if ($user->connect($login, $password) === true):

            //  Recuperer le 'id' de l'utilisateur
            // $id = $requ_fetch['id'];

            // Création des variables global de session
            $_SESSION['login'] = $login;
            // $_SESSION['id'] = $id;

            // redirection vers la page 
            // header('location: .php');
        else:
            $err[] = 'Password incorect !';

        endif;

    else:
        $err[] = 'Login inexistant !';
endif;



    // if (isset($login) && isset($password))


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
    <?php require 'include/header.php' ?>
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
            <input type="text" name="login" <?php if(isset($login)): echo 'value="'. $login . '"'; else: echo 'placeholder="Votre Login"'; endif ?>>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Votre Password">

            <input id="submit" type="submit" value="Valider" name="submit">
        </form>
    </main>
</body>
</html>
