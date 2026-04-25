<?php 
session_start(); 
// if ($_SESSION["rol_"]!="administradores") {
//     header("Location: ../index.php");
// }
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
            <h1 class="titulo-1">Bienvenido <?php echo $_SESSION["nombre_editor"];?> a la intranet de Maven Weeb </h1>
        </div>        
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>