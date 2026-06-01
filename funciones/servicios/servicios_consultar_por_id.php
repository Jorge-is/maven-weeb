<?php
$nombre  = "";
$detalle = "";
$precio  = "";

if (isset($_GET['id_servicio']) && $_GET['funcion'] == 'actualizar') {
    $id_servicio = (int)$_GET['id_servicio'];

    try {
        conectar();
        $sql              = "SELECT id_servicio, nombre, detalle, imagen, precio, id_administrador FROM servicios WHERE id_servicio = ?";
        $datos_servicios  = consultar_prep($sql, "i", $id_servicio);
        desconectar();

        if (count($datos_servicios) > 0) {
            $datos_servicio   = $datos_servicios[0];
            $nombre           = $datos_servicio["nombre"];
            $detalle          = $datos_servicio["detalle"];
            $imagen           = $datos_servicio["imagen"];
            $precio           = $datos_servicio["precio"];
            $id_administrador = $datos_servicio["id_administrador"];
        } else {
            echo "Servicio no encontrado.";
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
