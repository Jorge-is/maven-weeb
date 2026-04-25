<?php

define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado

function limpiar_espacios($cadena) {
    return trim(preg_replace('/\s+/', ' ', $cadena));
}

function formato_capital($cadena) {
    return ucwords(strtolower($cadena));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
    $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre']))) ;
    $correo = strtolower(limpiar_espacios(strip_tags($_POST['correo']))) ;
    $usuario = strip_tags(trim($_POST['usuario']));
    $clave = strip_tags(trim($_POST['clave'])); // Tomar la clave sin hashear

    // Conectar a la base de datos y guardar los datos del cliente
    try {
        conectar();
        $clave_cifrada = "AES_ENCRYPT('$clave', '" . AES_KEY . "')";
        $sql = "INSERT INTO clientes (apellido, nombre, correo, usuario, clave) VALUES ('$apellido', '$nombre', '$correo', '$usuario', $clave_cifrada)";
        if (ejecutar($sql)) {
            echo "Cliente creado exitosamente.";
            header("Location: iniciar_sesion.php?mensaje=true");
            exit();
        } else {
            echo "Error al crear el cliente.";
            header("Location: registro.php?mensaje=false");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}

?>
