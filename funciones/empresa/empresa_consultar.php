<?php

try {
    conectar();
    $sql = "SELECT * FROM empresa";
    $empresa = consultar($sql);
    desconectar();
    return  $empresa;
} catch (Exception $ex) {
    manejar_error($ex);
}
?>
