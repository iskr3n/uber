<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: index.html');
   }

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $iban = $_POST["IBAN"];
  $f_permiso_circu = $_POST["f_permiso_circu"];

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

  $sql = "UPDATE CONDUCTOR SET f_permiso_circu='$f_permiso_circu', iban='$iban'
   WHERE email='$ses'";
  $retval = var_dump($sql);die();
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');
  header('Location: conducir.php');

  $data = array($iban, $f_permiso_circu);
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
