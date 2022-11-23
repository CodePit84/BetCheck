<?php
$title = "Encaisser";
$nav = "Encaisser";
require_once 'functions/auth.php';
force_connected_user();
?>

<?php require 'header.php'; ?>


<!-- Veuillez indiquer le montant de votre retrait (ou encaissement) :
<form action="/paris/consultation.php" method="post">
<input type="number" name="encaissement">
<input type="date" name="date_encaissement">
<button type="submit">Enregister</button>
</form> -->


<h3>Veuillez indiquer le montant de votre encaissement :</h3>
<form action="/paris/consultation_all.php" method="post">
    <div class="form-group">
        <input class="form-control" type="number" name="encaissement" placeholder="ex : 50"></br>
        <input class="form-control" type="date" name="date_encaissement"></br>
        <label for="site-select">facultatif :</label>
            <select class="custom-select" name="site" id="site-select">
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