<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Informes</title>

<link rel="icon" href="assets/images/logo/image-logo">

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

<header> 
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white " style="background-color:#e3f2fd">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="btn btn-info" href="index.php" role="button">Página de incio</a> </li>
        <li class="nav-item active"> <a class="btn btn-success" href="tabla.php" role="button">Registros</a> </li>
      </ul>
    </div>
  </nav>
</header>

<?php
include("ajax/db_connection.php");
?>

<!--Tabla-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ruta');
        data.addColumn('string', '#');
        data.addRows([

      <?php
      //Consulta para contar la cantidad de rutas
      $year = date("Y");
      $query = ("SELECT ruta, COUNT(ruta) AS num FROM manifiestos where year(fecha) = '".$year."'
      GROUP BY ruta order by num desc");

        if (!$result = mysqli_query($con, $query)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
      while($row = mysqli_fetch_assoc($result)){
           echo "['".$row['ruta']."','".$row['num']."'],";
          }
        } 
      ?>
        ]);
        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
  </script>

<!--DIAGRAMA CIRCULAR-->
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([

    <?php
    $Year = date("Y");
      //Consulta para contar los viajes por cliente
      $query2 = ("SELECT cliente, COUNT(cliente) AS num 
      FROM manifiestos where year(fecha) = '".$year."' GROUP BY cliente order by num desc");

        if (!$result = mysqli_query($con, $query2)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
      while($row = mysqli_fetch_assoc($result)){
           echo "['".$row['cliente']."',".$row['num']."],";
          }
        } 
      ?>

  ]);

  // Set chart options
  var options = {'title':'% de viajes por cliente',
    is3D : true,
                 'width':900,
                 'height':600};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
</script>

<!--DIAGRAMA DE BARRAS VERTICALES-->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "COP", { role: "style" } ],
        

    <?php
    $Year = date("Y");
      $colorblue= "bluesky";
      //Consulta para sumar lo facturado por mes
      $query3 = ("SELECT extract(month from fecha) as mes, sum(valor) AS num FROM manifiestos
      where year(fecha) = '".$year."' GROUP BY month(fecha) order by month(fecha) asc");

        if (!$result = mysqli_query($con, $query3)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
      while($row = mysqli_fetch_assoc($result)){
           echo "['".$row['mes']."',".$row['num'].",'".$colorblue."'],";
          }
        } 
      ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2]);

      var options = {
        title: "Activos por mes",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
      }
  </script>

  <!--DIAGRAMA DE BARRAS VERTICALES-->

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Ruta", "Kg", { role: "style" } ],
        
    <?php
      $Year = date("Y");
      //Consulta para calcular los kg transportados mes a mes
      $query4 = ("SELECT extract(month from fecha) as mes, sum(cantidad) AS num FROM manifiestos
      where year(fecha) = '".$year."' GROUP BY month(fecha) order by month(fecha) ASC");

        if (!$result = mysqli_query($con, $query4)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
      while($row = mysqli_fetch_assoc($result)){
           echo "['".$row['mes']."',".$row['num'].",'".$colorblue."'],";
          }
        } 
      ?>

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Kg de GLP cargados por mes",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

  <!--Gráfico de barras cabezotes -->
  <script type="text/javascript">

google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Placa', 'Millones Facturados'],
      
    <?php
    $Year = date("Y");
      //Consulta para contar viajes por cabezote
      $query5 = ("SELECT placa, COUNT(placa) AS num, SUM(valor) AS total FROM
      manifiestos where year(fecha) = '".$year."' GROUP BY placa order by num desc;");
      
        if (!$result = mysqli_query($con, $query5)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
        while($row = mysqli_fetch_assoc($result)){
         
          $plac = $row['placa'];
          $cant = $row['num'];
          $txtnum = ($plac." # viajes: ".$cant);

          echo "['".$txtnum."',".$row['total']."],";
          }
        }        
      ?>
        
      ]);
      var options = {
        title: 'Facturación por vehículo',
        width: 900,
        legend: { position: 'none' },
        chart: { title: 'Facturación por vehículo',
                subtitle: 'Millones de pesos' },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: { side: 'top', label: 'Millones COP'} // Top x-axis.
          }
        },
        bar: { groupWidth: "90%" }
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_cabezotes'));
      chart.draw(data, options);
    }
  </script>


    <!--Gráfica de barras conductores-->
    <script type="text/javascript">

google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Nombre', 'Millones Facturados'],
      
    <?php
    $Year = date("Y");
      //Consulta para contar viajes por cabezote
      $query6 = ("SELECT conductor, COUNT(conductor) AS cond, SUM(valor) AS totalf FROM
       manifiestos where year(fecha) = '".$year."' GROUP BY conductor order by cond desc;");

        if (!$result = mysqli_query($con, $query6)) {
          exit(mysqli_error($con));
          }
          if(mysqli_num_rows($result) > 0 )
          {
        while($row = mysqli_fetch_assoc($result)){
         
          $cond = $row['conductor'];
          $candd = $row['cond'];
          $txtcant = ($cond." # viajes: ".$candd);

          echo "['".$txtcant."',".$row['totalf']."],";
          }
        }        
      ?>
        
      ]);
      var options = {
        title: 'Facturación por conductor',
        width: 900,
        legend: { position: 'none' },
        chart: { title: 'Facturación por conductor',
                subtitle: 'Millones de pesos' },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
          x: {
            0: { side: 'top', label: 'Millones COP'} // Top x-axis.
          }
        },
        bar: { groupWidth: "90%" }
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_conductores'));
      chart.draw(data, options);
    }
  </script>

<div class="container">
  <h3 class="mt-5">Informes</h3>
<hr>
  <div class="row">
    <div class="col-12 col-md-12">
    <!--Div that will hold the pie chart-->
      <div id="barchart_values" style="width: 900px; height: 390px;"></div>
    <hr>
      <div id="columnchart_values" style="width: 900px; height: 390px;"></div>
    <hr>
      <div id="chart_div"></div>
    <hr>
      <div id="barchart_cabezotes" style="width: 2000px; height: 2300px;"></div>
    <hr>
      <div id="barchart_conductores" style="width: 2000px; height: 2300px;"></div>
    <hr>
    <div id="table_div"></div>

          <!-- Fin Contenido --> 
          </div>
  </div>
  <!-- Fin row --> 

</div>
<!--Fin container-->
  </body>
</html>