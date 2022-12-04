<?php
$title = "Tout consulter";
$nav = "ConsultALL";
require_once 'functions/auth.php';
force_connected_user();
?>

<?php require 'header.php'; ?>





<?php

$movement_id = $_GET['id'] ;
// echo $movement_id;              // '19'




// revoir la connection a la bdd pour y incure apres le delete_mov

// connection à la bdd
try{
$bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
// print_r($bdd);

$delete_mov = "DELETE FROM movements WHERE id=$movement_id" ;
// $delete_mov = "DELETE FROM movements WHERE id=20" ;
$sth = $bdd->prepare($delete_mov);
$sth->execute();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}



// $req_delete = $bdd->query("DELETE * FROM movements WHERE id=$movement_id") ;
// $will_delete = $req_delete->fetch() ;

// $bdd->query("DELETE * FROM movements WHERE id=$movement_id") ;






$Message = urlencode("Mouvement supprimé avec succès !");
    header("Location:consultation_all.php?Message=".$Message);
    die;







// $req_delete->closeCursor(); 

// echo "Mouvement Supprimé !";


// echo $_GET['id'];

// echo "Voulez-vous vraiment supprimer le mouvement : </br>" ;
// var_dump($will_delete) ;
//echo $will_delete['id'] . " " . $will_delete['date'] . " " . $will_delete['movement'] . "€ " . $will_delete['site'] ;


// $movement_id = 


// $serveur='localhost';
// $user='root';
// $motdepasse=''; 
// $bdd='tableaudebord';
// $connect= mysql_connect($serveur,$user,$motdepasse) or die ("Impossible de se connecter: "); 
// mysql_select_db($bdd);
// $retournbtutos = mysql_query("SELECT COUNT(*) AS id FROM tuto");
// $donneesnbtutos = mysql_fetch_array($retournbtutos);
 
// $id = $_GET['id'];
// $delete_stage = 'DELETE FROM tuto WHERE id='.$id; 
// $result = mysql_query($delete_stage, $connect) or die(mysql_error());
