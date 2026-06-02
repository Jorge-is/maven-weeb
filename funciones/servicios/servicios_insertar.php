<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {
    csrf_verificar();

    if (!function_exists('limpiar_espacios')) {
        function limpiar_espacios($cadena) {
            return trim($cadena);
        }
    }

    if (!function_exists('formato_capital')) {
        function formato_capital($texto) {
            return ucwords(strtolower($texto));
        }
    }

    $nombre  = isset($_POST['nombre'])  ? formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])))  : '';
    $detalle = isset($_POST['detalle']) ? formato_capital(limpiar_espacios(strip_tags($_POST['detalle']))) : '';
    $precio  = isset($_POST['precio'])  ? (float)$_POST['precio'] : 0.0;

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
        $sql = "INSERT INTO servicios (nombre, detalle, precio) VALUES (?, ?, ?)";
        if (ejecutar_prep($sql, "ssd", $nombre, $detalle, $precio)) {
            echo "Servicio creado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
