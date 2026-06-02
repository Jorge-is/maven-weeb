<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sesion_segura();
    csrf_verificar();

    $usuario = strip_tags(trim($_POST['usuario']));
    $clave   = strip_tags(trim($_POST['clave']));

    try {
        conectar();
        $sql      = "SELECT id_cliente, nombre, usuario, clave FROM clientes WHERE usuario = ?";
        $usuarios = consultar_prep($sql, "s", $usuario);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && password_verify($clave, $usuarioDb['clave'])) {
                session_regenerate_id(true);
                $_SESSION["id_cliente"]     = $usuarioDb['id_cliente'];
                $_SESSION["nombre_cliente"]  = $usuarioDb['nombre'];
                $_SESSION["rol_cliente"]    = "clientes";
                $usuarioValido = true;
                break;
            }
        }

        if ($usuarioValido) {
            header("Location: cliente/index.php?mensaje=exito");
            exit();
        } else {
            header("Location: iniciar_sesion.php?mensaje=error");
            exit();
        }
    } catch (Exception $ex) {
        manejar_error($ex);
    }
} else {
    sesion_segura();
}
?>
