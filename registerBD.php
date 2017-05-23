<?php
class Encrypter {

    private static $Key = "dublin";

    public static function encrypt ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        return $output;
    }

    public static function decrypt ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        return $output;
    }

}

function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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

  $err = false;

  $data = array($email, $nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia,
        $cod_post, $dni, $telefono);
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
 if(strlen($cod_post) != 5) {
   $err = true;
   echo '<script language="javascript">alert("El código postal debe tener cinco cifras");</script>';
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
  echo "<script>setTimeout(\"location.href = '/uber/register.php';\",0);</script>";
} else {
  echo "<script>setTimeout(\"location.href = '/uber/login.html';\",0);</script>";
}

  $contrasenya = Encrypter::encrypt($_POST['password']);

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

  $db_host='bbdd.dlsi.ua.es';
  $db_user='gi_im23';
  $db_pwd='.im23.';
  $database='gi_uber';
  $con=mysql_connect($db_host,$db_user,$db_pwd);

  //$imagen = !empty($imagen) ? "'$imagen'" : "NULL";

  if(!$con)
      die("No puede conectar a la BD");
  if(!mysql_select_db($database))
      die("No puede conectar a la BD");


  $sql = "INSERT INTO PERSONA(email, nombre, apellidos, f_nacimiento, direccion,
          localidad, provincia, cp, dni, movil, contrasenya, imagen) VALUES('$email', '$nombre', '$apellidos',
          '$fecha_nac', '$direccion', '$ciudad', '$provincia', '$cod_post', '$dni', '$telefono', '$contrasenya', $foto)";

  $retval = mysql_query($sql, $con);
   //header('Location: login.html');
}

?>
