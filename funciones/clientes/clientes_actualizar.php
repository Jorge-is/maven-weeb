<?php

if (isset($_POST['id_cliente']) && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
    csrf_verificar();

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
        $clave    = strip_tags(trim($_POST['clave']));

        $reglas = [
            'apellido' => ['valor' => $apellido, 'requerido' => true, 'min_len' => 2, 'max_len' => 50],
            'nombre'   => ['valor' => $nombre,   'requerido' => true, 'min_len' => 2, 'max_len' => 50],
            'correo'   => ['valor' => $correo,   'requerido' => true, 'email' => true, 'max_len' => 100],
            'usuario'  => ['valor' => $usuario,  'requerido' => true, 'min_len' => 3, 'max_len' => 30],
        ];
        if (!empty($clave)) {
            $reglas['clave'] = ['valor' => $clave, 'min_len' => 8];
        }
        $errores = validar($reglas);
        if ($errores) {
            echo implode(' ', $errores);
            return;
        }

        try {
            conectar();

            if (!empty($clave)) {
                $hash = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 12]);
                $sql  = "UPDATE clientes SET apellido = ?, nombre = ?, correo = ?, usuario = ?, clave = ? WHERE id_cliente = ?";
                ejecutar_prep($sql, "sssssi", $apellido, $nombre, $correo, $usuario, $hash, $id_cliente);
            } else {
                $sql = "UPDATE clientes SET apellido = ?, nombre = ?, correo = ?, usuario = ? WHERE id_cliente = ?";
                ejecutar_prep($sql, "ssssi", $apellido, $nombre, $correo, $usuario, $id_cliente);
            }

            echo "Cliente actualizado exitosamente.";
            desconectar();
        } catch (Exception $ex) {
            manejar_error($ex);
        }
    }
}
?>
