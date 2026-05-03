<?php
class Pelicula {
    protected $id;
    protected $duracion;
    protected $genero;
    protected $director;
    protected $edad;

    public function __construct($id, $duracion, $genero, $director, $edad) {
        $this->id = $id;
        $this->duracion = $duracion;
        $this->genero = $genero;
        $this->director = $director;
        $this->edad = $edad;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function setDuracion($duracion): self
    {
        $this->duracion = $duracion;
        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero): self
    {
        $this->genero = $genero;
        return $this;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director): self
    {
        $this->director = $director;
        return $this;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad): self
    {
        $this->edad = $edad;
        return $this;
    }
}