<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: error.html');
   }

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $fecha_nac = $_POST['fecha_n'];
  $direccion = $_POST['dir'];
  $ciudad = $_POST['ciudad'];
  $provincia = $_POST['prov'];
  $cod_post = $_POST['cp'];
  $dni = $_POST['dni'];
  $telefono = $_POST['telefono'];
  $contrasenya = $_POST['password'];
  $imagen = $_POST['imagen'];

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

  $imagen = !empty($imagen) ? "'$imagen'" : "NULL";

  $sql = "UPDATE PERSONA SET nombre='$nombre', apellidos='$apellidos', f_nacimiento='$fecha_nac',
    direccion='$direccion', localidad='$ciudad', provincia='$provincia', cp='$cod_post', dni='$dni',
    movil='$telefono', contrasenya='$contrasenya', imagen=$imagen WHERE email='$ses'";
   //$retval = var_dump($sql);die();
 $retval = mysql_query($sql, $con);
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');
  header('Location: perfil.php');

  $data = array($nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia, $cod_post,
    $dni, $telefono, $contrasenya);
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
