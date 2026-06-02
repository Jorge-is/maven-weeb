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
        $clave    = strip_tags(trim($_POST['clave']));

        try {
            conectar();

            if (!empty($clave)) {
                $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);
                $sql  = "UPDATE editores SET apellido = ?, nombre = ?, correo = ?, usuario = ?, clave = ? WHERE id_editor = ?";
                ejecutar_prep($sql, "sssssi", $apellido, $nombre, $correo, $usuario, $hash, $id_editor);
            } else {
                $sql = "UPDATE editores SET apellido = ?, nombre = ?, correo = ?, usuario = ? WHERE id_editor = ?";
                ejecutar_prep($sql, "ssssi", $apellido, $nombre, $correo, $usuario, $id_editor);
            }

            echo "Editor actualizado exitosamente.";
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>
