<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p class="error"><b>Error:</b> <?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>

        <label>
            <input type="checkbox" name="recordarme"> Recordarme en este equipo
        </label>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <p>¿No tienes cuenta? <a href="index.php?accion=alta">Regístrate aquí</a></p>
    <a href="index.php" class="link-secundario">← Volver al inicio</a>
</body>
</html>