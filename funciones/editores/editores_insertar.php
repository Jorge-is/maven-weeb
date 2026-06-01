<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['funcion'] == 'insertar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $apellido        = htmlentities(trim($_POST['apellido'])) ? formato_capital(limpiar_espacios(htmlentities(trim($_POST['apellido'])))) : '';
    $nombre          = htmlentities(trim($_POST['nombre']))   ? formato_capital(limpiar_espacios(htmlentities(trim($_POST['nombre']))))   : '';
    $correo          = htmlentities(trim($_POST['correo']))   ? strtolower(limpiar_espacios($_POST['correo']))   : '';
    $usuario         = htmlentities(trim($_POST['usuario']))  ? strtolower(limpiar_espacios($_POST['usuario']))  : '';
    $clave           = htmlentities(trim($_POST['clave']));
    $id_administrador = (int)$_POST['id_administrador'];

    try {
        conectar();
        $sql = "INSERT INTO editores (apellido, nombre, correo, usuario, clave, id_administrador) VALUES (?, ?, ?, ?, AES_ENCRYPT(?, ?), ?)";
        if (ejecutar_prep($sql, "ssssssi", $apellido, $nombre, $correo, $usuario, $clave, AES_KEY, $id_administrador)) {
            echo "Editor creado exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
