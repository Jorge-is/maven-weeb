<?php

try {
    conectar();
    $sql = "SELECT * FROM cotizaciones";
    $cotizaciones = consultar($sql);
    desconectar();
    return $cotizaciones;
} catch (Exception $ex) {
    manejar_error($ex);
}
?>