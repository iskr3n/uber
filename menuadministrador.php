<?php
   session_start();
   if ($_SESSION["username"]=='admin') {
    
   }else{
    header('Location: error.html');
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Uber</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/Slides-SlidesJS-3/examples/playing/css/slider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
                <li><a href="transacciones.php">TRANSACCIONES</a></li>
                <li><a href="documento.xml">EXTRAER XML</a></li>
                <li><a href="index.html">CERRAR SESIÓN</a></li>
                </ul>
            </div>

        </div>
    </div>
</head>


<br>
<br>
<br>
<br>



<body>
<div class="container">
  <table class="table table-hover table-responsive">
   <thead>
      <tr>
      <th><h2>Información del catálogo</h2></th>
     </tr>
  
     </thead>
     <tbody>
<tr> <td> <a href="InformacionBD.php"><pre>&nbsp;&nbsp;Información gi_uber <span class="badge">1</span></a><br></td></tr>
 <tr> <td> <a href="tablasBD.php"><pre>&nbsp;&nbsp;Información por tablas <span class="badge">9</span></a><br></td></tr>
 <tr> <td> <a href="disparadores.php"><pre>&nbsp;&nbsp;Información por disparador <span class="badge">2</span></a><br></td></tr>
 <tr> <td> <a href="rutinas.php"><pre>&nbsp;&nbsp;Información por rutina <span class="badge">3</span></a><br></td></tr>
 <tr> <td> <a href="indices.php"><pre>&nbsp;&nbsp;Visualizar índices<span class="badge">0</span></a><br></td></tr>

  </pre>

</tbody>

</table>
</div>
<div class="container">
  <table class="table table-hover table-responsive">
   <thead>
      <tr>
      <th><h2>Menú</h2></th>
     </tr>
  
     </thead>
     <tbody>
 <tr> <td> <a href="direcciones.php"><pre>&nbsp;&nbsp;Ver direcciones registradas<span class="badge">14</span></a><br></td></tr>
 <tr> <td> <a href="vista_viajero.php"><pre>&nbsp;&nbsp;Ver usuario más viajero<span class="badge">1</span></a><br></td></tr>
 <tr> <td> <a href="vista_conductor.php"><pre>&nbsp;&nbsp;Ver usuario más conductor<span class="badge">1</span></a><br></td></tr>
 <tr> <td> <a href="vista_coches.php"><pre>&nbsp;&nbsp;Usuario con más coches<span class="badge">1</span></a><br></td></tr>
 <tr> <td> <a href="vista_tipo.php"><pre>&nbsp;&nbsp;Tipo de coche más utilizado<span class="badge">1</span></a><br></td></tr>
 <tr> <td> <a href="vista_conductoresclientes.php"><pre>&nbsp;&nbsp;Usuarios conductores y viajeros a la vez <span class="badge">4</span></a><br></td></tr>
 <tr> <td> <a href="vista_viajeros_masdosveces.php"><pre>&nbsp;&nbsp;Clientes que han viajado más de dos veces <span class="badge">3</span></a><br></td></tr>
 <tr> <td> <a href="vista_conductores_masdosveces.php"><pre>&nbsp;&nbsp;Conductores que han realizado más de dos viajes <span class="badge">2</span></a><br></td></tr>
  </pre>

</tbody>

</table>
</div>

</body>
</html>