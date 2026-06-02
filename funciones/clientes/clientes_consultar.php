<?php

try {
    conectar();
    $sql = "SELECT id_cliente, apellido, nombre, correo, usuario FROM clientes";
    $clientes = consultar($sql);
    desconectar();
} catch (Exception $ex) {
    manejar_error($ex);
}
?>