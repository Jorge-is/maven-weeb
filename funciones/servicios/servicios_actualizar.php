<?php

if (isset($_POST['id_servicio']) && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
    csrf_verificar();

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_servicio = intval($_POST['id_servicio']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre  = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
        $detalle = formato_capital(limpiar_espacios(strip_tags($_POST['detalle'])));
        $precio  = (float)$_POST['precio'];

        try {
            conectar();
            $sql = "UPDATE servicios SET nombre = ?, detalle = ?, precio = ? WHERE id_servicio = ?";
            if (ejecutar_prep($sql, "ssdi", $nombre, $detalle, $precio, $id_servicio)) {
                echo "Servicio actualizado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>
