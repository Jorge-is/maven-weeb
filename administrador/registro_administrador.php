<?php
session_start(); 
if ($_SESSION["rol_administrador"]!="administradores") {
    header("Location: index.php");
}
include_once '../funciones/conexion.php';
include_once '../funciones/administradores/administradores_registro.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Registro de usuario</title>
    <?php require_once './fragments/links.php'; ?>
</head>

<body class="">
    <main>
        <div class="container">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="tarjeta jumbo-info">
                        <form class="formulario" action="" method="POST">
                            <fieldset>
                                <legend>Regístrate</legend>
                                <input type="text" name="apellido" placeholder="Apellidos" required>
                                <input type="text" name="nombre" placeholder="Nombres" required>
                                <input type="email" name="correo" placeholder="Correo electronico" required>
                                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                                <input type="password" name="clave" placeholder="Contraseña" required>
                                <input type="password" name="clave_confirmar" placeholder="Confirmar contraseña" required>
                                <button class="submit-button" type="submit">Continuar</button>
                            </fieldset>
                        </form>
                    </div>
                </article>
            </section>
        </div>
    </main>        
    <script>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'false') : ?>
            Swal.fire({
                icon: 'error',
                title: 'Complete los datos',
                text: 'Por favor, inténtelo de nuevo',
            });
        <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'true') : ?>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                text: 'Registro exitoso',
                showConfirmButton: false,
                timer: 1300
            }).then(function() {
                window.location.href = 'sesion.php';
            });
        <?php endif; ?>
    </script>            
</body>
</html>