<?php

// Conectar a la base de datos y obtener los datos del editor
try {
    conectar();
    $sql = "SELECT id_editor, apellido, nombre, correo, usuario, id_administrador FROM editores";
    $editores = consultar($sql);
    desconectar();

    if (count($editores) > 0) {
        $editor = $editores[0];
    } else {
        echo "Editor no encontrado.";
    }
} catch (Exception $ex) {
    manejar_error($ex);
}
?>