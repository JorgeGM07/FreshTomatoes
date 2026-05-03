<!DOCTYPE html>
<html>
<head>
    <title>Fresh Tomatoes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Fresh Tomatoes</h1>

    <div class="sesion">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            Bienvenido, <b><?= $_SESSION['usuarioEmail'] ?></b> | 
            <a href="index.php?accion=logout">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar Sesión</a> | 
            <a href="index.php?accion=alta">Registrarse</a>
        <?php endif; ?>
    </div>

    <a href="index.php?accion=crear" class="btn-agregar">+ Agregar Película</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Duración (min)</th>
            <th>Género</th>
            <th>Director</th>
            <th>Edad mínima</th>
            <th>Nº Equipo</th>
            <th>Días de rodaje</th>
            <th>Presupuesto (M€)</th>
            <th>Actor estrella</th>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>

        <?php foreach ($vehiculos as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>
            <td><?= ($p instanceof Indie) ? "Indie" : "Blockbuster"; ?></td>
            <td><?= $p->getDuracion() ?></td>
            <td><?= $p->getGenero() ?></td>
            <td><?= $p->getDirector() ?></td>
            <td><?= $p->getEdad() ?></td>
            <td><?= ($p instanceof Indie) ? $p->getNumeroEquipo() : "--"; ?></td>
            <td><?= ($p instanceof Indie) ? $p->getDiasRodaje() : "--"; ?></td>
            <td><?= ($p instanceof Blockbuster) ? $p->getPresupuesto() . "M" : "--"; ?></td>
            <td><?= ($p instanceof Blockbuster) ? $p->getActorEstrella() : "--"; ?></td>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <td>
                    <a href="index.php?accion=editar&id=<?= $p->getId() ?>" class="btn-editar">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>" class="btn-eliminar">Eliminar</a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>