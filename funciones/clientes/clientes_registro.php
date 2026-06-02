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
    $usuario  = strip_tags(trim($_POST['usuario']));
    $clave    = strip_tags(trim($_POST['clave']));

    $errores = validar([
        'apellido' => ['valor' => $apellido, 'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'nombre'   => ['valor' => $nombre,   'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'correo'   => ['valor' => $correo,   'requerido' => true, 'email' => true, 'max_len' => 100],
        'usuario'  => ['valor' => $usuario,  'requerido' => true, 'min_len' => 3, 'max_len' => 30],
        'clave'    => ['valor' => $clave,    'requerido' => true, 'min_len' => 8],
    ]);
    if ($errores) {
        header("Location: iniciar_sesion.php?mensaje=error");
        exit();
    }

    $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);

    try {
        conectar();
        $sql = "INSERT INTO clientes (apellido, nombre, correo, usuario, clave) VALUES (?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssss", $apellido, $nombre, $correo, $usuario, $hash)) {
            header("Location: iniciar_sesion.php?mensaje=true");
            exit();
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
