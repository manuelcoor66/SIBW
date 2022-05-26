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
  
  session_start();
  
  $user = $_SESSION['usuario'];
  $contrasena = $_SESSION['contraseña'];
  $tipo = $_SESSION['tipo'];
  $email = $_SESSION['email'];
  
  echo $twig->render('producto.html', ['pala' => $pala, 'usuario' => $user, 'contrasena' => $contrasena, 'tipo' => $tipo, 'email' => $email]);
?>
