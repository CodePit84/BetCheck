<?php require_once 'header.php'; ?>

<?php
require_once 'functions/auth.php';
if (connected()){
    header('Location: consultation_all.php');
    exit();
}


// Message transmit de sign_up.php lors du succès de l'inscription
if(isset($_GET['Message'])){
    $success = $_GET['Message'];
} else {
    $success = null;
}
?>



<?php
// connection à la bdd
// try{
//     $bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
//     }
//     catch (Exception $e)
//     {
//         die('Erreur : ' . $e->getMessage());
//     }

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connexionPDO.php';

$erreur = null;
if(!empty($_POST['nickname']) || !empty($_POST['password'])) {   // mettre ET plus tard quoi que....

    $nickname = $_POST['nickname'] ;

    $statement = $bdd->prepare("SELECT password FROM members WHERE nickname=:nickname");
        
        $req = $bdd->prepare('SELECT id FROM members WHERE nickname = :nickname '); // OpenClassrooms connection pour demarrer la session
        $req->execute(array('nickname' => $nickname));                              //
        $resultat = $req->fetch();                                                  //
       
    
    if ($resultat) {  // On vérifie si résultat est à TRUE pour continuer le script sinon l'utilisateur n'existe pas dans la bdd

        $statement->execute(array('nickname'=>$nickname));

        $output = $statement->fetchAll(PDO::FETCH_ASSOC);

        $hashed_password = $output[0]["password"];

        $user_entered_password = $_POST['password'];

        if(password_verify($user_entered_password,$hashed_password))
        {
            session_start();                                                            //
            $_SESSION['id'] = $resultat['id'];                                          //
            $_SESSION['nickname'] = $nickname;
            $_SESSION['connected'] = 1;                                          //
            // echo "Vous êtes connecté ! Bonjour " . htmlspecialchars($nickname);
            header('Location: /paris/consultation_all.php');                              //

        }else{

            // echo 'Identification incorrecte !';
            $erreur = "Mot de passe incorrect !" ;
        }

    } else {
        $erreur = "Utilisateur inconnu !" ;
    }

} 

?>

<?php if ($erreur): ?>
<div class="alert alert-danger">
    <?= $erreur ?>
</div>
<?php endif ?>


<?php if ($success): ?>
<div class="alert alert-success">
    <?= $success ?>
</div>
<?php endif ?>



<h2>Se connecter</h2>
<form action="/paris/login.php" method="post">
    <div class="form-group">
        <label>Pseudo : </label></br><input class="form-control" type="text" name="nickname"></br>
        <label>Mot de passe : </label></br><input class="form-control" type="password" name="password"></br>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require_once 'footer.php'; ?>
