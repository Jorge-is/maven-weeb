<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {
    csrf_verificar();

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $nombre    = formato_capital(limpiar_espacios(strip_tags(trim($_POST['nombre']))));
    $detalle   = formato_capital(limpiar_espacios(strip_tags(trim($_POST['detalle']))));
    $imagen    = limpiar_espacios(strip_tags($_POST['imagen']));
    $rubro     = formato_capital(limpiar_espacios(strip_tags(trim($_POST['rubro']))));
    $fecha     = strip_tags(trim($_POST['fecha']));
    $id_editor = (int)$_POST['id_editor'];

    $errores = validar([
        'nombre'  => ['valor' => $nombre,  'requerido' => true, 'min_len' => 2, 'max_len' => 100],
        'detalle' => ['valor' => $detalle, 'requerido' => true, 'min_len' => 5, 'max_len' => 500],
        'rubro'   => ['valor' => $rubro,   'requerido' => true, 'max_len' => 100],
        'fecha'   => ['valor' => $fecha,   'requerido' => true],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

    try {
        conectar();
        $sql = "INSERT INTO proyectos (nombre, detalle, imagen, rubro, fecha, id_editor) VALUES (?, ?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssssi", $nombre, $detalle, $imagen, $rubro, $fecha, $id_editor)) {
            echo "Proyecto creado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
