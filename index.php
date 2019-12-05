<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contendor de productos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container-fluid">      <!--Encabezado-->
       <div class="row">
             <div class="col-sm-12" style="background-color:#ffe7ad"> </div>
             <img src="img/baner.jpg" width="100%">
        </div>
       <div class="row">
            <!--menu-->
            <div class="col-sm-3" style="background-color:#fff1e9;">
                <b>  Men&uacute; </b> 
                  <div class="list-group">
                   <a href="index.php?opc=1" class="list-group-item list-group-item-action">Primer producto</a>
                    <a href="index.php?opc=2" class="list-group-item list-group-item-action">Api Grafica</a>
                    <a href="index.php?opc=3" class="list-group-item list-group-item-action">Transacciones</a>
                    <a href="index.php?opc=4" class="list-group-item list-group-item-action">Botones</a>
                    <a href="index.php?opc=5" class="list-group-item list-group-item-action">Facebook</a>
                    <a href="index.php?opc=6" class="list-group-item list-group-item-action">Fraccion</a>
                </div>
            </div>
        
           <!--Contenido-->
           <div class="col-sm-9" style="background-color:#ffdfdf;">
                <?php
                    switch ($_GET['opc']){
                     case '1':
                     require_once("producto1.php");
                     break;
                        case '2':
                        require_once("alumno.php");
                        break;
                        case '3':
                     require_once("transacciones.php");
                    break;
                    case '4':
                    require_once("botones.php");
                    break;
                    case '5':
                    require_once("facebook.php");
                    break;
                    case '6':
                    require_once("fraccion.php");
                    
                    }
                    
                ?>
           </div>
       </div>

         <div class="row">
             <div class="col-sm-12" style="background-color:#d1eecc;">
                 <center>
                 periodo Septiembre-Diciembre 2019 grupo 4"D" turno vespertino <br>  
                 Allison herrera Ortiz

              </center>

             </div>
         </div>
   </div>
    
</body>
</html>