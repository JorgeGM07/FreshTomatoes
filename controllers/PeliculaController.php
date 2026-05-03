<?php

class PeliculaController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $vehiculos = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            $duracion = $_POST['duracion'];
            $genero = $_POST['genero'];
            $director = $_POST['director'];
            $edad = $_POST['edad'];
            if ($_POST['tipo']=="Indie"){
                $numEquipo = $_POST['numEquipo']; 
                $diasRodaje = $_POST['diasRodaje']; 
                $pelicula = new Indie ($duracion, $genero, $director, $edad, $numEquipo, $diasRodaje);
            }else{
                $presupuesto = $_POST['presupuesto'];
                $actorEstrella = $_POST['actorEstrella'];
                $pelicula = new Blockbuster ($duracion, $genero, $director, $edad, $presupuesto, $actorEstrella);
            }
            $this->gestor->agregar($pelicula);

            header("Location: index.php");
            exit;
        }

        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $pelicula=($this->gestor->buscar($id));
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pelicula->setDuracion($_POST['duracion']);
            $pelicula->setGenero($_POST['genero']);
            $pelicula->setDirector($_POST['director']);
            $pelicula->setEdad($_POST['edad']);
            if ($pelicula instanceof Indie){
                $pelicula->setNumEquipo($_POST['numEquipo']);
                $pelicula->setDiasRodaje($_POST['diasRodaje']);
            }else{
                $pelicula->setPresupuesto($_POST['presupuesto']);
                $pelicula->setActorEstrella($_POST['actorEstrella']);
            }
            

            $this->gestor->actualizar($pelicula);
            header("Location: index.php");
            exit;
        }

        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}
