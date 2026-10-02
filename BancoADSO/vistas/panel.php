<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco ADSO - Panel</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="barra-superior">
        <span class="marca">Banco ADSO</span>
        <a href="index.php?ruta=logout">Cerrar sesión</a>
    </div>

    <div class="menu">
        <a href="index.php?ruta=panel">Panel</a>
        <a href="index.php?ruta=retiro">Retiro</a>
        <a href="index.php?ruta=historial_retiros">Historial de retiros</a>
        <a href="index.php?ruta=transferencia">Transferencia</a>
        <a href="index.php?ruta=historial_transferencias">Historial de transferencias</a>
    </div>

    <div class="contenido">
        <h1>Hola de nuevo</h1>
        <p class="texto-apoyo">Esta es la información de tu cuenta.</p>

        <div class="tarjeta-saldo">
            <p class="etiqueta">Número de cuenta</p>
            <p class="numero-cuenta"><?= e($cuenta->getNumeroCuenta()) ?></p>

            <p class="etiqueta" style="margin-top: 20px;">Saldo disponible</p>
            <p class="saldo">$<?= number_format($cuenta->getSaldo(), 2) ?></p>
        </div>

        <h2 class="subtitulo-seccion">¿Qué quieres hacer?</h2>

        <div class="grid-acciones">
            <a href="index.php?ruta=retiro" class="tarjeta-accion">
                <span class="icono">💵</span>
                <span class="titulo-accion">Realizar retiro</span>
            </a>

            <a href="index.php?ruta=transferencia" class="tarjeta-accion">
                <span class="icono">🔁</span>
                <span class="titulo-accion">Realizar transferencia</span>
            </a>

            <a href="index.php?ruta=historial_retiros" class="tarjeta-accion">
                <span class="icono">📄</span>
                <span class="titulo-accion">Historial de retiros</span>
            </a>

            <a href="index.php?ruta=historial_transferencias" class="tarjeta-accion">
                <span class="icono">📑</span>
                <span class="titulo-accion">Historial de transferencias</span>
            </a>
        </div>
    </div>
</body>
</html>