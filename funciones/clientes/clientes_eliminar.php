<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_cliente']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_cliente = intval($_POST['id_cliente']);

    // Conectar a la base de datos y eliminar el cliente
    try {
        conectar();
        $sql = "DELETE FROM clientes WHERE id_cliente = $id_cliente";
        if (ejecutar($sql)) {
            echo "Cliente eliminado exitosamente.";
        } else {
            echo "Error al eliminar el cliente: " . mysqli_error($conn);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID de cliente no especificado.";
}

?>