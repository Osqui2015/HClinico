<?php
session_start();
// echo $_SESSION['tipo'];

require_once "../../conControl.php";

$query = mysqli_query($conControl, "SELECT Habitacion,
Descripcion,
Estado,
Ultimaactualizacion
FROM habitaciones ORDER BY habitacion;");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control</title>
    <?php  include_once "dependencias.php" ?>
    <link rel="icon" href="../../imagen/modelo.jpg">


    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    
    <!-- searchPanes -->
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.0.1/css/searchPanes.dataTables.min.css">
    <!-- select -->
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">


</head>
<body  >
    <br>    <br>    <br>    <br>
            <!–– menu -->
             <?php  include_once "menu.php" ?>
            <!–– fin menu -->
            <div  >
                <!–– Principal -->
                <div class="card">
                    <h5 class="card-header">Habitaciones</h5>
                    <div class="card-body">
                        <!-- table -->
                        <table id="Habitaciones" class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Habitacion</th>
                                    <th>Descripcion</th>                                                                      
                                    <th>Estado</th>
                                    <th>Ultima Actualizacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_array($query)) {?>
                                    <tr>
                                        <td>  <?php echo $row['Habitacion']; ?>
                                        </td>                       
                                        <td> <?php echo $row['Descripcion'];?> </td> 
                                        <td>
                                            <?php switch ($row['Estado']) {
                                                    case 0:
                                                        ?><button type="button" class="btn btn-secondary">LIBRE</button><?php                                                        
                                                        break;
                                                    case 1:
                                                        ?><button type="button" class="btn btn-secondary">OCUPADA</button><?php                                                        
                                                        break;
                                                    case 2:
                                                        ?><button id="<?= $row['Habitacion']?>" type="button" class="btn btn-danger" onclick="cambiarEstado(<?= $row['Habitacion']?>, <?= $row['Estado'] ?>)">INHABILITADA</button><?php
                                                        break;
                                                    case 3:                                                        
                                                        ?><button id="<?= $row['Habitacion']?>" type="button" class="btn btn-success" onclick="cambiarEstado(<?= $row['Habitacion']?>, <?= $row['Estado'] ?>)">HABILITADA</button><?php
                                                        break;
                                                }
                                            
                                            ?> 
                                        </td>
                                        <td> <?php echo $row['Ultimaactualizacion'] ?> </td>
                                    </tr>
                                    <?php
                                    }//Fin while
                                // 
                                    
                                    ?>                                                
                            </tbody> 
                        </table>
                        <!-- -->
                    </div>
                </div>
                
                <!–– Fin Principal -->
            </div>
       
        <!-- <span class="footer">© <?php echo date('Y'); ?> Todos los derechos reservados </span> -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
                
        <!--   Datatables-->
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

        <!-- searchPanes   -->
        <script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>
        <!-- select -->
        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="funciones.js"></script>
        
<script>
    $('#Habitaciones').DataTable( { 
        
        "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    }, 
        pageLength : 100,
    } );
</script>
</body>

</html>
