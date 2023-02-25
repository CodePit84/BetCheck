<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'www' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'auth.php';

if (!empty($_SESSION['nickname'])) {
$nickname = $_SESSION['nickname'] ;
}

function nav_item (string $lien, string $titre, string $linkClass = ''): string
{
  $classe = 'nav-item';
  if ($_SERVER['SCRIPT_NAME'] === $lien) {
      $classe .= ' active';
  }
  return <<<HTML
<li class="$classe">
    <a class="$linkClass" href="$lien">$titre</a>
</li>
HTML;
}


function nav_menu (string $linkClass = ''): string
{
  return
  nav_item('index.php', 'Accueil', $linkClass) . 
  nav_item('depense.php', 'Dépense', $linkClass) .
  nav_item('retrait.php', 'Encaisser', $linkClass) .
  nav_item('consultation_all.php', 'Consulter', $linkClass);
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="pictures/favicon.ico">
<!-- Définir un title dynamique en fonction de la page -->
    <title>
        <?php if (isset($title)) : ?>
            <?= $title ?>
        <?php else : ?>
            BETCHECK
        <?php endif ?>
    </title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/starter-template/"> -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/zephyr/bootstrap.css" integrity="sha512-c9+KC+uyA//rVyts4kiSNFVXdNW6BOtxLoqjnj2FYHMllipaaYHz6T3Uf9Z6JkUHhNWD5GVGXbXXDdovk0IZlQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/zephyr/bootstrap.min.css" integrity="sha512-6xTXXOICeHpx2gWokonCPSIdUI/pgnq2e0Q9OoBszhagROWSjZxbeHOAmaRhMAHuVEkPK44/7j5uLmSIxu8EMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>

  <!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4"> -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
      <!-- <a class="navbar-brand" href="index.php">BETCHECK</a> -->
      <a class="navbar-brand ms-4" href="index.php"><img class="rounded mx-auto d-block" width="250" src="/pictures/Betcheck_400.png" alt="Betcheck Logo"></a>
      <button class="navbar-toggler me-2" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <?= nav_menu('nav-link') ?>
        </ul>
        <!-- <ul class="navbar-nav"> -->
        <ul class="navbar-nav ms-auto">
          <?php if (connected()): ?>
            <li class="nav-item"><a href="logout.php" class="nav-link">Se déconnecter <?= htmlspecialchars($nickname) ?></a></li>
          <?php else : ?>
            <li class="nav-item"><a href="login.php" class="nav-link">Se connecter</a></li>
          <?php endif; ?>  
        </ul>
      </div>
  </nav>

    <main role="main" class="container">