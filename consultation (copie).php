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



// SI dépense ALORS Enregistre une dépense dans la bdd

if ((isset($_POST['depense'])) && (isset($_POST['date_depense']))){
    $date = $_POST['date_depense'];
    $newDeposit = (int)$_POST['depense']*-1 ;
    $req = $bdd->prepare('INSERT INTO movements(date, movement) VALUES (:date, :movement)');
    $req->execute(array(
        'date' => $date,
        'movement' => $newDeposit
    ));
    echo "Le mouvement a été enregistré ! $newDeposit €" ;
}

// SI encaissement ALORS Enregistre un encaissement dans la bdd

if ((isset($_POST['encaissement'])) && (isset($_POST['date_encaissement']))){
    $date = $_POST['date_encaissement'];
    $newWithdrawal = (int)$_POST['encaissement'] ;
    $req = $bdd->prepare('INSERT INTO movements(date, movement) VALUES (:date, :movement)');
    $req->execute(array(
        'date' => $date,
        'movement' => $newWithdrawal
    ));
    echo "Le mouvement a été enregistré ! + $newWithdrawal €" ;
}

// SI dépense OU encaissement ALORS Affiche le nouveau solde

$reponse = $bdd->query('SELECT SUM(movement) AS balance FROM movements');
$newBalance = $reponse->fetch();
echo "</br>" ;
echo 'Nouveau solde : ' . $newBalance['balance'] . '€';
$reponse->closeCursor();


// echo " Nouveau solde : $balance" ; 
echo "</br>" ;
// echo " Nouveau solde : $newBalance" ;
// var_dump($newBalance);

?>