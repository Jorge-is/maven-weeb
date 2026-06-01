<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
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
        die($ex->getMessage());
    }
}
?>
