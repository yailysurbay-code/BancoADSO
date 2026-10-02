<?php
/** @var array $transferencias */
/** @var float $totalTransferido */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco ADSO - Historial de transferencias</title>
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
        <h1>Historial de transferencias enviadas</h1>

        <div class="tarjeta">
            <p>Total de transferencias: <strong><?= count($transferencias) ?></strong></p>
            <p>Suma total transferida: <strong>$<?= number_format($totalTransferido, 2) ?></strong></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cuenta destino (id)</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transferencias as $t): ?>
                    <tr>
                        <td><?= e($t->getFecha()) ?></td>
                        <td><?= e((string) $t->getCuentaDestinoId()) ?></td>
                        <td>$<?= number_format($t->getValor(), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>