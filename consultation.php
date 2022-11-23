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



// SELECT id FROM members WHERE nickname = 'Tintin'






// SI dépense ALORS Enregistre une dépense dans la bdd

if ((isset($_POST['depense'])) && (isset($_POST['date_depense']))){
    
    $user_id = $_SESSION['id'] ;
    $date = $_POST['date_depense'];
    $newDeposit = (int)$_POST['depense']*-1 ;
    $site = $_POST['site'] ;
    $req = $bdd->prepare('INSERT INTO movements(date, movement, site, user_id) VALUES (:date, :movement, :site, :user_id)');
    $req->execute(array(
        'date' => $date,
        'movement' => $newDeposit,
        'site' => $site,
        'user_id' => $user_id
    ));
    echo "Le mouvement a été enregistré ! $newDeposit €" ;
}

// SI encaissement ALORS Enregistre un encaissement dans la bdd

if ((isset($_POST['encaissement'])) && (isset($_POST['date_encaissement']))){
    $user_id = $_SESSION['id'] ;
    $date = $_POST['date_encaissement'];
    $newWithdrawal = (int)$_POST['encaissement'] ;
    $site = $_POST['site'] ;
    $req = $bdd->prepare('INSERT INTO movements(date, movement, site, user_id) VALUES (:date, :movement, :site, :user_id)');
    $req->execute(array(
        'date' => $date,
        'movement' => $newWithdrawal,
        'site' => $site,
        'user_id' => $user_id
    ));
    echo "Le mouvement a été enregistré ! + $newWithdrawal €" ;
}

// SI dépense OU encaissement ALORS Affiche le nouveau solde

$reponse = $bdd->query("SELECT SUM(movement) AS balance FROM movements WHERE user_id='$user_id'");
$newBalance = $reponse->fetch();
echo "</br>" ;
echo 'Nouveau solde : ' . $newBalance['balance'] . '€';
$reponse->closeCursor();


// echo " Nouveau solde : $balance" ; 
echo "</br>" ;
// echo " Nouveau solde : $newBalance" ;
// var_dump($newBalance);

?>