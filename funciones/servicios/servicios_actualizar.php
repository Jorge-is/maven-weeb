<?php

if (isset($_POST['id_servicio']) && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_servicio = intval($_POST['id_servicio']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
        $detalle = formato_capital(limpiar_espacios(strip_tags($_POST['detalle'])));
        $precio = strip_tags(trim($_POST['precio']));

        try {
            $conn = conectar();
            $sql = "UPDATE servicios 
                    SET nombre = '$nombre', detalle = '$detalle', precio = '$precio' 
                    WHERE id_servicio = $id_servicio";
            if (ejecutar($sql)) {
                echo "Servicio actualizado exitosamente.";
            } else {
                echo "Error al actualizar el servicio: " . mysqli_error($conn);
            }
            desconectar($conn);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>