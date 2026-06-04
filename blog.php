<?php
include_once 'funciones/conexion.php';
sesion_segura();
redirigir_si_autenticado();
include_once 'funciones/blogs/blogs_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Blog</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <h1 class="titulo-1">Blog</h1>
            <?php if (empty($blogs)): ?>
                <p class="empty-state">Próximamente publicaremos contenido. ¡Vuelve pronto!</p>
            <?php else: ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="tarjeta">
                        <div class="tarjeta-info">
                            <h3><?php echo e($blog['titulo']); ?></h3>
                            <p class="tarjeta-texto"><?php echo e($blog['contenido']); ?></p>
                            <p><?php echo e($blog['fecha']); ?></p>
                            <span><?php echo e($blog['id_editor']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
