<?php

if (isset($_POST['id_proyecto']) && isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena){
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
    function formato_capital($cadena){
        return ucwords(strtolower($cadena));
    }

    $id_proyecto = intval($_POST['id_proyecto']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = formato_capital(limpiar_espacios(strip_tags(trim($_POST['nombre']))));
        $detalle = formato_capital(limpiar_espacios(strip_tags(trim($_POST['detalle']))));
        $imagen = strtolower(limpiar_espacios($_POST['imagen']));
        $rubro = strtolower(limpiar_espacios($_POST['rubro']));
        $fecha = strip_tags(trim($_POST['fecha']));
        $id_editor = strip_tags($_POST['id_editor']);

        try {
            conectar();
            $sql = "UPDATE proyectos  
                SET nombre = '$nombre', detalle = '$detalle', imagen = '$imagen', rubro = '$rubro', fecha = '$fecha', id_editor = '$id_editor'  
                WHERE id_proyecto = $id_proyecto";
            if (ejecutar($sql)) {
                echo "proyecto actualizado exitosamente.";
            } else {
                echo "Error al actualizar el proyecto: " . mysqli_error($cnx);
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
