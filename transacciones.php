<?php
	// ver file:///E:/ADOdb_22oct2019/1_Descarga/documentation/v5/userguide/transactions.html
	include("adodb5/adodb.inc.php");
	$con = NewADOConnection('mysqli');
	$con->Connect("localhost", "root", "", "banca");
	
	echo "<table>
		<tr>
	
	<td>";
	// Imprimir la tabla cliente
	echo "Tabla cliente <br />";
	$recordset = $con->Execute("SELECT * FROM cliente");
	if ($recordset === false) die("Fallo");
	echo "<table border='1'>";
	for($i=0; $i<$recordset->RecordCount(); $i++){
		echo "<tr>";
		echo "<td>" . $recordset->fields[0] . "</td>" ;
		echo "<td>" . $recordset->fields[1] . "</td>";
		$recordset->MoveNext();
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>
	
	<td>";
	// imprimir tabla cuenta
	echo "Tabla cuenta <br />";
	$recordset = $con->Execute("SELECT * FROM cuenta");
	if ($recordset === false) die("Fallo");
	echo "<table border='1'>";
	for($i=0; $i<$recordset->RecordCount(); $i++){
		echo "<tr>";
		echo "<td>" . $recordset->fields[0] . "</td>";
		echo "<td>" . $recordset->fields[1] . "</td>";
		echo "<td>" . $recordset->fields[2] . "</td>";
		$recordset->MoveNext();
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>
	
	<td>";
	// Imprimir la tabla banco
	echo "Tabla banco <br />";
	$recordset = $con->Execute("SELECT * FROM banco");
	if ($recordset === false) die("Fallo");
	echo "<table border='1'>";
	for($i=0; $i<$recordset->RecordCount(); $i++){
		echo "<tr>";
		echo "<td>" . $recordset->fields[0] . "</td>" ;
		echo "<td>" . $recordset->fields[1] . "</td>";
		$recordset->MoveNext();
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>
	</tr>
	</table>";
	
	
	
	
	if(isset($_POST['btnTransferir'])&& $_POST['btnTransferir']){
		$con->beginTrans();
		$consulta="update cuenta set saldo=saldo-". 
		$_POST['txtMonto']."where idcliente=".
		$_POST['cbx1']."and idbanco".$_POST['cbx3'];
		echo  $consulta . "</br>";

		$ok=$con->execute($consulta);		
		if($ok){
			$ok=$con->execute("update");
			if($ok){
				$con->commitTrans();
			}else{
				$con->rollbackTrans();
			}
		}else{
			$con->rollbackTrans();
		}
	}
	
	
	if( isset($_POST['btnin']) && $_POST['btnin'] ){
		$consulta = "insert into cliente(id, nombre) values (" . $_POST['txtid'] .
		            ", '" . $_POST['txtnombre'] . "')";
		echo $consulta;
		$con->Execute($consulta);
	}
	if( isset($_POST['btne']) && $_POST['btne'] ){
		$consulta = "delete from cliente where id=" . $_POST['txtid'];
		echo $consulta;
		$con->Execute($consulta);
	}
	if( isset($_POST['btnac']) && $_POST['btnac'] ){
		$consulta = "update cliente set nombre='" . $_POST['txtnombre'] .
					"' where id=" . $_POST['txtid'];
		echo $consulta;
		$con->Execute($consulta);
	}
	
	if(isset($_POST['cbx'])){
		echo "Valor de la opción seleccionada: " .
		 $_POST['cbx'];
	}
	
?>
<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="index.php?opc=3">
		<table>
			<tr>
				<td>
				<br/>Cliente 1<br/>
			<select name="cbx1">
				<?php
$consulta = "select id, nombre from cliente order by nombre";
$recordset = $con->Execute($consulta);
$num_filas = $recordset->RecordCount();
for($i=0; $i<$num_filas; $i++){
	if($_POST['cbx1']==$recordset->fields[0]){
		echo '<option value="' . $recordset->fields[0] . 
		'"selected>' . $recordset->fields[1] . '</option>';
	}else{
		echo '<option value="' . $recordset->fields[0] . 
      	 '">' . $recordset->fields[1] . '</option>';
	}
	
	$recordset->MoveNext();
}
				?>
			</select>		
		
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<br/>Cliente 2<br/>
			<select name="cbx2">
				<?php
$consulta = "select id, nombre from cliente order by nombre";
$recordset = $con->Execute($consulta);
$num_filas = $recordset->RecordCount();
for($i=0; $i<$num_filas; $i++){
	if($_POST['cbx2']==$recordset->fields[0]){
		echo '<option value="' . $recordset->fields[0] . 
      	 '"selected>' . $recordset->fields[1] . '</option>';
	}else{
		echo '<option value="' . $recordset->fields[0] . 
		'">' . $recordset->fields[1] . '</option>';

	}

	$recordset->MoveNext();
}
				?>
			</select>
		</tr>
			<tr>
			<td></td>
			<td>
			<input type="submit" name="btncar" value="Cargar">
			</td>
			<td></td>
		</tr>
		<tr>

				<td>
				<br/>Banco Cliente  1<br/>
			<select name="cbx3">
				<?php
	if( isset($_POST['btncar']) && $_POST['btncar']){
		$consulta = "select banco.id,banco.nombre from banco, cliente, cuenta where banco.id=cuenta.idbanco and cliente.id=cuenta.idcliente and cliente.id=" .$_POST['cbx1'];
		$recordset = $con->Execute($consulta);
		$num_filas = $recordset->RecordCount();
			for($i=0; $i<$num_filas; $i++){
				
				echo '<option value="' . $recordset->fields[0] . 
      				 '">' . $recordset->fields[1] . '</option>';
			$recordset->MoveNext();
}
	}
				?>
			</select>		
		
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<br/>Banco Cliente 2<br/>
			<select name="cbx4">
				<?php
	if( isset($_POST['btncar']) && $_POST['btncar']){
		echo "hola";
		$consulta = "select banco.id,banco.nombre from banco, cliente, cuenta where banco.id=cuenta.idbanco and cliente.id=cuenta.idcliente and cliente.id=" .$_POST['cbx2'];
		$recordset = $con->Execute($consulta);
		$num_filas = $recordset->RecordCount();
			for($i=0; $i<$num_filas; $i++){
				echo '<option value="' . $recordset->fields[0] . 
      				 '">' . $recordset->fields[1] . '</option>';
			$recordset->MoveNext();
}
	}
				?>
			</select>
		</tr>
		<tr>
			<td>Proporciona el monto  </td>
			<td> <input type="text" name="txtMonto" size="5" value="<?php if(isset($_POST['txtMonto']))echo $_POST['txtMonto'];?>"></td>
			<td><input type="submit" name="btnTransferir" value="Transferir"> </td>
		</tr>
		</table>
		

<!--
<input type="submit" name="btncar" value="Cargar">
<br />
<input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
<input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
<input type="checkbox" name="vehicle3" value="Boat" checked> I have a boat<br>
-->

		</form>
	</body>
</html>
