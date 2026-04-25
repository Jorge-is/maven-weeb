<?php
session_start(); 
if ($_SESSION["rol_administrador"]!="administradores") {
    header("Location: index.php");
}
include_once '../funciones/conexion.php';
include_once '../funciones/editores/editores_actualizar.php';
include_once '../funciones/editores/editores_eliminar.php';
include_once '../funciones/editores/editores_insertar.php';
include_once '../funciones/editores/editores_consultar_por_id.php';
include_once '../funciones/editores/editores_consultar.php';
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
                                <legend>Registrar editores</legend>

                                <input type="hidden" id="nombre" name="id_editor" value="<?php echo $id_editor;?>" maxlength="50" required/>

                                <label for="apellido">Apellidos</label>
                                <input type="text" id="apellido" name="apellido" placeholder="Escriba sus apellidos" value="<?php echo $apellido; ?>" maxlength="50" required/>

                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba sus nombres" value="<?php echo $nombre; ?>" maxlength="50" required/>

                                <label for="correo">Correo electrónico</label>
                                <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" value="<?php echo $correo;?>" maxlength="50" required/>

                                <label for="nombre">Usuario</label>
                                <input type="text" id="nombre" name="usuario" placeholder="Escriba sus nombres" value="<?php echo $usuario;?>" maxlength="50" required/>

                                <label for="nombre">Clave</label>
                                <input type="password" id="nombre" name="clave" placeholder="Escriba una clave" value="<?php echo $clave;?>" maxlength="50" required/>

                                <input type="hidden" id="nombre" name="id_administrador" value="1" maxlength="50" required/>
                                <?php
                                if (isset($_GET['funcion']) && $_GET['funcion'] == 'actualizar') {
                                ?>
                                    <input type="hidden" id="funcion" name="funcion" value="actualizar" maxlength="50" required/>
                                    <button class="boton-mediano boton-actualizar" type="submit">Actualizar</button>
                                <?php
                                } else {
                                ?>
                                    <input type="hidden" id="funcion" name="funcion" value="insertar" maxlength="50" required/>
                                    <button class="boton-mediano boton-insertar" type="submit">Insertar</button>
                                <?php
                                }
                                ?>                
                                
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-tabla">
                        <h1 class="titulo-tabla">Gestionar editores</h1>
                        <a href="editores_administrador.php?funcion=insertar">
                            <button class="boton-mediano boton-insertar">Añadir editor</button>
                        </a>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Administrador</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($editores as $editor) {
                                        echo "<tr>
                                                <td>{$editor['apellido']}</td>
                                                <td>{$editor['nombre']}</td>
                                                <td>{$editor['correo']}</td>
                                                <td>{$editor['usuario']}</td>
                                                <td>{$editor['id_administrador']}</td>
                                                <td>
                                                    <a href='editores_administrador.php?id_editor={$editor['id_editor']}&funcion=actualizar'>
                                                        <button class='boton boton-actualizar'>Actualizar</button>
                                                    </a>
                                                    <form method='POST' action='editores_administrador.php' onsubmit='return confirm(\"¿Estás seguro de eliminar este editor?\");' style='display:inline;'>
                                                        <input type='hidden' name='id_editor' value='{$editor['id_editor']}'>
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