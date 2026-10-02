<?php

namespace App\Controladores;

use App\Servicios\ServicioAutenticacion;

class ControladorSesion
{
    private ServicioAutenticacion $servicioAuth;

    public function __construct(ServicioAutenticacion $servicioAuth)
    {
        $this->servicioAuth = $servicioAuth;
    }

    public function mostrarLogin(): void
    {
        $error = null;
        require __DIR__ . '/../../vistas/login.php';
    }

    public function procesarLogin(): void
    {
        $numeroCuenta = $_POST['numero_cuenta'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $cuenta = $this->servicioAuth->validarCredenciales($numeroCuenta, $clave);

        if ($cuenta === null) {
            $error = "Número de cuenta o contraseña incorrectos.";
            require __DIR__ . '/../../vistas/login.php';
            return;
        }

        $_SESSION['cuenta_id'] = $cuenta->getId();
        header('Location: index.php?ruta=panel');
        exit;
    }
}