<?php
$title = "Tout consulter";
$nav = "ConsultALL";
require_once 'functions/auth.php';
force_connected_user();
?>

<?php require 'header.php'; ?>

<?php 

// connection à la bdd
try{
$bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


// Affiche le solde

$reponse = $bdd->query('SELECT SUM(movement) AS balance FROM movements') ;
$newBalance = $reponse->fetch();
echo "</br>" ;
echo 'Nouveau solde : ' . $newBalance['balance'] . '€';
$reponse->closeCursor(); 
echo "</br>" ;
echo "</br>" ;

// Affiche toutes les transactions MAIS date en anglais

// $reponse2 = $bdd->query('SELECT * FROM movements') ;
// while ($donnees = $reponse2->fetch())
// {
//     echo 'le ' . $donnees['date'] . ' : ' . $donnees['movement'] . "</br>";
//     // var_dump($donnees) ;
// }
// $reponse->closeCursor(); 


// test date en FR

$reponse3 = $bdd->query("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date2 FROM movements") ;
while ($donnees2 = $reponse3->fetch())
{
    echo 'le ' . $donnees2['date2'] . ' : ' . $donnees2['movement'] . "</br>";
    // echo $donnees2['date2'] ;
    // var_dump($donnees2) ;
}
$reponse->closeCursor(); 


// $mydate = $donnees['date'] ;


?>