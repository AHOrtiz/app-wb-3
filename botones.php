<?php
    // Section 1
include("adodb5/adodb.inc.php");
$con = NewADOConnection('mysqli');
$con->Connect("localhost", "root", "", "banca");

    // Section 2
$recordset = $con->Execute("SELECT * FROM cliente");
if ($recordset === false) die("Fallo");

if(isset($_POST['btnV']) && $_POST['btnV']){
    echo "<table border='2' class='table table-bordered'>";
    for($i=0; $i<$recordset->RecordCount(); $i++){
        echo "<tr>";
        echo "<td>" . $recordset->fields[0] . "</td>"; 
        echo "<td>" . $recordset->fields[1] . "</td>";
        
        $recordset->MoveNext();
        echo "</tr>";
    }
    echo "</table>";
}
//Insertar
if(isset($_POST['btnIn']) && $_POST['btnIn']){
    $consulta="insert into cliente (id,nombre) values(" . $_POST['txtId'] . ", '" . $_POST['txtNom'] . "')";
    echo $consulta;
    $con->Execute($consulta);
}

//Eliminar
if( isset($_POST['btnEl']) && $_POST['btnEl'] ){
    $consulta = "delete from cliente where id='" . $_POST['txtId'] . "'";
    echo $consulta;
    $con->Execute($consulta);
}

//Actualizar
if( isset($_POST['btnAc']) && $_POST['btnAc'] ){
    $consulta = "update cliente set nombre='" . $_POST['txtNom'] . "' where id='" . $_POST['txtId'] . "'";
    echo $consulta;
    $con->Execute($consulta);
}

if(isset($_POST['btnEc']) && $_POST['btnEc']){
    $consulta = "delete from cliente where id='" . $_POST['cbo'];
    echo $consulta;
    $con->Execute($consulta);
}

//Botones Incremento y Decremento
if(isset($_POST['btnI']) && $_POST['btnI']){
    $_POST['posicion'] = 0;
    $recordset->Move($_POST['posicion']);
    echo "<br /><br />" . $recordset->fields[0] . " " . $recordset->fields[1];
}
if(isset($_POST['btnS']) && $_POST['btnS']){
    //Ultimo registro
   if($_POST['posicion'] == $recordset->RecordCount()-1){
       $recordset->Move(0);
       $_POST['posicion'] = 0;
      
   }else{
       $_POST['posicion']++;
       $recordset->Move($_POST['posicion']);
   }
   echo "<br /><br />" . $recordset->fields[0] . " " . $recordset->fields[1];
}

if(isset($_POST['btnA']) && $_POST['btnA']){
    //Ultimo registro
   if($_POST['posicion'] ==  0){
       $recordset->Move($recordset->RecordCount()-1);
       $_POST['posicion'] = $recordset->RecordCount()-1;
      
   }else{
       $_POST['posicion']--;
       $recordset->Move($_POST['posicion']);
   }
   echo "<br /><br />" . $recordset->fields[0] . " " . $recordset->fields[1];
}

$posicioFinal=$recordset->RecordCount()-1;
if(isset($_POST['btnF']) && $_POST['btnF']){
    $_POST['posicion'] = 0;
    $recordset->Move($posicioFinal);
    echo "<br />" . $recordset->fields[0] . " " . $recordset->fields[1];
}

//Cargar
if(isset($_POST['btnCa']) && $_POST['btnCa']){
    $consulta = "select nombre from cliente where id=" . $_POST['cbx'];
    $lista = $con->Execute($consulta);
    $_POST['txtNom'] = $lista->fields[0];
    $_POST['txtId'] = $_POST['cbx'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="index.php?opc=4" method="post">
    <table border="2">
    <tr>
        <td>
        <label for="id">ID</label>
        </td>
        <td colspan="2">
        <input type="text" name="txtId" value="<?php if(isset($_POST['txtId'])) echo $_POST['txtId'] ?>">
        </td>
    </tr>
    <tr>
        <td>
        <label for="id">Nombre</label>
        </td>
        <td colspan="2">
        <input type="text" name="txtNom" value="<?php if(isset($_POST['txtNom'])) echo $_POST['txtNom'] ?>"></td>
    </tr>
    <tr>
        <td colspan="2">
        <input type="submit" value="|<" name="btnI">
        <input type="submit" value=">>" name="btnS">
        <input type="submit" value="<<" name="btnA">
        <input type="submit" value=">|" name="btnF">
        </td>
    </tr>
    <tr >
        <td colspan="2">
        <input type="submit" value="Ver" name="btnV">
        <input type="submit" value="Insertar" name="btnIn">
        <input type="submit" value="Eliminar" name="btnEl">
        <input type="submit" value="Actualizar" name="btnAc">
        <input type="submit" value="Cargar" name="btnCa">
        <input type="hidden" name="posicion" value="<?php echo $_POST['posicion']?>">
        </td>
    </tr>
    <tr>
        <td colspand="2">
            <select name="cbx">
                <?php
                    $consulta = "select id,nombre from cliente order by nombre";
                    $recordset = $con->Execute($consulta);
                    $numeroFilas = $recordset->RecordCount();
                    for($i=0; $i<$numeroFilas; $i++){
                        echo '<option value="' . $recordset->fields[0] .'">' . $recordset->fields[1] . '</option>';
                        $recordset->MoveNext();
                    }
                ?>
            </select>
        </td>
    </tr>
    </table>
    </form>
</body>
</html>