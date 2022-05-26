<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['Comentario'];

    if (empty($comentario)==true) {
        $errors[] = "No se ha introducido nada";
    }

    if (empty($errors) == true) {
        cambiarComentario($comentario);

        header("Location: index.php");
            
        exit();
    }

    header("Location: index.php");
            
    exit();    
  }

  echo $twig->render('cambiar-comentario.html', []);
?>