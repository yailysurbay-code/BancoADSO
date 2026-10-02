<?php

namespace App\Repositorios;

use App\Modelos\Retiro;
use PDO;

class RepositorioRetiros
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function crear(int $cuentaId, float $valor): void
    {
        $sql = "INSERT INTO retiros (cuenta_id, valor) VALUES (:cuenta_id, :valor)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cuenta_id' => $cuentaId, 'valor' => $valor]);
    }

    public function listarPorCuenta(int $cuentaId): array
    {
        $sql = "SELECT id, cuenta_id, valor, fecha FROM retiros WHERE cuenta_id = :cuenta_id ORDER BY fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cuenta_id' => $cuentaId]);
        $filas = $stmt->fetchAll();

        $retiros = [];
        foreach ($filas as $fila) {
            $retiros[] = new Retiro((int) $fila['id'], (int) $fila['cuenta_id'], (float) $fila['valor'], $fila['fecha']);
        }

        return $retiros;
    }
}