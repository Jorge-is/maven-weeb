<?php
session_start();

define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = htmlentities(trim($_POST["usuario"]));
    $clave = htmlentities(trim($_POST["clave"]));

    try {
        conectar();
        $sql = "SELECT id_editor, nombre, usuario, AES_DECRYPT(clave, '" . AES_KEY . "') AS clave FROM editores WHERE usuario = '$usuario'";
        $usuarios = consultar($sql);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && $usuarioDb['clave'] === $clave) {
                $_SESSION["id_editor"]=$usuarioDb['id_editor'] ;
                $_SESSION["nombre_editor"]=$usuarioDb['nombre'] ;
                $_SESSION["rol_editor"]="editores";
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
}
?>