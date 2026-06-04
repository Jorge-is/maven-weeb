<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_cliente"]) || $_SESSION["rol_cliente"] !== "clientes") {
    header("Location: ../iniciar_sesion.php");
    exit();
}
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
                                    <?php if (isset($_SESSION["nombre_cliente"])): ?>
                                        <div class="info">
                                            <h3>Cliente</h3>
                                            <h2><?php echo e($_SESSION["nombre_cliente"]); ?></h2>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($cotizaciones[0]['codigo'] ?? null): ?>
                                        <div class="info">
                                            <h3>Codigo</h3>
                                            <h2><?php echo e($cotizaciones[0]['codigo']); ?></h2>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h4>Total de la cotización</h4>
                            <h2>S/.<?php echo number_format($total_precio, 2); ?></h2>
                            <?php if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])): ?>
                                <form method="POST" action="cotizacion.php" style="display:inline;">
                                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="funcion" value="insertar">
                                    <button class="boton-mediano boton-insertar" type="submit">Enviar cotización</button>
                                </form>
                            <?php else: ?>
                                <button class="boton-mediano boton-secundario" disabled>Enviar cotización</button>
                            <?php endif; ?>
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
                                    <?php if (isset($_SESSION['cotizaciones']) && !empty($_SESSION['cotizaciones'])): ?>
                                        <?php foreach ($_SESSION['cotizaciones'] as $key => $cotizacion): ?>
                                            <tr>
                                                <td><?php echo (int)$cotizacion['id_cliente']; ?></td>
                                                <td><?php echo (int)$cotizacion['id_servicio']; ?></td>
                                                <td><?php echo e($cotizacion['nombre_servicio']); ?></td>
                                                <td><?php echo e($cotizacion['detalle_servicio']); ?></td>
                                                <td>S/.<?php echo number_format((float)$cotizacion['precio'], 2); ?></td>
                                                <td>
                                                    <form method="POST" action="cotizacion.php" onsubmit="return confirm('¿Estás seguro de eliminar esta cotización?');" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                                        <input type="hidden" name="key" value="<?php echo (int)$key; ?>">
                                                        <input type="hidden" name="funcion" value="eliminar">
                                                        <button class="boton boton-eliminar" type="submit">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No hay cotizaciones disponibles.</td>
                                        </tr>
                                    <?php endif; ?>
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
