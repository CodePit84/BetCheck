<?php

//effectuer la connexion à la base de données
$mysqli = new PDO('mysql:host=localhost;dbname=tug_mysql', 'tug_mysql', 'eL6Yrt4Y', array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',65536));
//fichier contenant le sql
$lines = explode("\n",file_get_contents("dbCreate.sql"));
//initialisation des variables
$req = "";
$finRequete = false;
//pour chaque ligne du fichier
foreach ($lines as $line) {
    //on saute les commentaires
    if (substr($line, 0, 2) == '--' || $line == '') {
        continue;
    }
    //on ajoute la ligne à la requête
    $req .= $line;
    //Permet de repérer quand il faut envoyer l'ordre SQL...
    if (substr(trim($line), -1, 1) == ';') {
        $finRequete = true;
    }
    //si requête terminé, on l'exécute et on recommence le traitement à partir de la ligne suivante
    if ($finRequete) {
        if (!$mysqli->query($req)) {
            echo "<div class='alert alert-danger'>Erreur : " . $mysqli->error . "<br>" . $req . "</div>";
        }
        $req = "";
        $finRequete = false;
    }
}