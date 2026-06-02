<?php

try {
    conectar();
    $sql = "SELECT * FROM inicio";
    $inicio = consultar($sql);
    desconectar();
    return $inicio;
} catch (Exception $ex) {
    manejar_error($ex);
}

?>
