<?php
$title = "Tout consulter";
$nav = "ConsultALL";
require_once 'functions/auth.php';
force_connected_user();
?>

<?php require 'header.php'; ?>

<?php

// Message transmit de delete.php lors du succès de la suppression du mouvement
if(isset($_GET['Message'])){
    $success = $_GET['Message'];
} else {
    $success = null;
}


// connection à la bdd
try{
$bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


////////////Rajout de consultation.php

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
    $success = "Le mouvement a été enregistré ! $newDeposit €" ;
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
    $success = "Le mouvement a été enregistré ! +$newWithdrawal €" ;
}

///////////////// UPDATE ////////////////////

// UPDATE deposit dépense

if ((isset($_POST['up_mouvement_spend'])) && (isset($_POST['up_date']))){
    $date = $_POST['up_date'];
    $deposit = (int)$_POST['up_mouvement_spend']*-1 ;
    $site = $_POST['up_site'] ;
    $movement_id = $_SESSION['movement_id'] ;
    $req = $bdd->prepare("UPDATE movements SET date='$date', movement='$deposit', site='$site' WHERE id=$movement_id");
    $req->execute();
        
    $success = "Le mouvement a été modifié ! $date $deposit € $site" ;
}


// UPDATE withdrawal encaissement

if ((isset($_POST['up_mouvement_earn'])) && (isset($_POST['up_date']))){
    $date = $_POST['up_date'];
    $withdrawal = (int)$_POST['up_mouvement_earn'] ;
    $site = $_POST['up_site'] ;
    $movement_id = $_SESSION['movement_id'] ;
    $req = $bdd->prepare("UPDATE movements SET date='$date', movement='$withdrawal', site='$site' WHERE id=$movement_id");
    $req->execute();
        
    $success = "Le mouvement a été modifié ! $date +$withdrawal € $site" ;
}

/////////////////// FIN UPDATE ////////////////////////////


if (isset($success)): ?>
<div class="alert alert-success">
    <?= $success ?>
</div>
<?php endif ?>
<h3>Consultation</h3>
<?php


// Affiche le solde
$user_id = $_SESSION['id'] ;
$reponse = $bdd->query("SELECT SUM(movement) AS balance FROM movements WHERE user_id='$user_id'") ;
$newBalance = $reponse->fetch();
echo '<strong>Solde : ' . $newBalance['balance'] . '€</strong>';
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




// Affichage avec la date en FR
// $reponse3 = $bdd->query("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date2 FROM movements WHERE user_id='$user_id'") ;
$reponse3 = $bdd->query("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date2 FROM movements WHERE user_id='$user_id' ORDER BY date DESC") ;
while ($donnees2 = $reponse3->fetch())
{
    // $tab = 
    ?>
    <a href="delete.php?id=<?=$donnees2['id']?>" onclick="return confirm('Voulez-vous vraiment suprimer ce mouvement ?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
    </svg></a>

    <a href="edit.php?id=<?=$donnees2['id']?>" onclick="return confirm('Voulez-vous vraiment modifier ce mouvement ?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
    </svg></a>
    
    <?php
    // echo 'le ' . $donnees2['id'] . ' ' . $donnees2['date2'] . ' : ' . $donnees2['movement'] . "€</br>";
    echo $donnees2['date2'] . ' : ';
    if (($donnees2['movement']) > 0) {
        echo "+" . $donnees2['movement'] . "€ " . $donnees2['site'] . "</br>"; 
    } 
    else {
        echo $donnees2['movement'] . "€ " . $donnees2['site'] . "</br>" ;
    };
}
$reponse3->closeCursor(); 


// $mydate = $donnees['date'] ;


?>




 


