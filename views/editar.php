<!DOCTYPE html>
<html>
<head>
    <title>Editar Película</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Película</h1>

    <form method="POST">
        <label for="duracion">Duración (min)</label>
        <input type="number" name="duracion" id="duracion" value="<?= $pelicula->getDuracion() ?>" required>

        <label for="genero">Género</label>
        <input type="text" name="genero" id="genero" value="<?= $pelicula->getGenero() ?>" required>

        <label for="director">Director</label>
        <input type="text" name="director" id="director" value="<?= $pelicula->getDirector() ?>" required>

        <label for="edad">Edad mínima</label>
        <input type="number" name="edad" id="edad" value="<?= $pelicula->getEdad() ?>" required>

        <?php if ($pelicula instanceof Indie): ?>
            <label for="numEquipo">Número de equipo</label>
            <input type="number" name="numEquipo" id="numEquipo" value="<?= $pelicula->getNumeroEquipo() ?>" required>

            <label for="diasRodaje">Días de rodaje</label>
            <input type="number" name="diasRodaje" id="diasRodaje" value="<?= $pelicula->getDiasRodaje() ?>" required>
        <?php endif; ?>

        <?php if ($pelicula instanceof Blockbuster): ?>
            <label for="presupuesto">Presupuesto (M€)</label>
            <input type="number" step="0.01" name="presupuesto" id="presupuesto" value="<?= $pelicula->getPresupuesto() ?>" required>

            <label for="actorEstrella">Actor estrella</label>
            <input type="text" name="actorEstrella" id="actorEstrella" value="<?= $pelicula->getActorEstrella() ?>" required>
        <?php endif; ?>

        <button type="submit">Actualizar Película</button>
    </form>

    <br>
    <a href="index.php" class="link-secundario">← Volver al listado</a>
</body>
</html>