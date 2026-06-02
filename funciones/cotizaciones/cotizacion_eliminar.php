<?php

if (isset($_POST['id_cotizacion']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_cotizacion = (int)$_POST['id_cotizacion'];

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM cotizaciones WHERE id_cotizacion = ?", "i", $id_cotizacion)) {
            header("Location: cotizacion.php?mensaje=eliminado");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
} else {
    echo "ID de cotización no especificado.";
}
?>
