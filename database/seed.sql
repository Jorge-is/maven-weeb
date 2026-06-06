-- Maven Weeb — Seed Data
-- Datos mínimos para arrancar la aplicación en desarrollo.
--
-- IMPORTANTE: Antes de importar este archivo, generá un hash real para la clave:
--   php -r "echo password_hash('TuClaveAqui', PASSWORD_BCRYPT, ['cost' => 12]);"
-- Reemplazá el valor HASH_AQUI en los INSERT de abajo.

USE maven_weeb;

-- 1. Administrador inicial
INSERT INTO administradores (apellido, nombre, correo, usuario, clave)
VALUES ('Demo', 'Admin', 'admin@demo.com', 'admin', 'HASH_AQUI');

-- 2. Editor inicial (asociado al administrador del paso 1)
INSERT INTO editores (apellido, nombre, correo, usuario, clave, id_administrador)
VALUES ('Demo', 'Editor', 'editor@demo.com', 'editor', 'HASH_AQUI', 1);

-- 3. Datos de la empresa (una sola fila requerida para las páginas públicas)
INSERT INTO empresa (nombre, descripcion, celular, correo, horario, quienes_somos, mision, vision, valores, id_administrador)
VALUES (
  'Maven Weeb',
  'Agencia de diseño y desarrollo web.',
  '000-000-0000',
  'contacto@demo.com',
  'Lunes a viernes, 9:00 - 18:00',
  'Somos una agencia especializada en soluciones web a medida.',
  'Brindar soluciones digitales de calidad que impulsen el crecimiento de nuestros clientes.',
  'Ser la agencia de referencia en desarrollo web de la región.',
  'Calidad, compromiso, innovación y trabajo en equipo.',
  1
);

-- 4. Contenido de la página de inicio (una sola fila requerida)
INSERT INTO inicio (banner, titulo, texto, disenio_uno, disenio_dos, desarrollo_uno, desarrollo_dos, id_editor)
VALUES (
  'imagenes/inicio/banner.png',
  'Bienvenidos a Maven Weeb',
  'Diseñamos y desarrollamos soluciones web a medida para tu negocio.',
  'imagenes/servicios/UX_UI.jpg',
  'imagenes/servicios/fronted.jpg',
  'imagenes/servicios/backend.jpg',
  'imagenes/servicios/seguridad_web.jpg',
  1
);
