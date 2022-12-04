<?php
$title = "Dépense";
$nav = "Dépense";
require_once 'functions/auth.php';
force_connected_user();
?>

<?php require 'header.php'; ?>

<?php

$movement_id = $_GET['id'] ;


// connection à la bdd
// try{
// $bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
// }
// catch (Exception $e)
// {
//     die('Erreur : ' . $e->getMessage());
// }

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connexionPDO.php';

$reponse = $bdd->query("SELECT * FROM movements WHERE id=$movement_id") ;
$edit_mov = $reponse->fetch();
$date = $edit_mov['date'];
$movement = $edit_mov['movement'];
$site = $edit_mov['site'];
$id_mov = $edit_mov['id'];
$_SESSION['movement_id'] = $edit_mov['id'];
// $reponse->closeCursor(); 

// var_dump($edit_mov);

if ($movement < 0) {
    $mov_depense = $movement*-1 ;
    ?>
    <h3>Veuillez modifier votre dépense :</h3>
    <form action="/paris/consultation_all.php" method="post">
        <div class="form-group">
            <input class="form-control" type="number" name="up_mouvement_spend" value="<?=$mov_depense?>"></br>
            <input class="form-control" type="date" name="up_date" value="<?=$date?>"></br>
            <label for="site-select">facultatif :</label>
                <select class="custom-select" name="up_site" id="site-select">
                    <option value="<?=$site?>"><?=$site?></option>
                    <option value="">Choisissez le type de dépense</option>
                    <option value="FDJ">Française des jeux (FDJ)</option>
                    <option value="Winamax">Winamax</option>
                    <option value="Betclick">Betclick</option>
                    <option value="PMU">PMU</option>
                    <option value="Casino">Casino</option>
                    <option value="Parions Sport">Parions Sport</option>
                    <option value="Unibet">Unibet</option>
                    <option value="ZEbet">ZEbet</option>
                    <option value="bwin">bwin</option>
                    <option value="POCKERSTARS">POCKERSTARS</option>
                    <option value="vbet">vbet</option>
                    <option value="autre">autre...</option>
                </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregister</button>
    </form>
    <?php
} else {
    ?>
    <h3>Veuillez modifier votre encaissement (gain) :</h3>
    <form action="/paris/consultation_all.php" method="post">
        <div class="form-group">
            <input class="form-control" type="number" name="up_mouvement_earn" value="<?=$movement?>"></br>
            <input class="form-control" type="date" name="up_date" value="<?=$date?>"></br>
            <label for="site-select">facultatif :</label>
                <select class="custom-select" name="up_site" id="site-select">
                    <option value="<?=$site?>"><?=$site?></option>
                    <option value="">Choisissez le type de dépense</option>
                    <option value="FDJ">Française des jeux (FDJ)</option>
                    <option value="Winamax">Winamax</option>
                    <option value="Betclick">Betclick</option>
                    <option value="PMU">PMU</option>
                    <option value="Casino">Casino</option>
                    <option value="Parions Sport">Parions Sport</option>
                    <option value="Unibet">Unibet</option>
                    <option value="ZEbet">ZEbet</option>
                    <option value="bwin">bwin</option>
                    <option value="POCKERSTARS">POCKERSTARS</option>
                    <option value="vbet">vbet</option>
                    <option value="autre">autre...</option>
                </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregister</button>
    </form>
    <?php
}


?>

