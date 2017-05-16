
<?php 
//cadena de conexion 
            $db_host='bbdd.dlsi.ua.es';
            $db_user='gi_amp129';
            $db_pwd='.amp129.';
            $con=mysql_connect($db_host,$db_user,$db_pwd);
//DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe 
if ($busqueda<>''){ 
   //CUENTA EL NUMERO DE PALABRAS 
   $trozos=explode(" ",$busqueda); 
   $numero=count($trozos); 
  if ($numero==1) { 
   //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE 
   $cadbusca="SELECT * FROM LUGARES WHERE table_schema='gi_uber' AND direccion LIKE '%$busqueda%' OR localidad LIKE '%$busqueda%' LIMIT 50"; 
  } elseif ($numero>1) { 
  //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST 
  //busqueda de frases con mas de una palabra y un algoritmo especializado 
  $cadbusca="SELECT direccion, localidad AGAINST ( '$busqueda' ) FROM LUGARES WHERE MATCH ( direccion, localidad ) AGAINST ( '$busqueda' );"; 
} 
$result=mysql("direcciones", $cadbusca); 
While($row=mysql_fetch_object($result)) 
{ 
   //Mostramos los titulos de los articulos o lo que deseemos... 
  $localidad=$row->direccion; 
   $direccion=$row->localidad; 
   echo $direccion." - ".$localidad."<br>";
} 
}
?>