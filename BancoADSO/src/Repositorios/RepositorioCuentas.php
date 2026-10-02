<?php

namespace App\Repositorios;

use App\Modelos\Cuenta;
use PDO;

class RepositorioCuentas
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarPorNumero(string $numeroCuenta): ?Cuenta
    {
        $sql = "SELECT id, cliente_id, numero_cuenta, saldo FROM cuentas WHERE numero_cuenta = :numero_cuenta";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['numero_cuenta' => $numeroCuenta]);
        $fila = $stmt->fetch();

        if (!$fila) {
            return null;
        }

        return new Cuenta((int) $fila['id'], (int) $fila['cliente_id'], $fila['numero_cuenta'], (float) $fila['saldo']);
    }

    public function buscarPorId(int $id): ?Cuenta
    {
        $sql = "SELECT id, cliente_id, numero_cuenta, saldo FROM cuentas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $fila = $stmt->fetch();

        if (!$fila) {
            return null;
        }

        return new Cuenta((int) $fila['id'], (int) $fila['cliente_id'], $fila['numero_cuenta'], (float) $fila['saldo']);
    }

    public function actualizarSaldo(int $id, float $nuevoSaldo): void
    {
        $sql = "UPDATE cuentas SET saldo = :saldo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['saldo' => $nuevoSaldo, 'id' => $id]);
    }
}