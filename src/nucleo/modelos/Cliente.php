
<?php
namespace BancoADSO\modelos;

class Cliente
{
    private $id;
    private $nombre;
    private $documento;
    private $correo;

    public function __construct($nombre, $documento, $correo)
    {
        $this->nombre = $nombre;
        $this->documento = $documento;
        $this->correo = $correo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    public function getCorreo()
    {
        return $this->correo;
    }
}

