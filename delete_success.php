<?php
// fichier tampon pour header("Location:") car HTML déjà généré m'empêchant de rerouter la page avec un message de succes donc reroutage via Javascript et cettte page
$Message = urlencode("Mouvement supprimé avec succès !");
header("Location:consultation_all.php?Message=".$Message);