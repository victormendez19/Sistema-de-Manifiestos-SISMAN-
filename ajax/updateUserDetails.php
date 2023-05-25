<?php
// include Database connection file

// check request


    include("db_connection.php");

    // get values
    $id = $_POST['id'];
    $consecutivo=$_POST['consecutivo'];
    $ruta=$_POST['ruta'];
    $fecha = $_POST['fecha'];
    $cliente=$_POST['cliente'];
    $placa=$_POST['placa'];
    $cisterna = $_POST['cisterna'];
    $conductor=$_POST['conductor'];
    $cedula=$_POST['cedula'];
    $cantidad = $_POST['cantidad'];
    $valor=$_POST['valor'];
    


    // Updaste User details
    $query = "UPDATE manifiestos SET consecutivo ='$consecutivo', ruta ='$ruta', fecha = '$fecha',
    cliente ='$cliente', placa ='$placa', cisterna = '$cisterna', conductor ='$conductor', cedula = '$cedula',
    cantidad = '$cantidad', valor = '$valor' WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));  
}
