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
    $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $correo = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $usuario = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave = formato_capital(limpiar_espacios(strip_tags($_POST['clave']))); // Tomar la clave sin hashear

    // Conectar a la base de datos y guardar los datos del cliente
    try {
        conectar();
        $clave_cifrada = "AES_ENCRYPT('$clave', '" . AES_KEY . "')";
        $sql = "INSERT INTO administradores (apellido, nombre, correo, usuario, clave) VALUES ('$apellido', '$nombre', '$correo', '$usuario', $clave_cifrada)";
        if (ejecutar($sql)) {
            echo "Administrador creado exitosamente.";
            header("Location: index.php?mensaje=true");
            exit();
        } else {
            echo "Error al crear al administrador.";
            header("Location: administadores_registro.php?mensaje=false");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}

?>
