<?php
include_once 'funciones/conexion.php';
include_once 'funciones/inicio/inicio_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>WEEB MAVEN | Inicio</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="banners flex-center">
            <img src="imagenes/inicio/banner.png" alt="dispositivo1">
        </div>
        <div class="container">
            <h1 class="titulo-1">Últimos sitios web</h1>
            <section class="album flex-center">
                <article class="flex-center">
                    <div>
                        <img src="imagenes/proyectos/pasteleria1.jpg" alt="pasteleria1">
                        <p>Pastelería</p>
                    </div>
                    <div>
                        <img src="imagenes/proyectos/ferreteria1.jpg" alt="ferreteria2">
                        <p>Ferretería</p>
                    </div>
                    <div>
                        <img src="imagenes/proyectos/restaurante1.jpg" alt="restaurante1">
                        <p>Restaurante</p>
                    </div>
                    <div>
                        <img src="imagenes/proyectos/floreria1.jpg" alt="floreria1">
                        <p>Florería</p>
                    </div>
                </article>
            </section>
            <section class="jumbo">
                <article class="flex-center">
                    <div class="jumbo-info">
                        <h1><?php echo e($inicio[0]['titulo']); ?></h1>
                        <p><?php echo e($inicio[0]['texto']); ?></p>
                    </div>
                    <div class="jumbo-img">
                        <figure>
                            <img src="imagenes/inicio/elegirnos.jpg" alt="Por qué elegirnos - equipo Maven Web">
                        </figure>
                    </div>
                </article>
            </section>
            <section class="jumbo-2">
                <article class="flex-center">
                    <div class="lado-1 flex-center">
                        <h2 class="titulo-1">Diseño web</h2>
                        <img src="<?php echo e($inicio[0]['disenio_uno']); ?>" alt="polleria">
                        <img src="<?php echo e($inicio[0]['disenio_dos']); ?>" alt="restaurante3">
                        <h3><strong>Diseños</strong> a la medida de nuestros clientes</h3>
                    </div>
                    <div class="lado-2 flex-center">
                        <h2 class="titulo-1">Desarrollo web</h2>
                        <img src="<?php echo e($inicio[0]['desarrollo_uno']); ?>" alt="desarrollo">
                        <img src="<?php echo e($inicio[0]['desarrollo_dos']); ?>" alt="nosotros_diseño">
                        <h3><strong>Desarrollo</strong> con las últimas actualizaciones</h3>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
