<?php
$title = "Tout consulter";
$nav = "ConsultALL";
require_once 'functions/auth.php';
force_connected_user();

require 'header.php';

$movement_id = $_GET['id'] ;


// connection à la bdd
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connexionPDO.php';

try{
$delete_mov = "DELETE FROM movements WHERE id=$movement_id" ;
$sth = $bdd->prepare($delete_mov);
$sth->execute();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


// $Message = urlencode("Mouvement supprimé avec succès !");
//     header("Location:consultation_all.php?Message=".$Message);
//     die;

// Comme la redirection affiche une erreur header on redirige avec une redirection JavaScript avec une page tampon pour passer le message
echo '<script language="Javascript">
<!--
document.location.replace("delete_success.php");
// -->
</script>';