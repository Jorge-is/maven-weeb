<?php
session_start();
echo "Sesion finalizada";
header("Location:../iniciar_sesion.php");
session_destroy();
?>