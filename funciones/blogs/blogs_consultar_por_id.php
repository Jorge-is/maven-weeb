<?php
$id_blog   = "";
$titulo    = "";
$imagen    = "";
$contenido = "";
$fecha     = "";
$hora      = "";
$id_editor = "";

if (isset($_GET['id_blog']) && $_GET['funcion'] == 'actualizar') {
    $id_blog = (int)$_GET['id_blog'];

    try {
        conectar();
        $sql            = "SELECT * FROM blogs WHERE id_blog = ?";
        $datos_blogs_id = consultar_prep($sql, "i", $id_blog);
        desconectar();

        if (count($datos_blogs_id) > 0) {
            $dato_blog = $datos_blogs_id[0];
            $titulo    = $dato_blog["titulo"];
            $imagen    = $dato_blog["imagen"];
            $contenido = $dato_blog["contenido"];
            $fecha     = $dato_blog["fecha"];
            $hora      = $dato_blog["hora"];
            $id_editor = $dato_blog["id_editor"];
        } else {
            echo "Blog no encontrado.";
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
