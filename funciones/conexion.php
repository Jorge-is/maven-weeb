<?php
# Definir zona horaria
date_default_timezone_set("America/Lima");

# Propiedades de la base de datos
const HOST = "localhost";
const USER = "root";
const PASS = "";
const DATABASE = "maven_web";
const PORT = "3306";

$cnx = ''; # Variable para la conexión

# Conexión a la base de datos
function conectar() {
    global $cnx;
    $cnx = mysqli_connect(HOST, USER, PASS, DATABASE, PORT);
    if (!$cnx) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    mysqli_query($cnx, "SET NAMES 'utf8'");
}

# Desconexión de la base de datos
function desconectar(){
    global $cnx;
    if ($cnx) {
        mysqli_close($cnx);
    }
}

# Consultas a la Base de datos
function consultar($query) {
    global $cnx;
    $result = mysqli_query($cnx, $query);
    if (!$result) {
        throw new Exception(mysqli_error($cnx));
    }
    $lista = array();
    while ($registro = mysqli_fetch_assoc($result)) {
        $lista[] = $registro;
    }
    mysqli_free_result($result);
    return $lista;
}

# Ejecutar una consulta de modificación (INSERT, UPDATE, DELETE)
function ejecutar($query) {
    global $cnx;
    if (mysqli_query($cnx, $query)) {
        return true;
    } else {
        throw new Exception(mysqli_error($cnx));
    }
}
?>
