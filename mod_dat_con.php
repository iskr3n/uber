<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: error.html');
   }

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $iban = $_POST["IBAN"];
  $f_permiso_circu = $_POST["f_permiso_circu"];

  $err = false;

  $data = array($iban, $f_permiso_circu);
        foreach ($data as $key => $value) {
            if (empty($value)) {
              $err = true;
              echo '<script language="javascript">alert("Los campos no deben estar vacios");</script>';
              break;
            }
        }
 //VALIDACIONES
 if (!preg_match("/^[0-9a-zA-Z ]*$/",$iban) || (strlen($iban) != 24)) {
   $err = true;
  echo '<script language="javascript">alert("El campo IBAN debe contener 2 letras y 22 cifras");</script>';
 }

if($err) {
  echo "<script>setTimeout(\"location.href = '/uber/modificar_con.php';\",0);</script>";
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

  $sql = "UPDATE CONDUCTOR SET f_permiso_circu='$f_permiso_circu', iban='$iban'
   WHERE email='$ses'";
  // $retval = var_dump($sql);die();
  $retval = mysql_query($sql, $con);
  //echo('Insertado correctamente'.$retval);
  //header('Location: login.html');

}


//header('Location: conducir.html');
?>
