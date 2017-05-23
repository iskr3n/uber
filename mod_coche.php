<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: error.html');
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

  $err = false;

  $data = array($matricula, $marca, $modelo, $anyo, $plaza);
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
  if (!preg_match("/^[0-9a-zA-Z ]*$/",$matricula) || (strlen($matricula) != 7)) {
    $err = true;
   echo '<script language="javascript">alert("Matricula debe tener 4 cifras y 3 letras");</script>';
  }
  if (!preg_match("/^[a-zA-Z ]*$/",$marca)) {
    $err = true;
   echo '<script language="javascript">alert("Marca solo puede contener letras");</script>';
  }
  if (!preg_match("/^[0-9a-zA-Z ]*$/",$modelo) ) {
    $err = true;
   echo '<script language="javascript">alert("El campo modelo no es correcto");</script>';
  }
  if(strlen($anyo) != 4) {
    $err = true;
    echo '<script language="javascript">alert("El año debe tener 4 cifras");</script>';
  }


if($err) {
  echo "<script>setTimeout(\"location.href = '/uber/modificar_coche.php';\",0);</script>";
} else {
  echo "<script>setTimeout(\"location.href = '/uber/conducir.php';\",0);</script>";
}

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
    anyo='$anyo', equipaje='$equipaje', plaza='$plaza', tipo='$tipo' WHERE email_conduc='$ses'";
  //  $retval = var_dump($sql);die();
 $retval = mysql_query($sql, $con);
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');
}

//header('Location: conducir.html');
?>
