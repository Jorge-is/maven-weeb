<?php
session_start();
echo "Sesion finalizada";
header("location: index.php");
session_destroy();
?>