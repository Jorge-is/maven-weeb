<?php

if (isset($_POST['id_editor']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_editor = intval($_POST['id_editor']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM editores WHERE id_editor = ?", "i", $id_editor)) {
            echo "Editor eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
} else {
    echo "ID no proporcionado.";
}
?>
