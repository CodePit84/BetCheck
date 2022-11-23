<?php require 'header.php'; ?>

<?php

// connection à la bdd
// try{
//     $bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
//     }
//     catch (Exception $e)
//     {
//         die('Erreur : ' . $e->getMessage());
//     }


// $today = date("Y-m-d");
// $today = date("d/m/Y");
?>

<!-- S'inscrire
<form action="/paris/sign_up_next.php" method="post">
    <label>Pseudo : </label></br><input type="text" name="nickname"></br>
    <label>Email : </label></br><input type="email" name="email"></br>
    <label>Mot de passe : </label></br><input type="password" name="password"></br>
    <label>Vérification du mot de passe : </label></br><input type="password" name="password2"></br>
    <button type="submit">S'incrire</button>
</form> -->

<h2>S'inscrire</h2>
<form action="/paris/sign_up_next.php" method="post">
    <div class="form-group">
        <label>Pseudo : </label></br><input class="form-control" type="text" name="nickname"></br>
        <label>Email : </label></br><input class="form-control" type="email" name="email"></br>
        <label>Mot de passe : </label></br><input class="form-control" type="password" name="password"></br>
        <label>Vérification du mot de passe : </label></br><input class="form-control" type="password" name="password2"></br>
    </div>
    <button type="submit" class="btn btn-primary">S'incrire</button>
</form>