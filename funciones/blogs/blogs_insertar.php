<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $titulo    = formato_capital(limpiar_espacios(strip_tags($_POST['titulo'])));
    $imagen    = limpiar_espacios(strip_tags($_POST['imagen']));
    $contenido = formato_capital(limpiar_espacios(strip_tags($_POST['contenido'])));
    $fecha     = formato_capital(limpiar_espacios(strip_tags($_POST['fecha'])));
    $hora      = strip_tags(trim($_POST['hora']));
    $id_editor = (int)$_POST['id_editor'];

    try {
        conectar();
        $sql = "INSERT INTO blogs (titulo, imagen, contenido, fecha, hora, id_editor) VALUES (?, ?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssssi", $titulo, $imagen, $contenido, $fecha, $hora, $id_editor)) {
            echo "Blog insertado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
