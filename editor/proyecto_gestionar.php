<?php
session_start(); 
// if ($_SESSION["rol_editor"]!="editores") {
//     header("Location: index.php");
// }
include_once '../funciones/conexion.php';
include_once '../funciones/proyectos/proyectos_actualizar.php';
include_once '../funciones/proyectos/proyectos_eliminar.php';
include_once '../funciones/proyectos/proyectos_insertar.php';
include_once '../funciones/proyectos/proyectos_consultar_id.php';
include_once '../funciones/proyectos/proyectos_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Cotizaciones</title>
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
                                <legend>Registrar proyectos</legend>
                                <input type="hidden" id="nombre" name="id_proyecto" value="<?php echo $id_proyecto;?>" maxlength="50" required/>
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba su nombre" value="<?php echo $nombre; ?>" maxlength="50" required />

                                <label for="detalle">Detalle</label>
                                <input type="text" id="detalle" name="detalle" placeholder="Escriba su detalle" value="<?php echo $detalle; ?>" maxlength="50" required />

                                <label for="imagen">Imagen</label>
                                <input type="text" id="imagen" name="imagen" placeholder="Escriba su imagen" value="<?php echo $imagen; ?>" maxlength="50" required />

                                <label for="rubro">Rubro</label>
                                <input type="text" id="rubro" name="rubro" placeholder="Escriba su rubro" value="<?php echo $rubro; ?>" maxlength="50" required />

                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" name="fecha" placeholder="Escriba una fecha" value="<?php echo $fecha; ?>" maxlength="50" required />
                                <input type="hidden" id="id_editor" name="id_editor" value="13" maxlength="50" required />

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
                        <h1 class="titulo-tabla">Gestionar proyectos</h1>
                        <a href="proyecto_gestionar.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir proyecto</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Detalle</th>
                                        <th>Imagen</th>
                                        <th>Rubro</th>
                                        <th>Fecha</th>
                                        <th>Editor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($proyectos as $proyecto) {
                                        echo "<tr> 
                                                <td>{$proyecto['nombre']}</td> 
                                                <td>{$proyecto['detalle']}</td> 
                                                <td><img src='{$proyecto['imagen']}' alt='Imagen del proyecto' width='50' height='50'></td> 
                                                <td>{$proyecto['rubro']}</td> 
                                                <td>{$proyecto['fecha']}</td> 
                                                <td>{$proyecto['id_editor']}</td> 
                                                <td> 
                                                    <a href='proyecto_gestionar.php?id_proyecto={$proyecto['id_proyecto']}&funcion=actualizar'> 
                                                        <button class='boton boton-actualizar'>Actualizar</button> 
                                                    </a> 
                                                    <form method='POST' action='proyecto_gestionar.php' onsubmit='return confirm(\"¿Estás seguro de eliminar este proyecto?\");' style='display:inline;'> 
                                                        <input type='hidden' name='id_proyecto' value='{$proyecto['id_proyecto']}'> 
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
            <h1 class="titulo-1">Vista previa</h1>
            <?php
            if (!empty($proyectos)) {
                foreach ($proyectos as $p) :
            ?>
                    <div class="tarjeta">
                        <div>
                            <figure>
                                <img src="../<?php echo $p['imagen']; ?>" alt="Imagen de <?php echo $p['nombre']; ?>">
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

</html>