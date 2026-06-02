<?php
include_once 'funciones/conexion.php';
sesion_segura();
include_once 'funciones/clientes/clientes_registro.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Registro de usuario</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body class="fondo-registro">
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="tarjeta jumbo-info">
                        <form class="formulario" action="" method="POST">
                            <fieldset>
                                <legend>Regístrate</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <input type="text"     name="apellido"         placeholder="Apellidos"             maxlength="50"  required>
                                <input type="text"     name="nombre"           placeholder="Nombres"               maxlength="50"  required>
                                <input type="email"    name="correo"           placeholder="Correo electronico"    maxlength="200" required>
                                <input type="text"     name="usuario"          placeholder="Nombre de usuario"     maxlength="50"  required>
                                <input type="password" name="clave"            placeholder="Contraseña"            maxlength="50"  required>
                                <input type="password" name="clave_confirmar"  placeholder="Confirmar contraseña"  maxlength="50"  required>
                                <button class="submit-button" type="submit">Continuar</button>
                            </fieldset>
                        </form>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <script>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'false'): ?>
            Swal.fire({ icon: 'error', title: 'Complete los datos', text: 'Por favor, inténtelo de nuevo' });
        <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'true'): ?>
            Swal.fire({ icon: 'success', title: 'Bienvenido', text: 'Registro exitoso', showConfirmButton: false, timer: 1300 })
                .then(function() { window.location.href = 'iniciar_sesion.php'; });
        <?php endif; ?>
    </script>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
