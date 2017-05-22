<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: index.html');
   }

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $matricula = $_POST["matricula"];
  $marca = $_POST["marca"];
  $modelo = $_POST["modelo"];
  $anyo = $_POST["anyo"];
  $equipaje = $_POST["equipaje"];
  $plaza = $_POST["plaza"];
  //$imagen = $_POST["imagen"];
  $tipo = $_POST["tipo"];

  //Email que hay que coger de la session_start
  $ses =  $_SESSION['username'];

  $db_host='bbdd.dlsi.ua.es';
  $db_user='gi_im23';
  $db_pwd='.im23.';
  $database='gi_uber';
  $con=mysql_connect($db_host,$db_user,$db_pwd);

  if(!$con)
      die("No puede conectar a la BD");
  if(!mysql_select_db($database))
      die("No puede conectar a la BD");


  //$imagen = !empty($imagen) ? "'$imagen'" : "NULL";

 $sql= "UPDATE VEHICULO SET matricula='$matricula', marca='$marca', modelo='$modelo',
    anyo='$anyo', equipaje='$equipaje', plaza='$plaza', tipo='$tipo' WHERE email='$ses'";
   //$retval = var_dump($sql);die();
 $retval = mysql_query($sql, $con);
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');
  header('Location: conducir.php');

  $data = array($matricula, $marca, $modelo, $anyo, $equipaje, $plaza, $tipo);
  test_input($data);
}

function test_input($data) {

  foreach ($data as $key => $value) {
      if (empty($value)) {
        echo '<script language="javascript">alert("Los campos no deben estar vacios");</script>';
        return;
      }
  }
}

//header('Location: conducir.html');
?>
