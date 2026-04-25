<?php
include_once '../funciones/conexion.php';
include_once '../funciones/servicios/servicios_actualizar.php';
include_once '../funciones/servicios/servicios_eliminar.php';
include_once '../funciones/servicios/servicios_insertar.php';
include_once '../funciones/servicios/servicios_consultar_por_id.php';
include_once '../funciones/servicios/servicios_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Servicios</title>
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
                                <legend>Registrar servicios</legend>
                                <input type="hidden" id="id_servicio" name="id_servicio" value="<?php echo $id_servicio; ?>" required />
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba el nombre" value="<?php echo $nombre; ?>" maxlength="50" required />
                                <label for="detalle">Detalle</label>
                                <input type="text" id="detalle" name="detalle" placeholder="Escriba la descripcion" value="<?php echo $detalle; ?>" maxlength="50" required />
                                <label for="precio">Precio</label>
                                <input type="number" id="precio" name="precio" placeholder="Escriba el precio del servicio" value="<?php echo $precio; ?>" maxlength="50" required />
                                <input type="hidden" name="id_editor" value="<?php echo $_SESSION['id_editor']; ?>" required />
                                
                                <?php if (isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') { ?>
                                    <input type="hidden" id="funcion" name="funcion" value="actualizar" required />
                                    <button class="boton-mediano boton-actualizar" type="submit">Actualizar</button>
                                <?php } else { ?>
                                    <input type="hidden" id="funcion" name="funcion" value="insertar" required />
                                    <button class="boton-mediano boton-insertar" type="submit">Insertar</button>
                                <?php } ?>
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-tabla">
                        <h1 class="titulo-tabla">Gestionar servicios</h1>
                        <a href="servicios_gestionar.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir servicio</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Detalle</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($servicios as $servicio) {
                                        echo "<tr>
                                        <td>{$servicio['nombre']}</td>
                                        <td>{$servicio['detalle']}</td>
                                        <td>{$servicio['precio']}</td>
                                        <td>
                                           <a href='servicios_gestionar.php?id_servicio={$servicio['id_servicio']}&funcion=actualizar'>
                                              <button class='boton boton-actualizar'>Actualizar</button>
                                           </a>                                      
                                            <form method='POST' action='servicios_gestionar.php' onsubmit='return confirm(\"¿Estás seguro de eliminar este servicio?\");' style='display:inline;'>
                                            <input type='hidden' name='id_servicio' value='{$servicio['id_servicio']}'>
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