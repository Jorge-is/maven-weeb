<?php

if (isset($_POST['id_blog']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_blog = intval($_POST['id_blog']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM blogs WHERE id_blog = ?", "i", $id_blog)) {
            echo "Blog eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID no proporcionado.";
}
