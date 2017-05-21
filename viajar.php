<?php
   session_start();
   if ($_SESSION["username"]=='') {
    header('Location: viajar.html');
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

    <script src="http://maps.google.com/maps?file=api&amp;v=2&oe=ISO-8859-1;&amp;key=AIzaSyCRy7L6o0UU06-sluTlgHSG40gn2OSKSk0&oe=ISO-8859-1"
type="text/javascript"></script>






    <script type="text/javascript">

var map;
var gdir;
var geocoder = null;
var addressMarker;

function initialize() {
if (GBrowserIsCompatible()) { 
map = new GMap2(document.getElementById("mapa_ruta"));
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl());
gdir = new GDirections(map, document.getElementById("direcciones"));
GEvent.addListener(gdir, "load", onGDirectionsLoad);
GEvent.addListener(gdir, "error", handleErrors);

setDirections("Alicante", "Calpe"); 

}
} 

function setDirections(fromAddress, toAddress) {
gdir.load("from: " + fromAddress + " to: " + toAddress);
}

function handleErrors(){
if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
alert("Dirección no disponible.\nError code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code); 
else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code); 
else if (gdir.getStatus().code == G_GEO_BAD_KEY)
alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code); 
else alert("An unknown error occurred."); 
}

function onGDirectionsLoad(){ 
}

</script>


</head>
<!--END HEAD SECTION -->
<body onload="initialize()" onunload="GUnload()">
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
                  <li><a>VIAJAR</a></li>
                  <li><a href="modificar_via.php">DATOS PERSONALES</a></li>
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
            $sql = "SELECT * from PERSONA where email like '$ses'";
            $sql2 = "
            SELECT count(destino_direccion) as num_viajes_dir, count(destino_localidad) as num_viajes_loc,destino_direccion, destino_localidad, provincia, 
            FROM LUGARES, VIAJE 
            WHERE direccion = destino_direccion and destino_localidad=localidad
            GROUP BY destino_direccion, destino_localidad   
            ORDER BY destino_direccion DESC 
            LIMIT 10";


            $retval = mysql_query( $sql, $con );
            $retval2 = mysql_query( $sql2, $con );

               if(! $retval ) {
                  die('Could not get data: ' . mysql_error());
               }

             $row = mysql_fetch_assoc($retval);
;
             $localidad_usada = mysql_fetch_assoc($retval2);             




              ?>




<div class="container" style="margin-top: 120px">
    <div class="row">


        <div class="col-sm-2 col-md-2">

               <div style="width: 450px;" class="panel panel-primary text-center no-boder">
                           <div style="height: 80px; padding-top: 30px;" class="textodonde" class="panel-footer panel-red back-footer-green">
                                Destinos más Visitados

                            </div> 
                            <div style="width: 450px" class="panel-body" >
                                <h3><?php echo $localidad_usada['destino_localidad']?></h3>
                            </div>

                </div>

        </div>

        <div style="padding-left: 350px" class="col-sm-2 col-md-2">
             <div style="padding-left: 100px;" class="bolamundo">
                  <p class="textodonde">¿DONDE QUIERES IR?
                  <img src="http://www.skyonline.es/wp-content/uploads/2014/10/bola-mundo.png" class="bola" width="15%" alt="Responsive image"></p>
                
                </div>
                <br>
                <form action="#" onsubmit="setDirections(this.from.value, this.to.value); return false" name="form">

                Origen: <input type="text" size="25" id="fromAddress" name="from"/><br><br>

                Destino: <input name="to" type="text" id="toAddress" size="25"/><br>


              
                </select>
                <br>
                <input type="submit" name="Submit" value="Buscar Viajes" style="font-color: #333;
                background-color: #d5d5d5; width: 150px; height: 30px; letter-spacing: .05em; font-weight: bold;                "/>
                <br>
                <br>
                <div id="mapa_ruta" style="width: 650px; height: 300px; border: 4px solid #333;"></div>
                <div id="direcciones" style="width: 650px"></div> 



                </form> 

        </div>
    </div>
</div>









    <div class="container" style="margin-top: 120px">
        <div class="row">

            <!--<div class="col-sm-3 col-md-3">-->

          </div>
            <!--<div class="col-sm-12 col-md-12">-->

                <!--<h2 style="">
                    ¿Dónde quieres ir?
                </h2> -->

               
                
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
