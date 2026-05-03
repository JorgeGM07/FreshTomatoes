<?php

class GestorPDO{

    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConn();
    }

    public function listar() {
        $consulta="SELECT * FROM listaPeliculas";
        $rtdo=$this->db->query($consulta);
        $arrayPeliculas=[];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)){
            if ($value['tipoPelicula']=="Indie"){
                $pelicula = new Indie ($value['duracion'], $value['genero'], $value['director'], $value['edad'], $value['numEquipo'], $value['diasRodaje'], $value['id']);
            }else{
                $pelicula = new Blockbuster ($value['duracion'], $value['genero'], $value['director'], $value['edad'], $value['presupuesto'], $value['actorEstrella'], $value['id']);
            }
            
            $arrayPeliculas[]=$pelicula;
        }
        return $arrayPeliculas;
    }
    public function agregar($pelicula) {
        try {
            if ($pelicula instanceof Indie){
                $sql = "INSERT INTO listaPeliculas (tipoPelicula, duracion, genero, director, edad, numEquipo, diasRodaje) VALUES (:tipoPelicula, :duracion, :genero, :director, :edad, :numEquipo, :diasRodaje)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipoPelicula', "Indie");
                $stmt->bindValue(':duracion', $pelicula->getDuracion());
                $stmt->bindValue(':genero', $pelicula->getGenero());
                $stmt->bindValue(':director', $pelicula->getDirector());
                $stmt->bindValue(':edad', $pelicula->getEdad());
                $stmt->bindValue(':numEquipo', $pelicula->getNumeroEquipo());
                $stmt->bindValue(':diasRodaje', $pelicula->getDiasRodaje());
            }else{
                $sql = "INSERT INTO listaPeliculas (tipoPelicula, duracion, genero, director, edad, presupuesto, actorEstrella) VALUES (:tipoPelicula, :duracion, :genero, :director, :edad, :presupuesto, :actorEstrella)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':tipoPelicula', "Blockbuster");
                $stmt->bindValue(':duracion', $pelicula->getDuracion());
                $stmt->bindValue(':genero', $pelicula->getGenero());
                $stmt->bindValue(':director', $pelicula->getDirector());
                $stmt->bindValue(':edad', $pelicula->getEdad());
                $stmt->bindValue(':presupuesto', $pelicula->getPresupuesto());
                $stmt->bindValue(':actorEstrella', $pelicula->getActorEstrella());
            }
           // Ejecutamos
            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            //código que quiera para mostrar
            return false;
        }
    }
    
    public function buscar($id) {
        $sql = "SELECT * FROM listaPeliculas WHERE id = :id";
        $stmt = $this->conn->prepare($sql); // Mejor usar prepare para evitar inyección SQL
        $stmt->bindValue(':id', $id);
        $stmt->execute();
 
        if ($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($value['tipoPelicula'] == "Indie") {
                return new Indie($value['duracion'], $value['genero'], $value['director'], $value['edad'], $value['numEquipo'], $value['diasRodaje'], $value['id']);
            } else {
                return new Blockbuster($value['duracion'], $value['genero'], $value['director'], $value['edad'], $value['presupuesto'], $value['actorEstrella'], $value['id']);
            }
        }
        return null;
    }

    public function actualizar($pelicula) {
        try {
            if ($pelicula instanceof Indie){
                $sql="UPDATE listaPeliculas SET tipoPelicula=:tipoPelicula, duracion=:duracion, genero=:genero, director=:director, edad=:edad, numEquipo=:numEquipo, diasRodaje=:diasRodaje WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $pelicula->getId());
                $stmt->bindValue(':tipoPelicula', "Indie");
                $stmt->bindValue(':duracion', $pelicula->getDuracion());
                $stmt->bindValue(':genero', $pelicula->getGenero());
                $stmt->bindValue(':director', $pelicula->getDirector());
                $stmt->bindValue(':edad', $pelicula->getEdad());
                $stmt->bindValue(':numEquipo', $pelicula->getNumeroEquipo());
                $stmt->bindValue(':diasRodaje', $pelicula->getDiasRodaje());
            }else{
                $sql="UPDATE listaPeliculas SET tipoPelicula=:tipoPelicula, duracion=:duracion, genero=:genero, director=:director, edad=:edad, presupuesto=:presupuesto, actorEstrella=:actorEstrella WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $pelicula->getId());
                $stmt->bindValue(':tipoPelicula', "Blockbuster");
                $stmt->bindValue(':duracion', $pelicula->getDuracion());
                $stmt->bindValue(':genero', $pelicula->getGenero());
                $stmt->bindValue(':director', $pelicula->getDirector());
                $stmt->bindValue(':edad', $pelicula->getEdad());
                $stmt->bindValue(':presupuesto', $pelicula->getPresupuesto());
                $stmt->bindValue(':actorEstrella', $pelicula->getActorEstrella());
            } 
        // Ejecutamos
            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            die("Error de la base de datos al actualizar: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        $sql="DELETE FROM listaPeliculas WHERE id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    //operaciones de gestión de usuarios
    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);

            // Usamos los getters del objeto
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());

            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si encontró algo, creamos y devolvemos el objeto Usuario
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        // Si no existe, devolvemos false o null
        return false;
    }
}