<?php

namespace App\Nucleo;

class Router
{
    private array $rutas = [];

    public function agregar(string $ruta, callable $accion): void
    {
        $this->rutas[$ruta] = $accion;
    }

    public function despachar(string $rutaActual): void
    {
        if (!isset($this->rutas[$rutaActual])) {
            http_response_code(404);
            echo "Página no encontrada";
            return;
        }

        call_user_func($this->rutas[$rutaActual]);
    }
}