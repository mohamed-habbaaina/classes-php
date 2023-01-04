<?php
session_start();
$login = $_SESSION['login'];
require_once 'class/User.php';
$user = new User();
$user->delete($login);
header("location: ../inscription.php"); // redirige l'utilisateur