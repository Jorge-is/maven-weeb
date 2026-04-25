<?php 

if (isset($_POST['id_cliente']) && isset($_POST['funcion']) && $_POST['funcion'] == 'actualizar') { 

    function limpiar_espacios($cadena) { 
        return trim(preg_replace('/\s+/', ' ', $cadena)); 
    } 

    function formato_capital($cadena) { 
        return ucwords(strtolower($cadena)); 
    } 

    $id_cliente = intval($_POST['id_cliente']); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        define("AES_KEY", "clave_secreta_para_aes");
        $apellido = formato_capital(limpiar_espacios(strip_tags($_POST['apellido']))); 
        $nombre = formato_capital(limpiar_espacios(strip_tags($_POST['nombre']))); 
        $correo = strtolower(limpiar_espacios(strip_tags($_POST['correo'])));
        $usuario = formato_capital(limpiar_espacios(strip_tags($_POST['usuario']))); 
        $clave = limpiar_espacios(strip_tags($_POST['clave'])); 

        try { 
            $conn = conectar(); // Establecer la conexión a la base de datos
            $clave_cifrada = "AES_ENCRYPT('$clave', '" . AES_KEY . "')";
            $sql = "UPDATE clientes  
                    SET apellido = '$apellido', nombre = '$nombre', correo = '$correo', usuario = '$usuario', clave = $clave_cifrada
                    WHERE id_cliente = $id_cliente"; 
            if (ejecutar($sql)) { 
                echo "Servicio actualizado exitosamente."; 
            } else { 
                echo "Error al actualizar el servicio: " . mysqli_error($cnx); 
            } 
            desconectar(); 
        } catch (Exception $ex) { 
            die($ex->getMessage()); 
        } 
    } 
} 
?>
