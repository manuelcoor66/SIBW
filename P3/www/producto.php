<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if (isset($_GET['id'])) {
    $idPala = $_GET['id'];
  } else {
    $idPala = -1;
  }
   
  $pala = getPala($idPala);
  
  
  echo $twig->render('producto.html', ['pala' => $pala]);
?>
