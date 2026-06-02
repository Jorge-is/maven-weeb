<?php
session_start();
if (!isset($_SESSION["rol_administrador"]) || $_SESSION["rol_administrador"] !== "administradores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/conexion.php';
include_once '../funciones/mensajes/mensajes_eliminar.php';
include_once '../funciones/mensajes/mensajes_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Mensajes</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="jumbo-tabla">
                        <h1 class="titulo-1">Gestionar Mensajes</h1>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Mensaje</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mensajes as $mensaje): ?>
                                        <tr>
                                            <td><?php echo e($mensaje['apellido']); ?></td>
                                            <td><?php echo e($mensaje['nombre']); ?></td>
                                            <td><?php echo e($mensaje['celular']); ?></td>
                                            <td><?php echo e($mensaje['correo']); ?></td>
                                            <td><?php echo e($mensaje['mensaje_texto']); ?></td>
                                            <td>
                                                <form method="POST" action="mensajes_administrador.php" onsubmit="return confirm('¿Estás seguro de eliminar este mensaje?');" style="display:inline;">
                                                    <input type="hidden" name="id_mensaje" value="<?php echo (int)$mensaje['id_mensaje']; ?>">
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
