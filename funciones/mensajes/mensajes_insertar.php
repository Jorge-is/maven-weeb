<?php
include_once 'funciones/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    sesion_segura();
    csrf_verificar();
    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $apellido      = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
    $nombre        = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $celular       = limpiar_espacios(strip_tags($_POST['celular']));
    $correo        = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $mensaje_texto = limpiar_espacios(strip_tags($_POST['mensaje_texto']));

    $errores = validar([
        'apellido'      => ['valor' => $apellido,      'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'nombre'        => ['valor' => $nombre,        'requerido' => true, 'min_len' => 2, 'max_len' => 50],
        'celular'       => ['valor' => $celular,       'requerido' => true, 'min_len' => 7, 'max_len' => 20],
        'correo'        => ['valor' => $correo,        'requerido' => true, 'email' => true, 'max_len' => 100],
        'mensaje_texto' => ['valor' => $mensaje_texto, 'requerido' => true, 'min_len' => 10, 'max_len' => 1000],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

    try {
        conectar();
        $sql = "INSERT INTO mensajes (apellido, nombre, celular, correo, mensaje_texto) VALUES (?, ?, ?, ?, ?)";
        ejecutar_prep($sql, "sssss", $apellido, $nombre, $celular, $correo, $mensaje_texto);
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
