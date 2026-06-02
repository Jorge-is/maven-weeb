<?php
sesion_segura();
if (!isset($_SESSION["rol_editor"]) || $_SESSION["rol_editor"] !== "editores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/conexion.php';
include_once '../funciones/inicio/inicio_consultar.php';
include_once '../funciones/inicio/inicio_actualizar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Gestionar Inicio</title>
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
                                <legend>Modificar inicio</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id_inicio" value="<?php echo (int)$inicio[0]['id_inicio']; ?>">
                                <label for="banner">Banner:</label>
                                <input type="text" name="banner" id="banner" value="<?php echo e($inicio[0]['banner']); ?>" required>
                                <label for="titulo">Título:</label>
                                <input type="text" name="titulo" id="titulo" value="<?php echo e($inicio[0]['titulo']); ?>" required>
                                <label for="texto">Texto:</label>
                                <textarea name="texto" id="texto" required><?php echo e($inicio[0]['texto']); ?></textarea>
                                <label for="disenio_uno">Diseño Uno:</label>
                                <input type="text" name="disenio_uno" id="disenio_uno" value="<?php echo e($inicio[0]['disenio_uno']); ?>" required>
                                <label for="disenio_dos">Diseño Dos:</label>
                                <input type="text" name="disenio_dos" id="disenio_dos" value="<?php echo e($inicio[0]['disenio_dos']); ?>" required>
                                <label for="desarrollo_uno">Desarrollo Uno:</label>
                                <input type="text" name="desarrollo_uno" id="desarrollo_uno" value="<?php echo e($inicio[0]['desarrollo_uno']); ?>" required>
                                <label for="desarrollo_dos">Desarrollo Dos:</label>
                                <input type="text" name="desarrollo_dos" id="desarrollo_dos" value="<?php echo e($inicio[0]['desarrollo_dos']); ?>" required>
                                <input type="hidden" name="id_editor" value="<?php echo (int)$_SESSION['id_editor']; ?>">
                                <input type="hidden" name="funcion" value="actualizar">
                                <button class="submit-button" type="submit">Actualizar</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-info">
                        <div class="tarjeta">
                            <h4>Banner</h4>
                            <p><?php echo e($inicio[0]['banner']); ?></p>
                            <h4>Título</h4>
                            <p><?php echo e($inicio[0]['titulo']); ?></p>
                            <h4>Texto</h4>
                            <p><?php echo e($inicio[0]['texto']); ?></p>
                            <h4>Diseño Uno</h4>
                            <p><?php echo e($inicio[0]['disenio_uno']); ?></p>
                            <h4>Diseño Dos</h4>
                            <p><?php echo e($inicio[0]['disenio_dos']); ?></p>
                            <h4>Desarrollo Uno</h4>
                            <p><?php echo e($inicio[0]['desarrollo_uno']); ?></p>
                            <h4>Desarrollo Dos</h4>
                            <p><?php echo e($inicio[0]['desarrollo_dos']); ?></p>
                            <h4>Editor</h4>
                            <p><?php echo (int)$inicio[0]['id_editor']; ?></p>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
</body>
</html>
