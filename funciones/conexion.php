<?php
date_default_timezone_set("America/Lima");

const HOST     = "localhost";
const USER     = "root";
const PASS     = "";
const DATABASE = "maven_web";
const PORT     = "3306";

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

function sesion_segura(): void {
    if (session_status() !== PHP_SESSION_NONE) {
        return;
    }
    session_set_cookie_params([
        'lifetime' => 7200,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verificar(): void {
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die('Token de seguridad inválido. Recargá la página e intentá nuevamente.');
    }
}

function e(mixed $str): string {
    return htmlspecialchars((string)$str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
