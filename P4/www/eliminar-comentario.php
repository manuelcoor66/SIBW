<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  eliminarComentario();

  header("Location: index.php");
        
  exit();

  echo $twig->render('eliminar-comentario.html', []);
?>