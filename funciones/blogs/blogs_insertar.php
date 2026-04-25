<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }
    
    $titulo = formato_capital(limpiar_espacios(strip_tags($_POST['titulo'])));
    $imagen = formato_capital(limpiar_espacios(strip_tags($_POST['imagen'])));
    $contenido = formato_capital(limpiar_espacios(strip_tags($_POST['contenido'])));
    $fecha = formato_capital(limpiar_espacios(strip_tags($_POST['fecha'])));
    $hora = strip_tags(trim($_POST['hora']));
    $id_editor = formato_capital(limpiar_espacios(strip_tags($_POST['id_editor'])));

    try {
        conectar();
        $sql = "INSERT INTO blogs (titulo, imagen, contenido, fecha, hora, id_editor)  
                VALUES ('$titulo', '$imagen', '$contenido', '$fecha', '$hora', '$id_editor')";
        if (ejecutar($sql)) {
            echo "Blog insertado exitosamente.";
        } else {
            echo "Error al insertar el blog: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
