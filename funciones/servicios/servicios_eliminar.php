<?php 

if (isset($_POST['id_servicio']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
        $id_servicio = intval($_POST['id_servicio']); 
        try { 
            conectar(); 
            $sql = "DELETE FROM servicios WHERE id_servicio = '$id_servicio'"; 
            if (ejecutar($sql)) { 
                echo "Servicio eliminado exitosamente."; 
            } else { 
                echo "Error al eliminar el servicio: " . mysqli_error($cnx); 
            } 
            desconectar(); 
        } catch (Exception $ex) { 
            die($ex->getMessage()); 
        } 
} else { 
    echo "ID de servicio no válido."; 
} 

function limpiar_numero($numero) { 
    return preg_replace('/[^0-9]/', '', $numero); 
} 

?> 