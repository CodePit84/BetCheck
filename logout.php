<?php
session_start();
unset($_SESSION['connected']);
header('Location: index.php');


// Supression des variables de session et de la session
//$_SESSION = array();
//session_destroy();

// Supression des cookies de connexion automatique
// setcookie('login', '');
// setcookie('pass_hache', '');