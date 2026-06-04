<?php
include_once 'funciones/conexion.php';
sesion_segura();
redirigir_si_autenticado();
include_once 'funciones/empresa/empresa_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Nosotros</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <section class="jumbo">
            <article class="flex-center">
                <h3 class="titulo-1">¿QUIÉNES SOMOS?</h3>
                <div class="jumbo-img">
                    <img src="imagenes/conocenos/trabajo_en_equipo.jpg" alt="trabajo_en_equipo">
                </div>
                <div class="jumbo-info">
                    <p><?php echo e($empresa[0]['quienes_somos']); ?></p>
                </div>
            </article>
            <article class="flex-center">
                <h3 class="titulo-1">MISIÓN</h3>
                <div class="jumbo-info">
                    <p><?php echo e($empresa[0]['mision']); ?></p>
                </div>
                <div class="jumbo-img">
                    <img src="imagenes/conocenos/disenos_a_la_medida.jpg" alt="diseño_a_medida1">
                </div>
            </article>
            <article class="flex-center">
                <h3 class="titulo-1">VISIÓN</h3>
                <div class="jumbo-img">
                    <img src="imagenes/conocenos/vision.jpg" alt="vision">
                </div>
                <div class="jumbo-info">
                    <p><?php echo e($empresa[0]['vision']); ?></p>
                </div>
            </article>
            <article class="flex-center">
                <h3 class="titulo-1">VALORES</h3>
                <div class="jumbo-info">
                    <p><?php echo e($empresa[0]['valores']); ?></p>
                </div>
                <div class="jumbo-img">
                    <img src="imagenes/conocenos/valores.jpg" alt="valores">
                </div>
            </article>
        </section>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
