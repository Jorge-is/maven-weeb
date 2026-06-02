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

    $errores = validar([
        'apellido' => ['valor' => $apellido, 'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'nombre'   => ['valor' => $nombre,   'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'correo'   => ['valor' => $correo,   'requerido' => true, 'email' => true, 'max_len' => 100],
        'usuario'  => ['valor' => $usuario,  'requerido' => true, 'min_len' => 3, 'max_len' => 30],
        'clave'    => ['valor' => $clave,    'requerido' => true, 'min_len' => 8],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

    $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);

    try {
        conectar();
        $sql = "INSERT INTO clientes (apellido, nombre, correo, usuario, clave) VALUES (?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssss", $apellido, $nombre, $correo, $usuario, $hash)) {
            echo "Cliente creado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
?>
