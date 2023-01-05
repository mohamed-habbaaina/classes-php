<?php
session_start();
$login = $_SESSION['login'];
require_once 'class/User-pdo.php';
$user = new Userpdo();

if ($user->isConnected() === false):
    header('location: inscription.php');
    exit;
endif;

$user->delete($login);
header("location: ../inscription.php"); // redirige l'utilisateur