<?php

namespace App\Servicios;

use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioUsuarios;
use App\Repositorios\RepositorioTransferencias;
use PDO;
use Throwable;

class ServicioTransferencias
{
    private PDO $pdo;
    private RepositorioCuentas $repoCuentas;
    private RepositorioUsuarios $repoUsuarios;
    private RepositorioTransferencias $repoTransferencias;

    public function __construct(
        PDO $pdo,
        RepositorioCuentas $repoCuentas,
        RepositorioUsuarios $repoUsuarios,
        RepositorioTransferencias $repoTransferencias
    ) {
        $this->pdo = $pdo;
        $this->repoCuentas = $repoCuentas;
        $this->repoUsuarios = $repoUsuarios;
        $this->repoTransferencias = $repoTransferencias;
    }

     
    public function realizarTransferencia(
        int $cuentaOrigenId,
        string $numeroCuentaDestino,
        string $claveReconfirmada,
        $valorIngresado
    ): ?string {
        $usuario = $this->repoUsuarios->buscarPorCuentaId($cuentaOrigenId);
        if ($usuario === null || !password_verify($claveReconfirmada, $usuario->getClaveHash())) {
            return "Contraseña incorrecta.";
        }

        $cuentaDestino = $this->repoCuentas->buscarPorNumero($numeroCuentaDestino);
        if ($cuentaDestino === null) {
            return "La cuenta destino no existe.";
        }

        if (!is_numeric($valorIngresado) || (float) $valorIngresado <= 0) {
            return "El valor a transferir debe ser un número mayor que 0.";
        }
        $valor = (float) $valorIngresado;

        $cuentaOrigen = $this->repoCuentas->buscarPorId($cuentaOrigenId);
        if ($cuentaOrigen === null) {
            return "Cuenta origen no encontrada.";
        }

        if ($cuentaOrigen->getSaldo() < $valor) {
            return "Saldo insuficiente para realizar la transferencia.";
        }

        if ($cuentaOrigen->getId() === $cuentaDestino->getId()) {
            return "La cuenta destino debe ser diferente a la cuenta origen.";
        }

        try {
            $this->pdo->beginTransaction();

            $nuevoSaldoOrigen = $cuentaOrigen->getSaldo() - $valor;
            $this->repoCuentas->actualizarSaldo($cuentaOrigen->getId(), $nuevoSaldoOrigen);

            $nuevoSaldoDestino = $cuentaDestino->getSaldo() + $valor;
            $this->repoCuentas->actualizarSaldo($cuentaDestino->getId(), $nuevoSaldoDestino);

            $this->repoTransferencias->crear($cuentaOrigen->getId(), $cuentaDestino->getId(), $valor);

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            return "Ocurrió un error al procesar la transferencia. Intenta de nuevo.";
        }

        return null; // éxito
    }
}