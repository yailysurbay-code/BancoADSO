<?php

namespace App\Modelos;

class Retiro
{
    private int $id;
    private int $cuentaId;
    private float $valor;
    private string $fecha;

    public function __construct(int $id, int $cuentaId, float $valor, string $fecha)
    {
        $this->id = $id;
        $this->cuentaId = $cuentaId;
        $this->valor = $valor;
        $this->fecha = $fecha;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaId(): int
    {
        return $this->cuentaId;
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