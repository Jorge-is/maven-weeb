<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') {
    $id_empresa = intval($_POST['id_empresa']);
    $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre'])));
    $descripcion = formato_capital(limpiar_espacios(strip_tags($_POST['descripcion'])));
    $celular = limpiar_espacios(strip_tags($_POST['celular']));
    $correo = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
    $horario = formato_capital(limpiar_espacios(strip_tags($_POST['horario'])));
    $quienes_somos = formato_capital(limpiar_espacios(strip_tags($_POST['quienes_somos'])));
    $mision = formato_capital(limpiar_espacios(strip_tags($_POST['mision'])));
    $vision = formato_capital(limpiar_espacios(strip_tags($_POST['vision'])));
    $valores =formato_capital(limpiar_espacios(strip_tags($_POST['valores'])));
    $id_administrador = intval($_POST['id_administrador']);

    try {
        conectar();
        $sql = "UPDATE empresa 
                SET nombre = '$nombre', descripcion = '$descripcion', celular = '$celular', 
                    correo = '$correo', horario = '$horario', quienes_somos = '$quienes_somos', 
                    mision = '$mision', vision = '$vision', valores = '$valores', 
                    id_administrador = $id_administrador 
                WHERE id_empresa = $id_empresa";
        if (ejecutar($sql)) {
            echo "Empresa actualizada exitosamente.";
        } else {
            echo "Error al actualizar la empresa: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
