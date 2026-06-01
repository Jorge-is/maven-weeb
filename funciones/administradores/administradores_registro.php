<?php

function limpiar_espacios($cadena) {
    return trim(preg_replace('/\s+/', ' ', $cadena));
}

function formato_capital($cadena) {
    return ucwords(strtolower($cadena));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
    $nombre   = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $correo   = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $usuario  = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave    = formato_capital(limpiar_espacios(strip_tags($_POST['clave'])));

    try {
        conectar();
        $sql = "INSERT INTO administradores (apellido, nombre, correo, usuario, clave) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?))";
        if (ejecutar_prep($sql, "ssssss", $apellido, $nombre, $correo, $usuario, $clave, AES_KEY)) {
            header("Location: index.php?mensaje=true");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
