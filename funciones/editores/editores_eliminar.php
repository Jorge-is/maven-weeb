<?php

if (isset($_POST['id_editor'])  && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_editor = intval($_POST['id_editor']);

    try {
        conectar();
        $sql = "DELETE FROM editores WHERE id_editor = $id_editor";
        if (ejecutar($sql)) {
            echo "Editor eliminado exitosamente.";
        } else {
            echo "Error al eliminar el editor: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID no proporcionado.";
}

?>