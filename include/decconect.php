<?php
session_start();
require_once 'class/User.php';
$user = new User();
if ($user->isConnected() === false):
    header('location: inscription.php');
    exit;
endif;
$user->disconnect();
header("location: ../index.php"); // redirige l'utilisateur