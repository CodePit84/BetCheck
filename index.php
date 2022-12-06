<?php require 'header.php'; ?>

<img class="rounded mx-auto d-block img-fluid"
     src="/pictures/Betcheck_900.png"
     alt="Betcheck Logo">


<div class="container mt-4">
<p>Combien ça me rapporte ? Combien ça m'a coûté ?!</br>
De nombreux joueurs se posent ces questions...</p> 
<p><strong>BETCHECK</strong> est là pour vous aider à tenir vos comptes !
Paris sportifs, PMU, Grattages, Casinos, etc.</p>
<p>Vous pouvez enfin enregistrer tous vos mouvements (dépenses et gains) !</p>
<p>Vous pouvez désormais tenir vos comptes en lignes !</p>  
</div>



<?php
if (!connected()) {
?>
  <div class="row justify-content-center">
    <a class="btn btn-primary col-md-4 mt-4 mx-4" href="sign_up.php" role="button">S'incrire</a>
    <a class="btn btn-info col-md-4 mt-4 mx-4" href="login.php" role="button">Se connecter</a>
  </div>
<?php
}
?>


<?php require 'footer.php'; ?>