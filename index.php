<?php
require_once "autoload.php";
session_start();

$gestor=new GestorPDO();
$controller = new PeliculaController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

// --- LÓGICA DE COOKIES: RE-AUTENTICACIÓN AUTOMÁTICA ---
// Si NO hay sesión iniciada, pero SÍ existe la cookie "usuario_login"
if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    
    // 1. Recuperamos el email que guardamos en la cookie (estaba en Base64)
    $emailRecuperado = base64_decode($_COOKIE['usuario_login']);
    
    // 2. Buscamos al usuario en la base de datos
    $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);
    
    // 3. Si el usuario existe, restauramos la sesión automáticamente
    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuarioEmail'] = $usuario->getEmail();
    } else {// Si la cookie es falsa o el usuario ya no existe, borramos la cookie por seguridad

        setcookie('usuario_login', '', time() - 3600, '/');
    }
}
// ------------------------------------------------------

switch ($accion) {
    //opciones para la gestión de los usuarios
    case 'login':
        $usuarioController->login();
        break;
    case 'alta':
        $usuarioController->alta();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    //opciones para la gestión de los vehículos. Técnica fall-throught
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        // Si está autenticado, dejamos que ejecute la acción
        if ($accion === 'crear') $controller->crear();
        if ($accion === 'editar') $controller->editar();
        if ($accion === 'eliminar') $controller->eliminar();
        break;
    default:
        $controller->index();
}
