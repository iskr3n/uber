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
  <title>Uber</title>
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
<br>


<body>

<div class="table table-hover table-responsive">
  <h2>Información por índices</h2>
  
 <table class="table table-hover">
    <thead>
      <tr>
        <th class="col-sm-1">Nombre</th>
          <th class="col-sm-1">Tipo</th>
        <th class="col-sm-1">Tabla </th>
        <th class="col-sm-1">Columna</th>
        <th class="col-sm-1">Orden</th>
         <th class="col-sm-1">Cardinalidad</th>
          <th class="col-sm-1">unique?</th>
           <th class="col-sm-1">nullable?</th>
         

      </tr>
    </thead>
    <tbody>
     <?php 
      $conexion= ConectarBD();
      $sql = "select index_name,index_type,table_name,column_name,seq_in_index,cardinality,non_unique,nullable
                            from INFORMATION_SCHEMA.STATISTICS
                            where table_schema='gi_uber'
                            group by table_name,index_name,column_name,sub_part,seq_in_index,cardinality,non_unique,nullable,index_type;";
      $result = mysqli_query($conexion, $sql);
      $row= mysqli_fetch_array($result);
       while($row= mysqli_fetch_array($result)){
    ?>
     <tr>
        <td><pre><?php echo $row['index_name'];?></td></pre>
        <td><pre><?php echo $row['index_type'];?></td></pre>
        <td><pre><?php echo $row['table_name'];?></td></pre>
        <td><pre><?php echo $row['column_name'];?></td></pre>
        <td><pre><?php echo $row['seq_in_index'];?></td></pre>
        <td><pre><?php echo $row['cardinality'];?></td></pre>
        <td><pre><?php echo $row['non_unique'];?></td></pre>
        <td><pre><?php echo $row['nullable'];?></td></pre>
      </tr>
      <?php 
          }
          mysqli_close($conexion);
      ?>
  </table>
  </div>
        

</body>
</html>