<?php
date_default_timezone_set("America/Lima");

const HOST     = "localhost";
const USER     = "root";
const PASS     = "";
const DATABASE = "maven_web";
const PORT     = "3306";
const AES_KEY  = "clave_secreta_para_aes";

$cnx = null;

function conectar() {
    global $cnx;
    $cnx = new mysqli(HOST, USER, PASS, DATABASE, PORT);
    if ($cnx->connect_error) {
        die("Conexión fallida: " . $cnx->connect_error);
    }
    $cnx->set_charset("utf8");
}

function desconectar() {
    global $cnx;
    if ($cnx) {
        $cnx->close();
        $cnx = null;
    }
}

function consultar($sql) {
    global $cnx;
    $result = $cnx->query($sql);
    if (!$result) {
        throw new Exception($cnx->error);
    }
    $lista = [];
    while ($row = $result->fetch_assoc()) {
        $lista[] = $row;
    }
    $result->free();
    return $lista;
}

function ejecutar($sql) {
    global $cnx;
    if (!$cnx->query($sql)) {
        throw new Exception($cnx->error);
    }
    return true;
}

function consultar_prep($sql, $types = '', ...$params) {
    global $cnx;
    $stmt = $cnx->prepare($sql);
    if (!$stmt) {
        throw new Exception($cnx->error);
    }
    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception($stmt->error);
    }
    $result = $stmt->get_result();
    $lista  = [];
    while ($row = $result->fetch_assoc()) {
        $lista[] = $row;
    }
    $stmt->close();
    return $lista;
}

function ejecutar_prep($sql, $types = '', ...$params) {
    global $cnx;
    $stmt = $cnx->prepare($sql);
    if (!$stmt) {
        throw new Exception($cnx->error);
    }
    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }
    if (!$stmt->execute()) {
        throw new Exception($stmt->error);
    }
    $stmt->close();
    return true;
}
?>
