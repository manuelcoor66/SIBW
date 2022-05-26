<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $etiqueta = $_POST['Etiqueta'];
    $id = $_SESSION['id'];

    if (empty($etiqueta)==true) {
        $errors[] = "No se ha introducido nada";
    }

    if (empty($errors) == true) {
        eliminarEtiqueta($etiqueta, $id);

        header("Location: index.php");
      
        exit();
    }

    header("Location: index.php");
      
    exit();
  }

  echo $twig->render('eliminar-etiqueta.html', []);
?>