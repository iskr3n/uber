<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<!-- HEAD SECTION -->

<?php
if(!empty($_POST["register-user"])) {
    /* Form Required Field Validation */
    foreach($_POST as $key=>$value) {
        if(empty($_POST[$key])) {
        $error_message = "All Fields are required";
        break;
        }
    }
    /* Password Matching Validation */
    if($_POST['password'] != $_POST['confirm_password']){
    $error_message = 'Passwords should be same<br>';
    }

    /* Email Validation */
    if(!isset($error_message)) {
        if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid Email Addresswaawawawa";
        }
    }

    /* Validation to check if gender is selected */
    if(!isset($error_message)) {
    if(!isset($_POST["gender"])) {
    $error_message = " All Fields are required";
    }
    }

    /* Validation to check if Terms and Conditions are accepted */
    if(!isset($error_message)) {
        if(!isset($_POST["terms"])) {
        $error_message = "Accept Terms and Conditions to Register";
        }
    }

    if(!isset($error_message)) {
        require_once("dbcontroller.php");
        $db_handle = new DBController();
        $query = "INSERT INTO registered_users (user_name, first_name, last_name, password, email, gender) VALUES
        ('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "', '" . $_POST["gender"] . "')";
        $result = $db_handle->insertQuery($query);
        if(!empty($result)) {
            $error_message = "";
            $success_message = "You have registered successfully!";
            unset($_POST);
        } else {
            $error_message = "Problem in registration. Try Again!";
        }
    }
}
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Bootstrap Mutipager Template - Maxop</title>
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
                    <li><a>REGISTRAR CONDUCTOR</a></li>
                    <li><a style ='color: red' href="logout.php">CERRAR SESÓN</a></li>
                </ul>
            </div>

        </div>
    </div>
    <!--END NAV SECTION -->
    <!-- HOME SECTION -->



    <div class="container">
        <h2 class="well">Registrar conductor</h2>
        <div class="col-lg-12 well">
        <div class="row">
                    <form name="register-user" method="post">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <!-- Modificar fecha per-->
                                    <label>Fecha permiso circulación</label>
                                    <input name="fecha_per" type="text" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <!-- Aqui va la Disponibilidad del conductor-->
                                    <label>Disponibilidad</label>
                                    <input name="disponibilidad" type="text" class="form-control">
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>IBAN</label>
                                    <input name="iban" type="text" class="form-control">
                                </div>
                            </div>



                        <button type="submit" name="button_registro" class="btn btn-lg btn-info">Registrar</button>
                        </div>

                    </form>
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
