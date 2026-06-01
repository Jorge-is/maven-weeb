<?php

if (isset($_POST['id_cliente']) && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_cliente = intval($_POST['id_cliente']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
        $nombre   = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
        $correo   = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
        $usuario  = formato_capital(limpiar_espacios(strip_tags($_POST['usuario'])));
        $clave    = limpiar_espacios(strip_tags($_POST['clave']));

        try {
            conectar();
            $sql = "UPDATE clientes SET apellido = ?, nombre = ?, correo = ?, usuario = ?, clave = AES_ENCRYPT(?, ?) WHERE id_cliente = ?";
            if (ejecutar_prep($sql, "ssssssi", $apellido, $nombre, $correo, $usuario, $clave, AES_KEY, $id_cliente)) {
                echo "Cliente actualizado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>
