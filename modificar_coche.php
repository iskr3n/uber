<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: error.html');
   }

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<!-- HEAD SECTION -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Uber</title>
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--BOOTSTRAP MAIN STYLES -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--FONTAWESOME MAIN STYLE -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--SLIDER CSS CLASES -->
    <link href="assets/Slides-SlidesJS-3/examples/playing/css/slider.css" rel="stylesheet" />
    <!--CUSTOM STYLE -->
    <link href="assets/css/style.css" rel="stylesheet" />
        <style>
         body {
            padding-top: 50px;
            padding-bottom: 0px;
         }

         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: black;
         }

         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }

         .form-signin .checkbox {
            font-weight: normal;
         }

         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }

         .form-signin .form-control:focus {
            z-index: 2;
         }

         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }

         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }

         h2{
            text-align: center;
            color: black;
         }
      </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<!--END HEAD SECTION -->
<body>
    <!-- NAV SECTION -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="perfil.php">UBER</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a>Hola, <?php echo $_SESSION["username"]; ?></a></li>
                    <li><a>MODIFICAR DATOS COCHE</a></li>
                    <li><a href="perfil.php">PERFIL</a></li>
                    <li><a href="conducir.php">CONDUCIR</a></li>
                    <li><a style ='color: red' href="logout.php">CERRAR SESIÓN</a></li>
                </ul>
            </div>


        </div>
    </div>
    <!--END NAV SECTION -->
    <!-- HOME SECTION -->

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
            $ses =  $_SESSION['username'];
            $sql = "SELECT * from VEHICULO where email_conduc like '$ses'";

            $retval = mysql_query( $sql, $con );

            if(! $retval ) {
               die('Could not get data: ' . mysql_error());
            }
            //$row = mysql_fetch_assoc($retval);
    ?>

    <div class="container">
        <h2 class="well">Modificar datos coche</h2>
        <div class="col-lg-12 well"></div>
    </div>

    <?php

            while($row = mysql_fetch_assoc($retval)) {

    ?>


    <div class="container">
        <div class="col-lg-12 well">
          <form name="register-user" action="mod_coche.php" method="post">
          <div class="row">
              <div class="col-sm-4 form-group">
                  <label>Matricula</label>
                  <input name="matricula" type="text" class="form-control" value="<?php echo $row['matricula']?>">
              </div>
              <div class="col-sm-4 form-group">
                  <label>Marca</label>
                  <input name="marca" type="text" class="form-control" value="<?php echo $row['marca']?>">
              </div>
              <div class="col-sm-4 form-group">
                  <label>Modelo</label>
                  <input name="modelo" type="text" class="form-control" value="<?php echo $row['modelo']?>">
              </div>
          </div>
          <div class="row">
            <div class="col-sm-2 form-group">
                <label>Año</label>
                <input name="anyo" type="text" class="form-control" value="<?php echo $row['anyo']?>">
            </div>
            <div class="col-sm-4 form-group">
                <label>Equipaje</label>
                <select id="selectbasic1" name="equipaje" class="form-control">
                  <option value ="<?php echo $row['equipaje']?>"><?php echo $row['equipaje']?></option>
                  <?php

                    switch ($row['equipaje']) {
                      case 'PEQUENYO':
                        echo '<option value ="MEDIANO">MEDIANO</option>';
                        echo  '<option value ="GRANDE">GRANDE</option>';
                        break;

                      case 'MEDIANO':
                      echo '<option value ="PEQUENYO">PEQUEÑO</option>';
                      echo  '<option value ="GRANDE">GRANDE</option>';
                        break;
                      case 'GRANDE':
                      echo '<option value ="PEQUENYO">PEQUEÑO</option>';
                      echo  '<option value ="MEDIANO">MEDIANO</option>';
                        break;
                    }
                  ?>
                </select>
            </div>
            <div class="col-sm-2 form-group">
                <label>Plazas</label>
                <input name="plaza" type="text" class="form-control" value="<?php echo $row['plaza']?>">
            </div>
            <div class="col-sm-4 form-group">
                <label>Tipo</label>
                <!-- <input name="tipo" type="text" class="form-control" value=""> -->
                <select id="selectbasic2" name="tipo" class="form-control">
                  <option value ="<?php echo $row['tipo']?>"><?php echo $row['tipo']?></option>
                  <?php

                    switch ($row['tipo']) {
                      case 'UBER X':
                        echo '<option value ="UBER XL">UBER XL</option>';
                        echo  '<option value ="UBER BLACK">UBER BLACK</option>';
                        echo  '<option value ="ADAPTADO">ADAPTADO</option>';
                        break;

                      case 'UBER XL':
                      echo '<option value ="UBER X">UBER X</option>';
                      echo  '<option value ="UBER BLACK">UBER BLACK</option>';
                      echo  '<option value ="ADAPTADO">ADAPTADO</option>';
                        break;
                      case 'UBER BLACK':
                      echo '<option value ="UBER X">UBER X</option>';
                      echo  '<option value ="UBER XL">UBER XL</option>';
                      echo  '<option value ="ADAPTADO">ADAPTADO</option>';
                        break;
                      case 'ADAPTADO':
                      echo '<option value ="UBER X">UBER X</option>';
                      echo  '<option value ="UBER XL">UBER XL</option>';
                      echo  '<option value ="UBER BLACK">UBER BLACK</option>';
                        break;
                    }
                  ?>
                </select>

              </div>
              <div class="row">
                  <div class="col-sm-6 form-group">
                      <label>Subir una foto</label>
                    </span><input name="image" type="file" value="<?php echo $row['imagen']?>"/></span>
                  </div>
              </div>

            <button type="submit" name="button_registro" class="btn btn-lg btn-info">Guardar</button>
          </div>
        </form>

        </div>
      </div>
<?php
    }
?>


        <div class="space-bottom"></div>
    <!--END HOME SECTION -->
    <!--FOOTER SECTION -->

        <div id="footer">
            <div class="row">
                <div class="col-md-4">
                    <h4>Información :</h4>
                    <p>
                        Uber es una aplicacion innovadora mediante cual se puede conseguir un transporte más economico. Con la posibilidad de elegir entre vehiculos de distinto tamaño segun la necesidad. Y por otra parte proporciona una fuente de ingresos para aquellos que les gusta conducir.
                    </p>

                </div>
                <div class="col-md-4">
                    <h4>Necesitas ayuda? Contacta con nosotros. </h4>
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Pregunta"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <a href="#"><i class="fa fa-facebook-square fa-3x color-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter-square fa-3x color-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus-square fa-3x color-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin-square fa-3x color-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest-square fa-3x color-pinterest"></i></a>
                    <hr>
                    <p>
                        Calle Alicante 100,<br>
                        Alicante, España.<br>
                        Telefono: +999-333-000<br>
                        Email: uber@ua.es<br>
                    </p>

                    2017 www.uber.es | All Right Reserved
                </div>
            </div>


        </div>

        <!--END FOOTER SECTION -->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY LIBRARY -->
        <script src="assets/js/jquery.js"></script>
        <!-- CORE BOOTSTRAP LIBRARY -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- SLIDER SCRIPTS LIBRARY -->
        <script src="assets/Slides-SlidesJS-3/examples/playing/js/jquery.slides.min.js"></script>
        <!-- CUSTOM SCRIPT-->
        <script>
            $(document).ready(function () {
                $('#slides').slidesjs({
                    width: 940,
                    height: 528,
                    play: {
                        active: true,
                        auto: true,
                        interval: 4000,
                        swap: true
                    }
                });
            });

        </script>

    </body>
    </html>
