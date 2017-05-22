<?php
   session_start();
?>

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
                    if($_POST['username'] == $row['email'] && Encrypter::encrypt($_POST['password']) == $row['contrasenya']){
                       $user_mydb = $row['email'];
                       $pass_mydb = $row['contrasenya'];
                    }
                    }

               if ($_POST['username'] == $user_mydb && Encrypter::encrypt($_POST['password']) == $pass_mydb) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $user_mydb;

                  $ses =  $_SESSION['username'];

                  $sql2 = "UPDATE CONDUCTOR SET disponibilidad='DISPONIBLE' WHERE email like '$ses'";
                  $retval2 = mysql_query( $sql2, $con );

//<<<<<<< Updated upstream
                  if($ses==admin){
                  header('Location: menuadministrador.php');
                  }
                  else{
                  header('Location: perfil.php');
                  }

//=======
                  //header('Location: perfil.php');


//>>>>>>> Stashed changes
               }else {
                  $msg = 'Username o Password estan incorrectos.';
                  header('Location: login.html');
               }
            }
         ?>
