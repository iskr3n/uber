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

  $contrasenya = Encrypter::encrypt($_POST['password']);
  $foto= $_FILES["imagen"]["tmp_name"];
  $nombrefoto  = $_FILES["foto"]["name"];
//este es el archivo que añadiremosal campo blob
  $foto  = $_FILES['imagen']['tmp_name'];
  //lo comvertimos en binario antes de guardarlo
       $foto=mysql_real_escape_string(file_get_contents($_FILES["imagen"]["tmp_name"]));

  //$email = $_POST['email'];

  $db_host='bbdd.dlsi.ua.es';
  $db_user='gi_im23';
  $db_pwd='.im23.';
  $database='gi_uber';
  $con=mysql_connect($db_host,$db_user,$db_pwd);

  $imagen = !empty($imagen) ? "'$imagen'" : "NULL";

  if(!$con)
      die("No puede conectar a la BD");
  if(!mysql_select_db($database))
      die("No puede conectar a la BD");


  $sql = "INSERT INTO PERSONA(email, nombre, apellidos, f_nacimiento, direccion,
          localidad, provincia, cp, dni, movil, contrasenya, imagen) VALUES('$email', '$nombre', '$apellidos',
          '$fecha_nac', '$direccion', '$ciudad', '$provincia', '$cod_post', '$dni', '$telefono', '$contrasenya', '$foto')";

  $retval = mysql_query($sql, $con);
  echo('Insertado correctamente'.$retval);
  header('Location: login.html');
  $data = array($email, $nombre, $apellidos, $fecha_nac, $direccion, $ciudad, $provincia,
        $cod_post, $dni, $telefono, $contrasenya, $foto);
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
