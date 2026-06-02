<?php
date_default_timezone_set("America/Lima");

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');
error_reporting(E_ALL);

(function () {
    $env_path = __DIR__ . '/../.env';
    if (!file_exists($env_path)) {
        return;
    }
    foreach (file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
})();

define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'maven_web');
define('DB_PORT', $_ENV['DB_PORT'] ?? '3306');

$cnx = null;

function manejar_error(Throwable $ex, string $contexto = ''): void {
    $entrada  = date('[Y-m-d H:i:s]');
    $entrada .= $contexto !== '' ? " [{$contexto}]" : '';
    $entrada .= ' ' . get_class($ex) . ': ' . $ex->getMessage();
    $entrada .= ' en ' . $ex->getFile() . ':' . $ex->getLine();
    error_log($entrada);
    die('Error interno del servidor. Por favor, intenta más tarde.');
}

function conectar() {
    global $cnx;
    $cnx = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if ($cnx->connect_error) {
        error_log('[' . date('Y-m-d H:i:s') . '] DB connection failed: ' . $cnx->connect_error);
        die('Error interno del servidor. Por favor, intenta más tarde.');
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

function validar(array $reglas): array {
    $errores = [];
    foreach ($reglas as $campo => $r) {
        $v = trim((string)($r['valor'] ?? ''));
        if (!empty($r['requerido']) && $v === '') {
            $errores[] = "El campo {$campo} es obligatorio.";
            continue;
        }
        if ($v === '') {
            continue;
        }
        if (!empty($r['email']) && !filter_var($v, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El campo {$campo} debe ser un correo electrónico válido.";
        }
        if (isset($r['min_len']) && mb_strlen($v) < $r['min_len']) {
            $errores[] = "El campo {$campo} debe tener al menos {$r['min_len']} caracteres.";
        }
        if (isset($r['max_len']) && mb_strlen($v) > $r['max_len']) {
            $errores[] = "El campo {$campo} no puede superar {$r['max_len']} caracteres.";
        }
        if (!empty($r['positivo']) && (float)$v <= 0) {
            $errores[] = "El campo {$campo} debe ser mayor a cero.";
        }
    }
    return $errores;
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
