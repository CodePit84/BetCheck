<?php require_once 'header.php'; ?>

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
        // var_dump($resultat);
        // echo $resultat['id'] ;
    
    if ($resultat) {  // On vérifie si résultat est à TRUE pour continuer le script sinon l'utilisateur n'existe pas dans la bdd

//
        
        // $result_id = $bdd->query("SELECT id FROM members WHERE nickname = '$nickname'");
        // $out = $result_id->fetch();
        // var_dump($out);
        // echo $out['id'];
//

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
            echo "Vous êtes connecté ! Bonjour " . htmlspecialchars($nickname);
            // header('Location: consultation_all.php');                              //

        }else{

            // echo 'Identification incorrecte !';
            $erreur = "Mot de passe incorrect !" ;
        }

    } else {
        $erreur = "Utilisateur inconnu !" ;
    }

} else {
$erreur = "Veuillez remplir tous les champs !" ;
}




?>

<?php if ($erreur): ?>
<div class="alert alert-danger">
    <?= $erreur ?>
</div>
<?php endif ?>

<?php require 'footer.php'; ?>