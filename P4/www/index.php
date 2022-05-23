<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  
  $variablesParaTwig = [];
  
  session_start();
  
  $user = $_SESSION['usuario'];
  $contrasena = $_SESSION['contraseña'];
  $tipo = $_SESSION['tipo'];


  echo $twig->render('portada.html', ['usuario' => $user, 'contrasena' => $contrasena, 'tipo' => $tipo]);
?>
