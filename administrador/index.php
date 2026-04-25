<?php
include_once '../funciones/conexion.php';
include_once '../funciones/administradores/administradores_sesion.php';
?>

<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Inicio de sesión</title>
    <?php require_once './fragments/links.php'; ?>
</head>

<body>
    <main>
        <div class="container">
        <h1 class="titulo-1">Administración</h1>
            <section class="jumbo">
                <article class="flex-center">
                    <div class="tarjeta jumbo-info">
                        <form id="loginForm" class="formulario" method="POST">
                            <fieldset>
                                <legend>Iniciar sesión</legend>
                                <label>Usuario</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario">

                                <label>Contraseña</label>
                                <input type="password" id="clave" name="clave" placeholder="Ingrese su clave">

                                <button class="submit-button" type="submit">Iniciar</button>
                                <?php
                                if (empty($administrador)) {
                                ?>
                                <button class="submit-button" type="button">
                                    <a href="registro_administrador.php">Regístrate</a>
                                </button>
                                <?php
                                }
                                ?>
                            </fieldset>
                        </form>
                </article>
            </section>
        </div>
    </main>
    <script>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') : ?>
            Swal.fire({
                icon: 'error',
                title: 'Datos incorrectos',
                text: 'Por favor, verifique sus credenciales',
            });
        <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'exito') : ?>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                text: 'Inicio de sesión exitoso',
                showConfirmButton: false,
                timer: 1300
            }).then(function() {
                window.location.href = 'intranet.php';
            });
        <?php endif; ?>
    </script>
</body>

</html>
