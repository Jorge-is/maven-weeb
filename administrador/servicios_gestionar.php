<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_administrador"]) || $_SESSION["rol_administrador"] !== "administradores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/servicios/servicios_actualizar.php';
include_once '../funciones/servicios/servicios_eliminar.php';
include_once '../funciones/servicios/servicios_insertar.php';
include_once '../funciones/servicios/servicios_consultar_por_id.php';
include_once '../funciones/servicios/servicios_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Servicios</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="jumbo-form">
                        <form id="contactForm" method="POST" action="" class="formulario">
                            <fieldset>
                                <legend>Registrar servicios</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id_servicio" value="<?php echo (int)($id_servicio ?? 0); ?>">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba el nombre" value="<?php echo e($nombre ?? ''); ?>" maxlength="50" required>
                                <label for="detalle">Detalle</label>
                                <input type="text" id="detalle" name="detalle" placeholder="Escriba la descripcion" value="<?php echo e($detalle ?? ''); ?>" maxlength="50" required>
                                <label for="precio">Precio</label>
                                <input type="number" id="precio" name="precio" placeholder="Escriba el precio del servicio" value="<?php echo e($precio ?? ''); ?>" step="0.01" required>
                                <?php if (isset($_GET['funcion']) && $_GET['funcion'] === 'actualizar'): ?>
                                    <input type="hidden" name="funcion" value="actualizar">
                                    <button class="boton-mediano boton-actualizar" type="submit">Actualizar</button>
                                <?php else: ?>
                                    <input type="hidden" name="funcion" value="insertar">
                                    <button class="boton-mediano boton-insertar" type="submit">Insertar</button>
                                <?php endif; ?>
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-tabla">
                        <h1 class="titulo-tabla">Gestionar servicios</h1>
                        <a href="servicios_gestionar.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir servicio</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Detalle</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($servicios as $servicio): ?>
                                        <tr>
                                            <td data-label="Nombre"><?php echo e($servicio['nombre']); ?></td>
                                            <td data-label="Detalle"><?php echo e($servicio['detalle']); ?></td>
                                            <td data-label="Precio"><?php echo e($servicio['precio']); ?></td>
                                            <td>
                                                <a href="servicios_gestionar.php?id_servicio=<?php echo (int)$servicio['id_servicio']; ?>&funcion=actualizar">
                                                    <button class="boton boton-actualizar">Actualizar</button>
                                                </a>
                                                <form method="POST" action="servicios_gestionar.php" onsubmit="return confirm('¿Estás seguro de eliminar este servicio?');" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                                    <input type="hidden" name="id_servicio" value="<?php echo (int)$servicio['id_servicio']; ?>">
                                                    <input type="hidden" name="funcion" value="eliminar">
                                                    <button class="boton boton-eliminar" type="submit">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
