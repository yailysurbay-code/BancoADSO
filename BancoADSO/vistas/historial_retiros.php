<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco ADSO - Historial de retiros</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Historial de retiros</h1>

    <div class="tarjeta">
        <p>Total de retiros: <strong><?= count($retiros) ?></strong></p>
        <p>Suma total retirada: <strong>$<?= number_format($totalRetirado, 2) ?></strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($retiros as $retiro): ?>
                <tr>
                    <td><?= e($retiro->getFecha()) ?></td>
                    <td>$<?= number_format($retiro->getValor(), 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php?ruta=panel">Volver al panel</a>
</body>
</html>