<?php
session_start();

require_once 'class/User.php';
$user = new User();

if ($user->isConnected() === false):
    header('location: ../connexion.php');
    die('ERREUR DE CONNEXION');    // Mesure de securité.
endif;

$login = $_SESSION['login'];

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

        require_once 'class/User.php';
        $user = new User();

            // la verification des login dans la BDD.

            if ($user->verif_bdd($login) === 1 ):

                //  ajouter le nouveau utilisateur à la base de données
               $user->update($login, $password, $email, $firstname, $lastname);
                $_SESSION['login'] = $login;

                // redirection vers la page de connexion.
                header("location:../connexion.php");
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
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <h1>Modifier Voter Profil</h1>
        <?php
        if (!empty($err)){
            $i = 0;
            while(isset($err[$i])):
                echo $err[$i];
                $i++;
            endwhile;
        }
        // if (isset($err_pass)){
        //     echo $err_pass;
        // // }
        // // if (isset($err_log)){
        // //     echo $err_log;
        // }
        ?>
    <form action="#" method="POST">
            <label for="login">Login</label>
            <input type="text" name="login" value="<?= $login; ?>">

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
    </main>
</body>
</html>
