<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])) {
        $cotizaciones = $_SESSION['cotizaciones'];
        try {
            conectar();
            foreach ($cotizaciones as $cotizacion) {
                $codigo = (int)$cotizacion['codigo'];
                $id_cliente = (int)$cotizacion['id_cliente'];
                $id_servicio = (int)$cotizacion['id_servicio'];
                $precio = (float)$cotizacion['precio'];
                $nombre_servicio = $cotizacion['nombre_servicio'];
                $detalle_servicio = $cotizacion['detalle_servicio'];
                $fecha = date("Y-m-d");
                $hora =  date("H:i:s");

                $sql = "INSERT INTO cotizaciones (codigo, id_cliente, id_servicio, precio, nombre_servicio, detalle_servicio, fecha, hora) 
                        VALUES ($codigo, $id_cliente, $id_servicio, $precio, '$nombre_servicio', '$detalle_servicio', '$fecha', '$hora')";
                if (!ejecutar($sql)) {
                    echo "Error al crear la cotización: " . mysqli_error($cnx);
                }
            }
            desconectar();
            echo "Cotizaciones creadas exitosamente.";
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        unset($_SESSION['cotizaciones']);
    } else {
        echo "No hay cotizaciones en la sesión para insertar.";
    }
}

?>