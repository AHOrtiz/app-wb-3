<?php
	/*
	http://localhost/phpmyadmin/ --> Bases de datos --> Crear base de datos
	Nombre de la base de datos: escuela
	Cotejamiento: utf8_general_ci
	--> Crear
	--> SQL
	CREATE TABLE alumno(
		id varchar(12),
		nombre varchar(50),
		genero varchar(10),
		PRIMARY KEY(id)
	) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

	select count(*) from alumno
	select count(*) from alumno where genero='Hombre';
	select count(*) from alumno where genero='Mujer';
	*/
	$c = mysqli_connect("localhost", "root", "");
	mysqli_select_db($c, "escuela");
	if( isset($_POST['btncontar']) && $_POST['btncontar'] ){
		$consulta = "select count(*) from alumno where genero='Hombre'";
        $tabla = mysqli_query($c, $consulta);
        if($tabla){
            $fila = mysqli_fetch_array($tabla);
            $hombres = $fila[0];
        }
        $consulta = "select count(*) from alumno where genero='Mujer'";
        $tabla = mysqli_query($c, $consulta);
        if($tabla){
            $fila = mysqli_fetch_array($tabla);
            $mujeres = $fila[0];
        }
        echo "<br />No. de hombres = " . $hombres . "<br />";
        echo "No. de mujeres = " . $mujeres . "<br />";
        $total = $hombres + $mujeres;
        $src = "http://chart.apis.google.com/chart?chs=400x100&cht=p3&chd=t:" 
					  . $hombres . "," . $mujeres . "&chl=Hombres|Mujeres";
        echo '<img src=' . $src . ' width="400" height="100">';
	}
	if( isset($_POST['btninsertar']) && $_POST['btninsertar'] ){
		// insert into alumno(id, nombre, genero) values('UTP0008600','FMC','Mujer');
		$consulta = "insert into alumno(id, nombre, genero) values('" . 
					$_POST['txtid'] . "','" . $_POST['txtnombre'] . "','" . $_POST['txtgenero'] . "')";
		echo $consulta;
		mysqli_query($c, $consulta);
	}
	if( isset($_POST['btneliminar']) && $_POST['btneliminar'] ){
		// delete from alumno where id='UTP0008600';
		$consulta = "delete from alumno where id='" . $_POST['txtid'] . "'";
		echo $consulta;
		mysqli_query($c, $consulta);
	}
	if( isset($_POST['btnver']) && $_POST['btnver'] ){
		// select * from alumno;
		$consulta = "select * from alumno";
		echo $consulta;
		$tabla = mysqli_query($c, $consulta);
		$thtml = "<table border='1'><tr>";
		if($tabla){
			//obtener el numero de campos de la tabla;
			$columnas = mysqli_num_fields($tabla); 
			for ($i=0;$i<$columnas;$i++){ 
			//ciclo para mostrar el renglón de encabezado con el nombre de los campos
				$thtml .= "<th>" . mysqli_fetch_field($tabla)->name . "</th>";
			}
			$thtml .= "</tr>";
			while ( $fila = mysqli_fetch_array($tabla) ){
				$thtml .= "<tr>";
				for($i=0; $i<$columnas; $i++){
					$thtml .= "<td>" . $fila[$i] . "</td>";
				}
				$thtml .= "</tr>";		
			}
		}
		$thtml .= "</table><br />";
		echo $thtml;
	}
	mysqli_close($c);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Alumno</title>
	</head>
	<body>	
		<form action="index.php?opc=2" method="post">
			<table border="1">
				<tr>
					<td>Id:</td>
					<td><input type="text" name="txtid"></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="txtnombre" ></td>
				</tr>
				<tr>
					<td>G&eacute;nero:</td>
					<td><input type="text" name="txtgenero"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="btnver" value="Ver" />	
						<input type="submit" name="btninsertar" value="Insertar" />	
						<input type="submit" name="btneliminar" value="Eliminar" />
						<input type="submit" name="btncontar" value="Contar" />
					</td>
				</tr>	
			</table>
		</form>
	</body>
</html>