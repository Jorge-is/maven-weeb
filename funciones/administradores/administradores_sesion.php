<?php
session_start();

define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
    
    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $usuario = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
    $clave = formato_capital(limpiar_espacios(strip_tags($_POST['clave']))); // Tomar la clave sin hashear

    try {
        conectar();
        $sql = "SELECT id_administrador, nombre, usuario, AES_DECRYPT(clave, '" . AES_KEY . "') AS clave FROM administradores WHERE usuario = '$usuario'";
        $usuarios = consultar($sql);
        desconectar();

        $usuarioValido = false;

        foreach ($usuarios as $usuarioDb) {
            if ($usuarioDb['usuario'] === $usuario && $usuarioDb['clave'] === $clave) {
                $_SESSION["id_administrador"]=$usuarioDb['id_cadministrador'] ;
                $_SESSION["nombre_administrador"]=$usuarioDb['nombre'] ;
                $_SESSION["rol_administrador"]="administradores";
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
} else{
    try {
        conectar();
        $sql = "SELECT * FROM administradores ";
        $administradores = consultar($sql);
        desconectar();

        if (count($administradores) > 0) {
            $administrador = $administradores[0];
        } else {
            echo "No hay administradores" ;
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>