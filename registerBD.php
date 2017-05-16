<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
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
  //$email = $_POST['email'];

  $db_host='bbdd.dlsi.ua.es';
  $db_user='gi_im23';
  $db_pwd='.im23.';
  $database='gi_uber';
  $con=mysql_connect($db_host,$db_user,$db_pwd);

  if(!$con)
      die("No puede conectar a la BD");
  if(!mysql_select_db($database))
      die("No puede conectar a la BD");

  $sql = "INSERT INTO PERSONA(email, nombre, apellidos, f_nacimiento, direccion,
          localidad, provincia, cp, dni, movil, contrasenya) VALUES('$email', '$nombre', '$apellidos',
          '$fecha_nac', '$direccion', '$ciudad', '$provincia', '$cod_post', '$dni', '$telefono', '$contrasenya')";
  $retval = mysql_query($sql, $con);
  echo('Insertado correctamente'.$retval);
  header('Location: login.html');
  $data = array($email, $nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia,
        $cod_post, $dni, $telefono, $contrasenya);
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
?>