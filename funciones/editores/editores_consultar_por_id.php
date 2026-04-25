<?php

$id_editor="";
$apellido="";
$nombre="";
$correo="";
$usuario="";
$clave="";

if (isset($_GET['id_editor']) && $_GET['funcion'] == 'actualizar') {
    define("AES_KEY", "clave_secreta_para_aes"); // Define tu clave de cifrado
    $id_editor = (int)$_GET['id_editor'];

    // Conectar a la base de datos y obtener los datos del editor
    try {
        conectar();
        $sql = "SELECT apellido, nombre, correo, usuario, AES_DECRYPT(clave, '" . AES_KEY . "') AS clave 
                FROM editores 
                WHERE id_editor = $id_editor";
        $datos_editores_id = consultar($sql);
        desconectar();

        if (count($datos_editores_id ) > 0) {
            $dato_editor = $datos_editores_id[0];
            $apellido = $dato_editor["apellido"];
            $nombre = $dato_editor["nombre"];
            $correo = $dato_editor["correo"];
            $usuario = $dato_editor["usuario"];
            $clave = $dato_editor["clave"];
        } else {
            echo "Editor no encontrado.";
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
} else {
    // echo "ID de editor no especificado.";
}

?>
