<?php
   session_start();
?>

         <?php
            $db_host='bbdd.dlsi.ua.es';
            $db_user='gi_im23';
            $db_pwd='.im23.';
            $database='gi_uber';
            $con=mysql_connect($db_host,$db_user,$db_pwd);

            if(!$con)
                die("No puede conectar a la BD");
            if(!mysql_select_db($database))
                die("No puede conectar a la BD");

            $sql = 'SELECT email, contrasenya from PERSONA';
            
            $retval = mysql_query( $sql, $con );
   
               if(! $retval ) {
                  die('Could not get data: ' . mysql_error());
               }

            $msg = '';
            $login = 0;
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
             $user_mydb = '';
             $pass_mydb = '';
            while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                    if($_POST['username'] == $row['email'] && $_POST['password'] == $row['contrasenya']){
                       $user_mydb = $row['email'];
                       $pass_mydb = $row['contrasenya'];
                    }
                    }   

               if ($_POST['username'] == $user_mydb && 
                  $_POST['password'] == $pass_mydb) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $user_mydb;
                  
                  $ses =  $_SESSION['username'];
            
                  $sql2 = "UPDATE CONDUCTOR SET disponibilidad='DISPONIBLE' WHERE email like '$ses'";
                  $retval2 = mysql_query( $sql2, $con );

                  header('Location: perfil.php');
               }else {
                  $msg = 'Username o Password estan incorrectos.';
                  header('Location: login.html');
               }
            }
         ?>