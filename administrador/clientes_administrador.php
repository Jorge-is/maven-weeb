<?php
session_start(); 
if ($_SESSION["rol_administrador"]!="administradores") {
    header("Location: index.php");
}
include_once '../funciones/conexion.php';
include_once '../funciones/clientes/clientes_actualizar.php';
include_once '../funciones/clientes/clientes_eliminar.php';
include_once '../funciones/clientes/clientes_insertar.php';
include_once '../funciones/clientes/clientes_consultar_por_id.php';
include_once '../funciones/clientes/clientes_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Administrar Clientes</title>
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
                            <legend>Administrar Clientes</legend>
                            <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>" required />
                            <label for="apellido">Apellidos</label>
                            <input type="text" id="apellido" name="apellido" placeholder="Escriba sus apellidos" value="<?php echo $apellido; ?>" maxlength="50" required />

                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Escriba sus nombres" value="<?php echo $nombre; ?>" maxlength="50" required />

                            <label for="correo">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" value="<?php echo $correo; ?>" maxlength="50" required />

                            <label for="usuario">Usuario</label>
                            <input type="text" id="usuario" name="usuario" placeholder="Escriba su usuario" value="<?php echo $usuario; ?>" maxlength="50" required />

                            <label for="clave">Clave</label>
                            <input type="password" id="clave" name="clave" placeholder="Escriba una clave" value="<?php echo $clave; ?>" maxlength="50" required />
                            
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
                        <h1 class="titulo-tabla">Gestionar clientes</h1>
                        <a href="clientes_administrador.php?funcion=insertar">
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($clientes as $cliente) {
                                        echo "<tr>
                                                <td>{$cliente['apellido']}</td>
                                                <td>{$cliente['nombre']}</td>
                                                <td>{$cliente['correo']}</td>
                                                <td>{$cliente['usuario']}</td>
                                                <td>
                                                    <a href='clientes_administrador.php?id_cliente={$cliente['id_cliente']}&funcion=actualizar'>
                                                        <button class='boton boton-actualizar'>Actualizar</button>
                                                    </a>
                                                    <form method='POST' action='clientes_administrador.php' onsubmit='return confirm(\"¿Estás seguro de eliminar este editor?\");' style='display:inline;'>
                                                        <input type='hidden' name='id_cliente' value='{$cliente['id_cliente']}'>
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