<?php
include_once 'funciones/conexion.php';
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
            <?php
                foreach ($blogs as $blog) {
                    echo "
                    <div class='tarjeta'>
                        <div class='tarjeta-info'>
                            <h3>{$blog['titulo']}</h3>
                            <p class='tarjeta-texto'>{$blog['contenido']}</p>
                            <p class=''>{$blog['fecha']}</p>
                            <span>{$blog['id_editor']}</span>
                        </div>
                    </div>";
                }
            ?> 
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>

</html>