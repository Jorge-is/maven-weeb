<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    csrf_verificar();

    $id_cliente       = (int)$_POST['id_cliente'];
    $id_servicio      = (int)$_POST['id_servicio'];
    $precio           = (float)$_POST['precio'];
    $nombre_servicio  = formato_capital(limpiar_espacios(strip_tags($_POST['nombre_servicio'])));
    $detalle_servicio = formato_capital(limpiar_espacios(strip_tags($_POST['detalle_servicio'])));
    $fecha            = htmlentities(trim($_POST['fecha']));
    $hora             = htmlentities(trim($_POST['hora']));

    $errores = validar([
        'id_cliente'       => ['valor' => $id_cliente,       'requerido' => true, 'positivo' => true],
        'id_servicio'      => ['valor' => $id_servicio,      'requerido' => true, 'positivo' => true],
        'precio'           => ['valor' => $precio,           'requerido' => true, 'positivo' => true],
        'nombre_servicio'  => ['valor' => $nombre_servicio,  'requerido' => true, 'max_len' => 100],
        'detalle_servicio' => ['valor' => $detalle_servicio, 'requerido' => true, 'max_len' => 500],
        'fecha'            => ['valor' => $fecha,            'requerido' => true],
        'hora'             => ['valor' => $hora,             'requerido' => true],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

    try {
        conectar();
        $sql = "INSERT INTO cotizaciones (id_cliente, id_servicio, precio, nombre_servicio, detalle_servicio, fecha, hora) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "iidssss", $id_cliente, $id_servicio, $precio, $nombre_servicio, $detalle_servicio, $fecha, $hora)) {
            echo "Cotización creada exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
