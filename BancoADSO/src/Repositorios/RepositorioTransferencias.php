<?php

namespace App\Repositorios;

use App\Modelos\Transferencia;
use PDO;

class RepositorioTransferencias
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function crear(int $cuentaOrigenId, int $cuentaDestinoId, float $valor): void
    {
        $sql = "INSERT INTO transferencias (cuenta_origen_id, cuenta_destino_id, valor) 
                VALUES (:origen, :destino, :valor)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'origen' => $cuentaOrigenId,
            'destino' => $cuentaDestinoId,
            'valor' => $valor,
        ]);
    }

    public function listarEnviadasPorCuenta(int $cuentaOrigenId): array
    {
        $sql = "SELECT id, cuenta_origen_id, cuenta_destino_id, valor, fecha 
                FROM transferencias WHERE cuenta_origen_id = :cuenta_id ORDER BY fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cuenta_id' => $cuentaOrigenId]);
        $filas = $stmt->fetchAll();

        $transferencias = [];
        foreach ($filas as $fila) {
            $transferencias[] = new Transferencia(
                (int) $fila['id'],
                (int) $fila['cuenta_origen_id'],
                (int) $fila['cuenta_destino_id'],
                (float) $fila['valor'],
                $fila['fecha']
            );
        }

        return $transferencias;
    }
}