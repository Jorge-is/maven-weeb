<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_administrador"]) || $_SESSION["rol_administrador"] !== "administradores") {
    header("Location: index.php");
    exit();
}
include_once '../funciones/administradores/administradores_registro.php';
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Registro de administrador</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body>
    <main>
        <div class="container">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="tarjeta jumbo-info">
                        <form class="formulario" action="" method="POST">
                            <fieldset>
                                <legend>Regístrate</legend>
                                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                                <label for="apellido">Apellidos</label>
                                <input type="text"     id="apellido"        name="apellido"        placeholder="Apellidos"            required>
                                <label for="nombre">Nombre</label>
                                <input type="text"     id="nombre"          name="nombre"          placeholder="Nombres"              required>
                                <label for="correo">Correo electrónico</label>
                                <input type="email"    id="correo"          name="correo"          placeholder="Correo electronico"   required>
                                <label for="usuario">Nombre de usuario</label>
                                <input type="text"     id="usuario"         name="usuario"         placeholder="Nombre de usuario"    required>
                                <label for="clave">Contraseña</label>
                                <input type="password" id="clave"           name="clave"           placeholder="Contraseña"           required>
                                <label for="clave_confirmar">Confirmar contraseña</label>
                                <input type="password" id="clave_confirmar" name="clave_confirmar" placeholder="Confirmar contraseña" required>
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
                .then(function() { window.location.href = 'intranet.php'; });
        <?php endif; ?>
    </script>
</body>
</html>
