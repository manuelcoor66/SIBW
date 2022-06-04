<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd.php';  
  
  session_start();

  $etiquetas = getEtiquetas($_SESSION['id']);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();
    $id = sacarIdMax();
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $descripcion = $_POST['Descripcion'];
    $tipo_jugador = $_POST['TipoJugador'];
    $caracteristicas = $_POST['Caracteristicas'];
    $enlace = $_POST['Enlace'];
    $foto1 = $_POST['Foto1'];
    $foto2 = $_POST['Foto2'];
    $foto3 = $_POST['Foto3'];

    if (empty($id)==true || empty($nombre)==true ||empty($precio)==true ||empty($descripcion)==true ||empty($tipo_jugador)==true ||empty($caracteristicas)==true ||empty($enlace)==true ||empty($foto1)==true ||empty($foto2)==true ||empty($foto3)==true) {
        $errors[] = "Error, algún campo no se ha introducido";
    }

    if (empty($errors) == true) {
        añadirProducto($etiqueta);

        header("Location: index.php");
        
        exit();
        }

    header("Location: index.php");
      
    exit();
  }

  echo $twig->render('añadir-producto.html', []);
?>