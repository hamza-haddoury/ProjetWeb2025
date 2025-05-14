<?php
session_start();
require_once 'users.inc.php';

$login = $_POST['login'] ?? '';
$mdp = $_POST['mdp'] ?? '';

if (loginOk($login, $mdp)) {
    $_SESSION['login'] = $login;


    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?msg=Identifiants incorrects");
    exit();
}
