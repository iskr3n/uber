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
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/Slides-SlidesJS-3/examples/playing/css/slider.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="index.html">UBER</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="viajar.html">VIAJAR</a></li>
                    <li><a href="conducir.html">CONDUCIR</a></li>
                    <li><a href="conducir.html">MODIFICAR DATOS</a></li>
                    <li><a style ='color: red' href="logout.php">CERRAR SESÓN</a></li>
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
            $sql = "SELECT * from PERSONA where email like '$ses'";

            $retval = mysql_query( $sql, $con );

               if(! $retval ) {
                  die('Could not get data: ' . mysql_error());
               }

             $row = mysql_fetch_assoc($retval);

              ?>




<div class="container" style="margin-top: 120px">
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <div><a href="viajar.html">
            <img src="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/256/Map-Marker-Marker-Outside-Chartreuse-icon.png" alt="" class="img-rounded img-responsive" /></a>
            <h3 style="text-align: center;">VIAJAR</h3>
            </div>
            <div><a href="conducir.html">
            <img src="http://www.jcsdrivingschool.com.au/assets/images/icon-defensive-driving.png" alt="" class="img-rounded img-responsive" /></a>
            <h3 style="text-align: center;">CONDUCIR</h3>
            </div>
        </div>
        <div class="col-sm-1 col-md-1">

        </div>
        <div class="col-sm-3 col-md-3">
            <img style="height: 300px; width: 300px" src="http://st2.depositphotos.com/1006318/8387/v/950/depositphotos_83874174-stock-illustration-profile-icon-male-hispanic-avatar.jpg" alt="" class="img-rounded img-responsive" />
            <blockquote style="margin-top: 20px">
                <p><?php echo $row['nombre']?>, <?php echo $row['apellidos']?></p>
                <cite>Direccion</cite>
                <small><cite title="Direccion"><?php echo $row['direccion']?>,<?php echo $row['localidad']?>, <?php echo $row['provincia']?>  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
                <cite>Telefono</cite>
                <small><cite title="Telefono"><?php echo $row['movil']?>  <i class="glyphicon-envelope"></i></cite></small>
                <cite>Cumpleaños</cite>
                <small><cite title="Telefono"><?php echo $row['f_nacimiento']?> <i class="glyphicon glyphicon-gift"></i> </cite></small>
            </blockquote>
        </div>
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-sm-2 col-md-2">
                <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body">
                                <h3>124</h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Viajes Pasajero

                            </div>
                        </div>
               <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body">
                                <h3>8457</h3>
                            </div>
                            <div class="panel-footer panel-red back-footer-green">
                                Km Pasajero

                            </div>
                        </div>
                <div class="panel panel-primary text-center no-boder" style="height: 50px">
                    Más Datos
                </div>
        </div>

        <div class="col-sm-2 col-md-2">
                <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body">
                                <h3>3</h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Viajes Conductor

                            </div>
                        </div>
                <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body">
                                <h3>20</h3>
                            </div>
                            <div style="background: red" class="panel-footer panel-blue back-footer-green">
                                Km Conductor
                                Conductor 1

                            </div>
                        </div>
                <div  class="panel panel-blue panel-widget ">
                    <div class="row no-padding">
                        <div class="col-lg-0 widget-left">Más Datos</div>

                    </div>
                </div>
        </div>
    </div>
</div>

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
