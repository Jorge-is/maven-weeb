<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'insertar') {
    function limpiar_espacios($cadena){
        return trim($cadena);
    }

    function formato_capital($texto){
        return ucwords(strtolower($texto));
    }

    $apellido = isset($_POST['apellido']) ? formato_capital(limpiar_espacios(strip_tags($_POST['apellido']))) : '';
    $nombre = isset($_POST['nombre']) ? formato_capital(limpiar_espacios(strip_tags($_POST['nombre']))) : '';
    $correo = isset($_POST['correo']) ? strip_tags(trim($_POST['correo'])) : '';
    $usuario = isset($_POST['usuario']) ? formato_capital(limpiar_espacios(strip_tags($_POST['usuario']))) : '';
    $clave = isset($_POST['clave']) ? formato_capital(limpiar_espacios(strip_tags($_POST['clave']))) : '';

    // Validar que todos los campos necesarios estén presentes
    if ($nombre && $correo && $usuario && $clave) {
        try {
            conectar();
            $apellido = mysqli_real_escape_string($cnx, $apellido);
            $nombre = mysqli_real_escape_string($cnx, $nombre);
            $correo = mysqli_real_escape_string($cnx, $correo);
            $usuario = mysqli_real_escape_string($cnx, $usuario);
            $clave = mysqli_real_escape_string($cnx, $clave);

            $sql = "INSERT INTO clientes (apellido, nombre, correo, usuario, clave) VALUES ('$apellido', '$nombre', '$correo', '$usuario', '$clave')";

            if (ejecutar($sql)) {
                echo "Cliente creado exitosamente.";
            } else {
                echo "Error al crear el cliente: " . mysqli_error($cnx);
            }
            desconectar();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>