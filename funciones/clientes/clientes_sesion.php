<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = strip_tags(trim($_POST['usuario']));
    $clave   = strip_tags(trim($_POST['clave']));

    try {
        conectar();
        $sql      = "SELECT id_cliente, nombre, usuario, AES_DECRYPT(clave, ?) AS clave FROM clientes WHERE usuario = ?";
        $usuarios = consultar_prep($sql, "ss", AES_KEY, $usuario);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && $usuarioDb['clave'] === $clave) {
                $_SESSION["id_cliente"]    = $usuarioDb['id_cliente'];
                $_SESSION["nombre_cliente"] = $usuarioDb['nombre'];
                $_SESSION["rol_cliente"]   = "clientes";
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
        die($ex->getMessage());
    }
}
?>
