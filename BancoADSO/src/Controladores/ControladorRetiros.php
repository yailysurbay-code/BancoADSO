<?php

namespace App\Controladores;

use App\Servicios\ServicioRetiros;
use App\Repositorios\RepositorioRetiros;

class ControladorRetiros
{
    private ServicioRetiros $servicioRetiros;
    private RepositorioRetiros $repoRetiros;

    public function __construct(ServicioRetiros $servicioRetiros, RepositorioRetiros $repoRetiros)
    {
        $this->servicioRetiros = $servicioRetiros;
        $this->repoRetiros = $repoRetiros;
    }

    public function mostrarFormulario(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $error = null;
        require __DIR__ . '/../../vistas/retiro.php';
    }

    public function procesarRetiro(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $cuentaId = $_SESSION['cuenta_id'];
        $valor = $_POST['valor'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $error = $this->servicioRetiros->realizarRetiro($cuentaId, $clave, $valor);

        if ($error !== null) {
            require __DIR__ . '/../../vistas/retiro.php';
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
    $retiros = $this->repoRetiros->listarPorCuenta($cuentaId);

    $totalRetirado = 0;
    foreach ($retiros as $retiro) {
        $totalRetirado += $retiro->getValor();
    }

    require __DIR__ . '/../../vistas/historial_retiros.php';
}
}


?>