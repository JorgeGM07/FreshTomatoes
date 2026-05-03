<?php

class Indie extends Pelicula{

    private $numEquipo;

    private $diasRodaje;

    public function __construct($duracion, $genero, $director, $edad, $numEquipo, $diasRodaje, $id=0) {
        parent::__construct($id, $duracion, $genero, $director, $edad);
        $this->numEquipo = $numEquipo;
        $this->diasRodaje = $diasRodaje;
    }

    public function getNumeroEquipo()
    {
        return $this->numEquipo;
    }

    public function setNumEquipo($numEquipo): self
    {
        $this->numEquipo = $numEquipo;
        return $this;
    }
    public function getDiasRodaje()
    {
        return $this->diasRodaje;
    }

    public function setDiasRodaje($diasRodaje): self
    {
        $this->diasRodaje = $diasRodaje;
        return $this;
    }
}