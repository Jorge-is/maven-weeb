<?php
$nombre    = "";
$detalle   = "";
$imagen    = "";
$rubro     = "";
$fecha     = "";
$id_editor = "";

if (isset($_GET['id_proyecto']) && $_GET['funcion'] == 'actualizar') {
    $id_proyecto = (int)$_GET['id_proyecto'];

    try {
        conectar();
        $sql             = "SELECT id_proyecto, nombre, detalle, imagen, rubro, fecha, id_editor FROM proyectos WHERE id_proyecto = ?";
        $datos_proyectos = consultar_prep($sql, "i", $id_proyecto);
        desconectar();

        if (count($datos_proyectos) > 0) {
            $dato_proyecto = $datos_proyectos[0];
            $nombre        = $dato_proyecto["nombre"];
            $detalle       = $dato_proyecto["detalle"];
            $imagen        = $dato_proyecto["imagen"];
            $rubro         = $dato_proyecto["rubro"];
            $fecha         = $dato_proyecto["fecha"];
            $id_editor     = $dato_proyecto["id_editor"];
        } else {
            echo "Proyecto no encontrado.";
        }
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
