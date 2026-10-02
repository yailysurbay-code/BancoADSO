<?php

namespace App\Controladores;

use App\Repositorios\RepositorioCuentas;

class ControladorCuenta
{
    private RepositorioCuentas $repoCuentas;

    public function __construct(RepositorioCuentas $repoCuentas)
    {
        $this->repoCuentas = $repoCuentas;
    }

    public function mostrarPanel(): void
    {
        if (!isset($_SESSION['cuenta_id'])) {
            header('Location: index.php?ruta=login');
            exit;
        }

        $cuentaId = $_SESSION['cuenta_id'];
        $cuenta = $this->repoCuentas->buscarPorId($cuentaId);

        require __DIR__ . '/../../vistas/panel.php';
    }
}


?>