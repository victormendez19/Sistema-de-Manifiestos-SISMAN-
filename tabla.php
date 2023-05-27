<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Registros</title>

<link rel="icon" href="assets/images/logo/image-logo">

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>

<body>
<header> 
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white " style="background-color:#e3f2fd">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="btn btn-info" href="index.php" role="button">Página de incio</a> </li>
        <li class="nav-item active"> <a class="btn btn-success" href="graficos.php" role="button">Informes</a> </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input id="txtbusca" class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
        <label for="fechadesde">Fecha desde</label>
        <input id="fechadesde" class="form-control mr-sm-2" type="date" aria-label="Search">
      </form>
    </div>
  </nav>
</header>
<!-- Begin page content -->

<div class="container">
  <h3 class="mt-5">Manifiestos</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
      
<!-- Content Section --> 
<!-- crud jquery-->
<div class="da">
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Registro</button>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div id="records_content"></div>
    </div>
  </div>
</div>
<!-- /Content Section --> 

<!-- Bootstrap Modals --> 
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <form>  
    <div class="modal-content">
    
        <div class="modal-header">
          <h5 class="modal-title">Agregar Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label for="cons_r">Consecutivo</label>
            <input required type="text" id="cons_r" value="" placeholder="N° consecutivo"   class="form-control"/>
          </div>
          <div class="form-group">
            <label for="ruta_r">Ruta</label>
            <textarea required type="text" id="ruta_r" value="" placeholder="Municipio de cargue y descargue"   class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="fecha_r">Fecha</label>
            <input required type="date" id="fecha_r" value=""  class="form-control"/>
          </div>
          <div class="form-group">
            <label for="cli_r">Cliente</label>
            <input required type="text" id="cli_r" value="" placeholder="Empresa propietaria de la carga" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="placa_r">Placa</label>
            <input required type="text" id="placa_r" placeholder="Placa de la unidad tractora" class="form-control" value=""/>
          </div>
          <div class="form-group">
            <label for="cis_r">Remolques</label>
            <input required type="text" id="cis_r" placeholder="Placa del remolque" class="form-control" value=""/>
          </div>
          <div class="form-group">
            <label for="cond_r">Conductor</label>
            <input required type="text" id="cond_r" placeholder="Nombre del conductor" class="form-control" value=""/>
          </div>
          <div class="form-group">
            <label for="ced_r">Cedula</label>
            <input required type="text" id="ced_r" placeholder="N° de cédula del conductor" class="form-control" value=""/>
          </div>
          <div class="form-group">
            <label for="cant_r">Cantidad</label>
            <input required type="text" id="cant_r" placeholder="Peso del producto en Kilogramos" class="form-control" value=""/>
          </div>
          <div class="form-group">
            <label for="valor_r">Valor</label>
            <input required type="text" id="valor_r" placeholder="Valor del viaje" class="form-control" value=""/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- // Modal --> 

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-header">
        <h5 class="modal-title">Actualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      
      
      <div class="modal-body">
      <div class="form-group">
          <label for="idu">Id</label>
          <input readonly type="number" id="idu"   class="form-control"/>
        </div>
        <div class="form-group">
          <label for="consu">Consecutivo</label>
          <input  readonly type="number" id="consu"    class="form-control"/>
        </div>
        <div class="form-group">
          <label for="rutau">Ruta</label>
          <textarea required type="text" id="rutau"  class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="fechau">Fecha</label>
          <input required type="date" id="fechau"   class="form-control"/>
        </div>
        <div class="form-group">
          <label for="cliu">Cliente</label>
          <input required type="text" id="cliu"   class="form-control"/>
        </div>
        <div class="form-group">
          <label for="placau">Placa</label>
          <input required type="text" id="placau" class="form-control" />
        </div>
        <div class="form-group">
          <label for="cisu">Remolques</label>
          <input required type="text" id="cisu" class="form-control" />
        </div>
        <div class="form-group">
          <label for="condu">Conductor</label>
          <input required type="text" id="condu" class="form-control" />
        </div>
        <div class="form-group">
          <label for="cedu">Cedula</label>
          <input required type="number" id="cedu" class="form-control" />
        </div>
        <div class="form-group">
          <label for="cantu">Cantidad</label>
          <input required type="number" id="cantu" class="form-control" />
        </div>
        <div class="form-group">
          <label for="valoru">Valor</label>
          <input required type="number" id="valoru" class="form-control" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="upd" class="btn btn-primary" onclick="UpdateUserDetails()" >Guardar Cambios</button>
        <input type="hidden" id="hidden_user_id">
      </div>
    </div>
  </div> 
</div>
<!-- // Modal --> 
<!-- Jquery JS file --> 
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> 
<!-- Bootstrap JS file --> 
<!-- Custom JS file --> 
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript" src="js/script2.js"></script> 
<!-- Fin crud jquery-->



      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
  
</div>
<!-- Fin container -->

<!-- Bootstrap core JavaScript
    ================================================== --> 
<script src="dist/js/bootstrap.min.js"></script> 

<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>