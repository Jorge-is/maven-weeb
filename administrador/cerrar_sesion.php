<?php
session_start();
echo "Sesion finalizada";
header("Location: index.php");
session_destroy();
?>