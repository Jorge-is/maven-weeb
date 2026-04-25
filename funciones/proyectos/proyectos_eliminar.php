<?php
if (isset($_POST['id_proyecto']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_proyecto = intval($_POST['id_proyecto']);
    try {
        conectar();
        $sql = "DELETE FROM proyectos WHERE id_proyecto = $id_proyecto";
        if (ejecutar($sql)) {
            echo "proyecto eliminado exitosamente.";
        } else {
            echo "Error al eliminar el proyecto: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    echo "ID no proporcionado.";
}
