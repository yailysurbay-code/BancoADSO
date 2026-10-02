<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco ADSO - Transferencia</title>
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
        <h1>Realizar transferencia</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?= e($error) ?></p>
        <?php endif; ?>

        <div class="tarjeta">
            <form method="POST" action="index.php?ruta=transferencia">
                <label>Número de cuenta destino</label>
                <input type="text" name="numero_cuenta_destino" required>

                <label>Valor a transferir</label>
                <input type="text" name="valor" required>

                <label>Contraseña (confirmar)</label>
                <input type="password" name="clave" required>

                <button type="submit">Transferir</button>
            </form>
        </div>
    </div>
</body>
</html>