<?php
class UsuarioController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];

            // 1. Hasheamos la contraseña
            $passwordHash = password_hash($passwordPlana, PASSWORD_DEFAULT);

            // 2. Creamos el OBJETO Usuario (sin ID, porque es nuevo)
            $nuevoUsuario = new Usuario($email, $passwordHash);

            // 3. Pasamos el objeto al gestor
            $this->gestor->registrarUsuario($nuevoUsuario);

            header("Location: index.php?accion=login");
            exit;
        }

        include "views/alta.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];
            $recordar = isset($_POST['recordarme']); // Checkbox en tu HTML

            // 1. Buscamos al usuario (ahora devuelve un OBJETO Usuario o false)
            $usuario = $this->gestor->buscarUsuarioPorEmail($email);

            // 2. Usamos los GETTERS del objeto para la validación
            if ($usuario && password_verify($passwordPlana, $usuario->getPassword())) {
                
                // ¡Login correcto! 
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuarioEmail'] = $usuario->getEmail(); 

                // 2. Gestión de COOKIES para "Recordarme"
                if ($recordar) {
                    // Creamos un token único (puedes guardarlo en BD para más seguridad)
                    $token = base64_encode($usuario->getEmail()); 
                    
                    // Seteamos la cookie: dura 30 días
                    setcookie(
                        "usuario_login", 
                        $token, 
                        [
                            'expires' => time() + (86400 * 30), // 30 días
                            'path' => '/',
                            'httponly' => true,  // Seguridad: No accesible por JS
                            'samesite' => 'Strict' 
                        ]
                    );
                }

                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        }

        include "views/login.php";
    }

    public function logout() {
        // Vaciamos las variables de sesión
        $_SESSION = [];
        
        // Destruimos la sesión completamente
        session_destroy();
        
        // 3. Eliminamos la cookie al cerrar sesión
        if (isset($_COOKIE['usuario_login'])) {
            setcookie('usuario_login', '', time() - 3600000, '/');
        }

        // Redirigimos al inicio
        header("Location: index.php?accion=login");
        exit;
    }






}