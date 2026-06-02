<?php

function limpiar_espacios($cadena) {
    return trim(preg_replace('/\s+/', ' ', $cadena));
}

function formato_capital($cadena) {
    return ucwords(strtolower($cadena));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    sesion_segura();
    csrf_verificar();
    $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
    $nombre   = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $correo   = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $usuario  = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave    = strip_tags(trim($_POST['clave']));

    $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);

    try {
        conectar();
        $sql = "INSERT INTO administradores (apellido, nombre, correo, usuario, clave) VALUES (?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssss", $apellido, $nombre, $correo, $usuario, $hash)) {
            header("Location: index.php?mensaje=true");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
