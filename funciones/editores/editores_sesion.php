<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sesion_segura();
    csrf_verificar();

    $usuario = htmlentities(trim($_POST["usuario"]));
    $clave   = strip_tags(trim($_POST["clave"]));

    try {
        conectar();
        $sql      = "SELECT id_editor, nombre, usuario, clave FROM editores WHERE usuario = ?";
        $usuarios = consultar_prep($sql, "s", $usuario);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if (password_verify($clave, $usuarioDb['clave'])) {
                session_regenerate_id(true);
                $_SESSION["id_editor"]     = $usuarioDb['id_editor'];
                $_SESSION["nombre_editor"]  = $usuarioDb['nombre'];
                $_SESSION["rol_editor"]    = "editores";
                $usuarioValido = true;
                break;
            }
        }

        if ($usuarioValido) {
            header("Location: intranet.php?mensaje=exito");
            exit();
        } else {
            header("Location: index.php?mensaje=error");
            exit();
        }
    } catch (Exception $ex) {
        manejar_error($ex);
    }
} else {
    sesion_segura();
}
?>
