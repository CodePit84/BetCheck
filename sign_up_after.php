<?php
// fichier tampon pour header("Location:") car HTML déjà généré m'empêchant de rerouter la page avec un message de succes donc reroutage via Javascript et cettte page
$Message = urlencode("Inscription effectuée avec succès !");
header("Location: login.php?Message=".$Message);