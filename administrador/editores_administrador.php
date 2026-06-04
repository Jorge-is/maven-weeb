<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_administrador"]) || $_SESSION["rol_administrador"] !== "administradores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/editores/editores_actualizar.php';
include_once '../funciones/editores/editores_eliminar.php';
include_once '../funciones/editores/editores_insertar.php';
include_once '../funciones/editores/editores_consultar_por_id.php';
include_once '../funciones/editores/editores_consultar.php';
$actualizando = isset($_GET['funcion']) && $_GET['funcion'] === 'actualizar';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Gestionar Editores</title>
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
                                <legend>Registrar editores</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id_editor" value="<?php echo e($id_editor); ?>">
                                <label for="apellido">Apellidos</label>
                                <input type="text" id="apellido" name="apellido" placeholder="Escriba sus apellidos" value="<?php echo e($apellido); ?>" maxlength="50" required>
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba sus nombres" value="<?php echo e($nombre); ?>" maxlength="50" required>
                                <label for="correo">Correo electrónico</label>
                                <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" value="<?php echo e($correo); ?>" maxlength="50" required>
                                <label for="usuario">Usuario</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Escriba su usuario" value="<?php echo e($usuario); ?>" maxlength="50" required>
                                <label for="clave">Clave</label>
                                <input type="password" id="clave" name="clave" placeholder="<?php echo $actualizando ? 'Dejar en blanco para no cambiar' : 'Escriba una clave'; ?>" maxlength="50" <?php echo $actualizando ? '' : 'required'; ?>>
                                <input type="hidden" name="id_administrador" value="<?php echo (int)$_SESSION['id_administrador']; ?>">
                                <?php if ($actualizando): ?>
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
                        <h1 class="titulo-tabla">Gestionar editores</h1>
                        <a href="editores_administrador.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir editor</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Administrador</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($editores as $editor): ?>
                                        <tr>
                                            <td><?php echo e($editor['apellido']); ?></td>
                                            <td><?php echo e($editor['nombre']); ?></td>
                                            <td><?php echo e($editor['correo']); ?></td>
                                            <td><?php echo e($editor['usuario']); ?></td>
                                            <td><?php echo (int)$editor['id_administrador']; ?></td>
                                            <td>
                                                <a href="editores_administrador.php?id_editor=<?php echo (int)$editor['id_editor']; ?>&funcion=actualizar">
                                                    <button class="boton boton-actualizar">Actualizar</button>
                                                </a>
                                                <form method="POST" action="editores_administrador.php" onsubmit="return confirm('¿Estás seguro de eliminar este editor?');" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                                    <input type="hidden" name="id_editor" value="<?php echo (int)$editor['id_editor']; ?>">
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
