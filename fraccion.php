<?PHP

include("adodb5/adodb.inc.php");
	$con = NewADOConnection('mysqli');
    $con->Connect("localhost", "root", "", "bdf");
    
    $recordset = $con->Execute("SELECT * FROM fraccion");
if ($recordset === false) die("Fallo");

if(isset($_POST['btnV']) && $_POST['btnV']){
    echo "<table border='1' class='table table-bordered'>";
    for($i=0; $i<$recordset->RecordCount(); $i++){
        echo "<tr>";
        echo "<td>" . $recordset->fields[0] . "</td>"; 
        echo "<td>" . $recordset->fields[1] . "</td>";
        echo "<td>" . $recordset->fields[2] . "</td>";
        
        $recordset->MoveNext();
        echo "</tr>";
    }
    echo "</table>";
}

//Insertar
if(isset($_POST['btnIn']) && $_POST['btnIn']){
    $consulta="insert into fraccion (numerador,denominador,nombre) values(" . $_POST['txtNum'] . ", " . $_POST['txtDenominador'].", '" . $_POST['txtNom']."')";
    echo $consulta;
    $con->Execute($consulta);
}

//Eliminar
if( isset($_POST['btnEl']) && $_POST['btnEl'] ){
    $consulta = "delete from fraccion where nombre='" . $_POST['txtNom'] . "'";
    echo $consulta;
    $con->Execute($consulta);
}
//Actualizar
if( isset($_POST['btnAc']) && $_POST['btnAc'] ){
    $consulta = "update fraccion set nombre='" . $_POST['txtNom'] . "' where numerador='" . $_POST['txtNum']. "' AND denominador='"  .$_POST['txtDenominador']."' ";
    echo $consulta;
    $con->Execute($consulta);
}


//CARGAR
if(isset($_POST['btnCa']) && $_POST['btnCa']){
    $consulta = "select numerador,denominador,nombre from fraccion where nombre='" . $_POST['cbx'] . "'";
    $lista = $con->Execute($consulta);

    $_POST['txtNum'] = $lista->fields[0]; 
    $_POST['txtDenominador'] = $lista->fields[1]; 
    $_POST['txtNom'] = $lista->fields[2]; 
    
    // $_POST['txtNom'] = $_POST['cbx'];
    
   
}
//Botones de incremento y decremento
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

if (isset($_POST['btnExhibir'])&& $_POST['btnExhibir']){
    $consulta="select * from fraccion where nombre='".$_POST['txtNom']."'";
    
    $src = "http://chart.apis.google.com/chart?chs=400x100&cht=p3&chd=t:" 
    . $_POST['txtNum'] . "," . $_POST['txtDenominador'] . "&chl=". $_POST['txtNum'] . "/" . $_POST['txtDenominador'] ;
echo '<img src=' . $src . ' width="400" height="100">';
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
    <form action="index.php?opc=6" method="post">
    <table border="2">
    <tr>
        <td>
        <label for="id">Numerador</label>
        </td>
        <td colspan="2">
        <input type="text" name="txtNum" value="<?php if(isset($_POST['txtNum'])) echo $_POST['txtNum'] ?>">
        </td>
    </tr>
    <tr>
        <td>
        <label for="id">Denominador</label>
        </td>
        <td colspan="2">
        <input type="text" name="txtDenominador" value="<?php if(isset($_POST['txtDenominador'])) echo $_POST['txtDenominador'] ?>"></td>
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
        <input type="submit" value="Exhibir" name="btnExhibir">
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
        <td colspand="1">
            <select name="cbx">
                <?php
                    $consulta = "select nombre from fraccion ";
                    $recordset = $con->Execute($consulta);
                    $numeroFilas = $recordset->RecordCount();
                    for($i=0; $i<$numeroFilas; $i++){
                        echo '<option value="' . $recordset->fields[0] .'">' . $recordset->fields[0] . '</option>';
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

