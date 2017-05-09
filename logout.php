
<?php
   session_start();

    
      $db_host='bbdd.dlsi.ua.es';
      $db_user='gi_im23';
      $db_pwd='.im23.';
      $database='gi_uber';
      $con=mysql_connect($db_host,$db_user,$db_pwd);

      if(!$con)
          die("No puede conectar a la BD");
       if(!mysql_select_db($database))
          die("No puede conectar a la BD");


      $ses =  $_SESSION['username'];
      $sql2 = "UPDATE CONDUCTOR SET disponibilidad='FUERA DE SERVICIO' WHERE email like '$ses'";
      $retval2 = mysql_query( $sql2, $con );

   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();

   header('Refresh: 1; URL = index.html');
?>