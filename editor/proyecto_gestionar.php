<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_editor"]) || $_SESSION["rol_editor"] !== "editores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/proyectos/proyectos_actualizar.php';
include_once '../funciones/proyectos/proyectos_eliminar.php';
include_once '../funciones/proyectos/proyectos_insertar.php';
include_once '../funciones/proyectos/proyectos_consultar_id.php';
include_once '../funciones/proyectos/proyectos_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Gestionar Proyectos</title>
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
                                <legend>Registrar proyectos</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id_proyecto" value="<?php echo (int)($id_proyecto ?? 0); ?>">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba su nombre" value="<?php echo e($nombre ?? ''); ?>" maxlength="50" required>
                                <label for="detalle">Detalle</label>
                                <input type="text" id="detalle" name="detalle" placeholder="Escriba su detalle" value="<?php echo e($detalle ?? ''); ?>" maxlength="50" required>
                                <label for="imagen">Imagen</label>
                                <input type="text" id="imagen" name="imagen" placeholder="Escriba la ruta de la imagen" value="<?php echo e($imagen ?? ''); ?>" maxlength="50" required>
                                <label for="rubro">Rubro</label>
                                <input type="text" id="rubro" name="rubro" placeholder="Escriba su rubro" value="<?php echo e($rubro ?? ''); ?>" maxlength="50" required>
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" name="fecha" value="<?php echo e($fecha ?? ''); ?>" required>
                                <input type="hidden" name="id_editor" value="<?php echo (int)$_SESSION['id_editor']; ?>">
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
                        <h1 class="titulo-tabla">Gestionar proyectos</h1>
                        <a href="proyecto_gestionar.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir proyecto</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Detalle</th>
                                        <th>Imagen</th>
                                        <th>Rubro</th>
                                        <th>Fecha</th>
                                        <th>Editor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($proyectos as $proyecto): ?>
                                        <tr>
                                            <td><?php echo e($proyecto['nombre']); ?></td>
                                            <td><?php echo e($proyecto['detalle']); ?></td>
                                            <td><img src="../<?php echo e($proyecto['imagen']); ?>" alt="Imagen del proyecto" width="50" height="50"></td>
                                            <td><?php echo e($proyecto['rubro']); ?></td>
                                            <td><?php echo e($proyecto['fecha']); ?></td>
                                            <td><?php echo (int)$proyecto['id_editor']; ?></td>
                                            <td>
                                                <a href="proyecto_gestionar.php?id_proyecto=<?php echo (int)$proyecto['id_proyecto']; ?>&funcion=actualizar">
                                                    <button class="boton boton-actualizar">Actualizar</button>
                                                </a>
                                                <form method="POST" action="proyecto_gestionar.php" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?');" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                                    <input type="hidden" name="id_proyecto" value="<?php echo (int)$proyecto['id_proyecto']; ?>">
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
                    <h1 class="titulo-1">Vista previa</h1>
                    <?php if (!empty($proyectos)): ?>
                        <?php foreach ($proyectos as $p): ?>
                            <div class="tarjeta">
                                <div>
                                    <figure>
                                        <img src="../<?php echo e($p['imagen']); ?>" alt="Imagen de <?php echo e($p['nombre']); ?>">
                                    </figure>
                                </div>
                                <div class="tarjeta-info">
                                    <h2 class="tarjeta-titulo"><?php echo e($p['nombre']); ?></h2>
                                    <p class="tarjeta-texto"><?php echo e($p['detalle']); ?></p>
                                    <p class="tarjeta-rubro"><?php echo e($p['rubro']); ?></p>
                                    <input type="hidden" name="id_proyecto" value="<?php echo (int)$p['id_proyecto']; ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay proyectos disponibles.</p>
                    <?php endif; ?>
                </article>
            </section>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
