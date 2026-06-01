<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_inicio      = intval($_POST['id_inicio']);
    $banner         = limpiar_espacios(strip_tags(trim($_POST['banner'])));
    $titulo         = formato_capital(limpiar_espacios(strip_tags(trim($_POST['titulo']))));
    $texto          = formato_capital(limpiar_espacios(strip_tags(trim($_POST['texto']))));
    $disenio_uno    = strtolower(limpiar_espacios(strip_tags($_POST['disenio_uno'])));
    $disenio_dos    = strtolower(limpiar_espacios(strip_tags($_POST['disenio_dos'])));
    $desarrollo_uno = strtolower(limpiar_espacios(strip_tags($_POST['desarrollo_uno'])));
    $desarrollo_dos = strtolower(limpiar_espacios(strip_tags($_POST['desarrollo_dos'])));
    $id_editor      = intval($_POST['id_editor']);

    try {
        conectar();
        $sql = "UPDATE inicio
                SET banner = ?, titulo = ?, texto = ?, disenio_uno = ?, disenio_dos = ?,
                    desarrollo_uno = ?, desarrollo_dos = ?, id_editor = ?
                WHERE id_inicio = ?";
        if (ejecutar_prep($sql, "sssssssii", $banner, $titulo, $texto, $disenio_uno, $disenio_dos, $desarrollo_uno, $desarrollo_dos, $id_editor, $id_inicio)) {
            echo "Registro de inicio actualizado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
