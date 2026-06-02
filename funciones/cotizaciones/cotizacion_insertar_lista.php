<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    csrf_verificar();
    if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])) {
        $cotizaciones = $_SESSION['cotizaciones'];

        try {
            conectar();
            $sql  = "INSERT INTO cotizaciones (codigo, id_cliente, id_servicio, precio, nombre_servicio, detalle_servicio, fecha, hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $fecha = date("Y-m-d");
            $hora  = date("H:i:s");

            foreach ($cotizaciones as $cotizacion) {
                $codigo           = (int)$cotizacion['codigo'];
                $id_cliente       = (int)$cotizacion['id_cliente'];
                $id_servicio      = (int)$cotizacion['id_servicio'];
                $precio           = (float)$cotizacion['precio'];
                $nombre_servicio  = $cotizacion['nombre_servicio'];
                $detalle_servicio = $cotizacion['detalle_servicio'];

                ejecutar_prep($sql, "iiidssss", $codigo, $id_cliente, $id_servicio, $precio, $nombre_servicio, $detalle_servicio, $fecha, $hora);
            }

            desconectar();
            unset($_SESSION['cotizaciones']);
            echo "Cotizaciones creadas exitosamente.";
        } catch (Exception $ex) {
            manejar_error($ex);
        }
    } else {
        echo "No hay cotizaciones en la sesión para insertar.";
    }
}
?>
