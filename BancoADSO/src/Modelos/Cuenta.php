<?php

namespace App\Modelos;

class Cuenta
{
    private int $id;
    private int $clienteId;
    private string $numeroCuenta;
    private float $saldo;

    public function __construct(int $id, int $clienteId, string $numeroCuenta, float $saldo)
    {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->numeroCuenta = $numeroCuenta;
        $this->saldo = $saldo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getClienteId(): int
    {
        return $this->clienteId;
    }

    public function getNumeroCuenta(): string
    {
        return $this->numeroCuenta;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}