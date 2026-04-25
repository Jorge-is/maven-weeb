<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {
    
    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
    
    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado
    $apellido = htmlentities(trim($_POST['apellido']))? formato_capital(limpiar_espacios(htmlentities(trim($_POST['apellido'])))) : '';
    $nombre = htmlentities(trim($_POST['nombre']))? formato_capital(limpiar_espacios(htmlentities(trim($_POST['nombre'])))) : '';
    $correo = htmlentities(trim($_POST['correo']))? strtolower(limpiar_espacios($_POST['correo'])) : '';
    $usuario = htmlentities(trim($_POST['usuario']))? strtolower(limpiar_espacios($_POST['usuario'])) : '';
    $clave = htmlentities(trim($_POST['clave']));
    $id_administrador = htmlentities($_POST['id_administrador']);

    try {
        conectar();
        $clave_cifrada = "AES_ENCRYPT('$clave', '" . AES_KEY . "')";
        $sql = "INSERT INTO editores (apellido, nombre, correo, usuario, clave, id_administrador) 
                VALUES ('$apellido', '$nombre', '$correo', '$usuario', $clave_cifrada, '$id_administrador')";
        if (ejecutar($sql)) {
            echo "Editor creado exitosamente.";
        } else {
            echo "Error al crear el editor: ";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}

?>