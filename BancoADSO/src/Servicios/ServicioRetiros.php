<?php

namespace App\Servicios;

use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioUsuarios;
use App\Repositorios\RepositorioRetiros;

class ServicioRetiros
{
    private RepositorioCuentas $repoCuentas;
    private RepositorioUsuarios $repoUsuarios;
    private RepositorioRetiros $repoRetiros;

    public function __construct(
        RepositorioCuentas $repoCuentas,
        RepositorioUsuarios $repoUsuarios,
        RepositorioRetiros $repoRetiros
    ) {
        $this->repoCuentas = $repoCuentas;
        $this->repoUsuarios = $repoUsuarios;
        $this->repoRetiros = $repoRetiros;
    }


    public function realizarRetiro(int $cuentaId, string $claveReconfirmada, $valorIngresado): ?string
    {
        $usuario = $this->repoUsuarios->buscarPorCuentaId($cuentaId);

        if ($usuario === null || !password_verify($claveReconfirmada, $usuario->getClaveHash())) {
            return "Contraseña incorrecta.";
        }

        if (!is_numeric($valorIngresado) || (float) $valorIngresado <= 0) {
            return "El valor a retirar debe ser un número mayor que 0.";
        }

        $valor = (float) $valorIngresado;

        $cuenta = $this->repoCuentas->buscarPorId($cuentaId);

        if ($cuenta === null) {
            return "Cuenta no encontrada.";
        }

        if ($cuenta->getSaldo() < $valor) {
            return "Saldo insuficiente para realizar el retiro.";
        }

        
        $nuevoSaldo = $cuenta->getSaldo() - $valor;
        $this->repoCuentas->actualizarSaldo($cuentaId, $nuevoSaldo);
        $this->repoRetiros->crear($cuentaId, $valor);

        return null; 
    }
}