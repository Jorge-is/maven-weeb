<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    csrf_verificar();

    if (!function_exists('limpiar_espacios')) {
        function limpiar_espacios($cadena) {
            return trim($cadena);
        }
    }

    if (!function_exists('formato_capital')) {
        function formato_capital($texto) {
            return ucwords(strtolower($texto));
        }
    }

    $apellido = isset($_POST['apellido']) ? formato_capital(limpiar_espacios(strip_tags($_POST['apellido']))) : '';
    $nombre   = isset($_POST['nombre'])   ? formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])))   : '';
    $correo   = isset($_POST['correo'])   ? strip_tags(trim($_POST['correo']))   : '';
    $usuario  = isset($_POST['usuario'])  ? formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])))  : '';
    $clave    = isset($_POST['clave'])    ? strip_tags(trim($_POST['clave']))    : '';

    if ($nombre && $correo && $usuario && $clave) {
        $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);

        try {
            conectar();
            $sql = "INSERT INTO clientes (apellido, nombre, correo, usuario, clave) VALUES (?, ?, ?, ?, ?)";
            if (ejecutar_prep($sql, "sssss", $apellido, $nombre, $correo, $usuario, $hash)) {
                echo "Cliente creado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
