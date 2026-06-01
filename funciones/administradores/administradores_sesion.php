<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $usuario = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave   = formato_capital(limpiar_espacios(strip_tags($_POST['clave'])));

    try {
        conectar();
        $sql      = "SELECT id_administrador, nombre, usuario, AES_DECRYPT(clave, ?) AS clave FROM administradores WHERE usuario = ?";
        $usuarios = consultar_prep($sql, "ss", AES_KEY, $usuario);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && $usuarioDb['clave'] === $clave) {
                $_SESSION["id_administrador"]    = $usuarioDb['id_administrador'];
                $_SESSION["nombre_administrador"] = $usuarioDb['nombre'];
                $_SESSION["rol_administrador"]   = "administradores";
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
        die($ex->getMessage());
    }
} else {
    try {
        conectar();
        $administradores = consultar("SELECT * FROM administradores");
        desconectar();

        if (count($administradores) > 0) {
            $administrador = $administradores[0];
        } else {
            echo "No hay administradores";
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
