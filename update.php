<?php
session_start();
$login = $_SESSION['login'];

require_once 'include/class/User-pdo.php';
$user = new Userpdo();

if ($user->isConnected() === false):
    $_SESSION['err'] = 'connexion non permise';
    header('location: connexion.php');
    exit();   // Mesure de securité.
endif;

$login_ancien = $_SESSION['login'];

//  verifier que l'utilisateur avalider le formulaire. 
if (isset($_POST['submit'])){
    $login = htmlspecialchars(strip_tags(trim($_POST['login'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
    $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
    $co_password = htmlspecialchars(strip_tags(trim($_POST['co_password'])));

    //  Verifier que l'utilisateur a rempli tous les cases.
    $err = [];
    if (empty($login)):
        $err[] = '<li> Veiller remplir le Login </li>';
    endif;
    
    if (empty($email)):
        $err[] = '<li>Veiller remplir votre Email</li>';
    endif;

    if (empty($firstname)):
        $err[] = '<li>Veiller remplir le Prénom</li>';
    endif;

    if (empty($lastname)):
        $err[] = '<li>Veiller remplir le Nom</li>';
    endif;

    if (empty($password)):
        $err[] = '<li>Veiller remplir le Password</li>';
    endif;

    if (empty($co_password)):
        $err[] = '<li>Veiller confirmer le Password</li>';
    endif;

        // verifier que l'utilisateur a rentrer le meme password. 
    if ($password !== $co_password):
        $err[] = '<li>Veiller rentrer le meme password</li>';
    else: //  cryptage du password
        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
    endif;

    if (empty($err)):


            // la verification des login dans la BDD.

            if (count($user->verif_bdd($login)) === 0 || $login === $login_ancien ):

                //  ajouter le nouveau utilisateur à la base de données
               $user->update($login, $password, $email, $firstname, $lastname, $login_ancien);
                $_SESSION['login'] = $login;

                // redirection vers la page de connexion.
                header("location:index.php");
            else:
                $err[] = '<li>Le login n\'est pas disponible, Veuillez le changer !</li>';
            endif;
    endif;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/connection.css">
    <title>Profil</title>
</head>
<body>
    <?php require 'include/header.php' ?>
    <main>
        <div class="form">
            <h1 style="padding: 10px 0 0 10px;"> Modifier Voter Profil</h1>
            <p class="errs"><?php
            if (!empty($err)){
                $i = 0;
                while(isset($err[$i])):
                    echo $err[$i];
                    $i++;
                endwhile;
            }
            ?></p>
            <form action="#" method="POST">
                <label for="login">Login</label>
                <input type="text" name="login" value="<?= $login_ancien; ?>">

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Votre Email">

                <label for="prenom">Prénom</label>
                <input type="text" name="firstname" placeholder="Votre Prénom">

                <label for="nom">Nom</label>
                <input type="text" name="lastname" placeholder="Votre Nom">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Votre Password">

                <label for="co_password">Confirme Password</label>
                <input type="password" name="co_password" placeholder="Confirmé Votre Password">

                <input id="submit" type="submit" value="Valider" name="submit">
            </form>
        </div>
    </main>
<script src="js.js"></script>
</body>
</html>
