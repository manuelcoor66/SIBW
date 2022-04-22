<?php
    include include("bd.php"); 
    
    $censuradas = getPalabras();

    echo json_encode($censuradas);
?>
