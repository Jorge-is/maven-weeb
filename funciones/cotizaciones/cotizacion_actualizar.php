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
        $codigo      = (int)$_POST['codigo'];
        $id_cliente  = (int)$_POST['id_cliente'];
        $id_servicio = (int)$_POST['id_servicio'];
        $precio      = (float)$_POST['precio'];
        $fecha       = htmlentities(trim($_POST['fecha']));
        $hora        = htmlentities(trim($_POST['hora']));

        try {
            conectar();
            $sql = "UPDATE cotizaciones SET codigo = ?, id_cliente = ?, id_servicio = ?, precio = ?, fecha = ?, hora = ? WHERE id_cotizacion = ?";
            if (ejecutar_prep($sql, "iiidssi", $codigo, $id_cliente, $id_servicio, $precio, $fecha, $hora, $id_cotizacion)) {
                echo "Cotización actualizada exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    } else {
        try {
            conectar();
            $cotizaciones = consultar_prep("SELECT * FROM cotizaciones WHERE id_cotizacion = ?", "i", $id_cotizacion);
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
