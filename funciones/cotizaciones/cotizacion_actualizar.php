<?php

function limpiar_espacios($cadena) {
    return trim(preg_replace('/\s+/', ' ', $cadena));
}

function formato_capital($cadena) {
    return ucwords(strtolower($cadena));
}

if (isset($_GET['id_cotizacion'])) {
    $id_cotizacion = (int)$_GET['id_cotizacion'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigo = strtolower(limpiar_espacios(strip_tags($_POST['codigo'])));
        $id_cliente = (int)$_POST['id_cliente'];
        $id_servicio = (int)$_POST['id_servicio'];
        $precio = (float)$_POST['precio'];
        $fecha = htmlentities(trim($_POST['fecha']));
        $hora = htmlentities(trim($_POST['hora']));

        try {
            conectar();
            $sql = "UPDATE cotizaciones 
                    SET codigo = $codigo, id_cliente = $id_cliente, id_servicio = $id_servicio,
                        precio = $precio, fecha = '$fecha', hora = '$hora' 
                    WHERE id_cotizacion = $id_cotizacion";
            if (ejecutar($sql)) {
                echo "Cotización actualizada exitosamente.";
            } else {
                echo "Error al actualizar la cotización: " . mysqli_error($cnx);
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    } else {
        try {
            conectar();
            $sql = "SELECT * FROM cotizaciones WHERE id_cotizacion = $id_cotizacion";
            $cotizaciones = consultar($sql);
            desconectar();

            if (count($cotizaciones) > 0) {
                $cotizacion = $cotizaciones[0];
            } else {
                die("Cotización no encontrada.");
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
} else {
    die("ID de cotización no especificado.");
}
?>