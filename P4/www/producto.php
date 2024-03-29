<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  
  if (isset($_GET['id'])) {
    $idPala = $_GET['id'];
    $_SESSION['id'] = $_GET['id'];
  } else {
    $idPala = -1;
  }

  
  session_start();
   
  $pala = getPala($idPala);

  $_SESSION['id'] = $idPala;
  
  $user = $_SESSION['usuario'];
  $contrasena = $_SESSION['contraseña'];
  $tipo = $_SESSION['tipo'];
  $email = $_SESSION['email'];
  $etiquetas = getEtiquetas($idPala);
  
  echo $twig->render('producto.html', ['pala' => $pala, 'usuario' => $user, 'contrasena' => $contrasena, 'tipo' => $tipo, 'email' => $email, 'etiquetas' => $etiquetas]);
?>
