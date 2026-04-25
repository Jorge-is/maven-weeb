<?php
session_start();
if ($_SESSION["rol_cliente"] != "clientes") {
    header("Location: ../iniciar_sesion.php");
}
include_once '../funciones/conexion.php';
// include_once '../funciones/cotizaciones/cotizacion_insertar.php';
include_once '../funciones/cotizaciones/cotizacion_lista_eliminar.php';
include_once '../funciones/cotizaciones/cotizacion_lista_insertar.php';
include_once '../funciones/cotizaciones/cotizacion_insertar_lista.php';
include_once '../funciones/cotizaciones/cotizacion_lista_consultar.php';
include_once '../funciones/cotizaciones/cotizacion_lista_total.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Cotizaciones</title>
    <?php require_once './fragments/links.php'; ?>
</head>

<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="jumbo-form">
                        <div class="tarjeta">
                            <div class="informacion_cliente">
                                <div class="titulo">
                                    <h3>Informacion del cliente</h3>
                                </div>
                                <div class="left">

                                    <?php if (isset($_SESSION["nombre_cliente"])) { ?>
                                        <div class="info">
                                            <h3>Cliente</h3>
                                            <h2><?php echo $_SESSION["nombre_cliente"]; ?></h2>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cotizaciones[0]['codigo'] ?? null) { ?>
                                        <div class="info">
                                            <h3>Codigo</h3>
                                            <h2><?php echo $cotizaciones[0]['codigo']; ?></h2>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <h4>Total de la cotización</h4>
                            <h2><?php echo "S/." . number_format($total_precio, 2); ?></h2>
                            <?php if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])) { ?>
                                <form method='POST' action='cotizacion.php' style='display:inline;'>
                                    <input type='hidden' name='funcion' value='insertar'>
                                    <button class='boton-mediano boton-insertar' type='submit'>Enviar cotización</button>
                                </form>
                            <?php } else { ?>
                                <button class='boton-mediano boton-secundario' disabled>Enviar cotización</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="jumbo-tabla">
                        <h1 class="titulo-tabla">Cotizaciones</h1>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
                                        <th>Nombre</th>
                                        <th>Detalle</th>
                                        <th>Precio</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Verificar si existe el array de cotizaciones en la sesión
                                    if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])) {
                                        // Iterar sobre cada cotización en el array
                                        foreach ($_SESSION['cotizaciones'] as $key => $cotizacion) {
                                            // Imprimir cada fila de la tabla con los datos de la cotización
                                            echo "<tr>
                                                    <td>{$cotizacion['id_cliente']}</td>
                                                    <td>{$cotizacion['id_servicio']}</td>
                                                    <td>{$cotizacion['nombre_servicio']}</td>
                                                    <td>{$cotizacion['detalle_servicio']}</td>
                                                    <td>S/." . number_format($cotizacion['precio'], 2) . "</td>
                                                    <td>
                                                        <form method='POST' action='cotizacion.php' onsubmit='return confirm(\"¿Estás seguro de eliminar esta cotización?\");' style='display:inline;'>
                                                            <input type='hidden' name='key' value='{$key}'>
                                                            <input type='hidden' name='funcion' value='eliminar'>
                                                            <button class='boton boton-eliminar' type='submit'>Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        // Mostrar un mensaje si no hay cotizaciones
                                        echo "<tr>
                                                <td colspan='6'>No hay cotizaciones disponibles.</td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>

</html>