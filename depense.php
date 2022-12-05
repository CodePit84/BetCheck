<?php
$title = "Dépense";
$nav = "Dépense";
require_once 'functions/auth.php';
force_connected_user();
require 'header.php'; 
?>


<h3>Veuillez indiquer le montant de votre dépense :</h3>
<form action="consultation_all.php" method="post">
    <div class="form-group">
        <input class="form-control" type="number" name="depense" placeholder="ex : 50"></br>
        <input class="form-control" type="date" name="date_depense"></br>
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