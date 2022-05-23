<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  
  if (isset($_GET['id'])) {
    $idPala = $_GET['id'];
  } else {
    $idPala = -1;
  }
   
  $pala = getPala($idPala);
  
  $variablesParaTwig = [];
  
  session_start();
  
  if (isset($_SESSION['nickUsuario'])) {
    $variablesParaTwig['user'] = getUser($_SESSION['nickUsuario']);
  }
  
  echo $twig->render('producto.html', ['pala' => $pala, 'usuario' => $variablesParaTwig]);
?>
