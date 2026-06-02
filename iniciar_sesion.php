<?php
include_once 'funciones/conexion.php';
sesion_segura();
include_once 'funciones/clientes/clientes_sesion.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Inicio de sesión</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body class="fondo-login">
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="tarjeta jumbo-info">
                        <form id="loginForm" class="formulario" action="iniciar_sesion.php" method="POST">
                            <fieldset>
                                <legend>Iniciar sesión</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <label for="usuario">Usuario</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario" maxlength="50">
                                <label for="clave">Contraseña</label>
                                <input type="password" id="clave" name="clave" placeholder="Ingrese su clave" maxlength="50">
                                <button class="submit-button" type="submit">Iniciar</button>
                                <button class="submit-button" type="button">
                                    <a href="registro.php">Regístrate</a>
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <script>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error'): ?>
            Swal.fire({ icon: 'error', title: 'Datos incorrectos', text: 'Por favor, verifique sus credenciales' });
        <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'exito'): ?>
            Swal.fire({ icon: 'success', title: 'Bienvenido', text: 'Inicio de sesión exitoso', showConfirmButton: false, timer: 1300 })
                .then(function() { window.location.href = 'intranet.php'; });
        <?php endif; ?>
    </script>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
