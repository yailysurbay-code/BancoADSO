<?php

namespace App\Repositorios;

use App\Modelos\Usuario;
use PDO;

class RepositorioUsuarios
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function buscarPorCuentaId(int $cuentaId): ?Usuario
    {
        $sql = "SELECT id, cuenta_id, clave_hash FROM usuarios WHERE cuenta_id = :cuenta_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['cuenta_id' => $cuentaId]);
        $fila = $stmt->fetch();

        if (!$fila) {
            return null;
        }

        return new Usuario((int) $fila['id'], (int) $fila['cuenta_id'], $fila['clave_hash']);
    }
}