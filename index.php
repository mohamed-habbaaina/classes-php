<?php
session_start();

require 'User.php';
$user = new User();

//  verifier que l'utilisateur avalider le formulaire. 
if (isset($_POST['submit'])){
    $login = htmlspecialchars(strip_tags(trim($_POST['login'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
    $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
    $co_password = htmlspecialchars(strip_tags(trim($_POST['co_password'])));

    //  Verifier que l'utilisateur a rempli tous les cases.
    if ($login && $email && $firstname && $lastname && $password && $co_password){
        
        // verifier que l'utilisateur a rentrer le meme password. 
        if ($password === $co_password){

            //  cryptage du password
            $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            // requette pour recupier les login et pour la verification.
            $req_login = $user->connct()->query("SELECT * FROM `utilisateurs` WHERE login='$login';");
            $login_verif = mysqli_num_rows($req_login);
            if ($login_verif === 0){

                //  ajouter le nouveau utilisateur à la base de données
                $user->register($login, $password, $email, $firstname, $lastname);
                $_SESSION['login'] = $login;

                echo 'user ok';
                // redirection vers la page de connexion.
                //header("location:connexion.php");

            } else {
                $err_log = 'Le login n\'est pas disponible, Veuillez le changer !';
            }
        } else {
            $err_pass = 'Veiller rentrer le meme password';
        }

    } else {
        $errs = ' Veiller remplir tous les champs !';
    }
}




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
</head>
<body>
    <main>
        <?php
        if (isset($errs)){
            echo $errs;
        }
        if (isset($err_pass)){
            echo $err_pass;
        }
        if (isset($err_log)){
            echo $err_log;
        }
        ?>
    <form action="#" method="POST">
            <label for="login">Login</label>
            <input type="text" name="login" placeholder="Votre Login">

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
