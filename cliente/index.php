<?php
sesion_segura();
if (!isset($_SESSION["rol_cliente"]) || $_SESSION["rol_cliente"] !== "clientes") {
    header("Location: ../iniciar_sesion.php");
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
    <main class="flex-center">
        <section>
            <div>
                <h1 class="titulo-1">Bienvenido <?php echo e($_SESSION["nombre_cliente"]); ?> a la intranet de Maven Weeb</h1>
            </div>
        </section>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
