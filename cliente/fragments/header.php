<?php
    $url_todo = $_SERVER["REQUEST_URI"];
    $url_dir  = strrpos($url_todo, "/");
    $url_actual = substr($url_todo, $url_dir + 1);
    $menu = [
        "Inicio"     => "index.php",
        "Servicios"  => "servicios.php",
        "Cotización" => "cotizacion.php",
    ];
?>

<header>
    <nav>
        <div class="nav-inner">
            <div class="nav-left">
                <button class="nav-toggle"
                        aria-label="Abrir menú"
                        aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <a href="index.php" class="nav-logo-link">
                    <img src="../imagenes/logos/logo_maven.png" alt="Maven Weeb" class="nav-logo">
                </a>
            </div>

            <ul class="nav-links">
                <?php foreach ($menu as $texto => $url_enlace): ?>
                    <?php $clase = ($url_actual === $url_enlace) ? 'active' : ''; ?>
                    <li>
                        <a href="<?php echo $url_enlace; ?>" class="<?php echo $clase; ?>">
                            <?php echo $texto; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="nav-right">
                <a href="cerrar_sesion.php" class="nav-cta">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="nav-lateral" role="dialog" aria-label="Menú de navegación" aria-hidden="true">
        <div class="nav-lateral-header">
            <a href="index.php" class="nav-logo-link">
                <img src="../imagenes/logos/logo_maven.png" alt="Maven Weeb" class="nav-logo">
            </a>
            <button class="nav-close" aria-label="Cerrar menú">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
        <ul>
            <?php foreach ($menu as $texto => $url_enlace): ?>
                <?php $clase = ($url_actual === $url_enlace) ? 'active' : ''; ?>
                <li>
                    <a href="<?php echo $url_enlace; ?>" class="<?php echo $clase; ?>">
                        <?php echo $texto; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="nav-overlay"></div>
</header>
