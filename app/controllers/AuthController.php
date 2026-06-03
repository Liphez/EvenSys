<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController
{
    public function index()
    {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function processarLogin()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            $_SESSION['erro_login'] = "Preencha todos os campos.";
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $usuario = Usuario::buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario->senha_hash)) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['usuario_nome'] = $usuario->nome;
            $_SESSION['usuario_perfil'] = $usuario->perfil;

            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        } else {
            $_SESSION['erro_login'] = "E-mail ou senha incorretos.";
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function cadastro()
    {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        
        require_once __DIR__ . '/../views/auth/cadastro.php';
    }

    public function processarCadastro()
    {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha)) {
            $_SESSION['erro_cadastro'] = "Todos os campos são obrigatórios.";
            header('Location: ' . BASE_URL . '/cadastro');
            exit;
        }

        if (Usuario::buscarPorEmail($email)) {
            $_SESSION['erro_cadastro'] = "Este e-mail já está cadastrado.";
            header('Location: ' . BASE_URL . '/cadastro');
            exit;
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        if (Usuario::criar($nome, $email, $senha_hash, 'organizador')) {
            $_SESSION['sucesso_cadastro'] = "Conta criada com sucesso! Faça login.";
            header('Location: ' . BASE_URL . '/login');
            exit;
        } else {
            $_SESSION['erro_cadastro'] = "Erro ao criar conta no banco de dados.";
            header('Location: ' . BASE_URL . '/cadastro');
            exit;
        }
    }
}