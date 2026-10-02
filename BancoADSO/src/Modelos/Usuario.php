<?php

namespace App\Modelos;

class Usuario
{
    private int $id;
    private int $cuentaId;
    private string $claveHash;

    public function __construct(int $id, int $cuentaId, string $claveHash)
    {
        $this->id = $id;
        $this->cuentaId = $cuentaId;
        $this->claveHash = $claveHash;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCuentaId(): int
    {
        return $this->cuentaId;
    }

    public function getClaveHash(): string
    {
        return $this->claveHash;
    }
}


?>