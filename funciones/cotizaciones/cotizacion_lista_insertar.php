<?php
// session_start();

function limpiar_espacios($cadena) {
    return trim(preg_replace('/\s+/', ' ', $cadena));
}

function formato_capital($cadena) {
    return ucwords(strtolower($cadena));
}

    // Inicializar arrays en la sesión si no están ya inicializados
    if (isset($_POST['funcion']) && $_POST['funcion'] == 'insertar_lista') {
        if (!isset($_SESSION['cotizaciones'])) {
            $_SESSION['cotizaciones'] = array();
            $_SESSION['codigo_random'] = rand(10000,99999);
        }
       
    // Capturar y limpiar los datos del formulario
    $codigo = isset($_SESSION['codigo_random']) ? limpiar_espacios(htmlspecialchars($_SESSION['codigo_random'], ENT_QUOTES, 'UTF-8')) : '';
    $id_cliente = $_POST['id_cliente'] ? limpiar_espacios(htmlspecialchars($_POST['id_cliente'], ENT_QUOTES, 'UTF-8')) : '';
    $id_servicio = $_POST['id_servicio'] ? limpiar_espacios(htmlspecialchars($_POST['id_servicio'], ENT_QUOTES, 'UTF-8')) : '';
    $nombre_servicio = $_POST['nombre_servicio'] ? formato_capital(limpiar_espacios(htmlspecialchars($_POST['nombre_servicio'], ENT_QUOTES, 'UTF-8'))) : '';
    $detalle_servicio = $_POST['detalle_servicio'] ? limpiar_espacios(strip_tags($_POST['detalle_servicio'], '<p><a>')) : '';
    $precio = $_POST['precio'] ? limpiar_espacios(htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8')) : '';

    // Almacenar los datos en el array de la sesión
    $_SESSION['cotizaciones'][] = array(
        'codigo' => $codigo,
        'id_cliente' => $id_cliente,
        'id_servicio' => $id_servicio,
        'nombre_servicio' => $nombre_servicio,
        'detalle_servicio' => $detalle_servicio,
        'precio' => $precio
    );
    // Redirigir con mensaje de éxito usando SweetAlert
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Cotización almacenada exitosamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = 'cotizacion.php'; // Cambia esto a la URL adecuada
                });
            });
          </script>";
    }
?>