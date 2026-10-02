<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco ADSO - Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="pantalla-login">
        <div class="caja-login">
            <h1>Banco ADSO</h1>
            <p class="subtitulo">Ingresa con tu número de cuenta</p>

            <?php if (!empty($error)): ?>
                <p class="error"><?= e($error) ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?ruta=login">
                <label>Número de cuenta</label>
                <input type="text" name="numero_cuenta" required>

                <label>Contraseña</label>
                <input type="password" name="clave" required>

                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>