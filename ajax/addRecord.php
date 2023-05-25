<?php

$msj='';

	if(isset($_POST))
	{
		// include Database connection file 
		include("db_connection.php");


		// get values 
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

		$sql=mysqli_query($con,"select * from manifiestos where consecutivo='$consecutivo'");//Consulta a la tabla manifiestos
		$num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
		

		if ($num==0)//Si es == 0 inserto
		{
			if($consecutivo!='consecutivo'){
			
				

				if ($insert=mysqli_query($con,"insert into manifiestos (id, consecutivo, ruta, fecha, cliente, placa, cisterna, conductor, cedula, cantidad, valor) values('','$consecutivo','$ruta', '$fecha', '$cliente','$placa','$cisterna','$conductor','$cedula','$cantidad','$valor')"))
				{
				$msj='<font color=green>Manifiesto <b>'.$consecutivo.'</b>Guardado</font><br/>';
				}//fin del if que comprueba que se guarden los datos
				
				else//sino ingresa el manifiesto
				{
				$msj='<font color=red>Manisfiesto <b>'.$id.' </b> NO Guardado '.mysqli_error($con).'</font><br/>';
				}
			}
		}
		//fin de if que comprueba que no haya en registro duplicado
		else
		{
		echo '<font color=red>El Manifiesto de código <b>'.$consecutivo.'</b> Está duplicado<br></font>';
		}
	echo $msj;

	}
	
?>