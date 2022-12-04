<?php // connection à la bdd

try{
$bdd = new PDO('mysql:host=localhost;dbname=tug_mysql', 'tug_mysql', 'eL6Yrt4Y');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}