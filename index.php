<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENTE</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="form.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</head>

<div class="logocamion">
    <img src="https://cdn-icons-png.flaticon.com/512/1297/1297479.png ">
</div>

<body>
<section class="divsection">
<?php

include 'header.php';

	# conectare la base de datos
    include("ajax/db_connection.php");
   
    if(!$con){ 
        die("imposible conectarse: ".mysqli_error($cone));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

    if (isset($_POST['enviar'])){
      
      $filename=$_FILES["file"]["name"];
      $info = new SplFileInfo($filename);
      $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
    
       if($extension == 'csv'){

      $filename = $_FILES['file']['tmp_name'];
      $manifiestos = fopen($filename, "r");
      while (($datos =fgetcsv($manifiestos,1000,";")) !== FALSE )//Leo linea por linea del archivo hasta un maximo de 1000 caracteres por linea leida usando coma(,) como delimitador
        {
        $linea[]=array('N°'=>$datos[0],'COD'=>$datos[1],'RUTA'=>$datos[2],'FECHA'=>$datos[3],'CLIENTE'=>$datos[4],'PLACA'=>$datos[5],'CISTERNA'=>$datos[6],'CONDUCTOR'=>$datos[7],'CEDULA'=>$datos[8],'CANTIDAD'=>$datos[9],'VALOR'=>$datos[10]);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo

        }
        fclose ($manifiestos);//Cierra el archivo

            $ingresado=0;//Variable que almacenara los insert exitosos
            $error=0;//Variable que almacenara los errores en almacenamiento
            $duplicado=0;//Variable que almacenara los registros duplicados
            foreach($linea as $indice=>$value) //Iteracion el array para extraer cada uno de los valores almacenados en cada items
            {
                $id=$value["N°"];//Codigo del manifiesto
                $consecutivo=$value["COD"];//Numero del consecutivo
                $ruta=$value["RUTA"];//Ruta origen y destino
                $fecha=$value["FECHA"];//Fecha en la que se realizó el cargue del producto
                $cliente=$value["CLIENTE"];//Cliente al que se le realiza el viaje
                $placa=$value["PLACA"];//Numero de placa del cabezote
                $cisterna=$value["CISTERNA"];//Numero de placa de la Cisterna
                $conductor=$value["CONDUCTOR"];//Nombre del conductor que realizó el viaje
                $cedula=$value["CEDULA"];//Numero de cdula del conductor que realizó el viaje
                $cantidad=$value["CANTIDAD"];//Cantidad de Kilogramos de GLP transportados
                $valor=$value["VALOR"];//Valor del viaje
            
            $sql=mysqli_query($con,"select * from manifiestos where consecutivo='$consecutivo'");//Consulta a la tabla manifiestos
            $num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
            
            
            if ($num==0)//Si es == 0 inserto
            {
                if($consecutivo!='COD'){
                    if ($insert=mysqli_query($con,"insert into manifiestos (id, consecutivo, ruta, fecha, cliente, placa, cisterna, conductor, cedula, cantidad, valor) values('','$consecutivo','$ruta', '$fecha', '$cliente','$placa','$cisterna','$conductor','$cedula','$cantidad','$valor')"))
                    {
            
                    echo $msj='<font color=green>Manifiesto <b>'.$consecutivo.'</b> Guardado</font><br/>';
                    $ingresado+=1;
                    }//fin del if que comprueba que se guarden los datos
                    else//sino ingresa el manifiesto
                    {
                    echo $msj='<font color=red>Manisfiesto <b>'.$id.' </b> NO Guardado '.mysqli_error($con).'</font><br/>';
                    $error+=1;
            }
            }
        }
            //fin de if que comprueba que no haya en registro duplicado
            else
            {
            $duplicado+=1;
            echo $duplicate='<font color=red>El Manifiesto de código <b>'.$consecutivo.'</b> Está duplicado<br></font>';
            }
            }   
        }
        else{
            echo 'ERROR! El archivo que quiere montar no tiene extensión CSV';
        }

        ?>

        <div class="Mensajes">
            <?php

                echo "<font color=green>".number_format($ingresado)." Manifiestos Almacenados con exito<br/>";
                echo "<font color=orange>".number_format($duplicado)." Manifiestos Duplicados<br/>";
                echo "<font color=red>".number_format($error)." Errores de almacenamiento<br/>";
            }
            ?>
        </div>
    </section>


<div class="divform">
   <form enctype="multipart/form-data" method="post" action="">
     
        <h1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35" height="35"><path d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path><path d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path></svg>
        CARGAR MANIFIESTOS</h1>


    <div class="mb-3">
      <span class="fa fa-file-csv"></span>
      <label for="formFile" class="form-label">Manifiestos, tipo de archivo (.CSV)</label>
        <input name='file' class="form-control" type="file" id="formFile">
      </div>

      <input style="background-color: orangered; border-color:orangered" type="submit" class="btn btn-success" name="enviar">
   </form>
</div>

</body>
</html>