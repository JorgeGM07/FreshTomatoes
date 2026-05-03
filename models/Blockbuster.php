<?php

class Blockbuster extends Pelicula{

    private $presupuesto;

    private $actorEstrella;

    public function __construct($duracion, $genero, $director, $edad, $presupuesto, $actorEstrella, $id=0) {
        parent::__construct($id, $duracion, $genero, $director, $edad);
        $this->presupuesto = $presupuesto;
        $this->actorEstrella = $actorEstrella;
    }

    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    public function setPresupuesto($presupuesto): self
    {
        $this->presupuesto = $presupuesto;
        return $this;
    }
    public function getActorEstrella()
    {
        return $this->actorEstrella;
    }

    public function setActorEstrella($actorEstrella): self
    {
        $this->actorEstrella = $actorEstrella;
        return $this;
    }
}