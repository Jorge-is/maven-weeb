<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    $id_cliente = (int)$_POST['id_cliente'];
    $id_servicio = (int)$_POST['id_servicio'];
    $precio = (float)$_POST['precio'];
    $nombre_servicio =  formato_capital(limpiar_espacios(strip_tags($_POST['nombre_servicio'])));
    $detalle_servicio =  formato_capital(limpiar_espacios(strip_tags($_POST['detalle_servicio'])));
    $fecha = htmlentities(trim($_POST['fecha']));
    $hora = htmlentities(trim($_POST['hora']));

    try {
        conectar();
        $sql = "INSERT INTO cotizaciones (id_cliente, id_servicio, precio, nombre_servicio, detalle_servicio, fecha, hora) 
                VALUES ($id_cliente, $id_servicio, $precio, '$nombre_servicio', '$detalle_servicio', '$fecha', '$hora')";
        if (ejecutar($sql)) {
            echo "Cotización creada exitosamente.";
        } else {
            echo "Error al crear la cotización: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>