<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_editor"]) || $_SESSION["rol_editor"] !== "editores") {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <title>Intranet | Maven Weeb</title>
    <?php require_once './fragments/links.php'; ?>
</head>
<body class="fondo-bienvenido">
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <h1 class="titulo-1">Bienvenido <?php echo e($_SESSION["nombre_editor"]); ?> a la intranet de Maven Weeb</h1>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
