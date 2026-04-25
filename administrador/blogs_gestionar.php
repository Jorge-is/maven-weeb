<?php
session_start(); 
if ($_SESSION["rol_administrador"]!="administradores") {
    header("Location: administrador/index.php");
}
include_once '../funciones/conexion.php';
include_once '../funciones/blogs/blogs_actualizar.php';
include_once '../funciones/blogs/blogs_eliminar.php';
include_once '../funciones/blogs/blogs_insertar.php';
include_once '../funciones/blogs/blogs_consultar_por_id.php';
include_once '../funciones/blogs/blogs_consultar.php';
?>

<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Blogs</title>
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
                                <legend>Registrar blog</legend>
                                <input type="hidden" id="id_blog" name="id_blog" value="<?php echo $id_blog; ?>" required />

                                <label for="titulo">Título:</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Escriba el título del blog" value="<?php echo $titulo; ?>" required />

                                <label for="imagen">Imagen:</label>
                                <input type="text" id="imagen" name="imagen" placeholder="Escriba la ruta de la imagen" value="<?php echo $imagen; ?>" required />

                                <label for="contenido">Contenido:</label>
                                <textarea id="contenido" name="contenido" placeholder="Escriba el contenido del blog"required> <?php echo $contenido; ?> </textarea>

                                <label for="fecha">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required />

                                <label for="hora">Hora:</label>
                                <input type="time" id="hora" name="hora" value="<?php echo $hora; ?>" required />
                                <input type="hidden" id="id_editor" name="id_editor" value="13" required />
                                <?php
                                if (isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') {
                                ?>
                                    <input type="hidden" id="funcion" name="funcion" value="actualizar" maxlength="50" required />
                                    <button class="boton-mediano boton-actualizar" type="submit">Actualizar</button>
                                <?php
                                } else {
                                ?>
                                    <input type="hidden" id="funcion" name="funcion" value="insertar" maxlength="50" required />
                                    <button class="boton-mediano boton-insertar" type="submit">Insertar</button>
                                <?php
                                }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-tabla">
                        <h1 class="titulo-tabla">Gestionar blogs</h1>
                        <a href="blogs_gestionar.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir blog</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Imagen</th>
                                        <th>Contenido</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Editor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($blogs as $blog) {
                                        echo "<tr> 
                                                <td>{$blog['titulo']}</td> 
                                                <td><img src='{$blog['imagen']}' alt='Imagen del blog' width='50' height='50'></td> 
                                                <td>{$blog['contenido']}</td> 
                                                <td>{$blog['fecha']}</td> 
                                                <td>{$blog['hora']}</td> 
                                                <td>{$blog['id_editor']}</td> 
                                                <td> 
                                                <a href='blogs_gestionar.php?id_blog={$blog['id_blog']}&funcion=actualizar'> 
                                                    <button class='boton boton-actualizar'>Actualizar</button> 
                                                </a> 
                                                <form method='POST' action='blogs_gestionar.php' onsubmit='return confirm(\"¿Estás seguro de eliminar este blog?\");' style='display:inline;'> 
                                                    <input type='hidden' name='id_blog' value='{$blog['id_blog']}'> 
                                                    <input type='hidden' name='funcion' value='eliminar'> 
                                                <button class='boton boton-eliminar' type='submit'>Eliminar</button> 
                                                </form> 
                                                </td> 
                                            </tr>";
                                    }
                                    ?>
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