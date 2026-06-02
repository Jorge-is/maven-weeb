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

        $errores = validar([
            'nombre'  => ['valor' => $nombre,  'requerido' => true, 'min_len' => 2, 'max_len' => 100],
            'detalle' => ['valor' => $detalle, 'requerido' => true, 'min_len' => 5, 'max_len' => 500],
            'precio'  => ['valor' => $precio,  'requerido' => true, 'positivo' => true],
        ]);
        if ($errores) {
            echo implode(' ', $errores);
            return;
        }

        try {
            conectar();
            $sql = "UPDATE servicios SET nombre = ?, detalle = ?, precio = ? WHERE id_servicio = ?";
            if (ejecutar_prep($sql, "ssdi", $nombre, $detalle, $precio, $id_servicio)) {
                echo "Servicio actualizado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            manejar_error($ex);
        }
    }
}
?>
