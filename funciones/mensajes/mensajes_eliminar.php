<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    $id_mensaje = intval($_POST['id_mensaje']);

    try {
        conectar();
        $sql = "DELETE FROM mensajes WHERE id_mensaje = $id_mensaje";
        if (ejecutar($sql)) {
            echo "Mensaje eliminado exitosamente.";
        } else {
            echo "Error al eliminar el mensaje: " . mysqli_error($cnx);
        }
        desconectar();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
// if (isset($_GET['id_mensaje']) && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
//     $id_mensaje = intval($_GET['id_mensaje']);

//     try {
//         conectar();
//         $sql = "DELETE FROM mensajes WHERE id_mensaje = $id_mensaje";
//         if (ejecutar($sql)) {
//             echo "Mensaje eliminado exitosamente.";
//         } else {
//             echo "Error al eliminar el mensaje: " . mysqli_error($cnx);
//         }
//         desconectar();
//     } catch (Exception $ex) {
//         die($ex->getMessage());
//     }
// } else {
//     echo "ID de mensaje no proporcionado.";
// }
?>
