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

  $err = false;

  $data = array($nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia,
        $cod_post, $dni, $telefono, $contrasenya);
        foreach ($data as $key => $value) {
            if (empty($value)) {
              $err = true;
              echo '<script language="javascript">alert("Los campos no deben estar vacios");</script>';
              break;
            }
        }
 //VALIDACIONES
 /*if(empty($_POST['contrasenya'])) {
   echo '<script language="javascript">alert("La contrasenya no debe estar vacía");</script>';
   $err = true;
 }
*/
 if(strlen($telefono) != 9) {
   $err = true;
   echo '<script language="javascript">alert("El telefono debe tener nueve cifras");</script>';
 }
 if(strlen($cod_post) != 4) {
   $err = true;
   echo '<script language="javascript">alert("El código postal esta incorrecto");</script>';
 }
 if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
   $err = true;
  echo '<script language="javascript">alert("Nombre solo puede contener letras");</script>';
 }

 if (!preg_match("/^[a-zA-Z ]*$/",$apellidos)) {
   $err = true;
  echo '<script language="javascript">alert("Apellidos solo puede contener letras");</script>';
 }
 if (!preg_match("/^[a-zA-Z ]*$/",$ciudad)) {
   $err = true;
  echo '<script language="javascript">alert("Ciudad solo puede contener letras");</script>';
 }
 if (!preg_match("/^[a-zA-Z ]*$/",$provincia)) {
   $err = true;
  echo '<script language="javascript">alert("Provincia solo puede contener letras");</script>';
 }

 if (!preg_match("/^[0-9a-zA-Z ]*$/",$dni) || (strlen($dni) != 9)) {
   $err = true;
  echo '<script language="javascript">alert("El campo DNI debe contener 8 cifras y 1 letra");</script>';
 }

 if (!preg_match("/^[0-9a-zA-Z ]*$/",$direccion) ) {
   $err = true;
  echo '<script language="javascript">alert("El campo dirección no es correcto");</script>';
 }

if($err) {
  echo "<script>setTimeout(\"location.href = '/uber/modificar.php';\",0);</script>";
} else {
  echo "<script>setTimeout(\"location.href = '/uber/perfil.php';\",0);</script>";
}

if(empty($_FILES["imagen"]["tmp_name"])) {
  $foto = "NULL";
} else {
  $foto= $_FILES["imagen"]["tmp_name"];
  $nombrefoto  = $_FILES["foto"]["name"];
  //este es el archivo que añadiremosal campo blob
  $foto  = $_FILES['imagen']['tmp_name'];
  //lo comvertimos en binario antes de guardarlo
  $foto=mysql_real_escape_string(file_get_contents($_FILES["imagen"]["tmp_name"]));
  $foto = "'$foto'";
}

  // leemos datos de la foto
  $foto= $_FILES["imagen"]["tmp_name"];
  $nombrefoto  = $_FILES["imagen"]["name"];
 
  //este es el archivo temporal
  $foto  = $_FILES['imagen']['tmp_name'];
  //leer el archivo temporal en binario
  $foto=mysql_real_escape_string(file_get_contents($_FILES["imagen"]["tmp_name"]));
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

<<<<<<< HEAD
  if(!$err) {
    $sql = "UPDATE PERSONA SET nombre='$nombre', apellidos='$apellidos', f_nacimiento='$fecha_nac',
      direccion='$direccion', localidad='$ciudad', provincia='$provincia', cp='$cod_post', dni='$dni',
      movil='$telefono', contrasenya='$contrasenya', imagen=$foto WHERE email='$ses'";
     //$retval = var_dump($sql);die();
   $retval = mysql_query($sql, $con);
  }
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');

=======

  $sql = "UPDATE PERSONA SET nombre='$nombre', apellidos='$apellidos', f_nacimiento='$fecha_nac',
    direccion='$direccion', localidad='$ciudad', provincia='$provincia', cp='$cod_post', dni='$dni',
    

  $retval = mysql_query($sql, $con);
  echo('Insertado correctamente'.$retval);
  header('Location: perfil.php');
  $data = array($nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia, $cod_post,
    $dni, $telefono, $contrasenya, $foto);
  test_input($data);
>>>>>>> origin/paula
}

//header('Location: conducir.html');
?>
