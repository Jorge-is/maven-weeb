<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'actualizar') {
    csrf_verificar();

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

    $errores = validar([
        'titulo'    => ['valor' => $titulo,    'requerido' => true, 'min_len' => 3, 'max_len' => 200],
        'contenido' => ['valor' => $contenido, 'requerido' => true, 'min_len' => 10],
        'fecha'     => ['valor' => $fecha,     'requerido' => true],
        'hora'      => ['valor' => $hora,      'requerido' => true],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

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
