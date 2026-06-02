<?php

if (isset($_POST['id_servicio']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_servicio = intval($_POST['id_servicio']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM servicios WHERE id_servicio = ?", "i", $id_servicio)) {
            echo "Servicio eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID de servicio no válido.";
}

function limpiar_numero($numero) {
    return preg_replace('/[^0-9]/', '', $numero);
}
?>
