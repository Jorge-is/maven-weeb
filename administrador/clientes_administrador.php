<?php
session_start();
if (!isset($_SESSION["rol_administrador"]) || $_SESSION["rol_administrador"] !== "administradores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/conexion.php';
include_once '../funciones/clientes/clientes_actualizar.php';
include_once '../funciones/clientes/clientes_eliminar.php';
include_once '../funciones/clientes/clientes_insertar.php';
include_once '../funciones/clientes/clientes_consultar_por_id.php';
include_once '../funciones/clientes/clientes_consultar.php';
$actualizando = isset($_GET['funcion']) && $_GET['funcion'] === 'actualizar';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Administrar Clientes</title>
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
                                <legend>Administrar Clientes</legend>
                                <input type="hidden" name="id_cliente" value="<?php echo e($id_cliente); ?>">
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
                        <h1 class="titulo-tabla">Gestionar clientes</h1>
                        <a href="clientes_administrador.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir cliente</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo e($cliente['apellido']); ?></td>
                                            <td><?php echo e($cliente['nombre']); ?></td>
                                            <td><?php echo e($cliente['correo']); ?></td>
                                            <td><?php echo e($cliente['usuario']); ?></td>
                                            <td>
                                                <a href="clientes_administrador.php?id_cliente=<?php echo (int)$cliente['id_cliente']; ?>&funcion=actualizar">
                                                    <button class="boton boton-actualizar">Actualizar</button>
                                                </a>
                                                <form method="POST" action="clientes_administrador.php" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');" style="display:inline;">
                                                    <input type="hidden" name="id_cliente" value="<?php echo (int)$cliente['id_cliente']; ?>">
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
