<?php    
    $url_todo = $_SERVER["REQUEST_URI"];
    $url_dir = strrpos($url_todo, "/");
    $url_actual = substr($url_todo, $url_dir + 1);
    $menu = [
        "Inicio" => "intranet.php",
        "Gestionar editores" => "editores_administrador.php",
        "Gestionar clientes" => "clientes_administrador.php",
        "Gestionar blogs" => "blogs_gestionar.php",
        "Gestionar servicios" => "servicios_gestionar.php",
        "Gestionar mensajes" => "mensajes_administrador.php",
    ];
?>

<header>
    <nav>
        <button class="btn-visible monitor-ocultar televisor-ocultar"><span>&#8801;</span></button>
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
        <button class="btn-invisible"><span>x</span></button>
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