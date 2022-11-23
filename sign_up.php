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



<?php
// initialisation de la variable erreur
$erreur = null;

// connection à la bdd
try{
    $bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

// Condition pour empêcher message d'erreur lorsque l'on charge la page vide
if((!empty($_POST['nickname'])) || (!empty($_POST['email'])) || (!empty($_POST['password'])) || (!empty($_POST['password2']))) { 

    // verification du champs pseudo
    if (empty($_POST['nickname'])) {
        $erreur .= "Le champ PSEUDO est obligatoire ! " ;
        
        // echo "Le champ PSEUDO est obligatoire" ;
        // exit();  
        } else {
        $nickname = $_POST['nickname'];
        }

        
    // verification du champs email
    if (empty($_POST['email'])) {
        $erreur .= "Le champ EMAIL est obligatoire ! " ;
        $email = null;
        // exit();
    } else {
        $email = $_POST['email'];
    }


    // Vérification si Nickname libre ou déjà utilisé
    function existNickname($nickname)
    {   
        global $bdd;
        
        $sql = "SELECT 1
                FROM members
                WHERE nickname = '$nickname'";
        
        $res = $bdd->query($sql);
        $row = $res->fetch();
        
        return !empty($row);
    }

    if(existNickname($nickname))
        {          
        $erreur .= "Pseudo déjà utilisé ! " ;
        // exit();
        }


    // Vérification si Email libre ou déjà utilisée
    function existEmail($email)
    {   
        global $bdd;
        
        $sql = "SELECT 1
                FROM members
                WHERE email = '$email'";
        
        $res = $bdd->query($sql);
        $row = $res->fetch();
        
        return !empty($row);
    }

    if(existEmail($email))
        {          
        $erreur .= "Adresse mail déjà utilisée ! " ;
        // echo "Adresse mail déjà utilisée !" ;
        // exit();
        } 


    // verification du MDP et de la correspondances de 2 Mots de passe saisis
    if (empty($_POST['password'])) {
        $erreur .= "Le champ MOT DE PASSE est obligatoire" ;
        // exit();
    } elseif ((isset($_POST['password'])) && (($_POST['password']) === ($_POST['password2']))) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;   
        } else {
            $erreur .= "Erreur, veuillez entrer un mot de passe identique dans les 2 champs MOTS DE PASSE" ;
            // exit();
            }



    
}


// si on a les 3 variables alors c'est que les verifications ont été effectuée alors on peut sauver dans la bdd
global $bdd;
if ((isset($nickname)) && (isset($email)) && (isset($password)) && (!$erreur)) {
    $req = $bdd->prepare('INSERT INTO members(nickname, password, email, registration_date) VALUES (:nickname, :password, :email, CURDATE())');

    $req->execute(array(
        'nickname' => $nickname,
        'password' => $password,
        'email' => $email));

    // echo "Inscription effectuée avec succès !";
    $Message = urlencode("Inscription effectuée avec succès !");
    header("Location:login.php?Message=".$Message);
    die;
}


?>

<?php if ($erreur): ?>
<div class="alert alert-danger">
    <?= $erreur ?>
</div>
<?php endif ?>

<h2>S'inscrire</h2>
<form action="/paris/sign_up.php" method="post">
    <div class="form-group">
        <label>Pseudo : </label></br><input class="form-control" type="text" name="nickname"></br>
        <label>Email : </label></br><input class="form-control" type="email" name="email"></br>
        <label>Mot de passe : </label></br><input class="form-control" type="password" name="password"></br>
        <label>Vérification du mot de passe : </label></br><input class="form-control" type="password" name="password2"></br>
    </div>
    <button type="submit" class="btn btn-primary">S'incrire</button>
</form>