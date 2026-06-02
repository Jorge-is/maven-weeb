<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {
    csrf_verificar();

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $apellido         = htmlentities(trim($_POST['apellido'])) ? formato_capital(limpiar_espacios(htmlentities(trim($_POST['apellido'])))) : '';
    $nombre           = htmlentities(trim($_POST['nombre']))   ? formato_capital(limpiar_espacios(htmlentities(trim($_POST['nombre']))))   : '';
    $correo           = htmlentities(trim($_POST['correo']))   ? strtolower(limpiar_espacios($_POST['correo']))   : '';
    $usuario          = htmlentities(trim($_POST['usuario']))  ? strtolower(limpiar_espacios($_POST['usuario']))  : '';
    $clave            = strip_tags(trim($_POST['clave']));
    $id_administrador = (int)$_POST['id_administrador'];

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
        $sql = "INSERT INTO editores (apellido, nombre, correo, usuario, clave, id_administrador) VALUES (?, ?, ?, ?, ?, ?)";
        if (ejecutar_prep($sql, "sssssi", $apellido, $nombre, $correo, $usuario, $hash, $id_administrador)) {
            echo "Editor creado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
?>
