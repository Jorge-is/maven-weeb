<?php

if (isset($_POST['id_proyecto']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_proyecto = intval($_POST['id_proyecto']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM proyectos WHERE id_proyecto = ?", "i", $id_proyecto)) {
            echo "Proyecto eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
} else {
    echo "ID no proporcionado.";
}
