<?php

namespace App\Servicios;

use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioUsuarios;
use App\Modelos\Cuenta;

class ServicioAutenticacion
{
    private RepositorioCuentas $repoCuentas;
    private RepositorioUsuarios $repoUsuarios;

    public function __construct(RepositorioCuentas $repoCuentas, RepositorioUsuarios $repoUsuarios)
    {
        $this->repoCuentas = $repoCuentas;
        $this->repoUsuarios = $repoUsuarios;
    }

    public function validarCredenciales(string $numeroCuenta, string $clave): ?Cuenta
    {
        $cuenta = $this->repoCuentas->buscarPorNumero($numeroCuenta);

        if ($cuenta === null) {
            return null;
        }

        $usuario = $this->repoUsuarios->buscarPorCuentaId($cuenta->getId());

        if ($usuario === null) {
            return null;
        }

        if (!password_verify($clave, $usuario->getClaveHash())) {
            return null;
        }

        return $cuenta;
    }
}