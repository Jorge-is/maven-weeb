<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_cliente']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $id_cliente = intval($_POST['id_cliente']);

    try {
        conectar();
        if (ejecutar_prep("DELETE FROM clientes WHERE id_cliente = ?", "i", $id_cliente)) {
            echo "Cliente eliminado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID de cliente no especificado.";
}
?>
