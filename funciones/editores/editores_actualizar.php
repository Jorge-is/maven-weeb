<?php

if (isset($_POST['id_editor']) && isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_editor = intval($_POST['id_editor']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
        $nombre   = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
        $correo   = strtolower(limpiar_espacios($_POST['correo']));
        $usuario  = strtolower(limpiar_espacios($_POST['usuario']));
        $clave    = htmlentities(trim($_POST['clave']));

        try {
            conectar();
            $sql = "UPDATE editores SET apellido = ?, nombre = ?, correo = ?, usuario = ?, clave = AES_ENCRYPT(?, ?) WHERE id_editor = ?";
            if (ejecutar_prep($sql, "ssssssi", $apellido, $nombre, $correo, $usuario, $clave, AES_KEY, $id_editor)) {
                echo "Editor actualizado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>
