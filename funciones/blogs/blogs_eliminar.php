<?php

if (isset($_POST['id_blog']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_blog = intval($_POST['id_blog']);
    try {
        conectar();
        $sql = "DELETE FROM blogs WHERE id_blog = $id_blog";
        if (ejecutar($sql)) {
            echo "Blog eliminado exitosamente.";
        } else {
            echo "Error al eliminar el blog: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID no proporcionado.";
}
