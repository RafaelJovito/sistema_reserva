<?php

require_once 'models/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function autenticarUsuario($username, $password) {
        // Verifica as credenciais do usuário no modelo
        $usuario = $this->userModel->getUserByUsername($username);
    
        if ($usuario && $password === $usuario['senha']) {
            // As credenciais são válidas, retorna true
            return true;
        } else {
            // As credenciais são inválidas, retorna false
            return false;
        }
    }
}