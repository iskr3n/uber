<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: index.html');
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
                    <li><a>CONDUCIR</a></li>
                    <li><a href="anyadir_coche.php">AÑADIR COCHE</a></li>
                    <li><a href="modificar_coche.php">MODIFICAR COCHE</a></li>
                    <li><a href="modificar_con.php">MODIFICAR DATOS</a></li>
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
            $sql = "select * from VEHICULO where email_conduc like '$ses'";

            $retval = mysql_query( $sql, $con );

               if(! $retval ) {
                  die('Could not get data: ' . mysql_error());
               }

             echo "<div class=\"container\" style=\"margin-top: 0px\"><h1 style=\"text-align: center;font-weight:normal;color:#000000;letter-spacing:7pt;word-spacing:3pt;font-size:49px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:3;\">Mis coches</h1>
                    <div class=\"row\">";

                while($row = mysql_fetch_array($retval)){   //Creates a loop to loop through results
                echo "<div class=\"col-sm-4 col-md-4\">
                        <a href=\"conduciendo.php\"><div style=\"-moz-box-shadow:inset 0px 1px 0px 0px #9fb4f2;
                        -webkit-box-shadow:inset 0px 1px 0px 0px #9fb4f2;box-shadow:inset 0px 1px 0px 0px #9fb4f2;
                        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #7892c2), color-stop(1, #476e9e));
                        background:-moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);background:-webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                        background:-o-linear-gradient(top, #7892c2 5%, #476e9e 100%);background:-ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
                        background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
                        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
                        background-color:#7892c2;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border:1px solid #4e6096;display:inline-block;
                         cursor:pointer;color:#ffffff;font-family:Arial;font-size:15px;font-weight:bold;padding:6px 146px;text-decoration:none;text-shadow:0px 1px 0px #283966;\">
                            Conducir
                        </div></a>
                        <img style=\"height: 250px; width: 600px; margin-top: 10px\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRdUq5QHHd6IMV-aqD6yg4GRS8k7Lyi-hp5Gp3_SShjnznpDsf\" alt=\"\" class=\"img-rounded img-responsive\" />
                        <blockquote style=\"margin-top: 20px\">
                            <p>".$row['marca']." ".$row['modelo']."</p>
                            <cite>Tipo</cite>
                            <small><cite>".$row['tipo']."</cite></small>
                            <cite>Matricula</cite>
                            <small><cite>".$row['matricula']."</cite></small>
                            <cite>Equipaje</cite>
                            <small><cite>".$row['equipaje']."</cite></small>
                            <cite>Año</cite>
                            <small><cite>".$row['anyo']."</cite></small>
                        </blockquote>
                    </div>";  //$row['index'] the index here is a field name



                }

                echo "</div></div>";

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
