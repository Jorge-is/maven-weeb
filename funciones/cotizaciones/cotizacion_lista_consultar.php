<?php
// session_start();

// Verificar si la sesión tiene cotizaciones almacenadas
if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])) {
    // Obtener el array de cotizaciones de la sesión
    $cotizaciones = $_SESSION['cotizaciones'];
} else {
    // Si no hay cotizaciones, inicializar como array vacío
    $cotizaciones = [];
}
?>