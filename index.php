<?php
session_start();
require_once 'include/class/User-pdo.php';
$user = new Userpdo();

if (isset($_SESSION['login'])):
$login = $_SESSION['login'];
endif;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <?php require 'include/header.php'; ?>
<main>
<?php echo 'Bonjour ';
if(isset($login)):
    echo $login . ' !';
endif;
?>
</main>
<script src="js.js"></script>
</body>
</html>