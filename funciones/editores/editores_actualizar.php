<?php

if (isset($_POST['id_editor']) && isset($_GET['funcion']) &&  $_GET['funcion'] == 'actualizar') {
    
    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }
    
    $id_editor = intval($_POST['id_editor']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado
        $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
        $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
        $correo = strtolower(limpiar_espacios($_POST['correo']));
        $usuario = strtolower(limpiar_espacios($_POST['usuario']));
        $clave = htmlentities(trim($_POST['clave']));
        $id_administrador = htmlentities($_POST['id_administrador']);

        try {
            conectar();
            $clave_cifrada = "AES_ENCRYPT('$clave', '" . AES_KEY . "')";
            $sql = "UPDATE editores 
                    SET apellido = '$apellido', nombre = '$nombre', correo = '$correo', usuario = '$usuario', clave = $clave_cifrada 
                    WHERE id_editor = $id_editor";
            if (ejecutar($sql)) {
                echo "Editor actualizado exitosamente.";
            } else {
                echo "Error al actualizar el editor: " . mysqli_error($cnx);
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}

?>