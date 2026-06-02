<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
    csrf_verificar();
    $id_empresa      = intval($_POST['id_empresa']);
    $nombre          = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $descripcion     = formato_capital(limpiar_espacios(strip_tags($_POST['descripcion'])));
    $celular         = limpiar_espacios(strip_tags($_POST['celular']));
    $correo          = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $horario         = formato_capital(limpiar_espacios(strip_tags($_POST['horario'])));
    $quienes_somos   = formato_capital(limpiar_espacios(strip_tags($_POST['quienes_somos'])));
    $mision          = formato_capital(limpiar_espacios(strip_tags($_POST['mision'])));
    $vision          = formato_capital(limpiar_espacios(strip_tags($_POST['vision'])));
    $valores         = formato_capital(limpiar_espacios(strip_tags($_POST['valores'])));
    $id_administrador = intval($_POST['id_administrador']);

    $errores = validar([
        'nombre'        => ['valor' => $nombre,        'requerido' => true, 'min_len' => 2, 'max_len' => 100],
        'descripcion'   => ['valor' => $descripcion,   'requerido' => true, 'max_len' => 500],
        'celular'       => ['valor' => $celular,       'requerido' => true, 'min_len' => 7, 'max_len' => 20],
        'correo'        => ['valor' => $correo,        'requerido' => true, 'email' => true, 'max_len' => 100],
        'horario'       => ['valor' => $horario,       'requerido' => true, 'max_len' => 100],
        'quienes_somos' => ['valor' => $quienes_somos, 'requerido' => true, 'max_len' => 2000],
        'mision'        => ['valor' => $mision,        'requerido' => true, 'max_len' => 1000],
        'vision'        => ['valor' => $vision,        'requerido' => true, 'max_len' => 1000],
        'valores'       => ['valor' => $valores,       'requerido' => true, 'max_len' => 1000],
    ]);
    if ($errores) {
        echo implode(' ', $errores);
        return;
    }

    try {
        conectar();
        $sql = "UPDATE empresa
                SET nombre = ?, descripcion = ?, celular = ?, correo = ?, horario = ?,
                    quienes_somos = ?, mision = ?, vision = ?, valores = ?, id_administrador = ?
                WHERE id_empresa = ?";
        if (ejecutar_prep($sql, "sssssssssii", $nombre, $descripcion, $celular, $correo, $horario, $quienes_somos, $mision, $vision, $valores, $id_administrador, $id_empresa)) {
            echo "Empresa actualizada exitosamente.";
        }
        desconectar();
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
?>
