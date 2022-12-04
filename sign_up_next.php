<?php require 'header.php'; ?>

<?php

// if (!isset($_POST['nickname'])) {
//     echo "Le champs pseudo est obligatoire" ;
// } else {
//     if (!isset($_POST['email'])) {
//     echo "Le champs email est obligatoire" ;
//     } else {
//         if (!isset($_POST['password'])) {
//             echo "Le champs password est obligatoire" ;
//         } else {
//             if (!isset($_POST['password2'])) {
//             echo "La vérification du mot des passe est obligatoire" ;
//             }
//         }




// connection à la bdd
// try{
//     $bdd = new PDO('mysql:host=localhost;dbname=paris_bdd', 'root', '');
//     }
//     catch (Exception $e)
//     {
//         die('Erreur : ' . $e->getMessage());
//     }

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'connexionPDO.php';

// verification du champs pseudo
if (empty($_POST['nickname'])) {
        echo "Le champ PSEUDO est obligatoire" ;
        exit();
    } else {
        $nickname = $_POST['nickname'];
    }

    
// verification du champs email
if (empty($_POST['email'])) {
    echo "Le champ EMAIL est obligatoire" ;
    exit();
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
    echo "Pseudo déjà utilisé !" ;
    exit();
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
    echo "Adresse mail déjà utilisée !" ;
    exit();
    }


// verification du MDP et de la correspondances de 2 Mots de passe saisis
if (empty($_POST['password'])) {
    echo "Le champ MOT DE PASSE est obligatoire" ;
    exit();
} elseif ((isset($_POST['password'])) && (($_POST['password']) === ($_POST['password2']))) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;    
        } else {
            echo "Erreur, veuillez entrer un mot de passe identique dans les 2 champs MOTS DE PASSE" ;
            exit();
        }



// else {

//         if ((isset($_POST['password'])) && (($_POST['password']) === ($_POST['password2']))) {
//             $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
            
//         } else {
//             echo "Erreur, veuillez entrer un mot de passe identique dans les 2 champs mots de passe" ;
//             }
// }



// si on a les 3 variables alors c'est que les verifications ont été effectuée alors on peux sauver dans la bdd
if ((isset($nickname)) && (isset($email)) && (isset($password))) {
    $req = $bdd->prepare('INSERT INTO members(nickname, password, email, registration_date) VALUES (:nickname, :password, :email, CURDATE())');

    $req->execute(array(
        'nickname' => $nickname,
        'password' => $password,
        'email' => $email));

    echo "Inscription effectuée avec succès !";
}

// Hachage du mot de passe
// $pass_hache = sha1($_POST['password']) ; // ancienne methode

// $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
// echo $password ;

