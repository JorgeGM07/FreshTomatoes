<!DOCTYPE html>
<html>
<head>
    <title>Crear Película</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Crear Película</h1>

    <form method="POST">
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo" required>
            <option value="Indie">Indie</option>
            <option value="Blockbuster">Blockbuster</option>
        </select>

        <label for="duracion">Duración (min)</label>
        <input type="number" name="duracion" id="duracion" required>

        <label for="genero">Género</label>
        <input type="text" name="genero" id="genero" required>

        <label for="director">Director</label>
        <input type="text" name="director" id="director" required>

        <label for="edad">Edad mínima</label>
        <input type="number" name="edad" id="edad" required>

        <label for="numEquipo">Número de personas en el equipo (Indie)</label>
        <input type="number" name="numEquipo" id="numEquipo">

        <label for="diasRodaje">Días de rodaje (Indie)</label>
        <input type="number" name="diasRodaje" id="diasRodaje">

        <label for="presupuesto">Presupuesto en Millones de € (Blockbuster)</label>
        <input type="number" step="0.01" name="presupuesto" id="presupuesto">

        <label for="actorEstrella">Actor estrella (Blockbuster)</label>
        <input type="text" name="actorEstrella" id="actorEstrella">

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php" class="link-secundario">← Volver</a>
</body>
</html>