<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: index.html');
   }

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $metodo_pago = $_POST["metodo_pago"];

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

  $sql = "UPDATE CLIENTE SET m_pago='$metodo_pago' WHERE email='$ses'";
   //$retval = var_dump($sql);die();
 $retval = mysql_query($sql, $con);
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');
  header('Location: viajar.html');

  $data = array($metodo_pago);
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
