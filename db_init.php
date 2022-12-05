<?php


// function executeSqlFile(){
//     $req = file_get_contents("dbCreate.sql");
//     $array = explode(PHP_EOL, $req);
//     foreach ($array as $sql) {
//         if ($sql != '') {
//             Sql($sql);
//         }
//     }
// }

// $connexion = new PDO('mysql:host='.PARAM_hote.';port='.PARAM_port,PARAM_utilisateur, PARAM_mot_passe,
// array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',65536));


// $bdd = new PDO('mysql:host=localhost;dbname=tug_mysql', 'tug_mysql', 'eL6Yrt4Y', array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',65536));


//////////////////////


try{
    $bdd = new PDO('mysql:host=localhost;dbname=tug_mysql', 'tug_mysql', 'eL6Yrt4Y', array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',65536));

    $req = file_get_contents("dbCreate.sql");
    $array = explode(PHP_EOL, $req);
    foreach ($array as $sql) {
        if ($sql != '') {
            Sql($sql);
        }
    }

    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }