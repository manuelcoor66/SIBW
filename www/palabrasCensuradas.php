<?php
    include("bd.php"); 
    
    $censuradas = getPalabras();

    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode($censuradas);
?>
