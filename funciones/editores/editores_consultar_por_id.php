<?php
$id_editor = "";
$apellido  = "";
$nombre    = "";
$correo    = "";
$usuario   = "";

if (isset($_GET['id_editor']) && $_GET['funcion'] == 'actualizar') {
    $id_editor = (int)$_GET['id_editor'];

    try {
        conectar();
        $sql              = "SELECT apellido, nombre, correo, usuario FROM editores WHERE id_editor = ?";
        $datos_editores_id = consultar_prep($sql, "i", $id_editor);
        desconectar();

        if (count($datos_editores_id) > 0) {
            $dato_editor = $datos_editores_id[0];
            $apellido = $dato_editor["apellido"];
            $nombre   = $dato_editor["nombre"];
            $correo   = $dato_editor["correo"];
            $usuario  = $dato_editor["usuario"];
        } else {
            echo "Editor no encontrado.";
        }
    } catch (Exception $ex) {
        manejar_error($ex);
    }
}
?>
