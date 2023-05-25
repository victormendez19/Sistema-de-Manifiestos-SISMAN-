<?php

	// include Database connection file 
	include("db_connection.php");

	$year = date("Y");
	$query = "";
	if(isset($_POST['manifiestos'])){ 
		$dato = $_POST['manifiestos'];
		$query = ("SELECT * FROM manifiestos WHERE consecutivo LIKE '%".$dato."%'");
    }
	else{
		$mes = date("m");
		$query = ("SELECT * FROM manifiestos");
    }

	if(isset($_POST['fechadesde'])){
		$datofecha = $_POST['fechadesde'];
		$query = ("SELECT * FROM manifiestos WHERE fecha BETWEEN '".$datofecha."' AND current_date() ORDER BY fecha");
		}
    
	// Design initial table header 

	$data = '<table class="table table-bordered table-striped" id"tabla_resultado">
						<tr>
							<th>Nº</th>
							<th>cod</th>
							<th>Ruta</th>
							<th>Fecha</th>
							<th>Cliente</th>
							<th>Placa</th>
							<th>Cisterna</th>
							<th>Conductor</th>
							<th>Cedula</th>
							<th>Kg</th>
							<th>Valor</th>
							<th style="width:100px">Editar</th>
							<th style="width:100px">Eliminar</th>
						</tr>';

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
		$i=1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr style="font-size:small">
				<td>'.$i++.'</td>
				<td>'.$row['consecutivo'].'</td>
				<td style="width:300px">'.$row['ruta'].'</td>
				<td style="width:300px">'.$row['fecha'].'</td>
				<td>'.$row['cliente'].'</td>
				<td>'.$row['placa'].'</td>
				<td>'.$row['cisterna'].'</td>
				<td style="width:300px">'.$row['conductor'].'</td>
				<td>'.$row['cedula'].'</td>
				<td>'.$row['cantidad'].'</td>
				<td>'.$row['valor'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning"><i class="fas fa-edit"></i></button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
				</td>
    		</tr>';
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">No hay registros que coincidan con el criterio de busqueda!</td></tr>';
    }

    $data .= '</table>';
	echo $data;

?>
