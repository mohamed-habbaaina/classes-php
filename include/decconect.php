<?php
session_start();
require_once 'class/User.php';
$user = new User();

$user->disconnect();
header("location: ../connexion.php"); // redirige l'utilisateur