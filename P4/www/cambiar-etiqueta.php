<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  $etiquetas = getEtiquetas($_SESSION['id']);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $etiqueta_vieja = $_POST['EtiquetaVieja'];
    $etiqueta_nueva = $_POST['EtiquetaNueva'];

    if (empty($etiqueta_vieja)==true) {
        $errors[] = "No se ha introducido nada";
    }

    if (empty($etiqueta_nueva)==true) {
      $errors[] = "No se ha introducido nada";
  }

    if (empty($errors) == true) {
      cambiarEtiqueta($etiqueta_nueva, $etiqueta_vieja);

      header("Location: index.php");
    
      exit();
    }

    header("Location: index.php");
      
    exit();
  }

  echo $twig->render('cambiar-etiqueta.html', ['etiquetas' => $etiquetas]);
?>