<?php

try {
    conectar();
    $sql = "SELECT id_proyecto, nombre, detalle, imagen, rubro, fecha, id_editor FROM proyectos";
    $proyectos = consultar($sql);
    desconectar();
    if (count($proyectos) > 0) {
        $editor = $proyectos[0];
    } else {
        echo "Editor no encontrado.";
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}

?> 

 

<?php
