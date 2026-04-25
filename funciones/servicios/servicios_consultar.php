<?php

try {
    conectar();
    $sql = "SELECT * FROM servicios";
    $servicios = consultar($sql);
    desconectar();
    return $servicios;
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>
