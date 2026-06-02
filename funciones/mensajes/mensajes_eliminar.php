<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_mensaje = intval($_POST['id_mensaje']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM mensajes WHERE id_mensaje = ?", "i", $id_mensaje)) {
            echo "Mensaje eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
