<?php

try {
    conectar();
    $sql = "SELECT * FROM mensajes";
    $mensajes = consultar($sql);
    desconectar();
    return $mensajes;
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>