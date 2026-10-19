<?php

class Incidencia
{
    private ?int $id;
    private string $nombre;
    private string $descripcion;
    private string $prioridad;
    private string $usuarioUsername;
    private ?string $fechaRegistro;

    public function __construct(
        string $nombre,
        string $descripcion,
        string $prioridad,
        string $usuarioUsername,
        ?int $id = null,
        ?string $fechaRegistro = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->prioridad = $prioridad;
        $this->usuarioUsername = $usuarioUsername;
        $this->fechaRegistro = $fechaRegistro;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
    public function getPrioridad(): string
    {
        return $this->prioridad;
    }
    public function getUsuarioUsername(): string
    {
        return $this->usuarioUsername;
    }
    public function getFechaRegistro(): ?string
    {
        return $this->fechaRegistro;
    }

    // Generador del CUI visual si quieres mostrarlo en detalle.php
    public function getCodigoFormateado(): string
    {
        $num = str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
        $fecha = $this->fechaRegistro ? date('Ymd', strtotime($this->fechaRegistro)) : date('Ymd');
        return "INC-{$num}-{$fecha}";
    }
}
