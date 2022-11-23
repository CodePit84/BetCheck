<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'paris' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'auth.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/starter-template/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Mon Site</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if ($_SERVER['SCRIPT_NAME'] === 'paris/index.php'): ?>active<?php endif; ?>">
            <a class="nav-link" href="/paris/depense.php">Dépense <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item  <?php if ($_SERVER['SCRIPT_NAME'] === 'paris/retrait.php'): ?>active<?php endif; ?>">
            <a class="nav-link" href="/paris/retrait.php">Retrait</a>
          </li>
          <li class="nav-item  <?php if ($_SERVER['SCRIPT_NAME'] === 'paris/consultation_all.php'): ?>active<?php endif; ?>">
            <a class="nav-link" href="/paris/consultation_all.php">Consultation ALL</a>
          </li>
          <!-- <ul class="navbar-nav">
            <?php if (connected()): ?>
                <li class="nav-item"><a href="/logout.php" class="nav-link">Se déconnecter</a></li>
            <?php endif ?>
          </ul> -->

          <ul class="navbar-nav">
          <?php if (connected()): ?>
            <li class="nav-item"><a href="/POO/logout.php" class="nav-link">Se déconnecter</a></li>
          <?php endif; ?>  
        </ul>

      </div>
    </nav>

    <main role="main" class="container">
