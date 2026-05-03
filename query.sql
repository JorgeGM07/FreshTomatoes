CREATE DATABASE FreshTomatoes;
USE FreshTomatoes;
CREATE TABLE listaPeliculas (
    id INT AUTO_INCREMENT PRIMARY KEY, --
    tipoPelicula ENUM('Indie', 'Blockbuster') NOT NULL, --
    duracion INT(10), --
    genero VARCHAR(100), --
    director VARCHAR(50), --
    edad INT(2), --
    numEquipo INT(10) NULL, --
    diasRodaje INT(10) NULL, --
    presupuesto DECIMAL(10, 2) NULL, --
    actorEstrella VARCHAR(50) NULL --
);