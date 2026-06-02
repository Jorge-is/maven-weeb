<?php
// session_start();

function eliminarCotizacion($key) {
    if (isset($_SESSION['cotizaciones'][$key])) {
        unset($_SESSION['cotizaciones'][$key]);
        // Re-indexar el array para evitar problemas con las claves
        $_SESSION['cotizaciones'] = array_values($_SESSION['cotizaciones']);
    }

    // Redirigir con mensaje de éxito usando SweetAlert
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Cotización eliminada exitosamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = 'cotizacion.php'; // Cambia esto a la URL adecuada
                });
            });
          </script>";
}

// Verificar si el formulario fue enviado para eliminar una cotización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['funcion']) && $_POST['funcion'] == 'eliminar') {
    csrf_verificar();
    $key = (int)$_POST['key'];
    eliminarCotizacion($key);
}
?>
