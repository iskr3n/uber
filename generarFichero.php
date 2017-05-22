<?php


  $db_host='bbdd.dlsi.ua.es';
            $db_user='gi_amp129';
            $db_pwd='.amp129.';
            $database='gi_uber';
            $con=mysql_connect($db_host,$db_user,$db_pwd);

if (!$con)
    die("No puede conectar a la BD");
if (!mysql_select_db($database))    
    die("No puede conectar a la BD");


    $query = "SELECT * FROM LUGARES"; 
     $result = @mysql_query($query);

    $xml='<?xml version="1.0" encoding="ISO-8859-1"?><?xml-stylesheet href="estilo.xsl" type="text/xsl" ?>';
    $xml .="<lugares>";

    while($row = mysql_fetch_array($result))
    {
	$direccion=$row['direccion'];
	$localidad=$row['localidad'];
	$xml .="<lugar> <direccion>$direccion</direccion><localidad>$localidad</localidad> </lugar>";
	


    }
    $xml .="</lugares>";




$fp=fopen("fichero.xml","w+");
fwrite($fp,$xml);
fclose($fp);


     
        
?> 

<HTML>
<HEAD>
<head>
  <title>PRACTICA PHP y MYSQL</title>
</head>
<BODY>

<p>Para ver el fichero XML pinche <a href="fichero.xml">aquí</a></p>

 
</BODY>
</HTML>

