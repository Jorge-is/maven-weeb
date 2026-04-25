<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
    
    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_inicio = intval($_POST['id_inicio']);
    $banner = limpiar_espacios(strip_tags(trim($_POST['banner'])));
    $titulo = formato_capital(limpiar_espacios(strip_tags(trim($_POST['titulo']))));
    $texto = formato_capital(limpiar_espacios(strip_tags(trim($_POST['texto']))));
    $disenio_uno = strtolower(limpiar_espacios($_POST['disenio_uno']));
    $disenio_dos = strtolower(limpiar_espacios($_POST['disenio_dos']));
    $desarrollo_uno = strtolower(limpiar_espacios($_POST['desarrollo_uno']));
    $desarrollo_dos = strtolower(limpiar_espacios($_POST['desarrollo_dos']));
    $id_editor = intval($_POST['id_editor']);

    try {
        $conn = conectar();
        $sql = "UPDATE inicio 
                SET banner = '$banner', titulo = '$titulo', texto = '$texto', 
                    disenio_uno = '$disenio_uno', disenio_dos = '$disenio_dos', 
                    desarrollo_uno = '$desarrollo_uno', desarrollo_dos = '$desarrollo_dos', id_editor = '$id_editor' 
                WHERE id_inicio = $id_inicio";
        if (ejecutar($sql)) {
            echo "Registro de inicio actualizado exitosamente.";
        } else {
            echo "Error al actualizar el registro: " . mysqli_error();
        }
        desconectar(); 
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}

?>