# Maven Web

Sitio web corporativo para una agencia de diseño y desarrollo web. Permite a la empresa gestionar su contenido (proyectos, servicios, blog, empresa) y a los clientes solicitar cotizaciones en línea.

---

## Stack técnico

| Capa | Tecnología |
|------|-----------|
| Backend | PHP 8.x (sin framework) |
| Base de datos | MySQL via `mysqli` OOP + prepared statements |
| Frontend | CSS custom con design tokens (custom properties) |
| Íconos | Font Awesome 6.0 (CDN) |
| Alertas | SweetAlert2 (CDN) |
| Servidor de desarrollo | XAMPP (Apache + MySQL) |

---

## Arquitectura

El proyecto sigue una arquitectura **MVC-like procedural** sin framework. La separación es por responsabilidad de archivos, no por clases.

```
maven-web/
│
├── funciones/                  # Lógica de negocio (Model + Controller)
│   ├── conexion.php            # Conexión DB, helpers globales, manejo de errores
│   ├── administradores/        # CRUD y sesión de administradores
│   ├── clientes/               # CRUD y sesión de clientes
│   ├── editores/               # CRUD y sesión de editores
│   ├── blogs/                  # CRUD de blogs
│   ├── servicios/              # CRUD de servicios
│   ├── proyectos/              # CRUD de proyectos
│   ├── cotizaciones/           # CRUD de cotizaciones
│   ├── mensajes/               # Insertar y eliminar mensajes de contacto
│   ├── empresa/                # Actualizar datos de empresa
│   └── inicio/                 # Actualizar contenido de página de inicio
│
├── fragments/                  # Partials del área pública (header, footer, links)
├── administrador/              # Área de administrador (CRUD completo)
│   └── fragments/
├── cliente/                    # Área de cliente (cotizaciones)
│   └── fragments/
├── editor/                     # Área de editor (proyectos, inicio)
│   └── fragments/
│
├── css/                        # Estilos organizados por contexto
│   ├── main.css                # Design tokens (:root) + estilos base
│   ├── header.css
│   ├── footer.css
│   ├── form.css
│   ├── table.css
│   └── carrito.css
│
├── imagenes/                   # Assets estáticos
├── logs/                       # Errores PHP (bloqueado en web via .htaccess)
│
├── .env                        # Variables de entorno — NO versionar
├── .htaccess                   # Seguridad Apache: headers HTTP, protección .env y logs/
└── funciones/conexion.php      # Entry point de toda la lógica compartida
```

### Flujo de request

```
[Browser] → [página PHP]
               ├── include_once 'funciones/conexion.php'  ← carga .env, define helpers
               ├── include_once 'funciones/[módulo]/[acción].php'  ← lógica
               └── HTML con require_once de fragments (header, footer)
```

### Áreas y roles

| Área | URL base | Rol requerido |
|------|----------|---------------|
| Pública | `/` | Sin sesión |
| Cliente | `/cliente/` | `$_SESSION["rol_cliente"] = "clientes"` |
| Editor | `/editor/` | `$_SESSION["rol_editor"] = "editores"` |
| Administrador | `/administrador/` | `$_SESSION["rol_administrador"] = "administradores"` |

Cada área verifica su sesión al inicio del request y redirige a su propio `index.php` si no está autenticada.

---

## Modelo de datos

```sql
administradores  (id_administrador, apellido, nombre, correo, usuario, clave)
clientes         (id_cliente, apellido, nombre, correo, usuario, clave)
editores         (id_editor, apellido, nombre, correo, usuario, clave, id_administrador)

blogs            (id_blog, titulo, imagen, contenido, fecha, hora, id_editor)
servicios        (id_servicio, nombre, detalle, precio)
proyectos        (id_proyecto, nombre, detalle, imagen, rubro, fecha, id_editor)

cotizaciones     (id_cotizacion, codigo, id_cliente, id_servicio, precio,
                  nombre_servicio, detalle_servicio, fecha, hora)
mensajes         (id_mensaje, apellido, nombre, celular, correo, mensaje_texto)
empresa          (id_empresa, nombre, descripcion, celular, correo, horario,
                  quienes_somos, mision, vision, valores, id_administrador)
inicio           (id_inicio, banner, titulo, texto, disenio_uno, disenio_dos,
                  desarrollo_uno, desarrollo_dos, id_editor)
```

---

## Setup local

### Prerrequisitos

- XAMPP (PHP 8.0+, Apache, MySQL)
- Git

### Instalación

```bash
# 1. Clonar en el directorio de XAMPP C:/xampp/htdocs/maven-web
git clone https://github.com/Jorge-is/maven-web.git

# 2. Crear la base de datos
# Importar el schema desde phpMyAdmin o MySQL CLI
mysql -u root -p maven_web < schema.sql

# 3. Configurar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales de MySQL
```

### Variables de entorno (`.env`)

```ini
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=maven_web
DB_PORT=3306
```

> `.env` está en `.gitignore`. **Nunca commitear credenciales.**

### Ejecutar

1. Iniciar Apache y MySQL desde el panel de XAMPP
2. Acceder a `http://localhost/maven-web/`

---

## Decisiones técnicas

### Sin framework PHP

Se eligió PHP procedural sin framework para mantener el proyecto comprensible sin dependencias externas y como ejercicio de construcción desde cero. La lógica está separada en archivos por módulo (`funciones/`) en lugar de clases.

### `conexion.php` como núcleo compartido

Todas las páginas hacen `include_once 'funciones/conexion.php'` primero. Este archivo centraliza:
- Carga del `.env`
- Constantes de DB
- Funciones de sesión segura y CSRF
- Helper `e()` para escape de output
- Helper `validar()` para validación server-side
- Helpers de DB (`consultar_prep`, `ejecutar_prep`)
- Manejo de errores (`manejar_error`)
- Configuración PHP (`display_errors = 0`, log a `logs/`)

### CSS con design tokens

`css/main.css` define un bloque `:root` con todas las custom properties del sistema de diseño: colores por categoría (brand, actions, semantic, neutral, form), border-radius, tipografía, sombras y transiciones. Todos los archivos CSS los consumen via `var()`.

---

## Seguridad

Todas las siguientes medidas fueron implementadas:

| Amenaza | Medida implementada |
|---------|-------------------|
| SQL Injection | Prepared statements con `mysqli` OOP en todos los módulos |
| XSS | Helper `e()` (`htmlspecialchars`) en todo output de variables |
| CSRF | Token por sesión verificado en todos los formularios POST |
| Session hijacking | Flags `HttpOnly`, `SameSite:Strict`, `Secure` condicional; `session_regenerate_id()` en login |
| Passwords débiles | `password_hash()` con `PASSWORD_BCRYPT` y cost=12 |
| Credenciales expuestas | Variables de entorno via `.env` (no en código fuente) |
| Clickjacking | `X-Frame-Options: DENY` + `frame-ancestors 'none'` en CSP |
| MIME sniffing | `X-Content-Type-Options: nosniff` |
| Info disclosure | `display_errors = 0`; errores logueados en `logs/errors.log` |
| Acceso a logs | `logs/.htaccess` bloquea acceso web al directorio |
| Validación de entrada | Helper `validar()` en 16 handlers POST (required, email, min/max length, positive) |

---

## Accesibilidad

- Todos los `<input>` tienen `<label for>` asociado programáticamente
- Botones hamburger con `aria-label` y caracteres decorativos con `aria-hidden`
- Contraste WCAG AA verificado en todos los colores de acción
- Atributos `alt` descriptivos en imágenes informativas

