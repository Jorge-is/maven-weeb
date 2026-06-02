<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    sesion_segura();
    csrf_verificar();

    $usuario = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave   = strip_tags(trim($_POST['clave']));

    try {
        conectar();
        $sql      = "SELECT id_administrador, nombre, usuario, clave FROM administradores WHERE usuario = ?";
        $usuarios = consultar_prep($sql, "s", $usuario);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && password_verify($clave, $usuarioDb['clave'])) {
                session_regenerate_id(true);
                $_SESSION["id_administrador"]     = $usuarioDb['id_administrador'];
                $_SESSION["nombre_administrador"]  = $usuarioDb['nombre'];
                $_SESSION["rol_administrador"]    = "administradores";
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
    try {
        conectar();
        $administradores = consultar("SELECT * FROM administradores");
        desconectar();

        if (count($administradores) > 0) {
            $administrador = $administradores[0];
        } else {
            $administrador = [];
        }
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
?>
