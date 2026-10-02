<?php

namespace App\Modelos;

class Cliente
{
    private int $id;
    private string $nombre;
    private string $documento;
    private string $correo;

    public function __construct(int $id, string $nombre, string $documento, string $correo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->documento = $documento;
        $this->correo = $correo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }
}