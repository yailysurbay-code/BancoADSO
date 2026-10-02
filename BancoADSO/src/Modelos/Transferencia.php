<?php

namespace App\Modelos;

class Transferencia
{
    private int $id;
    private int $cuentaOrigenId;
    private int $cuentaDestinoId;
    private float $valor;
    private string $fecha;

    public function __construct(int $id, int $cuentaOrigenId, int $cuentaDestinoId, float $valor, string $fecha)
    {
        $this->id = $id;
        $this->cuentaOrigenId = $cuentaOrigenId;
        $this->cuentaDestinoId = $cuentaDestinoId;
        $this->valor = $valor;
        $this->fecha = $fecha;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaOrigenId(): int
    {
        return $this->cuentaOrigenId;
    }

    public function getCuentaDestinoId(): int
    {
        return $this->cuentaDestinoId;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }
}

?>