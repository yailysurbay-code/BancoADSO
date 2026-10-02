<?php

namespace App\Controladores;

use App\Servicios\ServicioTransferencias;
use App\Repositorios\RepositorioTransferencias;

class ControladorTransferencias
{
    private ServicioTransferencias $servicioTransferencias;
    private RepositorioTransferencias $repoTransferencias;

    public function __construct(
        ServicioTransferencias $servicioTransferencias,
        RepositorioTransferencias $repoTransferencias
    ) {
        $this->servicioTransferencias = $servicioTransferencias;
        $this->repoTransferencias = $repoTransferencias;
    }

    public function mostrarFormulario(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $error = null;
        require __DIR__ . '/../../vistas/transferencia.php';
    }

    public function procesarTransferencia(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $cuentaOrigenId = $_SESSION['cuenta_id'];
        $numeroCuentaDestino = $_POST['numero_cuenta_destino'] ?? '';
        $valor = $_POST['valor'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $error = $this->servicioTransferencias->realizarTransferencia(
            $cuentaOrigenId,
            $numeroCuentaDestino,
            $clave,
            $valor
        );

        if ($error !== null) {
            require __DIR__ . '/../../vistas/transferencia.php';
            return;
        }

        header('Location: index.php?ruta=panel');
        exit;
    }

    public function mostrarHistorial(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $cuentaId = $_SESSION['cuenta_id'];
        $transferencias = $this->repoTransferencias->listarEnviadasPorCuenta($cuentaId);

        $totalTransferido = 0;
        foreach ($transferencias as $t) {
            $totalTransferido += $t->getValor();
        }

        require __DIR__ . '/../../vistas/historial_transferencias.php';
    }
}