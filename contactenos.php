<?php
include_once 'funciones/conexion.php';
include_once 'funciones/empresa/empresa_consultar.php';
// include_once 'funciones/mensaje/mensaje_consultar.php';
include_once 'funciones/mensajes/mensajes_insertar.php';
// include_once 'funciones/mensaje/mensaje_actualizar.php';
// include_once 'funciones/mensaje/mensaje_eliminar.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Contáctenos</title>
    <?php require_once './fragments/links.php'; ?>
</head>

<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container">
            <section class="jumbo">
                <article class="flex-center">
                    <div class="jumbo-info">
                        <form id="contactForm" method="POST" action="" class="formulario">
                            <fieldset>
                                <legend>Contáctenos</legend>
                                <label for="apellido">Apellidos</label>
                                <input type="text" id="apellido" name="apellido" placeholder="Escriba sus apellidos" maxlength="50" required />
                                
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba sus nombres" maxlength="50" required/>
                                
                                <label for="telefono">Teléfono o celular</label>
                                <input type="number" id="celular" name="celular" placeholder="Escriba su número de teléfono" maxlength="50" required />

                                <label for="correo">Correo electrónico</label>
                                <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" maxlength="50" required />

                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje_texto" id="mensaje_texto" cols="30" rows="10" placeholder="Escriba su mensaje" maxlength="200" required></textarea>

                                <button class="submit-button" type="submit">Enviar</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbo-info">
                        <div class="tarjeta">
                            <h4>Dirección de la Empresa</h4>
                            <p><?php echo e($empresa[0]['direccion']); ?></p>
                            <h4>Número</h4>
                            <p><?php echo e($empresa[0]['celular']); ?></p>
                            <h4>Correo</h4>
                            <p><?php echo e($empresa[0]['correo']); ?></p>
                            <h4>Horario</h4>
                            <p><?php echo e($empresa[0]['horario']); ?></p>
                        </div>
                        <div class="mapa">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.455575699114!2d-76.96845654611778!3d-12.08093289407926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c6ff58810593%3A0xa16b0e3adb106914!2sOficina%201404%20Torre%20A%2C%20Av.%20Circunvalaci%C3%B3n%20del%20Golf%20los%20Incas%20208%2C%20Santiago%20de%20Surco%2015023!5e0!3m2!1ses-419!2spe!4v1717795896186!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var campos = [
                document.getElementById('nombre').value,
                document.getElementById('apellido').value,
                document.getElementById('telefono').value,
                document.getElementById('correo').value,
                document.getElementById('mensaje').value
            ];

            var regex = /<\/?[a-z][\s\S]*>/i;
            var campoInvalido = null;

            for (var i = 0; i < campos.length; i++) {
                if (regex.test(campos[i])) {
                    campoInvalido = i;
                    break;
                }
            }

            if (campoInvalido !== null) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El campo ' + ['nombre', 'apellido', 'telefono', 'correo', 'mensaje'][campoInvalido] + ' no debe contener etiquetas HTML.'
                });
            }
        });
    </script>
</body>

</html>