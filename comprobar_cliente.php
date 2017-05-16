
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
      $sql = "select email from CLIENTE where email like '$ses'";
      $retval = mysql_query( $sql, $con );
      $row = mysql_fetch_assoc($retval);

      if($row['email'] == $ses ){
        header('Location: viajar.html');
      }
      else{
        header('Location: register_via.php');
      }
      
?>