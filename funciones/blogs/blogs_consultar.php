<?php

try {
    conectar();
    $sql = "SELECT * FROM blogs";
    $blogs = consultar($sql);
    desconectar();
    return $blogs;
} catch (Exception $ex) {

    manejar_error($ex);
}
