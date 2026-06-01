<?php
$id_cliente = "";
$apellido   = "";
$nombre     = "";
$correo     = "";
$usuario    = "";
$clave      = "";

if (isset($_GET['id_cliente']) && $_GET['funcion'] == 'actualizar') {
    $id_cliente = (int)$_GET['id_cliente'];

    try {
        conectar();
        $sql              = "SELECT apellido, nombre, correo, usuario, AES_DECRYPT(clave, ?) AS clave FROM clientes WHERE id_cliente = ?";
        $datos_clientes_id = consultar_prep($sql, "si", AES_KEY, $id_cliente);
        desconectar();

        if (count($datos_clientes_id) > 0) {
            $dato_cliente = $datos_clientes_id[0];
            $apellido = $dato_cliente["apellido"];
            $nombre   = $dato_cliente["nombre"];
            $correo   = $dato_cliente["correo"];
            $usuario  = $dato_cliente["usuario"];
            $clave    = $dato_cliente["clave"];
        } else {
            echo "Cliente no encontrado.";
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
?>
