<?php    
    $url_todo = $_SERVER["REQUEST_URI"];
    $url_dir = strrpos($url_todo, "/");
    $url_actual = substr($url_todo, $url_dir + 1);
    $menu = [
        "Inicio" => "index.php",
        "Proyectos" => "proyectos.php",
        "Blog" => "blog.php",
        "Servicios" => "servicios.php",
        "Contáctenos" => "contactenos.php",
        "Conócenos" => "conocenos.php",
    ];
?>

<header>
    <nav>
        <button class="btn-visible monitor-ocultar televisor-ocultar"><span>&#8801;</span></button>
        <a href="index.php"><img src="imagenes/logos/logo_maven.png" alt="Logo Web Maven"></a>
        <ul class="telefono-ocultar tablet-ocultar">
        <?php    
                foreach ($menu as $texto => $url_enlace) {
                    $clase_habilitada = ($url_actual == $url_enlace) ? "active" : "";
                    echo '<li>';
                    echo '<a href="'.$url_enlace.'" class="'.$clase_habilitada.'">';
                    echo $texto;
                    echo '</a>';
                    echo '</li>';
                }
            ?>
        </ul>
        <div class="opciones">
            <a href="iniciar_sesion.php">Iniciar sesión</a>
        </div>
    </nav>
    <div class="nav-lateral">    
        <button class="btn-invisible"><span>x</span></button>
        <a href="index.php"><img src="imagenes/logos/logo_maven.png" alt="Logo Web Maven"></a>
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