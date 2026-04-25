<?php
include_once 'funciones/conexion.php';
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
            <?php
            if (!empty($proyectos)) {
                foreach ($proyectos as $p) :
            ?>
                    <div class="tarjeta">
                        <div>
                            <figure>
                                <img src="<?php echo $p['imagen']; ?>" alt="Imagen de <?php echo $p['nombre']; ?>">
                            </figure>
                        </div>
                        <div class="tarjeta-info">
                            <h2 class="tarjeta-titulo"><?php echo $p['nombre']; ?></h2>
                            <p class="tarjeta-texto"><?php echo $p['detalle']; ?></p>
                            <p class="tarjeta-rubro"><?php echo $p['rubro']; ?></p>
                            <input type="hidden" name="id_proyecto" value="<?php echo $p['id_proyecto']; ?>">
                        </div>
                    </div>
            <?php 
                endforeach;
            } else {
                echo "<p>No hay proyectos disponibles.</p>";
            }
            ?>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
<script src="js/carrito.js"></script>
<script>
    function mostrarId(element) {
        const id = element.getAttribute('data-id');
        console.log('ID del botón: ' + id);
    }
</script>
</html>