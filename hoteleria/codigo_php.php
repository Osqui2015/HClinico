<?php
require_once "../../conControl.php";
// cambio de estado en habitacion
if (isset($_POST['habitacionId']) && isset($_POST['habitacionEstado'])) {
    $habitacionId = $_POST['habitacionId'];
    $habitacionEstado = $_POST['habitacionEstado'];
    $nuevoEstado = ($habitacionEstado == 2) ? 3 : 2;
    $valores = array();

    //CONSULTAR


    $resultados = mysqli_query($conControl, "UPDATE habitaciones SET Estado = '$nuevoEstado' WHERE Habitacion = '$habitacionId'");

    if (!$resultados) {
        echo mysqli_error($conControl);
    }

    $valores['existe'] = "1";


    $valores = json_encode($valores);
    echo $valores;
}

if (isset($_POST["action"]) && $_POST["action"] == 'refreshAll') {
    $resultados = mysqli_query($conControl, "select * from habitaciones"); //Podemos limitar solo a las actualizadas en el ultimo minuto para evitar la carga excesiva
    if (!$resultados) {
        echo mysqli_error($conControl);
    } else {
        $result = array();
        while ($row = mysqli_fetch_array($resultados)) {
            array_push($result, $row);
        }
        echo json_encode($result);
    }
}
