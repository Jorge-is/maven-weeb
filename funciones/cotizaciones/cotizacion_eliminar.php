<?php

if (isset($_POST['id_cotizacion']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_cotizacion = (int)$_POST['id_cotizacion'];

    try {
        conectar();
        $sql = "DELETE FROM cotizaciones WHERE id_cotizacion = $id_cotizacion";
        if (ejecutar($sql)) {
            header("Location: cotizacion.php?mensaje=eliminado");
        } else {
            echo "Error al eliminar la cotización: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID de cotización no especificado.";
}
?>