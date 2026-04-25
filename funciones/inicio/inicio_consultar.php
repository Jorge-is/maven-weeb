<?php

try {
    conectar();
    $sql = "SELECT * FROM inicio";
    $inicio = consultar($sql);
    desconectar();
    return $inicio;
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>
