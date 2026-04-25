<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {
    
    if (!function_exists('limpiar_espacios')) {
        function limpiar_espacios($cadena){
            return trim($cadena);
        }
    }

    if (!function_exists('formato_capital')) {
        function formato_capital($texto){
            return ucwords(strtolower($texto));
        }
    }

    $nombre = isset($_POST['nombre']) ? formato_capital(limpiar_espacios(strip_tags($_POST['nombre']))) : '';
    $detalle = isset($_POST['detalle']) ? formato_capital(limpiar_espacios(strip_tags($_POST['detalle']))) : '';
    $precio = isset($_POST['precio']) ? strip_tags(trim($_POST['precio'])) : '';

        try {
            conectar();
            $nombre = mysqli_real_escape_string($cnx, $nombre);
            $detalle = mysqli_real_escape_string($cnx, $detalle);
            $precio = mysqli_real_escape_string($cnx, $precio);
            $sql = "INSERT INTO servicios (nombre, detalle, precio) VALUES ('$nombre', '$detalle', '$precio')";
            if (ejecutar($sql)) {
                echo "Servicio creado exitosamente.";
            } else {
                echo "Error al crear el servicio: " . mysqli_error($cnx);
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }

}
