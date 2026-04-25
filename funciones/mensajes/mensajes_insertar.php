<?php
include_once 'funciones/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function limpiar_espacios($cadena) {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
    
    function formato_capital($cadena) {
        return ucwords(strtolower($cadena));
    }

    $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido'])));
    $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre']))) ;
    $celular = limpiar_espacios(strip_tags($_POST['celular'])) ;
    $correo = strtolower(limpiar_espacios(strip_tags($_POST['correo']))) ;
    $mensaje_texto = limpiar_espacios(strip_tags($_POST['mensaje_texto'])) ;

    try {
        conectar();
        $sql = "INSERT INTO mensajes (apellido, nombre, celular, correo, mensaje_texto) VALUES ('$apellido','$nombre', '$celular', '$correo', '$mensaje_texto')";
        if (ejecutar($sql)) {
            // echo "Mensaje enviado exitosamente.";
        } else {
            echo "Error al enviar el mensaje: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }    
}

?>