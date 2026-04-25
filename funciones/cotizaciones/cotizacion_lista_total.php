<?php
// session_start();

function calcularTotal() {
    $total_precio = 0;
    if (isset($_SESSION['cotizaciones'])) {
        foreach ($_SESSION['cotizaciones'] as $cotizacion) {
            $total_precio +=(float)$cotizacion['precio'];
        }
    }
    echo var_dump($total_precio);
    return $total_precio;
}

// Calcular el total de precios
$total_precio = calcularTotal();
?>
