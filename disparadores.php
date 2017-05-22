<?php
   session_start();
   if ($_SESSION["username"]=='admin') {
    
   }else{
    header('Location: error.html');
   }

?>

<?php 
include "conectarBD.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap GI_UBER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
                    <li><a href="index.html">CERRAR SESIÓN</a></li>
                </ul>
            </div>

        </div>
    </div>
</head>

<br>
<br>

<body>

<div class="table table-responsive">
  <h2>Información por disparadores</h2>
  <p></p>
   <table class="table table-hover ">
    <thead>
      <tr>
        <th class="col-sm-1">Nombre disparador</th>
        <th class="col-sm-1">Nombre tabla asociada</th>
        <th class="col-sm-1">Tipo manipulación</th>
        <th class="col-sm-1">Evento antes o después</th>
      </tr>
    </thead>
       <tbody>
     <?php 
      $conexion= ConectarBD();
      $sql = "select trigger_name,EVENT_OBJECT_TABLE,event_manipulation,action_timing
                            from INFORMATION_SCHEMA.TRIGGERS
                            where EVENT_OBJECT_SCHEMA='gi_uber'";
      $result = mysqli_query($conexion, $sql);
      $row= mysqli_fetch_array($result);
       while($row= mysqli_fetch_array($result)){
    ?>
     <tr>
        <td><pre><?php echo $row['trigger_name'];?></td></pre>
        <td><pre><?php echo $row['EVENT_OBJECT_TABLE'];?></td></pre>
        <td><pre><?php echo $row['event_manipulation'];?></td></pre>
       <td><pre><?php echo $row['action_timing'];?></td></pre>
      </tr>
      <?php 
           }
          mysqli_close($conexion);
      ?>
  </table>
  </div>
        

</body>
</html>