<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_blog   = intval($_POST['id_blog']);
    $titulo    = formato_capital(limpiar_espacios(strip_tags($_POST['titulo'])));
    $imagen    = limpiar_espacios(strip_tags($_POST['imagen']));
    $contenido = formato_capital(limpiar_espacios(strip_tags($_POST['contenido'])));
    $fecha     = formato_capital(limpiar_espacios(strip_tags($_POST['fecha'])));
    $hora      = strip_tags(trim($_POST['hora']));
    $id_editor = (int)$_POST['id_editor'];

    try {
        conectar();
        $sql = "UPDATE blogs SET titulo = ?, imagen = ?, contenido = ?, fecha = ?, hora = ?, id_editor = ? WHERE id_blog = ?";
        if (ejecutar_prep($sql, "sssssii", $titulo, $imagen, $contenido, $fecha, $hora, $id_editor, $id_blog)) {
            echo "Blog actualizado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
