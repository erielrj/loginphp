<?php
  // Init session
  session_start();

  // Include db config
  require_once 'db.php';

  // Validate login
  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="_resources/style.css">
  <title>Painel de controle</title>
</head>
<body class="bg">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card card-body bg-light mt-5">
          <h2>Painel de controle <small class="text-muted"><?php echo $_SESSION['email']; ?></small></h2>
          <p class="text-center mt-4"><strong>Bem-vindo ao painel de controle, <?php echo $_SESSION['name']; ?>.</strong></p>
          <div style="width:fit-content;" class="mx-auto">
          <figure>
            <img src="_resources/img/giphy.gif" alt="">
            <figcaption class="text-center">Conseguiu logar, parabéns. Agora saia.</figcaption>
          </figure>
          </div>
          <p><a href="logout.php" class="btn btn-danger mt-4">Sair</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>