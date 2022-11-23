<?php require_once 'header.php'; ?>

<?php
require_once 'functions/auth.php';
if (connected()){
    header('Location: consultation_all.php');
    exit();
}


?>

<h2>Se connecter</h2>
<form action="/paris/login_next.php" method="post">
    <div class="form-group">
        <label>Pseudo : </label></br><input class="form-control" type="text" name="nickname"></br>
        <label>Mot de passe : </label></br><input class="form-control" type="password" name="password"></br>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require_once 'footer.php'; ?>