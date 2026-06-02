<?php

if (isset($_POST['id_proyecto']) && isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') {
    csrf_verificar();

    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }

    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $id_proyecto = intval($_POST['id_proyecto']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre    = formato_capital(limpiar_espacios(strip_tags(trim($_POST['nombre']))));
        $detalle   = formato_capital(limpiar_espacios(strip_tags(trim($_POST['detalle']))));
        $imagen    = strtolower(limpiar_espacios(strip_tags($_POST['imagen'])));
        $rubro     = strtolower(limpiar_espacios(strip_tags($_POST['rubro'])));
        $fecha     = strip_tags(trim($_POST['fecha']));
        $id_editor = (int)$_POST['id_editor'];

        $errores = validar([
            'nombre'  => ['valor' => $nombre,  'requerido' => true, 'min_len' => 2, 'max_len' => 100],
            'detalle' => ['valor' => $detalle, 'requerido' => true, 'min_len' => 5, 'max_len' => 500],
            'rubro'   => ['valor' => $rubro,   'requerido' => true, 'max_len' => 100],
            'fecha'   => ['valor' => $fecha,   'requerido' => true],
        ]);
        if ($errores) {
            echo implode(' ', $errores);
            return;
        }

        try {
            conectar();
            $sql = "UPDATE proyectos SET nombre = ?, detalle = ?, imagen = ?, rubro = ?, fecha = ?, id_editor = ? WHERE id_proyecto = ?";
            if (ejecutar_prep($sql, "sssssii", $nombre, $detalle, $imagen, $rubro, $fecha, $id_editor, $id_proyecto)) {
                echo "Proyecto actualizado exitosamente.";
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
