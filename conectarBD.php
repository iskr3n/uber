<?php
function ConectarBD(){
    $userdb= "gi_amp129";
    $passdb= ".amp129.";
    $hostdb= "bbdd.dlsi.ua.es";
    $namedb= "gi_uber";
    
    $conexion = mysqli_connect($hostdb,$userdb,$passdb,$namedb);
    
   
    if (mysqli_connect_errno())
        return null;
    mysqli_set_charset($conexion,'utf8');
    return $conexion;
}
?>