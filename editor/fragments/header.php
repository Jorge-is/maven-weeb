<?php    
    $url_todo = $_SERVER["REQUEST_URI"];
    $url_dir = strrpos($url_todo, "/");
    $url_actual = substr($url_todo, $url_dir + 1);
    $menu = [
        "Inicio" => "intranet.php",
        "Gestionar inicio" => "inicio_gestionar.php",
        "Gestionar proyectos" => "proyecto_gestionar.php",
    ];
?>

<header>
    <nav>
        <button class="btn-visible monitor-ocultar televisor-ocultar" aria-label="Abrir menú" aria-expanded="false"><span aria-hidden="true">&#8801;</span></button>
        <a href="intranet.php"><img src="../imagenes/logos/logo_maven.png" alt="Logo Web Maven"></a>
        <ul class="telefono-ocultar tablet-ocultar">
            <?php    
                foreach($menu as $texto => $url_enlace) {
                    $clase_habilitada = ($url_actual == $url_enlace) ? "active" : "";
                    echo '<li><a href="'.$url_enlace.'" class="'.$clase_habilitada.'">'.$texto.'</a></li>';
                }
            ?>
        </ul>
        <div class="opciones">
            <a href="cerrar_sesion.php">Cerrar sesión</a>
        </div>
    </nav>
    <div class="nav-lateral">    
        <button class="btn-invisible" aria-label="Cerrar menú"><span aria-hidden="true">x</span></button>
        <a href="index.php"><img src="../imagenes/logos/logo_maven.png" alt="Logo Web Maven"></a>
        <ul>
            <?php    
                foreach($menu as $texto => $url_enlace) {
                    $clase_habilitada = ($url_actual == $url_enlace) ? "active" : "";
                    echo '<li><a href="'.$url_enlace.'" class="'.$clase_habilitada.'">'.$texto.'</a></li>';
                }
            ?>
        </ul>
    <div>
</header>