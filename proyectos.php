<?php
include_once 'funciones/conexion.php';
sesion_segura();
redirigir_si_autenticado();
include_once 'funciones/proyectos/proyectos_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Proyectos</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <h1 class="titulo-1">Proyectos</h1>
            <?php if (!empty($proyectos)): ?>
                <div class="tarjetas-grid">
                <?php foreach ($proyectos as $p): ?>
                    <div class="tarjeta">
                        <div>
                            <figure>
                                <img src="<?php echo e($p['imagen']); ?>" alt="Imagen de <?php echo e($p['nombre']); ?>">
                            </figure>
                        </div>
                        <div class="tarjeta-info">
                            <h2 class="tarjeta-titulo"><?php echo e($p['nombre']); ?></h2>
                            <p class="tarjeta-texto"><?php echo e($p['detalle']); ?></p>
                            <p class="tarjeta-rubro"><?php echo e($p['rubro']); ?></p>
                            <input type="hidden" name="id_proyecto" value="<?php echo e($p['id_proyecto']); ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No hay proyectos disponibles.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
    <script src="js/carrito.js"></script>
    <script>
        function mostrarId(element) {
            const id = element.getAttribute('data-id');
            console.log('ID del botón: ' + id);
        }
    </script>
</body>
</html>
