<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  $etiquetas = getEtiquetas($_SESSION['id']);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $etiqueta = $_POST['Etiqueta'];

    if (empty($etiqueta)==true) {
        $errors[] = "No se ha introducido nada";
    }

    if (empty($errors) == true) {
      insertarEtiqueta($etiqueta);

      header("Location: index.php");
    
      exit();
    }

    header("Location: index.php");
      
    exit();
  }

  echo $twig->render('añadir-etiqueta.html', ['etiquetas' => $etiquetas]);
?>