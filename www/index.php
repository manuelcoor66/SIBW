<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';
  
  session_start();
  
  $user = $_SESSION['usuario'];
  $contrasena = $_SESSION['contraseña'];
  $tipo = $_SESSION['tipo'];
  $email = $_SESSION['email'];
  $nombre = $_SESSION['nombre'];
  $apellidos = $_SESSION['apellidos'];


  echo $twig->render('portada.html', ['usuario' => $user, 'contrasena' => $contrasena, 'tipo' => $tipo, 'email' => $email, 'nombre' => $nombre, 'apellidos' => $apellidos]);
?>
